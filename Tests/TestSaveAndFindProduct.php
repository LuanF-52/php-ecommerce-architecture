<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Repository\InMemoryProductRepository;
use App\Entity\Product;
use Exception;


function TestSaveAndFindProduct(): void
{
    // Arrange
    $repository = new InMemoryProductRepository();
    $product = new Product(1, 'Notebook', 2500.00, 10);
    
    // Act
    $repository->save($product);
    $found = $repository->findById(1);
    
    // Assert
    if ($found === null) {
        throw new Exception("Test failed: product not found");
    }
    
    if ($found->name !== 'Notebook') {
        throw new Exception("Test failed: wrong name");
    }
    
    echo "testSaveAndFindProduct: PASSED\n";
}

testSaveAndFindProduct();

echo "\nPressione Enter para sair...";
fgets(STDIN);