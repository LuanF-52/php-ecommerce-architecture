<?php 

namespace App\Controller;

use App\Shipping\ShippingCalculatorFactory;
use App\Discount\DiscountFactory;
use App\Repository\CouponRepositoryInterface;
use App\Repository\ProductRepositoryInterface;
use App\Entity\Order;
use App\Entity\OrderItem;




class OrderController
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private ShippingCalculatorFactory $shippingFactory,
        private DiscountFactory $discountFactory,
        private CouponRepositoryInterface $couponRepository
    ) {}

    public function checkout(array $itemsData, string $shippingType, ?string $couponCode = null): float
    {

        $items = [];
        $shippingCalculator = $this->shippingFactory->create($shippingType);

    foreach ($itemsData as $data) {
        $product = $this->productRepository->findById($data['productId']);
        $items[] = new OrderItem($product, $data['quantity']);
    }


        $discount = null;
        if ($couponCode) {
            $coupon = $this->couponRepository->findByCode($couponCode);
            $discount = $this->discountFactory->create($coupon->type, $coupon->value);
        }

        $order = new Order($items, $shippingCalculator, $discount);

        return $order->getTotal();
    }
}