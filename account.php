<?php
require_once 'includes/auth.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

$user = getCurrentUser();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account - Daraz</title>
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
                <span>Hello, <?php echo htmlspecialchars($user['name']); ?></span>
                <a href="account.php">Account</a>
                <a href="logout.php">Logout</a>
                <a href="#"><span class="cart-icon">🛒</span> Cart</a>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="auth-container">
            <h2>My Account</h2>
            
            <div style="margin-bottom: 30px;">
                <h3 style="color: #232f3e; margin-bottom: 20px;">Account Information</h3>
                <div style="background-color: #f5f5f5; padding: 15px; border-radius: 4px; margin-bottom: 15px;">
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                </div>
            </div>

            <div style="margin-bottom: 30px;">
                <h3 style="color: #232f3e; margin-bottom: 15px;">Quick Links</h3>
                <ul style="list-style: none;">
                    <li style="margin-bottom: 10px;"><a href="#" style="color: #0066c0; text-decoration: none;">📦 Your Orders</a></li>
                    <li style="margin-bottom: 10px;"><a href="#" style="color: #0066c0; text-decoration: none;">❤️ Your Wishlist</a></li>
                    <li style="margin-bottom: 10px;"><a href="#" style="color: #0066c0; text-decoration: none;">⚙️ Edit Profile</a></li>
                    <li style="margin-bottom: 10px;"><a href="#" style="color: #0066c0; text-decoration: none;">🔐 Change Password</a></li>
                </ul>
            </div>

            <form style="margin-top: 30px;">
                <a href="logout.php" class="btn-submit" style="display: block; text-align: center; color: black; text-decoration: none;">Sign Out</a>
            </form>
        </div>
    </div>

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
            <p>&copy; 2026 Daraz. All rights reserved.</p>
        </div>
    </footer>

    <script src="assets/js/main.js"></script>
</body>
</html>
