<?php 
namespace App\Repository;
use App\Entity\Coupon;

Interface CouponRepositoryInterface
{
     public function findByCode(string $code): ?Coupon;
     public function save(Coupon $coupon): void;
     public function update(Coupon $coupon): void;
     public function delete(string $code): void;

}
?>