<?php
include 'db_config.php';

$id = $_GET['id'];
$sql = "DELETE FROM members WHERE sr_no=$id";
if ($conn->query($sql) === TRUE) {
    $message="Member Deleted Successfully";
    echo " <script>alert('$message');
    window.location.href='members_list.php';</script>";
    // header("Location: members_list.php?msg=delete_success");
} else {
    echo "Error: " . $conn->error;
}
?>