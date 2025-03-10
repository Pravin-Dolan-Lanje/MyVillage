<?php
include 'dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $product_use = $_POST['product_use'];
    $product_price = $_POST['product_price'];

    // Ensure the uploads directory exists
    $target_dir = "uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true); // Create folder if it doesn't exist
    }

    // File upload handling
    $target_file = $target_dir . basename($_FILES["product_photo"]["name"]);
    
    if (move_uploaded_file($_FILES["product_photo"]["tmp_name"], $target_file)) {
        // Insert into database
        $sql = "INSERT INTO shopkeeper1_products (product_name, product_use, product_photo, product_price) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssd", $product_name, $product_use, $target_file, $product_price);

        if ($stmt->execute()) {
            echo "Product added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "File upload failed!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<style>
    /* General Page Styling */
body {
    background-color: #f8f9fa;
    font-family: Arial, sans-serif;
}

/* Container */
.container {
    margin-top: 30px;
}

/* Table Styling */
.table {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}

.table th {
    background-color: #007bff;
    color: white;
    text-align: center;
}

.table td {
    vertical-align: middle;
    text-align: center;
}

/* Image Styling */
.img-thumbnail {
    max-width: 80px;
    height: auto;
    border-radius: 5px;
}

/* Responsive Table */
@media (max-width: 768px) {
    .table-responsive {
        overflow-x: auto;
    }
}

/* Buttons */
.btn {
    font-size: 14px;
    padding: 5px 10px;
}

</style>
<body>
<div class="container">
    <h2 class="text-center mt-4">Add New Product</h2>
    
    <div class="card p-4 shadow-sm">
        <form action="shop1add.php" method="POST" enctype="multipart/form-data">

            <div class="mb-3">
                <label class="form-label">Product Name</label>
                <input type="text" name="product_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Product Use</label>
                <input type="text" name="product_use" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Product Price (₹)</label>
                <input type="number" name="product_price" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Upload Product Photo</label>
                <input type="file" name="product_photo" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Add Product</button>
            <a href="shop1.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
