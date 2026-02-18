# PHP Procedural to OOP Refactoring

This project demonstrates a refactoring journey from procedural PHP to object-oriented architecture. Built as part of my software architecture studies, it showcases clean code principles, design patterns, and testable code structure.

## About

I created this project to practice software architecture concepts and demonstrate my ability to transform legacy procedural code into a well-structured, maintainable, and testable codebase.

## Before vs After

### Procedural Approach (Before)
```php
// All shipping types mixed in one function
function calculate_shipping($type, $weight) {
    if ($type === 'post_office') {
        return $weight * 2.5;
    } elseif ($type === 'transport') {
        return $weight * 1.8 + 10;
    } elseif ($type === 'store_pickup') {
        return 0;
    }
}

// All discount types mixed in one function  
function calculate_discount($type, $value, $total) {
    if ($type === 'fixed') {
        return $total - $value;
    } elseif ($type === 'percentage') {
        return $total * (1 - $value / 100);
    }
}
```

**Problems:**
- SQL injection vulnerabilities
- High coupling between functions
- Hard to add new types (must modify existing code)
- Impossible to test without a database
- Mixed responsibilities

### Object-Oriented Approach (After)
```php
// Each shipping type is a separate class
$calculator = $this->shippingFactory->create($type);
$shipping = $calculator->calculate($weight);

// Each discount type is a separate class
$discount = $this->discountFactory->create($coupon->type, $coupon->value);
$total = $discount->apply($subtotal);
```

**Benefits:**
- Secure (prepared statements)
- Low coupling (depends on interfaces)
- Easy to extend (add new class, don't modify existing)
- Testable (use InMemory repositories)
- Clear responsibilities

## Architecture

### Structure

I am using PSR-4 to organize files and folders.
```
App/
     Database/
        DbConnection.php
    Controller/
        ProductController.php
    Entity/
        Product.php
        Coupon.php
    Repository/
        ProductRepositoryInterface.php
        ProductRepository.php
        InMemoryProductRepository.php
        CouponRepositoryInterface.php
        CouponRepository.php
        InMemoryCouponRepository.php
    Shipping/
        ShippingCalculatorInterface.php
        PostOfficeShipping.php
        TransportShipping.php
        StorePickupShipping.php
        ShippingCalculatorFactory.php
    Discount/
        DiscountInterface.php
        FixedDiscount.php
        PercentageDiscount.php
        DiscountFactory.php
Tests/
    TestCheckoutCalculatesCorrectTotal.php
```

### Why This Structure?

Each layer has a single responsibility:

- **Entity**: Represents business data and contains self-validation
- **Repository**: Handles database communication, separated from business rules
- **Shipping/Discount**: Contains domain logic with interfaces, implementations, and factories
- **Controller**: Orchestrates the flow between layers

This separation makes the code easier to test, maintain, and extend.

### Design Patterns

**Strategy Pattern** was used to guarantee the Open/Closed Principle. I can add new shipping or discount types without modifying existing code.

**Factory Pattern** was used to create specific objects according to what was chosen by the client or retrieved from the database.

**Repository Pattern** was used to separate database communication from business rules. It also has an interface, which allows me to swap implementations. For example, I use InMemoryRepository for tests without needing a real database.

## How to Run
```bash
# Clone the repository
git clone https://github.com/yourusername/php-oop-refactoring.git

# Install dependencies
composer install

# Generate autoload
composer dump-autoload
```

## How to Test
```bash
# Run tests
php Tests/TestCheckoutCalculatesCorrectTotal.php
```

## What I Learned

- How to refactor procedural code into object-oriented architecture
- Design patterns (Strategy, Factory, Repository) and when to use each one
- SOLID principles, especially Single Responsibility and Open/Closed
- How interfaces enable polymorphism and reduce coupling
- How to write testable code using dependency injection
- PSR-4 autoloading and project structure

These patterns make the code more secure, easier to test, and simpler to extend with new features.

## Author

Luan - PHP Developer transitioning to Software Architecture

- LinkedIn: [your-linkedin]
- GitHub: [your-github]
