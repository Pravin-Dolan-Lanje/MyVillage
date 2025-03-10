<?php
include 'dbconn.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM shopkeeper1_products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $product_name = $_POST['product_name'];
    $product_use = $_POST['product_use'];
    $product_price = $_POST['product_price'];

    // Update SQL
    $sql = "UPDATE shopkeeper1_products SET product_name=?, product_use=?, product_price=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdi", $product_name, $product_use, $product_price, $id);

    if ($stmt->execute()) {
        header("Location: shop1.php");
        exit;
    } else {
        echo "Error updating product.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Product</title>
</head>
<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link rel="stylesheet" href="styles.css">

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
    <h2 class="text-center mt-4">Edit Product</h2>
    
    <div class="card p-4 shadow-sm">
        <form action="edit.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
            <input type="hidden" name="old_photo" value="<?php echo $product['product_photo']; ?>">

            <div class="mb-3">
                <label class="form-label">Product Name</label>
                <input type="text" name="product_name" class="form-control" value="<?php echo $product['product_name']; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Product Use</label>
                <input type="text" name="product_use" class="form-control" value="<?php echo $product['product_use']; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Product Price (₹)</label>
                <input type="number" name="product_price" class="form-control" value="<?php echo $product['product_price']; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Current Photo</label><br>
                <img src="<?php echo $product['product_photo']; ?>" class="img-thumbnail" width="100">
            </div>

            <div class="mb-3">
                <label class="form-label">Upload New Photo (Optional)</label>
                <input type="file" name="product_photo" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Update Product</button>
            <a href="shop1add.php" class="btn btn-success">Add Product</a>
            <a href="shop1.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
