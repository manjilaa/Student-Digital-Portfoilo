<?php
// config.php - included at the top of every page.
// It connects to the database and starts the login session.

session_start();

$host = 'localhost';
$dbname = 'digital_portfolio';
$user = 'root';      // XAMPP default
$pass = '';          // XAMPP default is empty

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('Could not connect to the database. Is MySQL started in XAMPP?');
}

// Escape text before printing it on a page (protects against XSS attacks)
function e($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

// Use at the top of any page that needs a logged-in user.
// Example: require_login('student');  or  require_login(); for any role
function require_login($role = null) {
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }
    if ($role !== null && $_SESSION['role'] !== $role) {
        http_response_code(403);
        die('You do not have permission to view this page.');
    }
}
