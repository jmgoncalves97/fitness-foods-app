<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\OpenFoodFacts\Repositories\ProductRepositoryInterface;
use App\Infrastructure\OpenFoodFacts\Repositories\ProductRepository;
use App\Infrastructure\OpenFoodFacts\Clients\OpenFoodFactsClient;
use App\Domain\OpenFoodFacts\Services\OpenFoodFactsService;

class OpenFoodFactsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->singleton(OpenFoodFactsClient::class, OpenFoodFactsClient::class);
        $this->app->singleton(OpenFoodFactsService::class, function ($app) {
            return new OpenFoodFactsService(
                $app->make(OpenFoodFactsClient::class),
                $app->make(ProductRepositoryInterface::class)
            );
        });
    }
}
