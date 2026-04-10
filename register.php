<?php
require_once 'includes/auth.php';

if (isLoggedIn()) {
    header('Location: index.php');
    exit;
}

$message = '';
$messageType = '';
$prefillEmail = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirmPassword = isset($_POST['confirmPassword']) ? $_POST['confirmPassword'] : '';
    
    if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
        $message = 'Please fill in all fields';
        $messageType = 'error';
    } elseif ($password !== $confirmPassword) {
        $message = 'Passwords do not match';
        $messageType = 'error';
    } elseif (strlen($password) < 6) {
        $message = 'Password must be at least 6 characters long';
        $messageType = 'error';
    } else {
        $result = registerUser($email, $password, $name);
        if ($result['success']) {
            $message = 'Registration successful! Redirecting to login...';
            $messageType = 'success';
            // Redirect after 2 seconds
            header('Refresh: 2; url=login.php');
        } else {
            $message = $result['message'];
            $messageType = 'error';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - Daraz</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <div class="header-top">
            <a href="index.php" class="logo">
                <span>🛒</span> Daraz
            </a>
        </div>
    </header>

    <div class="auth-container">
        <h2>Create Account</h2>
        
        <div id="message">
            <?php
            if ($message) {
                echo '<div class="message ' . $messageType . '">' . htmlspecialchars($message) . '</div>';
            }
            ?>
        </div>

        <form id="registerForm" method="POST">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your full name" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" value="<?php echo $prefillEmail; ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="At least 6 characters" required>
                <small style="color: #666; font-size: 12px; margin-top: 5px; display: block;">Password must be at least 6 characters long</small>
            </div>

            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Re-enter your password" required>
            </div>

            <button type="submit" class="btn-submit">Create Account</button>
        </form>

        <div class="social-login">
            <span class="social-login-label">Or, sign up with</span>
            <div class="social-buttons">
                <button type="button" class="social-btn google" onclick="alert('Google login integration would go here')">
                    <span>🔍</span> Google
                </button>
                <button type="button" class="social-btn facebook" onclick="alert('Facebook login integration would go here')">
                    <span>f</span> Facebook
                </button>
            </div>
        </div>

        <div class="auth-link">
            <p>Already have an account? <a href="login.php">Sign In</a></p>
        </div>
    </div>

    <footer>
        <div class="footer-bottom">
            <p>&copy; 2026 Daraz. All rights reserved.</p>
        </div>
    </footer>

    <script src="assets/js/main.js"></script>
</body>
</html>
