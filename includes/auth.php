<?php
session_start();
require_once 'config.php';

// Cookie settings
define('COOKIE_LIFETIME', 30 * 24 * 60 * 60); // 30 days
define('COOKIE_NAME_USER_ID', 'user_id_cookie');
define('COOKIE_NAME_USER_TOKEN', 'user_token_cookie');

function registerUser($email, $password, $name) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        return ['success' => false, 'message' => 'Email already registered'];
    }
    
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $conn->prepare("INSERT INTO users (email, password, name) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $email, $hashed_password, $name);
    
    if ($stmt->execute()) {
        return ['success' => true, 'message' => 'Registration successful'];
    } else {
        return ['success' => false, 'message' => 'Registration failed'];
    }
}

function loginUser($email, $password, $rememberMe = false) {
    global $conn;
    $stmt = $conn->prepare("SELECT id, email, password, name FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['login_time'] = time();
            
            // Set cookies if "Remember Me" is checked
            if ($rememberMe) {
                $token = bin2hex(random_bytes(32)); // Generate secure token
                setcookie(COOKIE_NAME_USER_ID, $user['id'], time() + COOKIE_LIFETIME, '/', '', false, true);
                setcookie(COOKIE_NAME_USER_TOKEN, $token, time() + COOKIE_LIFETIME, '/', '', false, true);
                setcookie('user_email', $email, time() + COOKIE_LIFETIME, '/', '', false, true);
                setcookie('user_name', $user['name'], time() + COOKIE_LIFETIME, '/', '', false, true);
            }
            
            return ['success' => true, 'message' => 'Login successful'];
        } else {
            return ['success' => false, 'message' => 'Invalid password'];
        }
    } else {
        return ['success' => false, 'message' => 'User not found'];
    }
}

function logoutUser() {
    // Clear session variables
    $_SESSION = [];
    session_destroy();
    
    // Clear cookies
    setcookie(COOKIE_NAME_USER_ID, '', time() - 3600, '/');
    setcookie(COOKIE_NAME_USER_TOKEN, '', time() - 3600, '/');
    setcookie('user_email', '', time() - 3600, '/');
    setcookie('user_name', '', time() - 3600, '/');
    
    return true;
}

function isLoggedIn() {
    // Check if user is logged in via session
    if (isset($_SESSION['user_id'])) {
        return true;
    }
    
    // Check if user is logged in via cookies
    if (isset($_COOKIE[COOKIE_NAME_USER_ID]) && isset($_COOKIE[COOKIE_NAME_USER_TOKEN])) {
        global $conn;
        $user_id = $_COOKIE[COOKIE_NAME_USER_ID];
        $stmt = $conn->prepare("SELECT id, email, name FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            // Restore session from cookie
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['login_time'] = time();
            return true;
        }
    }
    
    return false;
}

function getCurrentUser() {
    if (isLoggedIn() || isset($_SESSION['user_id'])) {
        return [
            'id' => $_SESSION['user_id'],
            'email' => $_SESSION['email'],
            'name' => $_SESSION['name']
        ];
    }
    return null;
}
?>
