
<?php
include 'contact/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO `contact_us` (`id`, `name`, `email`, `message`) VALUES (NULL, '$name', '$email', '$message')";
    if ($conn->query($sql) === TRUE) {
        // header("Location: members_list.php?msg=add_success");
        $message="Your message is recorded succefully";
      echo " <script>alert('$message');</script>";
        // exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
  
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body style="background-image: url(contact/contus.jpg);background-size:cover;" >
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="../index.html">Siregaon Bandh</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="../index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="../subindex/gallery.html">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link" href="../subindex/school.html">School/College</a></li>
                    <li class="nav-item"><a class="nav-link" href="../subindex/Shops.html">Shops</a></li>
                    <li class="nav-item"><a class="nav-link" href="../subindex/map.html">Map</a></li>
                </ul>
            </div>
        </div>
    </nav>
  <header>
    <h1>Contact Us</h1>
    <p>We'd love to hear from you. Feel free to get in touch!</p>
  </header><br><br>
<link rel="stylesheet" href="contact/cont_us.css">
  <main>

    <form  action="" method="post" enctype="multipart/form-data">
      <label for="name">Full Name:</label>
      <input type="text" id="name" name="name" required placeholder="Your Name">

      <label for="email">Email Address:</label>
      <input type="email" id="email" name="email" required placeholder="Your Email">

      <label for="message">Message:</label>
      <textarea id="message" name="message" required placeholder="Your Message"></textarea>

      <button type="submit">Submit</button>
    </form>
    <p id="successMessage" style="display:none; color: green;">Thank you for reaching out! We'll get back to you soon.</p>
  </main>
  <!-- <script src="cont_us.js"></script> -->
  <footer class="footer">
        <p>&copy; 2025 Siregaon Bandh. All rights reserved.</p>
        <p>
            <a href="../login/index1.HTML">Administrative Login</a> | 
            Design by Pravin D. Lanje| 
            <a href="contact_us.php">Contact Us</a>
        </p>
    </footer>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</html>