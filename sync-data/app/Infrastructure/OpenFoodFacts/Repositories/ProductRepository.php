<?php

namespace App\Infrastructure\OpenFoodFacts\Repositories;

use App\Domain\OpenFoodFacts\Repositories\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function save(array $data): void
    {
        try {
            $response = \Http::post(env('CRUD_API'), $data);

            if ($response->getStatusCode() == 200) {
                \Log::info('Product send!');
            } else {
                \Log::error($response->getBody()->getContents());
            }
        } catch (\Throwable $th) {
            \Log::error($th->getMessage());
        }

        unset($response);
        gc_collect_cycles();
    }
}
