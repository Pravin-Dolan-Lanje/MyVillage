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
        $stmt = $pdo->prepare("DELETE FROM images WHERE id = ?");
        $stmt->execute([$id]);
        $success = "Image deleted successfully!";
    } catch (PDOException $e) {
        $error = "Database error: " . $e->getMessage();
    }
}

// Fetch all images
try {
    $stmt = $pdo->query("SELECT id, name, mime_type, size, created_at FROM images ORDER BY created_at DESC");
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
    <title>Image Management System</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            text-align: center;
            color: #444;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .thumbnail {
            max-width: 80px;
            max-height: 80px;
            border-radius: 5px;
        }
        .action-links a {
            margin-right: 10px;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            transition: 0.3s;
        }
        .action-links a:first-child {
            background-color: #28a745;
            color: white;
        }
        .action-links a:last-child {
            background-color: #dc3545;
            color: white;
        }
        .action-links a:hover {
            opacity: 0.8;
        }
        .success, .error {
            text-align: center;
            padding: 10px;
            border-radius: 5px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .buttons {
            background-color: #007BFF;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            /* display: block; */
            width: 20%;
            transition: 0.3s;
        }
        .buttons:hover {
            background-color: #0056b3;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            table, th, td {
                display: block;
                width: 100%;
            }
            th, td {
                text-align: right;
                padding: 10px;
                position: relative;
            }
            th::before, td::before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                font-weight: bold;
                text-align: left;
            }
            .action-links a {
                display: block;
                margin: 5px 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Image Management System</h1>
        
        <?php if (!empty($success)): ?>
            <div class="success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>
        
        <?php if (!empty($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        
        <h2>Upload New Image</h2>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Image Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="image">Select Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>
            <button class="buttons" type="submit">Upload Image</button>
            <button class=""><a href="../indexgallery.php" >Back</a></button>
            <button class=""><a href="../../login/dashboard.php" >Administrative</a></button>
        </form>
        
        <h2>Image Gallery</h2>
        <?php if (!empty($images)): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Thumbnail</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($images as $image): ?>
                        <tr>
                            <td data-label="ID"><?= htmlspecialchars($image['id']) ?></td>
                            <td data-label="Thumbnail">
                                <img src="view_image.php?id=<?= htmlspecialchars($image['id']) ?>" class="thumbnail" alt="Thumbnail">
                            </td>
                            <td data-label="Name"><?= htmlspecialchars($image['name']) ?></td>
                            <td data-label="Actions" class="action-links">
                                <a href="view_image.php?id=<?= htmlspecialchars($image['id']) ?>" target="_blank">View</a>
                                <a href="index.php?delete=<?= htmlspecialchars($image['id']) ?>" onclick="return confirm('Are you sure you want to delete this image?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No images found in the database.</p>
        <?php endif; ?>
    </div>
</body>
</html>
