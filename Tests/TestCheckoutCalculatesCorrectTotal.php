<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\ProductController;
use App\Repository\InMemoryProductRepository;
use App\Repository\InMemoryCouponRespository;
use App\Entity\Product;
use App\Entity\Coupon;
use App\Shipping\ShippingCalculatorFactory;
use App\Discount\DiscountFactory;

function testCheckoutCalculatesCorrectTotal(): void
{
    $productRepository = new InMemoryProductRepository();
    $productRepository->save(new Product(1, 'Notebook', 2500.00, 10));
    $couponRepository = new InMemoryCouponRespository();
    $couponRepository->save(new Coupon('DISCOUNT10', 'percentage', 10.0, null));
    $productFactory = new ShippingCalculatorFactory();
    $discountFactory = new DiscountFactory();
    // Act
    $controller = new ProductController($productFactory, $discountFactory, $productRepository, $couponRepository);
    $total = $controller->checkout("transport", 10.0, 1, "DISCOUNT10");
    
    if (round($total, 2) !== 2275.2) {
        throw new Exception("Test failed: expected total 2528.0, got $total");
    }
    
    echo "Total: $total\n";
}

testCheckoutCalculatesCorrectTotal();