<?php
namespace App\Shipping;
class StorePickupShipping implements ShippingCalculatorInterface
{
    public function calculate(float $weight): float
    {
        return 0;
    }
}