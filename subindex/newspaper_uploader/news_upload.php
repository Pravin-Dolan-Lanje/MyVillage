<?php
require '../../db_configer.php';
require '../../Admin/auth_check.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $image = $_FILES['image'];
    $name = $_POST['name'] ?? 'Unnamed Newspaper';
    
    // Validate the image
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($image['type'], $allowed_types)) {
        die('Only JPG, PNG, and GIF images are allowed.');
    }
    
    if ($image['error'] !== UPLOAD_ERR_OK) {
        die('Upload failed with error code ' . $image['error']);
    }
    
    // Read the image file
    $imageData = file_get_contents($image['tmp_name']);
    
    try {
        $stmt = $pdo->prepare("INSERT INTO newspaper (name, image_data, mime_type, size) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $name,
            $imageData,
            $image['type'],
            $image['size']
        ]);
        
        header('Location: news_index.php?success=1');
        exit;
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
} else {
    header('Location: news_index.php');
    exit;
}
?>