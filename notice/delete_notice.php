<?php
include 'db_config.php';

$id = $_GET['id'];
$sql = "DELETE FROM notice WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    // header("Location: index.php?msg=Notice deleted successfully!");
    $message="Notice Deleted Successfully";
    echo " <script>alert('$message');
    window.location.href='index.php';</script>";
} else {
    echo "<div class='error'>Error: " . $conn->error . "</div>";
}
?>