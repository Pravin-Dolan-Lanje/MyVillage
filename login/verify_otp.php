<?php
session_start();

if (!isset($_SESSION['temp_user'])) {
    header('Location: login.php');
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['verify'])) {
    $userOtp = filter_input(INPUT_POST, 'otp', FILTER_SANITIZE_NUMBER_INT);
    
    if (isset($_SESSION['otp']) && isset($_SESSION['otp_time'])) {
        // OTP expires after 5 minutes (300 seconds)
        if ((time() - $_SESSION['otp_time']) > 300) {
            $error = "OTP has expired. Please request a new one.";
            unset($_SESSION['otp']);
            unset($_SESSION['otp_time']);
        } elseif ($_SESSION['otp'] == $userOtp) {
            // OTP verified successfully
            $_SESSION['user'] = $_SESSION['temp_user'];
            $_SESSION['user']['logged_in'] = true;
            $_SESSION['otp_verified'] = true;
            
            unset($_SESSION['temp_user']);
            unset($_SESSION['otp']);
            unset($_SESSION['otp_time']);
            
            header('Location: dashboard.php');
            exit();
        } else {
            $error = "Invalid OTP. Please try again.";
        }
    } else {
        $error = "OTP not found. Please request a new one.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --primary-light: rgba(67, 97, 238, 0.1);
            --secondary: #4cc9f0;
            --dark: #1f293a;
            --light-dark: #2c4766;
            --light: #f8f9fa;
            --light-transparent: rgba(255, 255, 255, 0.7);
            --danger: #f72585;
            --success: #4ad66d;
            --border-radius: 12px;
            --box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            --transition: all 0.3s ease;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            color: var(--light);
        }
        
        /* Background animation */
        .bg-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }
        
        .bg-circle {
            position: absolute;
            border-radius: 50%;
            background: var(--primary-light);
            animation: float 15s infinite linear;
            opacity: 0;
        }
        
        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(-1000px) rotate(720deg);
                opacity: 0;
            }
        }
        
        /* Main container */
        .otp-verification-container {
            width: 100%;
            max-width: 480px;
            padding: 2.5rem;
            background: rgba(31, 41, 58, 0.85);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            text-align: center;
            transform: translateY(0);
            transition: var(--transition);
        }
        
        .otp-verification-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.25);
        }
        
        /* Logo styles */
        .logo {
            margin-bottom: 1.5rem;
            transition: var(--transition);
        }
        
        .logo svg {
            width: 60px;
            height: 60px;
            filter: drop-shadow(0 0 8px rgba(67, 97, 238, 0.4));
        }
        
        .logo h2 {
            font-size: 1.8rem;
            margin-top: 0.8rem;
            font-weight: 600;
        }
        
        .highlight {
            color: var(--primary);
            font-weight: 700;
        }
        
        /* OTP message */
        .otp-message {
            margin-bottom: 2rem;
            line-height: 1.6;
        }
        
        .otp-message strong {
            color: var(--primary);
            font-weight: 500;
            word-break: break-all;
        }
        
        /* Error message */
        .error-message {
            color: var(--danger);
            background: rgba(247, 37, 133, 0.1);
            padding: 0.8rem;
            border-radius: var(--border-radius);
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            animation: shake 0.5s ease;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-5px); }
            40%, 80% { transform: translateX(5px); }
        }
        
        /* OTP input */
        .otp-input-container {
            display: flex;
            justify-content: center;
            gap: 0.8rem;
            margin-bottom: 2rem;
        }
        
        .otp-input {
            width: 55px;
            height: 55px;
            text-align: center;
            font-size: 1.4rem;
            font-weight: 600;
            border: 2px solid var(--light-dark);
            border-radius: var(--border-radius);
            background: rgba(44, 71, 102, 0.3);
            color: var(--light);
            transition: var(--transition);
        }
        
        .otp-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.3);
            outline: none;
            transform: scale(1.05);
        }
        
        /* Button styles */
        .btn {
            width: 100%;
            padding: 1rem;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
        }
        
        .btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(67, 97, 238, 0.4);
        }
        
        .btn:active {
            transform: translateY(0);
        }
        
        /* Resend link */
        .resend-link {
            margin-top: 1.5rem;
            color: var(--light-transparent);
            font-size: 0.9rem;
        }
        
        .resend-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
            position: relative;
        }
        
        .resend-link a:hover {
            color: var(--secondary);
        }
        
        .resend-link a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--secondary);
            transition: var(--transition);
        }
        
        .resend-link a:hover::after {
            width: 100%;
        }
        
        /* Responsive adjustments */
        @media (max-width: 576px) {
            .otp-verification-container {
                padding: 1.5rem;
                margin: 0 1rem;
            }
            
            .otp-input {
                width: 45px;
                height: 45px;
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Background animation -->
    <div class="bg-animation">
        <div class="bg-circle" style="width: 300px; height: 300px; top: 20%; left: 10%; animation-delay: 0s;"></div>
        <div class="bg-circle" style="width: 200px; height: 200px; top: 60%; left: 70%; animation-delay: 2s;"></div>
        <div class="bg-circle" style="width: 150px; height: 150px; top: 80%; left: 20%; animation-delay: 4s;"></div>
        <div class="bg-circle" style="width: 250px; height: 250px; top: 30%; left: 80%; animation-delay: 6s;"></div>
    </div>
    
    <div class="otp-verification-container">
        <div class="logo">
            <svg width="50" height="50" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#4361ee" stroke-width="2"/>
                <path d="M12 16V16.01M12 8V12" stroke="#4361ee" stroke-width="2" stroke-linecap="round"/>
            </svg>
            <h2>OTP <span class="highlight">Verification</span></h2>
        </div>
        
        <p class="otp-message">We've sent a 6-digit verification code to:<br>
        <strong><?php echo $_SESSION['temp_user']['email']; ?></strong></p>
        
        <?php if ($error): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="POST" action="verify_otp.php">
            <div class="otp-input-container">
                <input type="text" name="otp" class="otp-input" maxlength="6" pattern="\d{6}" 
                       required autofocus oninput="this.value = this.value.replace(/[^0-9]/g, '')">
            </div>
            
            <button type="submit" name="verify" class="btn">Verify & Continue</button>
        </form>
        
        <!-- <p class="resend-link">Didn't receive the code? <a href="resend_otp.php">Resend OTP</a></p> -->
    </div>
    
    <!-- Font Awesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    
    <script>
        // Auto-focus and auto-tab between OTP digits
        document.addEventListener('DOMContentLoaded', function() {
            const otpInput = document.querySelector('.otp-input');
            
            if (otpInput) {
                otpInput.focus();
                
                // Auto-advance to next input (if you had multiple digit boxes)
                // This is for a single input field, but kept for potential multi-input use
                otpInput.addEventListener('input', function(e) {
                    if (this.value.length === this.maxLength) {
                        this.blur();
                        document.querySelector('button[type="submit"]').focus();
                    }
                });
            }
        });
    </script>
</body>
</html>