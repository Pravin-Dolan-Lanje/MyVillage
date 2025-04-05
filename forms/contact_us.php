<?php
include '../db_config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO `contact_us` (`id`, `name`, `email`, `message`) VALUES (NULL, '$name', '$email', '$message')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Your message has been recorded successfully.');</script>";

        // Create PHPMailer instance
        $mail = new PHPMailer(true);
        try {
            // SMTP settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'dnyan4mule@gmail.com';  // Your Gmail
            $mail->Password   = 'yllv anbv rihc nkup';        // Use App Password, NOT your real password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            

            // Sender and recipient
            $mail->setFrom('dnyan4mule@gmail.com', 'Sirebaon Bandh');
            $mail->addAddress($email, $name); // Send confirmation to user
            $mail->addAddress('dnyan4mule@gmail.com'); // Send message copy to admin

            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'Thank You for Contacting Us';
            $mail->Body    = "<p>Hello <b>$name</b>,</p>
                              <p>Thank you for reaching out! We received your message:</p>
                              <blockquote>$message</blockquote>
                              <p>We will get back to you soon.</p>
                              <p>Best regards,<br>Sirebaon Bandh Team</p>";

            $mail->send();
            echo "<script>alert('Message has been sent successfully.');</script>";
        } catch (Exception $e) {
            echo "<script>alert('Error sending email: {$mail->ErrorInfo}');</script>";
        }
    } else {
        echo "<script>alert('Error inserting data into the database.');</script>";
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
<body style="background-image: url('contact/contus.jpg');background-size:cover;" >
<div id="header-container"></div>
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
  <div id="footer-container"></div>
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
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</html>

