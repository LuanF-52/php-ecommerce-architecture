<?php

namespace App\Repository;

use App\Repository\CouponRepositoryInterface;
use App\Entity\Coupon;
class InMemoryCouponRespository implements  CouponRepositoryInterface
{
    private array $coupons = [];
    public function findByCode(string $code): ?Coupon
    {
        return $this->coupons[$code] ?? null;
    }

    public function save(Coupon $coupon): void
    {
        $this->coupons[$coupon->code] = $coupon;
    }
    
    public function update(Coupon $coupon): void
    {
          $this->coupons[$coupon->code] = $coupon;
    }
    
     public function delete(string $code): void
    {
        unset($this->coupons[$code]);
    }
    
}