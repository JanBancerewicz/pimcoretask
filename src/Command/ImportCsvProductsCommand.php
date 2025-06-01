<?php

namespace App\Command;

use Pimcore\Model\DataObject\CategoryItem;
use Pimcore\Model\DataObject\ProducentInfo;
use Pimcore\Model\DataObject\Product;
use Pimcore\Model\Asset;
use Pimcore\Console\AbstractCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Pimcore\Model\DataObject\Data\ImageGallery;
use Pimcore\Model\DataObject\Data\ImageGallery\Image;
use Pimcore\Model\DataObject\AbstractObject;
use Pimcore\Model\DataObject\CategoryItem\Listing as CategoryItemListing;
use Pimcore\Model\DataObject\ProducentInfo\Listing as ProducentInfoListing;


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
        $csvPath = PIMCORE_PROJECT_ROOT . '/var/data/import/products.csv';

        if (!file_exists($csvPath)) {
            $output->writeln('<error>Plik CSV nie istnieje pod ścieżką: ' . $csvPath . '</error>');
            return self::FAILURE;
        }

        $rows = array_map('str_getcsv', file($csvPath));
        $header = array_shift($rows);

        foreach ($rows as $row) {
            $data = array_combine($header, $row);

            // --- Znajdź lub utwórz kategorię ---


            $categoryName = trim($data['Kategoria']);
            $category = null;

            if ($categoryName) {
                // Szukamy kategorii o podanej nazwie i odpowiednim parentId (np. folderze kategorii)
                $categoryKey = \Pimcore\Model\Element\Service::getValidKey($categoryName, 'object');
                $existingCategory = CategoryItem::getByPath('/Product Data/Categories/' . $categoryKey); // dopasuj ścieżkę!

                if ($existingCategory instanceof CategoryItem) {
                    $category = $existingCategory;
                } else {
                    $category = new CategoryItem();
                    $category->setKey($categoryKey);
                    $category->setParentId(8); // ID folderu kategorii
                    $category->setKategoria($categoryName);
                    $category->setOpis('Automatycznie utworzona kategoria');
                    $category->save();
                }

            }

            // --- Znajdź lub utwórz producenta ---
            $producer = null;
            $producerName = trim($data['Producent']);
            $producerNip = isset($data['NIP']) ? trim($data['NIP']) : '';
            if ($producerName) {
                $list = new ProducentInfo\Listing();
                $list->setCondition('Nazwa = ?', [$producerName]);
                $items = $list->load();
                if (count($items) > 0) {
                    $producer = $items[0];
                    if ($producerNip !== '' && $producerNip !== $producer->getNIP()) {
                        $producer->setNIP($producerNip);
                        $producer->save();
                    }
                } else {
                    $producer = new ProducentInfo();
                    $producer->setKey(\Pimcore\Model\Element\Service::getValidKey($producerName, 'object'));
                    $producer->setParentId(9); // ID folderu dla producentów
                    $producer->setNazwa($producerName);
                    if ($producerNip !== '') {
                        $producer->setNIP($producerNip);
                    }
                    $producer->save();
                }
            }

            // --- Utwórz obiekt produktu ---
            $productList = new \Pimcore\Model\DataObject\Product\Listing();
            $productList->setCondition('sku = ?', [$data['SKU']]);
            $existing = $productList->load()[0] ?? null;            
            if ($existing instanceof Product) {
                $output->writeln("<comment>Produkt o SKU {$data['SKU']} już istnieje, pomijam.</comment>");
                continue;
            }
            $product = new Product();
            $product->setKey(\Pimcore\Model\Element\Service::getValidKey($data['SKU'], 'object'));
            $product->setParentId(6); // ID folderu na produkty
            $product->setPublished(true);

            $product->setSku($data['SKU']);
            $product->setNazwa($data['Nazwa']);
            $product->setOpis($data['Opis']);
            $product->setCena((float)$data['Cena']);
            $product->setStatus($data['Status']);

            if ($category) {
                $product->setKategoria($category);
            }
            if ($producer) {
                $product->setProducent($producer);
            }

            // --- Zdjęcia - imageGallery ---
            $gallery = new ImageGallery();
            $imageFiles = array_map('trim', explode(',', $data['Zdjecia']));
            foreach ($imageFiles as $imageFile) {
                $imageFile = trim($imageFile, "\"' ");
                if ($imageFile) {
                    $asset = Asset::getByPath('/import/' . $imageFile);
                    if ($asset instanceof Asset\Image) {
                        $img = new Image();
                        $img->setImage($asset);
                        $img->setTitle($asset->getFilename());
                        $gallery->addImage($img);
                    }
                }
            }
            $product->setZdjecia($gallery);

            // --- Dokumentacja - advancedManyToManyRelation ---
            $docs = [];
            $docFiles = array_map('trim', explode(',', $data['Dokumentacja']));
            foreach ($docFiles as $docFile) {
                $docFile = trim($docFile, "\"' ");
                if ($docFile) {
                    $asset = Asset::getByPath('/import/' . $docFile);
                    if ($asset instanceof Asset\Document) {
                        $docs[] = $asset;
                    }
                }
            }
            if (!empty($docs)) {
                $product->setDokumentacja($docs);
            }

            $product->save();
            $output->writeln("<info>Zaimportowano produkt: {$data['SKU']}</info>");
        }

        $output->writeln('<info>Import zakończony pomyślnie!</info>');
        return self::SUCCESS;
    }
}
