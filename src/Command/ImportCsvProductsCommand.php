<?php

namespace App\Command;

use Pimcore\Console\AbstractCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Pimcore\Model\DataObject;
use Pimcore\Model\DataObject\CategoryItem;
use Pimcore\Model\DataObject\ProducentInfo;
use Pimcore\Model\DataObject\Product;
use Pimcore\Model\Asset;
use Pimcore\Model\DataObject\Data\ImageGallery;
use Pimcore\Model\DataObject\Data\Hotspotimage;
use Pimcore\Model\Element\Service;

class ImportCsvProductsCommand extends AbstractCommand
{
    const CATEGORIES_PATH = '/Produkcja/Kategorie';
    const PRODUCERS_PATH = '/Produkcja/Producenci';
    const PRODUCTS_PATH = '/Produkcja/Produkty';
    const ASSETS_PATH = PIMCORE_PROJECT_ROOT . '/assets/import';
    const ASSETS_TARGET_PATH = '/import';


    protected function configure()
    {
        $this
            ->setName('app:import-products')
            ->setDescription('Importuje produkty z pliku CSV do Pimcore');
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $this->initializeFolders($output);
            
            $csvPath = PIMCORE_PROJECT_ROOT . '/var/data/import/products.csv';
            if (!$this->validateCsvFile($csvPath, $output)) {
                return self::FAILURE;
            }

            $data = $this->parseCsv($csvPath, $output);
            if (empty($data)) {
                $output->writeln('<comment>Brak danych do importu w pliku CSV</comment>');
                return self::SUCCESS;
            }

            // ETAP 1: Importuj wszystkie kategorie i producentów
            $categories = [];
            $producers = [];
            
            foreach ($data as $item) {
                $categoryName = trim($item['Kategoria'] ?? '');
                if ($categoryName && !isset($categories[$categoryName])) {
                    $category = $this->getOrCreateCategory($categoryName, $output);
                    if ($category) {
                        $categories[$categoryName] = $category;
                    }
                }

                $producerName = trim($item['Producent'] ?? '');
                $producerNip = trim($item['NIP'] ?? '');
                if ($producerName && !isset($producers[$producerName])) {
                    $producer = $this->getOrCreateProducer($producerName, $producerNip, $output);
                    if ($producer) {
                        $producers[$producerName] = $producer;
                    }
                }
            }

            // ETAP 2: Importuj produkty
            $results = ['imported' => 0, 'skipped' => 0, 'failed' => 0];
            
            foreach ($data as $item) {
                $sku = trim($item['SKU'] ?? '');
                if (empty($sku)) {
                    $output->writeln('<comment>Pominięto wiersz - brak SKU</comment>');
                    $results['failed']++;
                    continue;
                }

                try {
                    if ($this->productExists($sku)) {
                        $results['skipped']++;
                        $output->writeln("<comment>Pominięto istniejący produkt: {$sku}</comment>");
                        continue;
                    }

                    $product = new Product();
                    $product->setKey(Service::getValidKey($sku, 'object'));
                    $product->setParent(DataObject::getByPath(self::PRODUCTS_PATH));
                    $product->setPublished(true); // Ustawiamy od razu na opublikowane
                    $product->setClassName('Product');
                    
                    // Ustawianie podstawowych właściwości
                    $product->setSku($sku);
                    $product->setNazwa(trim($item['Nazwa'] ?? ''));
                    $product->setOpis(trim($item['Opis'] ?? ''));
                    $product->setCena((float)($item['Cena'] ?? 0));
                    $product->setStatus((int)($item['Status'] ?? 0));

                    // Ustawianie relacji
                    $categoryName = trim($item['Kategoria'] ?? '');
                    if ($categoryName && isset($categories[$categoryName])) {
                        $product->setKategoria($categories[$categoryName]);
                    }

                    $producerName = trim($item['Producent'] ?? '');
                    if ($producerName && isset($producers[$producerName])) {
                        $product->setProducent($producers[$producerName]);
                    }

                    // Dodawanie obrazków
                    $this->addImagesToProduct($product, $item['Zdjecia'] ?? '', $output);

                    // Dodawanie dokumentów
                    $this->addDocumentToProduct($product, $item['Dokumentacja'] ?? '', $output);

                    // Zapisz produkt
                    $product->save();

                    $results['imported']++;
                    $output->writeln("<info>Zaimportowano produkt: {$sku}</info>");

                } catch (\Exception $e) {
                    $results['failed']++;
                    $output->writeln("<error>Błąd importu produktu {$sku}: " . $e->getMessage() . "</error>");
                    
                    if ($output->isVerbose()) {
                        $output->writeln("<error>Trace: " . $e->getTraceAsString() . "</error>");
                    }
                }
            }

            // Podsumowanie
            $output->writeln([
                '',
                '<comment>Podsumowanie importu:</comment>',
                "<info>Zaimportowano: {$results['imported']}</info>",
                "<comment>Pominięto istniejące: {$results['skipped']}</comment>",
                ($results['failed'] > 0 ? "<error>" : "<comment>") . 
                "Niepowodzenia: {$results['failed']}" . 
                ($results['failed'] > 0 ? "</error>" : "</comment>"),
                ''
            ]);

            return $results['failed'] > 0 ? self::FAILURE : self::SUCCESS;

        } catch (\Throwable $e) {
            $output->writeln([
                '<error>Krytyczny błąd podczas importu:</error>',
                "<error>" . $e->getMessage() . "</error>",
                $output->isVerbose() ? "<error>" . $e->getTraceAsString() . "</error>" : ''
            ]);
            return self::FAILURE;
        }
    }

    private function initializeFolders(OutputInterface $output): void
{
    $this->ensureFolderExists(self::CATEGORIES_PATH, $output);
    $this->ensureFolderExists(self::PRODUCERS_PATH, $output);
    $this->ensureFolderExists(self::PRODUCTS_PATH, $output);
    
    // Utwórz folder dla assetów jeśli nie istnieje
    $assetsFolder = Asset::getByPath(self::ASSETS_TARGET_PATH);
    if (!$assetsFolder) {
        $assetsFolder = new Asset\Folder();
        $assetsFolder->setParent(Asset::getByPath('/'));
        $assetsFolder->setKey(basename(self::ASSETS_TARGET_PATH));
        $assetsFolder->save();
        $output->writeln("<info>Utworzono folder assetów: " . self::ASSETS_TARGET_PATH . "</info>");
    }
}

    private function ensureFolderExists(string $path, OutputInterface $output): void
    {
        $folder = DataObject::getByPath($path);
        
        if (!$folder) {
            $parts = explode('/', trim($path, '/'));
            $currentPath = '';
            $parent = DataObject::getByPath('/');
            
            foreach ($parts as $part) {
                $currentPath .= '/' . $part;
                $folder = DataObject::getByPath($currentPath);
                
                if (!$folder) {
                    $folder = new DataObject\Folder();
                    $folder->setKey($part);
                    $folder->setParent($parent);
                    $folder->save();
                    $output->writeln("Utworzono folder: {$currentPath}");
                }
                
                $parent = $folder;
            }
        }
    }

    private function validateCsvFile(string $path, OutputInterface $output): bool
    {
        if (!file_exists($path)) {
            $output->writeln("<error>Plik CSV nie istnieje: {$path}</error>");
            return false;
        }

        if (filesize($path) === 0) {
            $output->writeln('<error>Plik CSV jest pusty</error>');
            return false;
        }

        return true;
    }

    private function parseCsv(string $path, OutputInterface $output): ?array
    {
        $rows = array_map('str_getcsv', file($path));
        if (empty($rows)) {
            $output->writeln('<error>Nie udało się przetworzyć pliku CSV</error>');
            return null;
        }

        $header = array_shift($rows);
        if (!$header) {
            $output->writeln('<error>Brak nagłówka w pliku CSV</error>');
            return null;
        }

        $data = [];
        foreach ($rows as $i => $row) {
            if (count($row) !== count($header)) {
                $output->writeln("<comment>Pominięto wiersz {$i} - nieprawidłowa liczba kolumn</comment>");
                continue;
            }
            $data[] = array_combine($header, $row);
        }

        return $data;
    }

    private function importData(array $data, OutputInterface $output): array
    {
        $results = ['imported' => 0, 'skipped' => 0];

        foreach ($data as $item) {
            try {
                $sku = trim($item['SKU'] ?? '');
                if (empty($sku)) {
                    $output->writeln('<comment>Pominięto wiersz - brak SKU</comment>');
                    continue;
                }

                // Sprawdź czy produkt już istnieje
                if ($this->productExists($sku)) {
                    $results['skipped']++;
                    continue;
                }

                // Przygotuj dane
                $category = $this->getOrCreateCategory($item['Kategoria'] ?? '', $output);
                $producer = $this->getOrCreateProducer(
                    $item['Producent'] ?? '',
                    $item['NIP'] ?? '',
                    $output
                );

                // Utwórz produkt
                $product = new Product();
                $product->setKey(Service::getValidKey($sku, 'object'));
                $product->setParent(DataObject::getByPath(self::PRODUCTS_PATH));
                $product->setPublished(true);
                
                // Ustaw podstawowe właściwości
                $product->setSku($sku);
                $product->setNazwa(trim($item['Nazwa'] ?? ''));
                $product->setOpis(trim($item['Opis'] ?? ''));
                $product->setCena((float)($item['Cena'] ?? 0));
                $product->setStatus(trim($item['Status'] ?? ''));
                
                // Ustaw relacje
                if ($category) {
                    $product->setKategoria($category);
                }
                if ($producer) {
                    $product->setProducent($producer);
                }

                // Dodaj zdjęcia
                $this->addImagesToProduct($product, $item['Zdjecia'] ?? '', $output);

                $product->save();
                $results['imported']++;
                $output->writeln("<info>Zaimportowano produkt: {$sku}</info>");

            } catch (\Exception $e) {
                $output->writeln("<error>Błąd importu produktu: " . $e->getMessage() . "</error>");
                continue;
            }
        }

        return $results;
    }

    private function productExists(string $sku): bool
    {
        $product = Product::getBySku($sku, ['limit' => 1, 'unpublished' => true]);
        return $product instanceof Product;
    }

    private function getOrCreateCategory(string $name, OutputInterface $output): ?CategoryItem
    {
        $name = trim($name);
        if (empty($name)) {
            return null;
        }

        // WYMUSZENIE ŚWIEŻEGO WYSZUKIWANIA
        $category = CategoryItem::getByKategoria($name, [
            'limit' => 1,
            'unpublished' => true,
            'force' => true // Pomija cache
        ]);

        if ($category) {
            // WERYFIKACJA LOKALIZACJI
            $expectedPath = self::CATEGORIES_PATH . '/' . $category->getKey();
            if ($category->getFullPath() !== $expectedPath) {
                $output->writeln("<error>Kategoria {$name} ma złą ścieżkę: {$category->getFullPath()}</error>");
                $output->writeln("<info>Przenoszenie do: {$expectedPath}</info>");
                
                $category->setParent(DataObject::getByPath(self::CATEGORIES_PATH));
                $category->save();
            }
            return $category;
        }

        // TWORZENIE NOWEJ KATEGORII Z WALIDACJĄ
        $parent = DataObject::getByPath(self::CATEGORIES_PATH);
        if (!$parent) {
            throw new \RuntimeException("Folder kategorii nie istnieje: " . self::CATEGORIES_PATH);
        }

        $category = new CategoryItem();
        $category->setKey(Service::getValidKey($name, 'object'));
        $category->setParent($parent); // JAWNE USTAWienie rodzica
        $category->setKategoria($name);
        $category->setPublished(true);
        
        // DEBUG: Weryfikacja przed zapisem
        $output->writeln("DEBUG: Tworzę kategorię '{$name}' w: " . $parent->getFullPath());
        
        $category->save();
        return $category;
    }

    private function getOrCreateProducer(string $name, string $nip, OutputInterface $output): ?ProducentInfo
    {
        $name = trim($name);
        if (empty($name)) {
            return null;
        }

        $nip = trim($nip);
        
        // WYMUSZENIE ŚWIEŻEGO WYSZUKIWANIA Z POMINIĘCIEM CACHE
        $producer = ProducentInfo::getByNazwa($name, [
            'limit' => 1,
            'unpublished' => true,
            'force' => true
        ]);
        
        if ($producer) {
            // WERYFIKACJA LOKALIZACJI PRODUCENTA
            $expectedPath = self::PRODUCERS_PATH . '/' . $producer->getKey();
            if ($producer->getFullPath() !== $expectedPath) {
                $output->writeln("<error>Producent {$name} ma złą ścieżkę: {$producer->getFullPath()}</error>");
                $output->writeln("<info>Przenoszenie do: {$expectedPath}</info>");
                
                try {
                    $producer->setParent(DataObject::getByPath(self::PRODUCERS_PATH));
                    $producer->save();
                    $output->writeln("<info>Poprawnie przeniesiono producenta {$name}</info>");
                } catch (\Exception $e) {
                    $output->writeln("<error>Błąd przenoszenia producenta {$name}: " . $e->getMessage() . "</error>");
                }
            }
            
            // Aktualizuj NIP jeśli jest różny
            if (!empty($nip) && $producer->getNIP() !== $nip) {
                $producer->setNIP($nip);
                $producer->save();
                $output->writeln("<info>Zaktualizowano NIP dla {$name} na {$nip}</info>");
            }
            return $producer;
        }

        // TWORZENIE NOWEGO PRODUCENTA Z WALIDACJĄ ŚCIEŻKI
        $parent = DataObject::getByPath(self::PRODUCERS_PATH);
        if (!$parent) {
            throw new \RuntimeException("Folder producentów nie istnieje: " . self::PRODUCERS_PATH);
        }

        // TWORZENIE NOWEGO PRODUCENTA
        $producer = new ProducentInfo();
        $producer->setKey(Service::getValidKey($name, 'object'));
        $producer->setParent(DataObject::getByPath(self::PRODUCERS_PATH));
        $producer->setNazwa($name);
        $producer->setNIP($nip);
        
        // USTAWIENIA GWARANTUJĄCE POPRAWNY STATUS
        $producer->setPublished(true); // 1. Wymuszenie publikacji
        $producer->setOmitMandatoryCheck(true); // 2. Pominięcie walidacji (tylko jeśli są problemy z wymaganymi polami)
        
        try {
            // 3. Zapis z wymuszeniem wersji
            $producer->save(['versionNote' => 'Import z CSV']);
            
            // 4. Publikacja wersji
            $latestVersion = $producer->getLatestVersion();
            if ($latestVersion) {
                $latestVersion->setPublic(true);
                $latestVersion->save();
            }
            
            $output->writeln("<info>Utworzono i opublikowano producenta: {$name}</info>");
            return $producer;
        } catch (\Exception $e) {
            $output->writeln("<error>Błąd tworzenia producenta {$name}: " . $e->getMessage() . "</error>");
            return null;
        }
    }

    private function addImagesToProduct(Product $product, string $imagesString, OutputInterface $output): void
{
    $images = array_filter(array_map('trim', explode(',', $imagesString)));
    $galleryItems = [];
    
    foreach ($images as $image) {
        $image = trim($image, "\"' ");
        if (empty($image)) {
            continue;
        }
        
        try {
            $filePath = self::ASSETS_PATH . '/' . $image;
            $assetPath = self::ASSETS_TARGET_PATH . '/' . $image;
            
            // Sprawdź czy asset już istnieje w Pimcore
            $asset = Asset::getByPath($assetPath);
            
            if (!$asset && file_exists($filePath)) {
                // Importuj nowy asset
                $asset = new Asset\Image();
                $asset->setParent(Asset::getByPath(self::ASSETS_TARGET_PATH));
                $asset->setFilename($image);
                $asset->setData(file_get_contents($filePath));
                $asset->save();
                $output->writeln("<info>Zaimportowano obraz: {$image}</info>");
            }
            
            if ($asset instanceof Asset\Image) {
                $hotspotImage = new Hotspotimage();
                $hotspotImage->setImage($asset);
                $galleryItems[] = $hotspotImage;
            } else {
                $output->writeln("<comment>Nie znaleziono obrazka: {$image}</comment>");
            }
        } catch (\Exception $e) {
            $output->writeln("<error>Błąd przetwarzania obrazu {$image}: " . $e->getMessage() . "</error>");
        }
    }
    
    if (!empty($galleryItems)) {
        $product->setZdjecia(new ImageGallery($galleryItems));
    }
}


    private function addDocumentToProduct(Product $product, string $documentName, OutputInterface $output): void
    {   
        $documents = array_filter(array_map('trim', explode(',', $documentName)));
        
        foreach ($documents as $document) {
            $document = trim($document, "\"' ");
            if (empty($document)) {
                continue;
            }
            
            try {
                $filePath = self::ASSETS_PATH . '/' . $document;
                $assetPath = self::ASSETS_TARGET_PATH . '/' . $document;
                
                // Sprawdź czy asset już istnieje w Pimcore
                $asset = Asset::getByPath($assetPath);
                
                if (!$asset && file_exists($filePath)) {
                    // Określ typ dokumentu na podstawie rozszerzenia
                    $extension = strtolower(pathinfo($document, PATHINFO_EXTENSION));
                    
                    if (in_array($extension, ['pdf', 'doc', 'docx', 'xls', 'xlsx'])) {
                        $asset = new Asset\Document();
                    } else {
                        $asset = new Asset();
                    }
                    
                    $asset->setParent(Asset::getByPath(self::ASSETS_TARGET_PATH));
                    $asset->setFilename($document);
                    $asset->setData(file_get_contents($filePath));
                    $asset->save();
                    $output->writeln("<info>Zaimportowano dokument: {$document}</info>");
                }
                
                if ($asset instanceof Asset\Document) {
                    $metadata = new DataObject\Data\ElementMetadata();
                    $metadata->setElement($asset);
                    $metadata->setFieldname('dokumentacja'); // Ustaw nazwę pola
                    $metadata->setColumns([]); // Ustaw puste kolumny jeśli nie są potrzebne
                    
                    $existingDocs = $product->getDokumentacja() ?: [];
                    $existingDocs[] = $metadata;
                    $product->setDokumentacja($existingDocs);
                } else {
                    $output->writeln("<comment>Nie znaleziono dokumentu: {$document}</comment>");
                }
            } catch (\Exception $e) {
                $output->writeln("<error>Błąd przetwarzania dokumentu {$document}: " . $e->getMessage() . "</error>");
            }
        }
    }

}