<?php
require '../../db_configer.php';
require '../../Admin/auth_check.php';

if (!isset($_GET['id'])) {
    die('No certificate ID specified');
}

$id = $_GET['id'];

try {
    $stmt = $pdo->prepare("SELECT image_data, mime_type FROM certificates WHERE id = ?");
    $stmt->execute([$id]);
    $image = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$image) {
        die('Certificate not found');
    }
    
    header("Content-Type: " . $image['mime_type']);
    echo $image['image_data'];
    exit;
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>