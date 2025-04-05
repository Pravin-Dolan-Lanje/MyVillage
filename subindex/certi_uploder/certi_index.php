<?php
require '../../db_configer.php';
require '../../Admin/auth_check.php';

// Initialize variables
$images = [];
$success = '';
$error = '';

// Handle image deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    
    try {
        $stmt = $pdo->prepare("DELETE FROM certificates WHERE id = ?");
        $stmt->execute([$id]);
        $success = "Certificate deleted successfully!";
    } catch (PDOException $e) {
        $error = "Database error: " . $e->getMessage();
    }
}

// Fetch all images
try {
    $stmt = $pdo->query("SELECT id, name, mime_type, size, created_at FROM certificates ORDER BY created_at DESC");
    $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = "Database error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificates Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2c3e50;
            margin-bottom: 25px;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
        }
        .thumbnail {
            max-width: 100px;
            max-height: 100px;
            border-radius: 4px;
            border: 1px solid #dee2e6;
        }
        .action-links a {
            margin-right: 8px;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 4px;
        }
        .btn-view {
            color: #fff;
            background-color: #3498db;
        }
        .btn-delete {
            color: #fff;
            background-color: #e74c3c;
        }
        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .upload-form {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Certificates Management System</h1>
        
        <?php if (!empty($success)): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>
        
        <?php if (!empty($error)): ?>
            <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        
        <div class="upload-form">
            <h2>Upload New Certificate</h2>
            <form action="certi_upload.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Certificate Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Select Certificate Image:</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                </div>
                <button type="submit" class="btn btn-primary">Upload Certificate</button>
                <button class=""><a href="../indexgallery.php" >Back</a></button>
                <button class=""><a href="../../login/dashboard.php" >Administrative</a></button>
            </form>
        </div>
        
        <h2>Certificates Gallery</h2>
        <?php if (!empty($images)): ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Preview</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($images as $image): ?>
                            <tr>
                                <td><?= htmlspecialchars($image['id']) ?></td>
                                <td><img src="certi_view.php?id=<?= htmlspecialchars($image['id']) ?>" class="thumbnail" alt="Preview"></td>
                                <td><?= htmlspecialchars($image['name']) ?></td>
                                <td class="action-links">
                                    <a href="certi_view.php?id=<?= htmlspecialchars($image['id']) ?>" target="_blank" class="btn-view">View</a>
                                    <a href="certi_index.php?delete=<?= htmlspecialchars($image['id']) ?>" onclick="return confirm('Are you sure you want to delete this certificate?')" class="btn-delete">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info">No certificates found in the database.</div>
        <?php endif; ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>