<?php

use App\Domain\OpenFoodFacts\Services\OpenFoodFactsService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

use App\Jobs\ImportOpenFoodFactsJob;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('openfoodfacts:import', function () {
    ImportOpenFoodFactsJob::dispatch(app(OpenFoodFactsService::class));
})->dailyAt('02:00');