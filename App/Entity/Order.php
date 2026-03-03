<?php

namespace App\Entity;


use App\Shipping\ShippingCalculatorInterface;
use App\Discount\DiscountInterface;
Class Order
{
     public function __construct(
        private array $items,
        private ShippingCalculatorInterface $shippingCalculator,
        private ?DiscountInterface $discount = null
    ) {}


   public function getProductsTotal(): float
{
    $total = 0;

    foreach ($this->items as $item) {
        $total += $item->getSubTotal();
    }

    return $total;
}


public function getTotalWeight(): float
{
    $weight = 0;

    foreach ($this->items as $item) {
        $weight += $item->getWeight();
    }

    return $weight;
}

public function getTotal(): float
{
    $total = $this->getProductsTotal();
    $total += $this->shippingCalculator->calculate($this->getTotalWeight());

    if ($this->discount) {
        $total = $this->discount->apply($total);
    }

    return $total;
}

}