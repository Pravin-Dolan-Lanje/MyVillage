<?php
include '../../db_config.php';
require_once '../Admin/auth_check.php';

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