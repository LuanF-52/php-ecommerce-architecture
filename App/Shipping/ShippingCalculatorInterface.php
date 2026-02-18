<?php

namespace App\shipping;

interface ShippingCalculatorInterface
{
    public function calculate(float $weight): float;
}