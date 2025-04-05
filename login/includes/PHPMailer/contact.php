<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

// require 'vendor/autoload.php'; // If using Composer
// require 'PHPMailer/PHPMailer.php'; // If manually installed
// require 'PHPMailer/SMTP.php'; // If manually installed
// require 'PHPMailer/Exception.php'; // If manually installed

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_email = $_POST['email'];
    $user_message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';  // SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'lanjepravin0@gmail.com'; // Your Gmail address
        $mail->Password   = 'skux srsr scmd buqm'; // Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Sender and Recipient
        $mail->setFrom($user_email, 'User');
        $mail->addAddress('lanjepravin0@gmail.com', 'Pravin Lanje'); // Your email
        $mail->addReplyTo($user_email, 'User');

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body    = "<strong>Email:</strong> $user_email <br><strong>Message:</strong><br>$user_message";

        // Send Email
        if ($mail->send()) {
            echo "Email sent successfully!";
        } else {
            echo "Failed to send email.";
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
