<?php

namespace App\Command;

use Pimcore\Console\AbstractCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use Pimcore\Model\DataObject\Product;
use Pimcore\Model\DataObject\CategoryItem;
use Pimcore\Model\DataObject\ProducentInfo;

class ExportProductsCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('app:export-products')
            ->setDescription('Eksportuje produkty do pliku JSON')
            ->addOption(
                'output',
                'o',
                InputOption::VALUE_REQUIRED,
                'Ścieżka do pliku wyjściowego',
                PIMCORE_PROJECT_ROOT . '/var/exports/products.json'
            )
            ->addOption(
                'status',
                null,
                InputOption::VALUE_OPTIONAL,
                'Filtruj po statusie (oddziel przecinkiem dla wielu wartości)'
            )
            ->addOption(
                'category',
                null,
                InputOption::VALUE_OPTIONAL,
                'Filtruj po kategorii (nazwa lub ID, oddziel przecinkiem dla wielu wartości)'
            )
            ->addOption(
                'producer',
                null,
                InputOption::VALUE_OPTIONAL,
                'Filtruj po producencie (nazwa lub ID, oddziel przecinkiem dla wielu wartości)'
            )
            ->addOption(
                'min-price',
                null,
                InputOption::VALUE_OPTIONAL,
                'Minimalna cena produktu'
            )
            ->addOption(
                'max-price',
                null,
                InputOption::VALUE_OPTIONAL,
                'Maksymalna cena produktu'
            )
            ->addOption(
                'published-only',
                null,
                InputOption::VALUE_NONE,
                'Eksportuj tylko opublikowane produkty'
            )
            ->addOption(
                'include-assets',
                null,
                InputOption::VALUE_NONE,
                'Dołącz informacje o assetach (zdjęcia, dokumenty)'
            )
            ->addOption(
                'pretty',
                null,
                InputOption::VALUE_NONE,
                'Formatuj JSON dla lepszej czytelności'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $startTime = microtime(true);
            
            // Pobierz wszystkie opcje
            $outputFile = $input->getOption('output');
            $statusFilter = $this->parseFilterOption($input->getOption('status'));
            $categoryFilter = $this->parseFilterOption($input->getOption('category'));
            $producerFilter = $this->parseFilterOption($input->getOption('producer'));
            $minPrice = $input->getOption('min-price');
            $maxPrice = $input->getOption('max-price');
            $publishedOnly = $input->getOption('published-only');
            $includeAssets = $input->getOption('include-assets');
            $pretty = $input->getOption('pretty');

            // Przygotuj zapytanie
            $listing = new Product\Listing();
            
            if ($publishedOnly) {
                $listing->setCondition('o_published = ?', [1]);
            }

            // Filtry
            $conditions = [];
            $params = [];

            if ($statusFilter) {
                $conditions[] = 'Status IN (' . implode(',', array_fill(0, count($statusFilter), '?')) . ')';
                $params = array_merge($params, $statusFilter);
            }

            if ($categoryFilter) {
                $categoryIds = $this->resolveCategoryIds($categoryFilter);
                if (!empty($categoryIds)) {
                    $conditions[] = 'Kategoria__id IN (' . implode(',', array_fill(0, count($categoryIds), '?')) . ')';
                    $params = array_merge($params, $categoryIds);
                }
            }

            if ($producerFilter) {
                $producerIds = $this->resolveProducerIds($producerFilter);
                if (!empty($producerIds)) {
                    $conditions[] = 'Producent__id IN (' . implode(',', array_fill(0, count($producerIds), '?')) . ')';
                    $params = array_merge($params, $producerIds);
                }
            }

            if ($minPrice !== null) {
                $conditions[] = 'Cena >= ?';
                $params[] = (float)$minPrice;
            }

            if ($maxPrice !== null) {
                $conditions[] = 'Cena <= ?';
                $params[] = (float)$maxPrice;
            }

            if (!empty($conditions)) {
                $condition = implode(' AND ', $conditions);
                if ($publishedOnly) {
                    $condition = '(o_published = 1) AND (' . $condition . ')';
                }
                $listing->setCondition($condition, $params);
            }

            try {
                $listing->setOrderKey('creationDate');
                $listing->setOrder('DESC');
            } catch (\Exception $e) {
                try {
                    $listing->setOrderKey('o_creationDate');
                    $listing->setOrder('DESC');
                } catch (\Exception $e) {
                    $listing->setOrderKey('o_id');
                    $listing->setOrder('DESC');
                }
            }

            $output->writeln('<info>Przygotowanie eksportu...</info>');
            $output->writeln(sprintf(
                '<comment>Znaleziono %d produktów do eksportu</comment>',
                $listing->getTotalCount()
            ));

            // Przygotuj dane do eksportu
            $exportData = [];
            $totalProducts = $listing->getTotalCount();
            $progressBar = null;

            if ($output->isVerbose()) {
                $progressBar = $this->io->createProgressBar($totalProducts);
                $progressBar->start();
            }

            foreach ($listing as $i => $product) {
                /** @var Product $product */
                $exportData[] = $this->prepareProductData($product, $includeAssets);

                if ($progressBar) {
                    $progressBar->advance();
                }

                // Optymalizacja pamięci dla dużych zbiorów danych
                if ($i % 50 === 0) {
                    \Pimcore::collectGarbage();
                }
            }

            if ($progressBar) {
                $progressBar->finish();
                $output->writeln('');
            }

            // Zapisz do pliku
            $jsonOptions = $pretty ? JSON_PRETTY_PRINT : 0;
            $jsonData = json_encode($exportData, $jsonOptions | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

            if (!file_exists(dirname($outputFile))) {
                mkdir(dirname($outputFile), 0777, true);
            }

            file_put_contents($outputFile, $jsonData);

            $executionTime = round(microtime(true) - $startTime, 2);
            $output->writeln([
                '',
                '<info>Eksport zakończony pomyślnie!</info>',
                sprintf('<comment>Ścieżka pliku: %s</comment>', realpath($outputFile)),
                sprintf('<comment>Czas wykonania: %s sekund</comment>', $executionTime),
                sprintf('<comment>Liczba wyeksportowanych produktów: %d</comment>', count($exportData)),
                ''
            ]);

            return self::SUCCESS;

        } catch (\Throwable $e) {
            $output->writeln([
                '',
                '<error>Błąd podczas eksportu:</error>',
                '<error>' . $e->getMessage() . '</error>',
                $output->isVerbose() ? '<error>' . $e->getTraceAsString() . '</error>' : '',
                ''
            ]);
            return self::FAILURE;
        }
    }

    private function prepareProductData(Product $product, bool $includeAssets = false): array
    {
        $data = [
            'id' => $product->getId(),
            'sku' => $product->getSKU(),
            'nazwa' => $product->getNazwa(),
            'opis' => $product->getOpis(),
            'cena' => $product->getCena(),
            'status' => $product->getStatus(),
            'published' => $product->getPublished(),
            'creationDate' => $product->getCreationDate(),
            'modificationDate' => $product->getModificationDate(),
        ];

        // Kategoria
        if ($category = $product->getKategoria()) {
            $data['kategoria'] = [
                'id' => $category->getId(),
                'nazwa' => $category->getKategoria(),
                'path' => $category->getFullPath()
            ];
        }

        // Producent
        if ($producer = $product->getProducent()) {
            $data['producent'] = [
                'id' => $producer->getId(),
                'nazwa' => $producer->getNazwa(),
                'nip' => $producer->getNIP(),
                'path' => $producer->getFullPath()
            ];
        }

        // Zdjęcia i dokumenty (tylko jeśli wymagane)
        if ($includeAssets) {
            // Zdjęcia
            if ($gallery = $product->getZdjecia()) {
                $data['zdjecia'] = [];
                foreach ($gallery->getItems() as $item) {
                    if ($image = $item->getImage()) {
                        $data['zdjecia'][] = [
                            'id' => $image->getId(),
                            'path' => $image->getFullPath(),
                            'url' => $image->getFullPath()
                        ];
                    }
                }
            }

            // Dokumentacja
            if ($docs = $product->getDokumentacja()) {
                $data['dokumentacja'] = [];
                foreach ($docs as $doc) {
                    if ($asset = $doc->getElement()) {
                        $data['dokumentacja'][] = [
                            'id' => $asset->getId(),
                            'path' => $asset->getFullPath(),
                            'url' => $asset->getFullPath(),
                            'type' => $asset->getType()
                        ];
                    }
                }
            }
        }

        return $data;
    }

    private function parseFilterOption(?string $value): array
    {
        if (empty($value)) {
            return [];
        }

        return array_map('trim', explode(',', $value));
    }

    private function resolveCategoryIds(array $filters): array
    {
        $ids = [];
        
        foreach ($filters as $filter) {
            if (is_numeric($filter)) {
                $ids[] = (int)$filter;
            } else {
                // Szukaj po nazwie
                $listing = new CategoryItem\Listing();
                $listing->setCondition('Kategoria LIKE ?', ['%' . $filter . '%']);
                $listing->setLimit(1);
                
                if ($category = $listing->current()) {
                    $ids[] = $category->getId();
                }
            }
        }

        return array_unique($ids);
    }

    private function resolveProducerIds(array $filters): array
    {
        $ids = [];
        
        foreach ($filters as $filter) {
            if (is_numeric($filter)) {
                $ids[] = (int)$filter;
            } else {
                // Szukaj po nazwie
                $listing = new ProducentInfo\Listing();
                $listing->setCondition('Nazwa LIKE ?', ['%' . $filter . '%']);
                $listing->setLimit(1);
                
                if ($producer = $listing->current()) {
                    $ids[] = $producer->getId();
                }
            }
        }

        return array_unique($ids);
    }
}