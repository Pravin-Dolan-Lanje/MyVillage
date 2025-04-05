<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siregaon Village Forms</title>

</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f9;
        /* background-image: url(photo/environ.jpg); */
        background-size: cover;
    }

    header {
        background-color: #2adf6f;
        color: white;
        text-align: center;
        padding: 20px;
    }

    section {
        padding: 20px;
        margin: 20px;
    }

    .container {
        max-width: 1000px;
        margin: 0 auto;
    }

    h2 {
        color: #333;
    }



    /* Basic reset for consistent sizing */
    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    /* Main layout container */
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        /* Viewport height */
    }

    /* Content wrapper - grows to push footer down */
    .content {
        flex: 1;
    }

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

    /* Footer styles */
    .footer {
        background-color: #343a40;
        padding: 20px;
        text-align: center;
        margin-top: auto;
        /* Pushes footer to bottom */
    }
</style>
<style>
/* Base Styles */
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
</style>

<body>
    <!-- Bootstrap Navbar -->
    <div id="header-container"></div>
    <?php
// Database connection
include '../db_config.php';
// require_once '../Admin/auth_check.php';

$sql = "SELECT * FROM gram_panchayat_forms ORDER BY form_name";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Forms - Gram Panchayat</title>
    <style>
    /* CSS from above goes here */
    </style>
</head>
<body>
    <h1>Gram Panchayat Forms</h1>
    
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
                                    <a href="../forms/village & panchayat form/download.php?id=<?= $row['id'] ?>" class="btn">Download</a>
                                  
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>No forms available yet.</p>
        <?php endif; ?>
        
        
    </div>
</body>
</html>

    <div class="content">
        <!-- We are working on it. -->
        </div>

    <!-- Footer -->
    <div id="footer-container"></div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Function to load HTML into an element
        async function loadHTML(url, elementId) {
          try {
            const response = await fetch(url);
            const html = await response.text();
            document.getElementById(elementId).innerHTML = html;
          } catch (err) {
            console.error(`Failed to load ${url}:`, err);
          }
        }
        
        // Load your components when page loads
        window.addEventListener('DOMContentLoaded', () => {
          loadHTML('../include/header2.html', 'header-container');
          loadHTML('../include/footer2.html', 'footer-container');
        //   loadHTML('include/slider.html', 'slider-container');
        });
        
    </script>
    
    <!-- Footer Section
    <footer>
        <p>&copy; 2025 Siregaon Village | All Rights Reserved</p>
    </footer> -->

</body>

</html>