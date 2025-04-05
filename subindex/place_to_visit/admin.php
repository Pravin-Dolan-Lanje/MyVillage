<?php
require '../../db_configer.php';
require '../../Admin/auth_check.php';

// Initialize variables
$places = [];
$editPlace = null;
$error = null;

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (isset($_POST['delete'])) {
            $stmt = $pdo->prepare("DELETE FROM places WHERE id = ?");
            $stmt->execute([$_POST['id']]);
        } else {
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            
            if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
                $imageData = file_get_contents($_FILES['image']['tmp_name']);
                $imageType = $_FILES['image']['type'];
                
                if (isset($_POST['id'])) {
                    $stmt = $pdo->prepare("UPDATE places SET title=?, description=?, image_data=?, image_type=? WHERE id=?");
                    $stmt->execute([$title, $description, $imageData, $imageType, $_POST['id']]);
                } else {
                    $stmt = $pdo->prepare("INSERT INTO places (title, description, image_data, image_type) VALUES (?, ?, ?, ?)");
                    $stmt->execute([$title, $description, $imageData, $imageType]);
                }
            } elseif (isset($_POST['id'])) {
                $stmt = $pdo->prepare("UPDATE places SET title=?, description=? WHERE id=?");
                $stmt->execute([$title, $description, $_POST['id']]);
            }
        }
        header("Location: admin.php");
        exit;
    } catch (PDOException $e) {
        $error = "Database error: " . $e->getMessage();
    }
}

// Get all places
try {
    $places = $pdo->query("SELECT * FROM places ORDER BY created_at DESC")->fetchAll();
} catch (PDOException $e) {
    $error = "Error loading places: " . $e->getMessage();
}

// Check if editing
if (isset($_GET['edit'])) {
    try {
        $editId = (int)$_GET['edit'];
        $stmt = $pdo->prepare("SELECT * FROM places WHERE id = ?");
        $stmt->execute([$editId]);
        $editPlace = $stmt->fetch();
    } catch (PDOException $e) {
        $error = "Error loading place to edit: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            line-height: 1.6;
        }
        .error {
            color: red;
            padding: 10px;
            background: #ffeeee;
            border: 1px solid #ffcccc;
            margin-bottom: 20px;
        }
        .form-container {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        textarea {
            min-height: 100px;
        }
        button, .btn {
            padding: 8px 15px;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .btn-outline {
            background: white;
            color: #4CAF50;
            border: 1px solid #4CAF50;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        .card {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
        }
        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .actions {
            margin-top: 10px;
        }
        .actions a, .actions button {
            margin-right: 10px;
        }
        .actions button.delete {
            background: #f44336;
        }
        .p{
            color: white;
        }
    </style>
</head>
<body>
    <h1>Admin Panel</h1>
    
    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    
    <div class="form-container">
        <form method="post" enctype="multipart/form-data">
            <?php if (isset($editPlace) && $editPlace): ?>
                <input type="hidden" name="id" value="<?= htmlspecialchars($editPlace['id']) ?>">
            <?php endif; ?>
            
            <h2><?= (isset($editPlace) && $editPlace) ? 'Edit Place' : 'Add New Place' ?></h2>
            
            <div class="form-group">
                <label>Title:</label>
                <input type="text" name="title" value="<?= isset($editPlace['title']) ? htmlspecialchars($editPlace['title']) : '' ?>" required>
            </div>
            
            <div class="form-group">
                <label>Description:</label>
                <textarea name="description" required><?= isset($editPlace['description']) ? htmlspecialchars($editPlace['description']) : '' ?></textarea>
            </div>
            
            <div class="form-group">
                <label>Image:</label>
                <?php if (isset($editPlace) && $editPlace): ?>
                    <img src="image.php?id=<?= htmlspecialchars($editPlace['id']) ?>" style="max-width: 200px; display: block; margin-bottom: 10px;">
                <?php endif; ?>
                <input type="file" name="image" <?= (!isset($editPlace) || !$editPlace) ? 'required' : '' ?>>
            </div>
            
            <button type="submit">Save</button>
            <button ><a class="p" href="../../login/dashboard.php" >Administrative</a></button>
            <?php if (isset($editPlace) && $editPlace): ?>
                <a href="admin.php" class="btn btn-outline">Cancel</a>
            <?php endif; ?>
        </form>
    </div>
    
    <h2>Manage Places</h2>
    <?php if (empty($places)): ?>
        <p>No places found. Add your first place above.</p>
    <?php else: ?>
        <div class="grid">
            <?php foreach ($places as $place): ?>
                <div class="card">
                    <img src="image.php?id=<?= htmlspecialchars($place['id']) ?>">
                    <h3><?= htmlspecialchars($place['title']) ?></h3>
                    <p><?= htmlspecialchars(substr($place['description'], 0, 100)) ?>...</p>
                    <div class="actions">
                        <a href="admin.php?edit=<?= htmlspecialchars($place['id']) ?>" class="btn">Edit</a>
                        <form method="post" style="display: inline;">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($place['id']) ?>">
                            <input type="hidden" name="delete" value="1">
                            <button type="submit" class="btn delete" onclick="return confirm('Delete this place?')">Delete</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</body>
</html>