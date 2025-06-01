<?php

namespace App\Command;

use Pimcore\Model\DataObject\CategoryItem;
use Pimcore\Model\DataObject\ProducentInfo;
use Pimcore\Model\DataObject\ProducentInfo\Listing as ProducentInfoListing;
use Pimcore\Model\DataObject\Product;
use Pimcore\Model\Asset;
use Pimcore\Console\AbstractCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Pimcore\Model\DataObject\Data\ImageGallery;
use Pimcore\Model\DataObject\CategoryItem\Listing as CategoryItemListing;

class ImportCsvProductsCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('app:import-products')
            ->setDescription('Importuje produkty z pliku CSV do Pimcore');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $skippedProducts = 0;
        $importedProducts = 0;

        $csvPath = PIMCORE_PROJECT_ROOT . '/var/data/import/products.csv';

        if (!file_exists($csvPath)) {
            $output->writeln('<error>Plik CSV nie istnieje pod ścieżką: ' . $csvPath . '</error>');
            return self::FAILURE;
        }

        // Wczytanie i parsowanie CSV
        $rows = array_map('str_getcsv', file($csvPath));
        if (empty($rows)) {
            $output->writeln('<error>Plik CSV jest pusty lub niepoprawny.</error>');
            return self::FAILURE;
        }

        $header = array_shift($rows);
        if (!$header) {
            $output->writeln('<error>Brak nagłówka w pliku CSV.</error>');
            return self::FAILURE;
        }

        foreach ($rows as $row) {
            if (count($row) !== count($header)) {
                $output->writeln('<comment>Niepoprawna liczba kolumn w wierszu, pomijam.</comment>');
                continue;
            }

            $data = array_combine($header, $row);

            // ################## Znajdź lub utwórz kategorię ######################
            $categoryName = trim($data['Kategoria']);
            $category = null;

            if ($categoryName) {
                $list = new CategoryItemListing();
                $list->setCondition('Kategoria = ?', [$categoryName]);
                $list->setUnpublished(true);
                $items = $list->load();

                //$output->writeln('Szukam kategorii po nazwie: "' . $categoryName . '", znaleziono: ' . count($items));

                if (count($items) > 0) {
                    $category = $items[0];
                    //$output->writeln("<comment>Użyto istniejącej kategorii: {$categoryName}</comment>");
                } else {
                    $output->writeln("<comment>Nie znaleziono kategorii: {$categoryName}, tworzę nową.</comment>");
                    
                    //Sprawdź czy obiekt o tym kluczu już istnieje
                    $categoryKey = \Pimcore\Model\Element\Service::getValidKey($categoryName, 'object');
                    $categoryParent = \Pimcore\Model\DataObject::getByPath('/Produkcja/Kategorie');
                    
                    if (!$categoryParent) {
                        $output->writeln('<error>Nie znaleziono folderu /Produkcja/Kategorie</error>');
                        continue;
                    }
                    
                    // Sprawdzenie czy obiekt istnieje po ścieżce
                    $existingByPath = \Pimcore\Model\DataObject::getByPath('/Produkcja/Kategorie/' . $categoryKey);
                    
                    if ($existingByPath instanceof CategoryItem) {
                        // Jeśli istnieje, ale nie znaleźliśmy go po nazwie, to trzeba zaakutalizować
                        $output->writeln("<error>Obiekt o kluczu {$categoryKey} istnieje, ale ma inną nazwę. Aktualizuję nazwę.</error>");
                        $existingByPath->setKategoria($categoryName);
                        try {
                            $existingByPath->save();
                            $category = $existingByPath;
                            $output->writeln("<info>Zaktualizowano nazwę kategorii na: {$categoryName}</info>");
                        } catch (\Exception $e) {
                            $output->writeln("<error>Błąd aktualizacji kategorii: " . $e->getMessage() . "</error>");
                            continue;
                        }
                    } else {
                        // Tworzenie nowej kategorii, gdy nie ma szukanej
                        $category = new CategoryItem();
                        $category->setKey($categoryKey);
                        $category->setParent($categoryParent);
                        $category->setKategoria($categoryName);
                        $category->setOpis('Automatycznie utworzona kategoria');
                        $category->setPublished(true);
                        
                        try {
                            $category->save();
                            $output->writeln("<info>Utworzono nową kategorię: {$categoryName}</info>");
                        } catch (\Exception $e) {
                            $output->writeln("<error>Błąd podczas zapisywania kategorii: " . $e->getMessage() . "</error>");
                            
                            // Jeśli to błąd unikalności, spróbuj znaleźć istniejący obiekt
                            if (strpos($e->getMessage(), 'unique constraint') !== false) {
                                $output->writeln("<comment>Próba znalezienia istniejącej kategorii po błędzie unikalności...</comment>");
                                $retryList = new CategoryItemListing();
                                $retryList->setCondition('Kategoria = ?', [$categoryName]);
                                $retryItems = $retryList->load();
                                
                                if (count($retryItems) > 0) {
                                    $category = $retryItems[0];
                                    $output->writeln("<info>Znaleziono kategorię po ponownym wyszukiwaniu</info>");
                                }
                            }
                            continue;
                        }
                    }
                }
            }

            // ################# Znajdź lub utwórz producenta ###################
            $producer = null;
            $producerName = trim($data['Producent']);
            $producerNip = isset($data['NIP']) ? trim($data['NIP']) : '';

            if ($producerName) {
                // Szukamy producenta po nazwie (pole Nazwa)
                $list = new ProducentInfoListing();
                $list->setCondition('Nazwa = ?', [$producerName]);
                $list->setUnpublished(true);
                $items = $list->load();

                if (count($items) > 0) {
                    $producer = $items[0];
                    //$output->writeln("<comment>Użyto istniejącego producenta: {$producerName}</comment>");
                    
                    // Aktualizuj NIP jeśli jest różny
                    if ($producerNip !== '' && $producerNip !== $producer->getNIP()) {
                        $producer->setNIP($producerNip);
                        try {
                            $producer->save();
                            $output->writeln("<info>Zaktualizowano NIP producenta: {$producerName}</info>");
                        } catch (\Exception $e) {
                            $output->writeln("<error>Błąd aktualizacji NIP: " . $e->getMessage() . "</error>");
                        }
                    }
                } else {
                    $output->writeln("<comment>Nie znaleziono producenta: {$producerName}, tworzę nowego.</comment>");
                    // Tworzenie nowego producenta
                    $producer = new ProducentInfo();
                    $producerKey = \Pimcore\Model\Element\Service::getValidKey($producerName, 'object');
                    $producerParent = \Pimcore\Model\DataObject::getByPath('/Produkcja/Producenci');
                    
                    if (!$producerParent) {
                        $output->writeln('<error>Nie znaleziono folderu /Produkcja/Producenci</error>');
                        continue;
                    }
                    
                    // Sprawdzenie czy obiekt istnieje po ścieżce
                    $existingByPath = \Pimcore\Model\DataObject::getByPath('/Produkcja/Producenci/' . $producerKey);
                    
                    if ($existingByPath instanceof ProducentInfo) {
                        $output->writeln("<error>Obiekt o kluczu {$producerKey} istnieje, ale ma inną nazwę. Aktualizuję nazwę.</error>");
                        $existingByPath->setNazwa($producerName);
                        if ($producerNip !== '') {
                            $existingByPath->setNIP($producerNip);
                        }
                        try {
                            $existingByPath->save();
                            $producer = $existingByPath;
                            $output->writeln("<info>Zaktualizowano producenta: {$producerName}</info>");
                        } catch (\Exception $e) {
                                $output->writeln("<error>Błąd aktualizacji producenta: " . $e->getMessage() . "</error>");
                                continue;
                            }
                    } else {
                        $producer->setKey($producerKey);
                        $producer->setParent($producerParent);
                        $producer->setNazwa($producerName);
                        if ($producerNip !== '') {
                            $producer->setNIP($producerNip);
                        }
                        $producer->setPublished(true);
                        
                        try {
                            $producer->save();
                            $output->writeln("<info>Utworzono nowego producenta: {$producerName}</info>");
                        } catch (\Exception $e) {
                            $output->writeln("<error>Błąd podczas zapisywania producenta: " . $e->getMessage() . "</error>");
                            continue;
                        }
                        }
                    }
                }

            // ####################### Utwórz lub sprawdź produkt #######################
            $sku = trim($data['SKU'] ?? '');
            if (!$sku) {
                $output->writeln('<comment>Brak SKU, pomijam wiersz.</comment>');
                continue;
            }

            $productList = new \Pimcore\Model\DataObject\Product\Listing();
            $productList->setCondition('sku = ?', [$data['SKU']]);
            $existing = $productList->load()[0] ?? null;

            if ($existing instanceof Product) {
                $skippedProducts++;
                continue; // Pomijamy istniejący produkt
            }

            $product = new Product();
            $product->setKey(\Pimcore\Model\Element\Service::getValidKey($sku, 'object'));
            $productParent = \Pimcore\Model\DataObject::getByPath('/Produkcja/Produkty');
            if (!$productParent) {
                $output->writeln('<error>Nie znaleziono folderu /Produkcja/Produkty</error>');
                continue;
            }
            $product->setParent($productParent);
            $product->setPublished(true);

            $product->setSku($sku);
            $product->setNazwa(trim($data['Nazwa'] ?? ''));
            $product->setOpis(trim($data['Opis'] ?? ''));
            $product->setCena(isset($data['Cena']) ? (float)$data['Cena'] : 0.0);
            $product->setStatus(trim($data['Status'] ?? ''));

            if ($category) {
                $product->setKategoria($category);
            }
            if ($producer) {
                $product->setProducent($producer);
            }

            // ####################### Zdjęcia - imageGallery ###########################
            $galleryItems = [];
            $imageFiles = array_map('trim', explode(',', $data['Zdjecia']));
            foreach ($imageFiles as $imageFile) {
                $imageFile = trim($imageFile, "\"' ");
                if ($imageFile) {
                    $asset = Asset::getByPath('/import/' . $imageFile);
                    if ($asset instanceof Asset\Image) {
                        $img = new \Pimcore\Model\DataObject\Data\Hotspotimage();
                        $img->setImage($asset);
                        // Ustawienie podstawowych właściwości
                        $img->setCrop(null);
                        $img->setMarker(null);
                        $img->setHotspots(null);
                        $galleryItems[] = $img;
                    }
                }
            }

            if (!empty($galleryItems)) {
                $product->setZdjecia(new ImageGallery($galleryItems));
            }

            try {
                $product->save();
                $importedProducts++;
                $output->writeln("<info>Zaimportowano nowy produkt: {$data['SKU']}</info>");
            } catch (\Exception $e) {
                $output->writeln("<error>Błąd podczas zapisywania produktu {$data['SKU']}: " . $e->getMessage() . "</error>");
                continue;
            }
        }

        if ($skippedProducts > 0) {
            $output->writeln("<comment>Pominięto {$skippedProducts} istniejących produktów</comment>");
        }
        $output->writeln("<info>Zaimportowano {$importedProducts} nowych produktów</info>");

        return self::SUCCESS;
    }
}
