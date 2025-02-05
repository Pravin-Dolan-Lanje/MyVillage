<?php
include 'db_config.php';

// Fetch Notices
$sql = "SELECT * FROM notice";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notice Management</title>
    <link rel="stylesheet" href="assets/styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <h1>Notice Management</h1>
    <a href="add_notice.php" class="add-btn">+ Add New Notice</a>
    <h2>Notices List</h2>
    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Notice</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['notice']; ?></td>
                    <td class="actions">
                        <a href="update_notice.php?id=<?= $row['id']; ?>" title="Update">
                            <i class="fas fa-edit" style="color: #3498db;"></i>
                        </a>
                        <a href="delete_notice.php?id=<?= $row['id']; ?>" title="Delete" onclick="return confirm('Are you sure?')">
                            <i class="fas fa-trash-alt" style="color: #e74c3c;"></i>
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p style="text-align: center;">No notices found.</p>
    <?php endif; ?>
    <?php $conn->close(); ?>
</body>
</html>