<?php
include '../db_config.php';
require_once '../Admin/auth_check.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $subtitle = $_POST["subtitle"];
    
    $query = "UPDATE events SET subtitle='$subtitle' WHERE id=$id";
    
    if (mysqli_query($conn, $query)) {
        echo "Event updated successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
