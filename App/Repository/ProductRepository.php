<?php
namespace App\Repository;
use App\Entity\Product;
use App\Repository\ProductRepositoryInterface;
use PDO;

class ProductRepository implements ProductRepositoryInterface
{
    public function __construct(
        private PDO $connection
    ) {}

    public function findById(int $id): ?Product
    {
        $stmt = $this->connection->prepare(
            "SELECT * FROM products WHERE id = ?"
        );
        $stmt->execute([$id]);
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return new Product(
            $row['id'],
            $row['name'],
            $row['price'],
            $row['stock']
        );
    }

    public function save(Product $product): void
    {
        $stmt = $this->connection->prepare(
            "INSERT INTO products (name, price, stock) VALUES (?, ?, ?)"
        );
        $stmt->execute([
            $product->name,
            $product->price,
            $product->getStock()
        ]);
    }

    public function update(Product $product): void
    {
        $stmt = $this->connection->prepare(
            "UPDATE products SET name = ?, price = ?, stock = ? WHERE id = ?"
        );
        $stmt->execute([
            $product->name,
            $product->price,
            $product->getStock(),
            $product->id
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->connection->prepare(
            "DELETE FROM products WHERE id = ?"
        );
        $stmt->execute([$id]);
    }
}