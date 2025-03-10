<?php
include '../contact/connection.php';

$id = $_GET['id'];
$sql = "DELETE FROM feedback WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    $message="Feedback Deleted Successfully";
    echo " <script>alert('$message');
    window.location.href='index.php';</script>";
    // header("Location: members_list.php?msg=delete_success");
} else {
    echo "Error: " . $conn->error;
}
?>