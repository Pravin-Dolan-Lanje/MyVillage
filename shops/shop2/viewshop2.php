<?php
include 'dbconn.php';

$sql = "SELECT * FROM shopkeeper2_products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shopkeeper Products</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 30px;
        }
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
        .img-thumbnail {
            max-width: 80px;
            height: auto;
            border-radius: 5px;
        }
        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
            }
        }
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
         /* Footer */
         .footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: auto;
            width: 100%;
        }
        .footer a {
            color: #f8f9fa;
            text-decoration: none;
            margin: 0 10px;
            font-size: 16px;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="../../index.html">Siregaon Bandh</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="../../index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="../../subindex/gallery.html">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link" href="../../subindex/school.html">School/College</a></li>
                    <li class="nav-item"><a class="nav-link" href="../../subindex/Shops.html">Shops</a></li>
                    <li class="nav-item"><a class="nav-link" href="../../subindex/map.html">Map</a></li>
                </ul>
            </div>
        </div>
    </nav>
<div class="container">
    <h2 class="text-center mb-4">Shopkeeper Products</h2>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Product Use</th>
                    <th>Product Photo</th>
                    <th>Product Price</th>
                    
                </tr>
            </thead>
            <tbody>

                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["product_name"] . "</td>";
                    echo "<td>" . $row["product_use"] . "</td>";
                    echo "<td><img src='" . $row["product_photo"] . "' class='img-thumbnail'></td>";
                    echo "<td>₹" . $row["product_price"] . "</td>";
                   
                    echo "</tr>";
                }
                ?>

            </tbody>
        </table>
    </div>
</div>
<footer class="footer">
        <p>&copy; 2025 Siregaon Bandh. All rights reserved.</p>
        <p>
            <a href="../../login/shopkeeper2.html">Shopkeeper Login</a> | 
            Design by Pravin D. Lanje| 
            <a href="../../forms/contact_us.php">Contact Us</a>
        </p>
    </footer>
<!-- Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
