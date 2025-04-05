<?php
include '../db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO `feedback` (`id`, `name`, `email`, `message`) VALUES (NULL, '$name', '$email', '$message')";
    if ($conn->query($sql) === TRUE) {
        // header("Location: index.php?msg=Notice added successfully!");
        $message="Thanks for your Feedback";
    echo " <script>alert('$message');
    window.location.href='feedback.php';</script>";
    } else {
        echo "<div class='error'>Error: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Feedback Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            margin-top: 20px;
        }

        h2 {
            text-align: center;
            color: #5a8f7d;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-size: 1rem;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        textarea {
            resize: vertical;
            height: 100px;
        }

        .form-group span {
            color: red;
            font-size: 0.9rem;
            display: none;
        }

        .submit-btn {
            background-color: #5a8f7d;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            width: 100%;
        }

        .submit-btn:hover {
            background-color: #46896f;
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
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary w-100">
        <div class="container">
        <a class="navbar-brand" href="../index.html">Siregaon Bandh</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="../index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="../subindex/gallery.html">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link" href="../subindex/school.html">School/College</a></li>
                    <li class="nav-item"><a class="nav-link" href="../subindex/shops/Shops.php">Shops</a></li>
                    <li class="nav-item"><a class="nav-link" href="../subindex/map.html">Map</a></li>
                </ul>
            </div>
        </div>
    </nav>
   
    <div class="form-container">
        <h2>Customer Feedback</h2>
        <form method="post">
            <div class="form-group" enctype="multipart/form-data">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Your Name" required>
                <span id="name-error">Please enter your name</span>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Your Email" required>
                <span id="email-error">Please enter a valid email</span>
            </div>

            <div class="form-group">
                <label for="feedback">Your Feedback:</label>
                <textarea id="feedback" name="message" placeholder="Write your feedback here" required></textarea>
                <span id="feedback-error">Please provide your feedback</span>
            </div>

            <button type="submit" class="submit-btn">Submit Feedback</button>
        </form>
        <div id="response-message"></div>
    </div>

    <footer class="footer">
    <p>&copy; 2025 Siregaon Bandh. All rights reserved.</p>
        <p>
            <a href="../login/index1.HTML">Administrative Login</a> | 
            Design by Pravin D. Lanje| 
            <a href="contact_us.php">Contact Us</a>
        </p>
    </footer>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
