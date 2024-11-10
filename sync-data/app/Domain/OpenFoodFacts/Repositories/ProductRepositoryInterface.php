<?php

namespace App\Domain\OpenFoodFacts\Repositories;

interface ProductRepositoryInterface
{
    public function save(array $data): void;
}