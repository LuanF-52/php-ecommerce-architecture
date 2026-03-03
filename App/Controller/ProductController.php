<?php

namespace App\Controller;

use App\Shipping\ShippingCalculatorFactory;
use App\Discount\DiscountFactory;
use App\Repository\ProductRepositoryInterface;
use App\Repository\CouponRepositoryInterface;
use InvalidArgumentException;

class ProductController
{
    public function __construct(
        private ShippingCalculatorFactory $shippingCalculatorFactory,
        private DiscountFactory $discountFactory,
        private ProductRepositoryInterface $productRepository,
        private CouponRepositoryInterface $couponRepository
    ) {}

    public function checkout(string $type, float $weight, int $productId, ?string $couponCode = null): float
    {
        $product = $this->productRepository->findById($productId);
        $coupon = null;

        if ($couponCode)
        {
            $coupon = $this->couponRepository->findByCode($couponCode);
        }

        if (!$product) {
            throw new InvalidArgumentException("Product not found");
        }

        $calculator = $this->shippingCalculatorFactory->create($type);

        if (!$coupon) {
            return $product->price + $calculator->calculate($weight);
        }
        else
        {
            $discount = $this->discountFactory->create($coupon->type, $coupon->value);
            $totalValue = $product->price + $calculator->calculate($weight);
            $totalWithDiscount = $discount->apply($totalValue);

            return max($totalWithDiscount, 0);
        }

    }
}