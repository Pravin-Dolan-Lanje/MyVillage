<?php  
require_once '../Admin/auth_check.php';
?>
<?php
include '../db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    
    $query = "DELETE FROM events WHERE id=$id";
    
    if (mysqli_query($conn, $query)) {
        echo "Event deleted successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
