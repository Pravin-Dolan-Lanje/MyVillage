<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer {
    private $mail;

    public function __construct() {
        $this->mail = new PHPMailer(true);
        
        // Server settings
        $this->mail->isSMTP();
        $this->mail->Host       = SMTP_HOST;
        $this->mail->SMTPAuth   = true;
        $this->mail->Username   = SMTP_USER;
        $this->mail->Password   = SMTP_PASS;
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->Port       = SMTP_PORT;
        
        // Sender
        $this->mail->setFrom(SMTP_USER, 'Your System');
        $this->mail->isHTML(true);
    }

    public function sendOTP($email, $otp) {
        try {
            $this->mail->addAddress($email);
            $this->mail->Subject = 'Your Login OTP';
            $this->mail->Body    = "Your OTP code is: <b>$otp</b><br>Valid for 5 minutes.";
            
            $this->mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Mailer Error: " . $this->mail->ErrorInfo);
            return false;
        }
    }
}
?>