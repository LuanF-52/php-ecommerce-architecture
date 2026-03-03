<?php

namespace App\Shipping;

class ShippingCalculatorFactory
{

private array $calculators = [
        'post_office' => PostShipping::class,
        'transport' => TransportShipping::class,
        'store_pickup' => StorePickupShipping::class,
    ];
     public function create(string $type): ShippingCalculatorInterface
    {
        if (!isset($this->calculators[$type])) {
            throw new InvalidArgumentException("Unknown shipping type: {$type}");
        }

        $class = $this->calculators[$type];
        return new $class();
    }
}
