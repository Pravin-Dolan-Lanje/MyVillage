<?php
include '../../db_config.php';
require_once '../../Admin/auth_check.php';

// Fetch Members
$sql = "SELECT * FROM feedback";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="../contact/index.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <h1>Contact_US Management</h1>
   <button> <a href="../../login/dashboard.php" class="add-btn">Administrative panel</a></button>
    <h2> List</h2>
    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email ID</th>
                <th>Message</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?= $row['name']; ?></td>
                    <td><?= $row['email']; ?></td>
                    <td><?= $row['message']; ?></td>
                    <td class="actions">
                       
                        <a href="delete.php?id=<?= $row['id']; ?>" title="Delete" onclick="return confirm('Are you sure?')">
                            <i class="fas fa-trash-alt" style="color: #e74c3c;">    </i>
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p style="text-align: center;">No messages found.</p>
    <?php endif; ?>
    <?php $conn->close(); ?>
</body>
</html>