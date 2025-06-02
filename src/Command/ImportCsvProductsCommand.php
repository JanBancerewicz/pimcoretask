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
    const ASSETS_PATH = '/import';

    protected function configure()
    {
        $this
            ->setName('app:import-products')
            ->setDescription('Importuje produkty z pliku CSV do Pimcore');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->initializeFolders($output);
        
        $csvPath = PIMCORE_PROJECT_ROOT . '/var/data/import/products.csv';
        if (!$this->validateCsvFile($csvPath, $output)) {
            return self::FAILURE;
        }

        $data = $this->parseCsv($csvPath, $output);
        if ($data === null) {
            return self::FAILURE;
        }

        // ETAP 1: Importuj wszystkie kategorie i producentów
        $categories = [];
        $producers = [];
        
        foreach ($data as $item) {
            $categoryName = trim($item['Kategoria'] ?? '');
            if ($categoryName && !isset($categories[$categoryName])) {
                $categories[$categoryName] = $this->getOrCreateCategory($categoryName, $output);
            }

            $producerName = trim($item['Producent'] ?? '');
            $producerNip = trim($item['NIP'] ?? '');
            if ($producerName && !isset($producers[$producerName])) {
                $producers[$producerName] = $this->getOrCreateProducer($producerName, $producerNip, $output);
            }
        }

        // ETAP 2: Importuj produkty
        $results = ['imported' => 0, 'skipped' => 0];
        
        foreach ($data as $item) {
            try {
                $sku = trim($item['SKU'] ?? '');
                if (empty($sku)) {
                    continue;
                }

                if ($this->productExists($sku)) {
                    $results['skipped']++;
                    continue;
                }

                $category = $categories[trim($item['Kategoria'])] ?? null;
                $producer = $producers[trim($item['Producent'])] ?? null;

                $product = new Product();
                $product->setKey(Service::getValidKey($sku, 'object'));
                $product->setParent(DataObject::getByPath(self::PRODUCTS_PATH));
                $product->setPublished(true);
                
                $product->setSku($sku);
                $product->setNazwa(trim($item['Nazwa'] ?? ''));
                $product->setOpis(trim($item['Opis'] ?? ''));
                $product->setCena((float)($item['Cena'] ?? 0));
                $product->setStatus(trim($item['Status'] ?? ''));

                if ($category) {
                    $product->setKategoria($category);
                }
                if ($producer) {
                    $product->setProducent($producer);
                }

                $this->addImagesToProduct($product, $item['Zdjecia'] ?? '', $output);

                $product->save();
                $results['imported']++;
                $output->writeln("<info>Zaimportowano produkt: {$sku}</info>");

            } catch (\Exception $e) {
                $output->writeln("<error>Błąd importu produktu {$sku}: " . $e->getMessage() . "</error>");
            }
        }

        $output->writeln([
            "<comment>Pominięto {$results['skipped']} istniejących produktów</comment>",
            "<info>Zaimportowano {$results['imported']} nowych produktów</info>"
        ]);

        return self::SUCCESS;
    }

    private function initializeFolders(OutputInterface $output): void
    {
        $this->ensureFolderExists(self::CATEGORIES_PATH, $output);
        $this->ensureFolderExists(self::PRODUCERS_PATH, $output);
        $this->ensureFolderExists(self::PRODUCTS_PATH, $output);
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
        $images = array_map('trim', explode(',', $imagesString));
        $galleryItems = [];
        
        foreach ($images as $image) {
            $image = trim($image, "\"' ");
            if (empty($image)) {
                continue;
            }
            
            $assetPath = self::ASSETS_PATH . '/' . $image;
            $asset = Asset::getByPath($assetPath);
            
            if ($asset instanceof Asset\Image) {
                $hotspotImage = new Hotspotimage();
                $hotspotImage->setImage($asset);
                $galleryItems[] = $hotspotImage;
            } else {
                $output->writeln("<comment>Nie znaleziono obrazka: {$assetPath}</comment>");
            }
        }
        
        if (!empty($galleryItems)) {
            $product->setZdjecia(new ImageGallery($galleryItems));
        }
    }
}