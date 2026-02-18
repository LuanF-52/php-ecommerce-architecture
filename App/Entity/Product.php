<?php

namespace App\Entity;


class Product
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $name,
        public readonly float $price,
        private int $stock
    ) {
        if (empty($name)) {
            throw new InvalidArgumentException("Name is required");
        }
        if ($price <= 0) {
            throw new InvalidArgumentException("Price must be greater than zero");
        }
        if ($stock < 0) {
            throw new InvalidArgumentException("Stock cannot be negative");
        }
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function addStock(int $quantity): void
    {
        $this->stock += $quantity;
    }

    public function removeStock(int $quantity): void
    {
        if ($quantity > $this->stock) {
            throw new RuntimeException("Insufficient stock");
        }
        $this->stock -= $quantity;
    }
}