<?php
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $designation = $_POST['designation'];
    $mobile_no = $_POST['mobile_no'];
    $email_id = $_POST['email_id'];
    $photo = addslashes(file_get_contents($_FILES['photo']['tmp_name']));

    $sql = "INSERT INTO members (photo, name, designation, mobile_no, email_id) 
            VALUES ('$photo', '$name', '$designation', '$mobile_no', '$email_id')";
    if ($conn->query($sql) === TRUE) {
        // header("Location: members_list.php?msg=add_success");
        $message="New Member added Successfully";
      echo " <script>alert('$message');</script>";
        // exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Member</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <h1>Add New Member</h1>
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Name" required>
        <input type="text" name="designation" placeholder="Designation" required>
        <input type="text" name="mobile_no" placeholder="Mobile No" required>
        <input type="email" name="email_id" placeholder="Email ID" required>
        <input type="file" name="photo" required>
        <button type="submit">Add Member</button>
        <button><a href="members_list.php">Member List</a></button>
    </form>
</body>
</html>