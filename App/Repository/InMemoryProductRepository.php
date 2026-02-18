<?php

namespace App\Repository;
use App\Entity\Product;
use App\Repository\ProductRepositoryInterface;
class InMemoryProductRepository implements  ProductRepositoryInterface
{
    private array $products = [];

    public function findById(int $id): ?Product
    {
        return $this->products[$id] ?? null;
    }

    public function save(Product $product): void
    {
        $this->products[$product->id] = $product;
    }
    
    public function update(Product $product): void
    {
          $this->products[$product->id] = $product;
    }
    
     public function delete(int $id): void
    {
        unset($this->products[$id]);
    }
    
}