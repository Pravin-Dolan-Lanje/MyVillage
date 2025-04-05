<?php
// Database connection
include '../../db_config.php';
require_once '../../Admin/auth_check.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Get file path first
    $result = $conn->query("SELECT file_path FROM gram_panchayat_forms WHERE id = $id");
    $row = $result->fetch_assoc();
    $file_path = $row['file_path'];
    
    // Delete from database
    $conn->query("DELETE FROM gram_panchayat_forms WHERE id = $id");
    
    // Delete file
    if (file_exists($file_path)) {
        unlink($file_path);
    }
    
    header("Location: view_forms.php?message=Form+deleted+successfully");
    exit();
}

header("Location: view_forms.php");
?>