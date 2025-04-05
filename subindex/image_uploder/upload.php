<?php
require '../../db_configer.php';
require '../../Admin/auth_check.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $image = $_FILES['image'];
    $name = $_POST['name'] ?? 'Unnamed Image';
    
    // Validate the image
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($image['type'], $allowed_types)) {
        die('Only JPG, PNG, and GIF images are allowed.');
    }
    
    if ($image['error'] !== UPLOAD_ERR_OK) {
        die('Upload failed with error code ' . $image['error']);
    }
    
    // Check file size (limit to 5MB)
    if ($image['size'] > 5 * 1024 * 1024) {
        die('File size exceeds 5MB limit.');
    }
    
    // Read the image file
    $imageData = file_get_contents($image['tmp_name']);
    
    try {
        $stmt = $pdo->prepare("INSERT INTO images (name, image_data, mime_type, size) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $name,
            $imageData,
            $image['type'],
            $image['size']
        ]);
        
        header('Location: index.php?success=1');
        exit;
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
} else {
    header('Location: index.php');
    exit;
}
?>