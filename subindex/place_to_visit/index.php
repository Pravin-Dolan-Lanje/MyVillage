<?php
// Database connection
require '../../db_configer.php';
// require '../../Admin/auth_check.php';
// Get all places
$places = $pdo->query("SELECT * FROM places ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Places to Visit</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 1200px; margin: 0 auto; padding: 20px; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; }
        .card { border: 1px solid #ddd; border-radius: 5px; overflow: hidden; }
        img { width: 100%; height: 200px; object-fit: cover; }
        .content { padding: 15px; }
        .admin-link { position: fixed; top: 20px; right: 20px; background: #333; color: white; padding: 8px 15px; text-decoration: none; border-radius: 4px; }
    </style>
</head>
<body>
    <a href="admin.php" class="admin-link">Admin Panel</a>
    <h1>Places to Visit</h1>
    
    <div class="grid">
        <?php foreach ($places as $place): ?>
            <div class="card">
                <img src="image.php?id=<?= $place['id'] ?>" alt="<?= htmlspecialchars($place['title']) ?>">
                <div class="content">
                    <h2><?= htmlspecialchars($place['title']) ?></h2>
                    <p><?= htmlspecialchars($place['description']) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>