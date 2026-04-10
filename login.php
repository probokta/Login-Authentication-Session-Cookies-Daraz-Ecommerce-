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
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $rememberMe = isset($_POST['remember_me']) && $_POST['remember_me'] === 'on' ? true : false;
    
    if (empty($email) || empty($password)) {
        $message = 'Please fill in all fields';
        $messageType = 'error';
    } else {
        $result = loginUser($email, $password, $rememberMe);
        if ($result['success']) {
            header('Location: index.php');
            exit;
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
    <title>Sign In - Daraz</title>
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
        <h2>Sign In</h2>
        
        <div id="message">
            <?php
            if ($message) {
                echo '<div class="message ' . $messageType . '">' . htmlspecialchars($message) . '</div>';
            }
            ?>
        </div>

        <form id="loginForm" method="POST">
            <div class="form-group">
                <label for="email">Email or Phone Number</label>
                <input type="email" id="email" name="email" placeholder="Please enter your email or phone" value="<?php echo $prefillEmail; ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Please enter your password" required>
            </div>

            <div class="form-group checkbox">
                <input type="checkbox" id="remember_me" name="remember_me">
                <label for="remember_me">Keep me signed in</label>
            </div>

            <div class="forgot-password">
                <a href="#">Forgot password?</a>
            </div>

            <button type="submit" class="btn-submit">Sign In</button>
        </form>

        <div class="social-login">
            <span class="social-login-label">Or, login with</span>
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
            <p>Don't have an account? <a href="register.php">Sign up</a></p>
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
