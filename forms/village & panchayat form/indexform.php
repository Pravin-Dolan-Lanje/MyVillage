<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Dashboard</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard-container {
            max-width: 600px;
            margin: 80px auto;
            padding: 20px;
            background: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }
        .btn-custom {
            width: 100%;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="dashboard-container">
        <h3 class="mb-4">Form Dashboard</h3>
        <a href="view_forms.php" class="btn btn-primary btn-custom">Forms</a>
        <a href="../Services/view_forms.php" class="btn btn-success btn-custom">Service</a>
        <a href="../Schemes/view_forms.php" class="btn btn-warning btn-custom">Schemes</a>
        <a href="../../login/dashboard.php" class="btn btn-danger btn-custom">Back</a>

        
    </div>
</div>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
