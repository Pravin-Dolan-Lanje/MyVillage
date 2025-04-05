<?php
// Database connection
include '../../db_config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT file_path FROM gram_panchayat_forms WHERE id = $id");
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $file_path = $row['file_path'];
        
        // Increment download count
        $conn->query("UPDATE gram_panchayat_forms SET download_count = download_count + 1 WHERE id = $id");
        
        // Force download
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($file_path).'"');
        header('Content-Length: ' . filesize($file_path));
        readfile($file_path);
        exit;
    }
}

header("Location: view_forms.php");
?>