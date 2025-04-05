<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'Siregaon_bandh');

// PHPMailer configuration
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_USER', 'lanjepravin0@gmail.com');
define('SMTP_PASS', 'skux srsr scmd buqm'); // Use App Password if 2FA enabled
define('SMTP_PORT', 587);

// Start session
session_start();

// Error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Autoload classes
spl_autoload_register(function ($class) {
    include __DIR__ . '/' . $class . '.php';
});

// Include PHPMailer
require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';
?>