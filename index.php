<?php
require_once 'includes/auth.php';
$user = getCurrentUser();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daraz - Your Online Shopping Destination</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header>
        <div class="header-top">
            <a href="index.php" class="logo">
                <span>🛒</span> Daraz
            </a>
            
            <div class="search-container">
                <input type="text" placeholder="Search products...">
                <button type="submit">Search</button>
            </div>
            
            <div class="header-nav">
                <?php if ($user): ?>
                    <span>Hello, <?php echo htmlspecialchars($user['name']); ?></span>
                    <a href="account.php">Account</a>
                    <a href="logout.php">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="nav-link">Hello, sign in</a>
                    <a href="register.php" class="nav-link">Start here</a>
                <?php endif; ?>
                <a href="#"><span class="cart-icon">🛒</span> Cart</a>
            </div>
        </div>
    </header>

    <section class="hero">
        <div>
            <h1>Welcome to Daraz</h1>
            <p>Discover amazing products at great prices</p>
            <button>Shop Now</button>
        </div>
    </section>

    <!-- Categories -->
    <div class="container">
        <div class="categories">
            <div class="category-box">
                <h3>� Electronics</h3>
            </div>
            <div class="category-box">
                <h3>👔 Fashion</h3>
            </div>
            <div class="category-box">
                <h3>🌿 Home & Garden</h3>
            </div>
            <div class="category-box">
                <h3>📖 Books</h3>
            </div>
            <div class="category-box">
                <h3>🏋️ Sports</h3>
            </div>
            <div class="category-box">
                <h3>🕹️ Gaming</h3>
            </div>
        </div>
    </div>

    <section class="products-section">
        <div class="container">
            <h2 class="section-title">Featured Products</h2>
            <div class="products-grid">
                <?php
                $products = [
                    ['name' => 'Wireless Headphones', 'price' => '$49.99', 'icon' => '🔊'],
                    ['name' => 'Smart Watch', 'price' => '$199.99', 'icon' => '⏱️'],
                    ['name' => 'USB-C Cable', 'price' => '$9.99', 'icon' => '⚡'],
                    ['name' => 'Phone Case', 'price' => '$14.99', 'icon' => '💎'],
                    ['name' => 'Laptop Stand', 'price' => '$29.99', 'icon' => '🖥️'],
                    ['name' => 'Desk Lamp', 'price' => '$24.99', 'icon' => '✨'],
                    ['name' => 'Keyboard', 'price' => '$79.99', 'icon' => '🎯'],
                    ['name' => 'Mouse Pad', 'price' => '$12.99', 'icon' => '👆'],
                ];
                
                foreach ($products as $product) {
                    echo '
                    <div class="product-card">
                        <div style="font-size: 60px; margin-bottom: 10px;">
                            ' . $product['icon'] . '
                        </div>
                        <h3 class="product-name">' . $product['name'] . '</h3>
                        <p class="product-price">' . $product['price'] . '</p>
                        <button>Add to Cart</button>
                    </div>
                    ';
                }
                ?>
            </div>
        </div>
    </section>

    <section class="products-section">
        <div class="container">
            <h2 class="section-title">Best Sellers</h2>
            <div class="products-grid">
                <?php
                $bestsellers = [
                    ['name' => 'Portable Speaker', 'price' => '$34.99', 'icon' => '�'],
                    ['name' => 'Power Bank', 'price' => '$29.99', 'icon' => '🔌'],
                    ['name' => 'Screen Protector', 'price' => '$7.99', 'icon' => '🛡️'],
                    ['name' => 'Charger', 'price' => '$19.99', 'icon' => '🔋'],
                    ['name' => 'Phone Mount', 'price' => '$11.99', 'icon' => '📌'],
                    ['name' => 'Cable Organizer', 'price' => '$8.99', 'icon' => '📎'],
                    ['name' => 'Webcam', 'price' => '$49.99', 'icon' => '📷'],
                    ['name' => 'Microphone', 'price' => '$39.99', 'icon' => '🎧'],
                ];
                
                foreach ($bestsellers as $product) {
                    echo '
                    <div class="product-card">
                        <div style="font-size: 60px; margin-bottom: 10px;">
                            ' . $product['icon'] . '
                        </div>
                        <h3 class="product-name">' . $product['name'] . '</h3>
                        <p class="product-price">' . $product['price'] . '</p>
                        <button>Add to Cart</button>
                    </div>
                    ';
                }
                ?>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h4>Get to Know Us</h4>
                <a href="#">About Daraz</a>
                <a href="#">Careers</a>
                <a href="#">Blog</a>
                <a href="#">Press</a>
            </div>
            <div class="footer-section">
                <h4>Make Money with Us</h4>
                <a href="#">Sell Products</a>
                <a href="#">Become an Affiliate</a>
                <a href="#">Advertise</a>
            </div>
            <div class="footer-section">
                <h4>Customer Support</h4>
                <a href="#">Contact Us</a>
                <a href="#">Help Center</a>
                <a href="#">Return Policy</a>
                <a href="#">FAQ</a>
            </div>
            <div class="footer-section">
                <h4>Connect with Us</h4>
                <a href="#">Facebook</a>
                <a href="#">Twitter</a>
                <a href="#">Instagram</a>
                <a href="#">LinkedIn</a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 Daraz. All rights reserved. | <a href="#" style="color: #aaa;">Privacy Policy</a> | <a href="#" style="color: #aaa;">Terms of Service</a></p>
        </div>
    </footer>

    <script src="assets/js/main.js"></script>
</body>
</html>
