<?php
namespace App\Entity;
use App\Discount\DiscountInterface;
use DateTime;

class Coupon
{
    public function __construct(
        public readonly string $code,
        public readonly string $type,
        public readonly float $value,
        public readonly ?DateTime $expiresAt = null
    ) {}

    public function isValid(): bool
    {
        if ($this->expiresAt === null) {
            return true;
        }
        return new DateTime() < $this->expiresAt;
    }
}