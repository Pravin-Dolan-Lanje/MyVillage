<?php
// Database configuration
require '../../db_config.php';
require '../../Admin/auth_check.php';

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $shopName = $_POST['shopName'];
    $shopDescription = $_POST['shopDescription'];
    
    // Handle file upload
    $targetDir = "uploads/";
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    
    $fileName = basename($_FILES["shopImage"]["name"]);
    $targetFilePath = $targetDir . uniqid() . '_' . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    
    // Allow certain file formats
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
    if (in_array($fileType, $allowTypes)) {
        // Upload file to server
        if (move_uploaded_file($_FILES["shopImage"]["tmp_name"], $targetFilePath)) {
            // Insert shop data into database
            $sql = "INSERT INTO shops (name, description, image_path) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $shopName, $shopDescription, $targetFilePath);
            
            if ($stmt->execute()) {
                header("Location: display_shops.php?success=1");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }
}

$conn->close();
?>
