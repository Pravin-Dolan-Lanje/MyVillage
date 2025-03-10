<?php
include 'dbconn.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM shopkeeper1_products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location:shop1.php");
        exit;
    } else {
        echo "Error deleting product.";
    }
}
?>
