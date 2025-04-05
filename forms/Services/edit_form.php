<?php
// Database connection
include '../../db_config.php';
require_once '../../Admin/auth_check.php';

// Get current form data
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM gram_panchayat_services WHERE id = $id");
$form = $result->fetch_assoc();

// Handle form update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $form_name = $conn->real_escape_string($_POST['form_name']);
    $form_description = $conn->real_escape_string($_POST['form_description']);
    
    // Update query
    $sql = "UPDATE gram_panchayat_services SET 
            form_name = '$form_name', 
            form_description = '$form_description' 
            WHERE id = $id";
    
    if ($conn->query($sql)) {
        header("Location: view_forms.php?message=Form+updated+successfully");
        exit();
    } else {
        $message = "Error updating form: " . $conn->error;
        $message_type = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Service - Gram Panchayat</title>
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
    <h1>Edit Gram Panchayat Form</h1>
    
    <div class="form-container">
        <?php if(isset($message)): ?>
            <div class="message <?= $message_type ?>"><?= $message ?></div>
        <?php endif; ?>
        
        <?php if ($form): ?>
            <form method="post">
                <input type="hidden" name="id" value="<?= $form['id'] ?>">
                
                <div class="form-group">
                    <label>Form Name:</label>
                    <input type="text" name="form_name" value="<?= htmlspecialchars($form['form_name']) ?>" required>
                </div>
                <div class="form-group">
                    <label>Description:</label>
                    <textarea name="form_description" required><?= htmlspecialchars($form['form_description']) ?></textarea>
                </div>
                <div class="form-group">
                    <label>Current File:</label>
                    <a href="<?= $form['file_path'] ?>" class="btn">Download Current File</a>
                </div>
                
                <button type="submit" class="btn btn-success">Update Form</button>
                <a href="view_forms.php" class="btn">Cancel</a>
            </form>
        <?php else: ?>
            <div class="message error">Form not found.</div>
            <a href="view_forms.php" class="btn">Back to Forms</a>
        <?php endif; ?>
    </div>
</body>
</html>