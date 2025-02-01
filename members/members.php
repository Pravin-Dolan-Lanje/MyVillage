<?php
include 'db_config.php';

// Fetch Members
$sql = "SELECT * FROM members";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Members List</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <h1>Members Management</h1>
    <h2>Members List</h2>
    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Sr. No</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Mobile No.</th>
                <th>Email ID</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['sr_no']; ?></td>
                    <td><img src="data:image/jpeg;base64,<?= base64_encode($row['photo']); ?>" alt="Photo"></td>
                    <td><?= $row['name']; ?></td>
                    <td><?= $row['designation']; ?></td>
                    <td><?= $row['mobile_no']; ?></td>
                    <td><?= $row['email_id']; ?></td>  
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p style="text-align: center;">No members found.</p>
    <?php endif; ?>
    <?php $conn->close(); ?>
</body>
</html>