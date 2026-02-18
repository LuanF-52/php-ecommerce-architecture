<?php
namespace App\Discount;
class PercentageDiscount implements DiscountInterface
{
    public function __construct(
        private float $percentage
    ) {}

    public function apply(float $total): float
    {
        return $total * (1 - $this->percentage / 100);
    }
}