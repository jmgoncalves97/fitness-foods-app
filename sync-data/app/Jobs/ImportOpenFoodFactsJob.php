<?php

namespace App\Jobs;

use App\Domain\OpenFoodFacts\Services\OpenFoodFactsService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ImportOpenFoodFactsJob implements ShouldQueue
{
    use Queueable;

    public function __construct(private OpenFoodFactsService $service)
    {
    }

    public function handle()
    {
        try {
            $this->service->importData();
        } catch (\Throwable $th) {
            \Log::error($th->getMessage() . "\n" . $th->getTraceAsString());
        }
    }
}
