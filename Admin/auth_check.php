<?php
session_start();

// Check if user is logged in and OTP verified
if (!isset($_SESSION['user']) || !$_SESSION['user']['logged_in'] || !isset($_SESSION['otp_verified'])) {
    header('Location: login.php');
    exit();
}
?>