<?php
include 'connection.php';

$id = $_GET['id'];
$sql = "DELETE FROM contact_us WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    $message="Contact Deleted Successfully";
    echo " <script>alert('$message');
    window.location.href='index.php';</script>";
    // header("Location: members_list.php?msg=delete_success");
} else {
    echo "Error: " . $conn->error;
}
?>