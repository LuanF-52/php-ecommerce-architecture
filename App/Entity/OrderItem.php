<?php

namespace App\Entity;
use App\Entity\Product;

class OrderItem
{

   public function __construct(
        private Product $product,
        private int $quantity
    ) {}


    public function getWeight(): float
    {
        return $this->product->weight * $this->quantity;
    }

    public function getSubTotal(): float
    {
        return $this->product->price * $this->quantity;

    }
}