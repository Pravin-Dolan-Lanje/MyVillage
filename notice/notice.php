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
    <!-- <title>Notice Management</title> -->
    <!-- <link rel="stylesheet" href="assets/styles.css"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- <h1>Notice Management</h1>
    <h2>Notices List</h2> -->
    
    <?php if ($result->num_rows > 0): 
        
            echo "<ul>";?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    
                    <td><li><strong><?= $row['notice']; ?></strong></li></td><br>
                    
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p style="text-align: center;">No notices found.</p>
    <?php endif; ?>
    <?php "</ul>"?>
    <?php $conn->close(); ?>
</body >
</html>