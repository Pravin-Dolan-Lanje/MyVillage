<?php
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $notice = $_POST['notice'];

    $sql = "INSERT INTO notice (notice) VALUES ('$notice')";
    if ($conn->query($sql) === TRUE) {
        // header("Location: index.php?msg=Notice added successfully!");
        $message="Notice Added Successfully";
    echo " <script>alert('$message');
    window.location.href='index.php';</script>";
    } else {
        echo "<div class='error'>Error: " . $conn->error . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Notice</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <h1>Add New Notice</h1>
    <form method="post">
        <textarea name="notice" placeholder="Enter your notice here" required></textarea>
        <button type="submit">Add Notice</button><br>
        <br>
        <button><a href="index.php">Notice List</a></button>

    </form>
</body>
</html>