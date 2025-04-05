<?php
// Database connection
include '../../db_config.php';
require_once '../../Admin/auth_check.php';

$sql = "SELECT * FROM gram_panchayat_services ORDER BY form_name";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Service - Gram Panchayat</title>
    <style>
<style>
/* Base Styles */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    line-height: 1.6;
    color: #333;
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f5f5f5;
}

h1, h2, h3 {
    color: #2c3e50;
    margin-top: 0;
}

a {
    color: #3498db;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

/* Forms */
.form-container {
    background: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-group input[type="text"],
.form-group textarea,
.form-group select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
}

.form-group textarea {
    min-height: 100px;
}

.form-group input[type="file"] {
    border: none;
}

button, .btn {
    background-color: #3498db;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    display: inline-block;
    margin-right: 10px;
    margin-bottom: 10px;
}

button:hover, .btn:hover {
    background-color: #2980b9;
}

.btn-danger {
    background-color: #e74c3c;
}

.btn-danger:hover {
    background-color: #c0392b;
}

.btn-success {
    background-color: #2ecc71;
}

.btn-success:hover {
    background-color: #27ae60;
}

/* Tables */
.table-responsive {
    overflow-x: auto;
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

th, td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #2c3e50;
    color: white;
}

tr:hover {
    background-color: #f5f5f5;
}

.action-links a {
    margin-right: 10px;
    white-space: nowrap;
}

/* Messages */
.message {
    padding: 10px 15px;
    margin-bottom: 20px;
    border-radius: 4px;
}

.success {
    background-color: #d4edda;
    color: #155724;
}

.error {
    background-color: #f8d7da;
    color: #721c24;
}

/* Responsive Design */
@media (max-width: 768px) {
    body {
        padding: 10px;
    }
    
    table {
        display: block;
    }
    
    th, td {
        padding: 8px 10px;
    }
    
    .action-links a {
        display: block;
        margin: 5px 0;
    }
}

@media (max-width: 480px) {
    .form-container {
        padding: 15px;
    }
    
    button, .btn {
        width: 100%;
        margin-right: 0;
    }
}
</style>    </style>
</head>
<body>
    <h1>Gram Panchayat Service</h1>
    
    <div class="form-container">
        <?php if(isset($_GET['message'])): ?>
            <div class="message success"><?= htmlspecialchars($_GET['message']) ?></div>
        <?php endif; ?>
        
        <?php if ($result->num_rows > 0): ?>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Form Name</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row["form_name"]) ?></td>
                                <td><?= htmlspecialchars($row["form_description"]) ?></td>
                                <td class="action-links">
                                    <a href="download.php?id=<?= $row['id'] ?>" class="btn">Download</a>
                                    <a href="edit_form.php?id=<?= $row['id'] ?>" class="btn">Edit</a>
                                    <a href="delete_form.php?id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Delete this form?')">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>No Service available yet.</p>
        <?php endif; ?>
        
        <a href="add_form.php" class="btn btn-success">Add New Form</a>
        <a href="../../login/dashboard.php" class="btn btn-success">Administrative Panel</a>
        <a href="../village & panchayat form/indexform.php" class="btn btn-success">Back</a>


    </div>
</body>
</html>