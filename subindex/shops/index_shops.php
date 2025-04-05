<?php
// Database configuration
require '../../db_config.php';
require '../../Admin/auth_check.php';

$sql = "SELECT * FROM shops ORDER BY created_at DESC";
$result = $conn->query($sql);
// Handle form submissions
$message = '';
$message_type = ''; // 'success' or 'error'

// Create or Update Shop
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    
    // Handle image upload
    $image_path = '';
    if (isset($_POST['existing_image'])) {
        $image_path = $_POST['existing_image'];
    }
    
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $file_extension;
        $target_file = $target_dir . $filename;
        
        // Check if image file is an actual image
        $check = getimagesize($_FILES['image']['tmp_name']);
        if ($check !== false) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image_path = $target_file;
                
                // Delete old image if it exists
                if (!empty($_POST['existing_image']) && file_exists($_POST['existing_image'])) {
                    unlink($_POST['existing_image']);
                }
            }
        }
    }
    
    if ($id > 0) {
        // Update existing shop
        $sql = "UPDATE shops SET name='$name', description='$description'";
        if (!empty($image_path)) {
            $sql .= ", image_path='$image_path'";
        }
        $sql .= " WHERE id=$id";
        
        if ($conn->query($sql) === TRUE) {
            $message = "Shop updated successfully!";
            $message_type = 'success';
        } else {
            $message = "Error updating shop: " . $conn->error;
            $message_type = 'error';
        }
    } else {
        // Create new shop
        $sql = "INSERT INTO shops (name, description, image_path) VALUES ('$name', '$description', '$image_path')";
        
        if ($conn->query($sql) === TRUE) {
            $message = "Shop added successfully!";
            $message_type = 'success';
            // Reset POST to avoid form resubmission
            header("Location: ".$_SERVER['PHP_SELF']."?success=1");
            exit();
        } else {
            $message = "Error adding shop: " . $conn->error;
            $message_type = 'error';
        }
    }
}

// Delete Shop
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    
    // First get image path to delete the file
    $sql = "SELECT image_path FROM shops WHERE id=$id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (!empty($row['image_path']) && file_exists($row['image_path'])) {
            unlink($row['image_path']);
        }
    }
    
    // Then delete the shop
    $sql = "DELETE FROM shops WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        $message = "Shop deleted successfully!";
        $message_type = 'success';
        // Redirect to avoid resubmission
        header("Location: ".$_SERVER['PHP_SELF']."?deleted=1");
        exit();
    } else {
        $message = "Error deleting shop: " . $conn->error;
        $message_type = 'error';
    }
}

// Fetch shop for editing
$edit_shop = null;
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $sql = "SELECT * FROM shops WHERE id=$id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $edit_shop = $result->fetch_assoc();
    }
}

// Fetch all shops from database
$sql = "SELECT * FROM shops ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        
        .shops-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .shop-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            height: 100%;
            position: relative;
        }
        
        .shop-image-container {
            width: 100%;
            height: 200px;
            overflow: hidden;
            position: relative;
        }
        
        .shop-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
            background-color: #f8f8f8;
        }
        
        .shop-info {
            padding: 15px;
            flex-grow: 1;
        }
        
        .shop-name {
            font-size: 20px;
            margin: 0 0 10px 0;
            color: #333;
        }
        
        .shop-description {
            color: #666;
            line-height: 1.5;
            margin-bottom: 0;
        }
        
        .message {
            padding: 10px;
            border-radius: 4px;
            text-align: center;
            margin-bottom: 20px;
        }
        
        .success-message {
            background-color: #d4edda;
            color: #155724;
        }
        
        .error-message {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .no-image {
            width: 100%;
            height: 200px;
            background-color: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
        }
        
        .shop-actions {
            display: flex;
            justify-content: space-between;
            padding: 10px 15px;
            background-color: #f8f9fa;
            border-top: 1px solid #eee;
        }
        
        .btn {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }
        
        .btn-edit {
            background-color: #ffc107;
            color: #212529;
        }
        
        .btn-delete {
            background-color: #dc3545;
            color: white;
        }
        
        .btn-add {
            display: block;
            width: 200px;
            margin: 0 auto 30px;
            padding: 10px;
            background-color: #28a745;
            color: white;
            text-align: center;
            font-size: 16px;
        }
        
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto 30px;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        .form-group input[type="text"],
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        
        .form-group textarea {
            height: 100px;
            resize: vertical;
        }
        
        .form-actions {
            text-align: right;
        }
        
        .btn-submit {
            background-color: #007bff;
            color: white;
            padding: 8px 15px;
        }
        
        .btn-cancel {
            background-color: #6c757d;
            color: white;
            padding: 8px 15px;
            margin-right: 10px;
        }
        
        .current-image {
            margin-top: 10px;
        }
        
        .current-image img {
            max-width: 100%;
            max-height: 150px;
        }
    </style>
</head>
<body>
    <h1>Shop Management</h1>
    
    <?php if (!empty($message)): ?>
        <div class="message <?php echo $message_type; ?>-message">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    
    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <div class="message success-message">
            Shop added successfully!
        </div>
    <?php endif; ?>
    
    <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 1): ?>
        <div class="message success-message">
            Shop deleted successfully!
        </div>
    <?php endif; ?>
    
    <!-- Add/Edit Shop Form -->
    <div class="form-container">
        <h2><?php echo $edit_shop ? 'Edit Shop' : 'Add New Shop'; ?></h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $edit_shop ? $edit_shop['id'] : 0; ?>">
            
            <div class="form-group">
                <label for="name">Shop Name</label>
                <input type="text" id="name" name="name" required 
                       value="<?php echo $edit_shop ? htmlspecialchars($edit_shop['name']) : ''; ?>">
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" required><?php 
                    echo $edit_shop ? htmlspecialchars($edit_shop['description']) : ''; 
                ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="image">Shop Image</label>
                <input type="file" id="image" name="image" accept="image/*">
                
                <?php if ($edit_shop && !empty($edit_shop['image_path'])): ?>
                    <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($edit_shop['image_path']); ?>">
                    <div class="current-image">
                        <p>Current Image:</p>
                        <img src="<?php echo htmlspecialchars($edit_shop['image_path']); ?>" 
                             alt="Current shop image">
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="form-actions">
                <?php if ($edit_shop): ?>
                    <a href="?" class="btn btn-cancel">Cancel</a>
                <?php endif; ?>
                <button type="submit" class="btn btn-submit"><?php echo $edit_shop ? 'Update' : 'Add'; ?> Shop</button>
            </div>
        </form>
    </div>
    
    <a href="?add" class="btn btn-add">Add New Shop</a>
   <a class="btn btn-add" href="../../login/dashboard.php" >Administrative</a>
    
    <div class="shops-container">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="shop-card">';
                
                // Handle image display
                if (!empty($row['image_path'])) {
                    // Check if path is relative and prepend base path if needed
                    $image_path = $row['image_path'];
                    if (!file_exists($image_path) && strpos($image_path, '/') !== 0) {
                        $image_path = $_SERVER['DOCUMENT_ROOT'] . '/' . ltrim($image_path, '/');
                    }
                    
                    if (file_exists($image_path)) {
                        echo '<div class="shop-image-container">';
                        echo '<img src="' . htmlspecialchars($row['image_path']) . '" class="shop-image" alt="' . htmlspecialchars($row['name']) . '" loading="lazy">';
                        echo '</div>';
                    } else {
                        echo '<div class="no-image">Image not found</div>';
                    }
                } else {
                    echo '<div class="no-image">No Image Available</div>';
                }
                
                echo '<div class="shop-info">';
                echo '<h2 class="shop-name">' . htmlspecialchars($row['name']) . '</h2>';
                echo '<p class="shop-description">' . htmlspecialchars($row['description']) . '</p>';
                echo '</div>';
                
                echo '<div class="shop-actions">';
                echo '<a href="?edit=' . $row['id'] . '" class="btn btn-edit">Edit</a>';
                echo '<a href="?delete=' . $row['id'] . '" class="btn btn-delete" onclick="return confirm(\'Are you sure you want to delete this shop?\')">Delete</a>';
                echo '</div>';
                
                echo '</div>';
            }
        } else {
            echo '<p style="grid-column: 1 / -1; text-align: center;">No shops found.</p>';
        }
        ?>
    </div>
    
    <script>
        // Simple confirmation for delete action
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function(e) {
                if (!confirm('Are you sure you want to delete this shop?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>
<?php
$conn->close();
?>