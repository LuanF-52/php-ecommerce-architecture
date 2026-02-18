<?php
namespace App\Repository;
use App\Entity\Coupon;
use App\Repository\CouponRepositoryInterface;
use PDO;

class CouponRepository implements CouponRepositoryInterface
{
    public function __construct(
        private PDO $connection
    ) {}

    public function findByCode(string $code): ?Discount
    {
        $stmt = $this->connection->prepare(
            "SELECT * FROM cupoms WHERE code = ?"
        );
        $stmt->execute([$code]);
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return new Coupon(
            $row['code'],
            $row['type'],
            $row['expiresAt'] ? new DateTime($row['expiresAt']) : null
        );
    }

    public function save(Coupon $coupon): void
    {
        $stmt = $this->connection->prepare(
            "INSERT INTO coupons (code, type, expiresAt) VALUES (?, ?, ?)"
        );
        $stmt->execute([
            $coupon->code,
            $coupon->type,
            $coupon->expiresAt ? $coupon->expiresAt->format('Y-m-d H:i:s') : null
        ]);
    }
    
    

    public function update(Coupon $coupon): void
    {
        $stmt = $this->connection->prepare(
            "UPDATE coupons SET code = ?, type = ?, expiresAt = ? WHERE code = ?"
        );
        $stmt->execute([
            $coupon->code,
            $coupon->type,
            $coupon->expiresAt ? $coupon->expiresAt->format('Y-m-d H:i:s') : null,
            $coupon->code
        ]);
    }

    public function delete(string $code): void
    {
        $stmt = $this->connection->prepare(
            "DELETE FROM coupons WHERE code = ?"
        );
        $stmt->execute([$code]);
    }
}