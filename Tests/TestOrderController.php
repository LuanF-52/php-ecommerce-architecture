<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\OrderController;
use App\Repository\InMemoryProductRepository;
use App\Repository\InMemoryCouponRespository;
use App\Entity\Product;
use App\Entity\Coupon;
use App\Shipping\ShippingCalculatorFactory;
use App\Discount\DiscountFactory;
use App\Shipping\ShippingType;



function testCheckoutCalculatesCorrectTotal(): void
{

    $productRepository = new InMemoryProductRepository();

    $productRepository->save(new Product(1, 'Notebook', 2500.00, 10, 2.0));
    $couponRepository = new InMemoryCouponRespository();

    $couponRepository->save(new Coupon('DISCOUNT10', 'percentage', 10.0, null));
    $productFactory = new ShippingCalculatorFactory();
    $discountFactory = new DiscountFactory();

    $itemsData = [
    ['productId' => 1, 'quantity' => 2]
    ];

    // Act
    $controller = new OrderController($productRepository,$productFactory,$discountFactory, $couponRepository);
    $total = $controller->checkout($itemsData, 'transport' , "DISCOUNT10");

    if (round($total, 2) !== 4515.48) {
    throw new Exception("Test failed: expected 4515.48, got $total");
    }

    echo "Total: $total\n";
}

testCheckoutCalculatesCorrectTotal();
