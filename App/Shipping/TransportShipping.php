<?php

namespace App\Shipping;

class TransportShipping implements ShippingCalculatorInterface
{
    public function calculate(float $weight): float
    {
       return ($weight * 1.8) + 10;
    }
}