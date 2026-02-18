<?php 
namespace App\Repository;
use App\Entity\Product;

Interface ProductRepositoryInterface
{
     public function findById(int $id): ?Product;
     public function save(Product $product): void;
     public function update(Product $product): void;
     public function delete(int $id): void;

}
?>