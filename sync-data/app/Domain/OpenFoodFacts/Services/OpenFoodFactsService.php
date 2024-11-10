<?php

namespace App\Domain\OpenFoodFacts\Services;

use App\Domain\OpenFoodFacts\Repositories\ProductRepositoryInterface;
use App\Infrastructure\OpenFoodFacts\Clients\OpenFoodFactsClient;
use Illuminate\Support\Facades\Storage;

class OpenFoodFactsService
{
    public function __construct(
        private OpenFoodFactsClient $client,
        private ProductRepositoryInterface $productRepository
    ) {}

    public function importData(): void
    {
        $files = $this->client->fetchIndexFile();

        foreach ($files as $fileName) {
            $compressedData = $this->client->downloadFile($fileName);
            Storage::disk('local')->put($fileName, $compressedData);
            \Log::info($fileName . ' downloaded!');
            
            $jsonFile = $this->decompressGz($fileName);
            \Log::info($fileName . ' decompressed!');
            
            $this->processFileData($jsonFile);
            
            Storage::disk('local')->delete($fileName);
            Storage::disk('local')->delete($jsonFile);

            \Log::info($fileName . ' processed!');
        }
    }

    private function decompressGz(string $fileName): string
    {
        $gzPath = storage_path("app/private/{$fileName}");
        $jsonPath = storage_path("app/private/" . str_replace('.gz', '', $fileName));

        $gzFile = gzopen($gzPath, 'rb');
        $outFile = fopen($jsonPath, 'wb');
        while (!gzeof($gzFile)) {
            fwrite($outFile, gzread($gzFile, 4096));
        }
        fclose($outFile);
        gzclose($gzFile);

        return $jsonPath;
    }

    private function processFileData(string $jsonFile): void
    {
        $handle = fopen($jsonFile, 'r');

        if (!$handle) {
            throw new \Exception("Could not open file: {$jsonFile}");
        }

        $dataCollection = collect();
        $batchSize = env('BATCH_SIZE', 1000);
    
        while (($line = fgets($handle)) !== false) {
            $line = trim($line);
            
            // If the line ends with a comma, remove the trailing comma.
            if (substr($line, -1) === ',') {
                $line = rtrim($line, ',');
            }
    
            $data = json_decode($line, true);
            $dataCollection->push($data);
    
            // Save data in batches to prevent excessive memory allocation.
            // When the data collection reaches the batch size, it's saved to the repository,
            // and the collection is cleared to free memory.
            if ($dataCollection->count() >= $batchSize) {
                $this->productRepository->save($dataCollection->toArray());
                $dataCollection = collect();
            }
        }
    
        fclose($handle);
    }
}
