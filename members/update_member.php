<?php
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $designation = $_POST['designation'];
    $mobile_no = $_POST['mobile_no'];
    $email_id = $_POST['email_id'];
    $photo = addslashes(file_get_contents($_FILES['photo']['tmp_name']));

    $sql = "UPDATE members SET photo='$photo', name='$name', designation='$designation', 
            mobile_no='$mobile_no', email_id='$email_id' WHERE sr_no=$id";
    if ($conn->query($sql) === TRUE) {
        // header("Location: members_list.php?msg=update_success");
        
        // exit();
        $message="Member Updated Successfully";
        echo " <script>alert('$message');
        window.location.href='members_list.php';</script>";
        
    } else {
        echo "Error: " . $conn->error;
    }
}

$id = $_GET['id'];
$sql = "SELECT * FROM members WHERE sr_no=$id";
$result = $conn->query($sql);
$member = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Member</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <h1>Update Member</h1>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $id; ?>">
        <input type="text" name="name" value="<?= $member['name']; ?>" required>
        <input type="text" name="designation" value="<?= $member['designation']; ?>" required>
        <input type="text" name="mobile_no" value="<?= $member['mobile_no']; ?>" required>
        <input type="email" name="email_id" value="<?= $member['email_id']; ?>" required>
        <input type="file" name="photo" required>
        <button type="submit">Update</button>
        <button><a href="members_list.php">Member List</a></button>

    </form>
</body>
</html>