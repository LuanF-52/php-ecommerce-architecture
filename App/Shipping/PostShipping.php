<?php

namespace App\Shipping;

class PostShipping implements ShippingCalculatorInterface
{
    public function calculate(float $weight): float
    {
        return $weight * 2.5;
    }

    
}