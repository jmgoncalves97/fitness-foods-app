<?php

namespace App\Infrastructure\OpenFoodFacts\Clients;

use Illuminate\Support\Facades\Http;

class OpenFoodFactsClient
{
    private string $indexUrl = 'https://challenges.coode.sh/food/data/json/index.txt';
    private string $baseDownloadUrl = 'https://challenges.coode.sh/food/data/json/';

    public function fetchIndexFile(): array
    {
        $indexContent = Http::get($this->indexUrl)->body();
        return array_filter(explode("\n", $indexContent));
    }

    public function downloadFile(string $fileName): string
    {
        $gzUrl = $this->baseDownloadUrl . $fileName;
        return Http::get($gzUrl)->body();
    }
}
