<?php
namespace App\Discount;
class FixedDiscount implements DiscountInterface
{
    public function __construct(
        private float $amount
    ) {}

    public function apply(float $total): float
    {
        return max(0, $total - $this->amount);
    }
}