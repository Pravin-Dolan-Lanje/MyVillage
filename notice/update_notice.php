<?php
include 'db_config.php';

$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $notice = $_POST['notice'];

    $sql = "UPDATE notice SET notice='$notice' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        // header("Location: index.php?msg=Notice updated successfully!");
        $message="Notice updated Successfully";
    echo " <script>alert('$message');
    window.location.href='index.php';</script>";
    } else {
        echo "<div class='error'>Error: " . $conn->error . "</div>";
    }
}

$sql = "SELECT * FROM notice WHERE id=$id";
$result = $conn->query($sql);
$noticeData = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Notice</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <h1>Update Notice</h1>
    <form method="post">
        <textarea name="notice" required><?= $noticeData['notice']; ?></textarea>
        <button type="submit">Update Notice</button>
    </form>
</body>
</html>