<?php
require '../../db_configer.php';
// require '../../Admin/auth_check.php';

// Get image from database
$stmt = $pdo->prepare("SELECT image_data, image_type FROM places WHERE id = ?");
$stmt->execute([$_GET['id']]);
$place = $stmt->fetch();

if ($place) {
    header("Content-Type: " . $place['image_type']);
    echo $place['image_data'];
} else {
    // Default placeholder image
    header("Content-Type: image/png");
    echo base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=');
}
exit;
?>