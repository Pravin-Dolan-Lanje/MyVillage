<?php
require_once '../Admin/auth_check.php';
include '../db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subtitle = $_POST["subtitle"];
    $target_dir = "uploads/";

    // Create the uploads folder if it doesn't exist
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $filename = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $filename;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Store only filename in the database
        $query = "INSERT INTO events (image_url, subtitle) VALUES ('$filename', '$subtitle')";
        if (mysqli_query($conn, $query)) {
            echo "Event added successfully!";
            header("Location: admin.php");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "File upload failed.";
    }
}
?>
