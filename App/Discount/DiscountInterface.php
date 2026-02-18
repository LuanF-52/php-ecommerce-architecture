<?php 

namespace App\Discount;

interface DiscountInterface
{
    public function apply(float $total): float;
}