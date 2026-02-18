<?php

namespace App\Discount;
 
class DiscountFactory
{

private array $couponTypes = [
        'fixed' => FixedDiscount::class,
        'percentage' => PercentageDiscount::class,
    ];
     public function create(string $type, float $value): DiscountInterface
    {
        if (!isset($this->couponTypes[$type])) {
            throw new InvalidArgumentException("Unknown discount type: {$type}");
        }

        $class = $this->couponTypes[$type];
        return new $class($value);
    }
}
