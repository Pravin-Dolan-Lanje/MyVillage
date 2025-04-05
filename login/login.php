<?php
require_once __DIR__ . '/includes/config.php';
require_once  '../Database.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    
    try {
        $db = new Database();
        $user = $db->verifyUser($email, $password);
        
        if ($user) {
            $_SESSION['temp_user'] = $user;
            
            // Generate OTP
            $otp = rand(100000, 999999);
            $_SESSION['otp'] = $otp;
            $_SESSION['otp_time'] = time();
            
            // Send OTP
            $mailer = new Mailer();
            if ($mailer->sendOTP($email, $otp)) {
                header('Location: verify_otp.php');
                exit();
            } else {
                $error = "Failed to send OTP. Please try again.";
            }
        } else {
            $error = "Invalid email or password.";
        }
    } catch (Exception $e) {
        $error = "System error. Please try again later.";
        error_log($e->getMessage());
    }
}

// Rest of your HTML remains the same
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login with OTP Verification</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --secondary: #4cc9f0;
            --dark: #1f293a;
            --light-dark: #2c4766;
            --light: #f8f9fa;
            --danger: #f72585;
            --success: #4ad66d;
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
        }
        
        .login-container {
            position: relative;
            width: 100%;
            max-width: 420px;
            padding: 40px;
            background: rgba(31, 41, 58, 0.9);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            z-index: 10;
            overflow: hidden;
        }
        
        .login-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                to bottom right,
                transparent 0%,
                rgba(67, 97, 238, 0.1) 50%,
                transparent 100%
            );
            transform: rotate(30deg);
            z-index: -1;
        }
        
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .logo h2 {
            font-size: 1.8em;
            color: var(--light);
            margin-top: 10px;
            font-weight: 600;
        }
        
        .logo .highlight {
            color: var(--primary);
        }
        
        .login-form {
            width: 100%;
        }
        
        .input-group {
            position: relative;
            margin-bottom: 25px;
        }
        
        .input-group input {
            width: 100%;
            height: 50px;
            background: rgba(44, 71, 102, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            outline: none;
            border-radius: 8px;
            font-size: 1em;
            color: var(--light);
            padding: 0 45px 0 20px;
            transition: all 0.3s ease;
        }
        
        .input-group input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(67, 97, 238, 0.2);
        }
        
        .input-group label {
            position: absolute;
            top: 50%;
            left: 20px;
            transform: translateY(-50%);
            font-size: 1em;
            color: rgba(255, 255, 255, 0.7);
            pointer-events: none;
            transition: all 0.3s ease;
        }
        
        .input-group input:focus ~ label,
        .input-group input:valid ~ label {
            top: 0;
            font-size: 0.8em;
            background: var(--dark);
            padding: 0 8px;
            color: var(--primary);
        }
        
        .input-group .icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.5);
        }
        
        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            font-size: 0.9em;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
        }
        
        .remember-me input {
            margin-right: 8px;
            accent-color: var(--primary);
        }
        
        .forgot-pass a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .forgot-pass a:hover {
            color: var(--primary);
        }
        
        .btn {
            width: 100%;
            height: 50px;
            background: var(--primary);
            border: none;
            outline: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1em;
            color: white;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
        }
        
        .btn:active {
            transform: translateY(0);
        }
        
        .error-message {
            color: var(--danger);
            font-size: 0.85em;
            margin-top: 5px;
            text-align: center;
        }
        
        /* Background animation elements */
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
            background: rgba(67, 97, 238, 0.1);
            animation: float 15s infinite linear;
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
    </style>
</head>
<body>
    <!-- Background animation -->
    <div class="bg-animation">
        <div class="bg-circle" style="width: 300px; height: 300px; top: 20%; left: 10%;"></div>
        <div class="bg-circle" style="width: 200px; height: 200px; top: 60%; left: 70%;"></div>
        <div class="bg-circle" style="width: 150px; height: 150px; top: 80%; left: 20%;"></div>
        <div class="bg-circle" style="width: 250px; height: 250px; top: 30%; left: 80%;"></div>
    </div>
    
    <div class="login-container">
        <div class="logo">
            <svg width="50" height="50" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#4361ee" stroke-width="2"/>
                <path d="M12 16V16.01M12 8V12" stroke="#4361ee" stroke-width="2" stroke-linecap="round"/>
            </svg>
            <h2>Secure <span class="highlight">Login</span></h2>
        </div>
        
        <form class="login-form" method="POST" action="login.php">
            <?php if ($error): ?>
                <div class="error-message"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <div class="input-group">
                <input type="email" id="email" name="email" required>
                <label>Email Address</label>
                <i class="fas fa-envelope icon"></i>
            </div>
            
            <div class="input-group">
                <input type="password" id="password" name="password" required>
                <label>Password</label>
                <i class="fas fa-lock icon"></i>
            </div>
            
            <div class="options">
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember me</label>
                </div>
                <div class="forgot-pass">
                    <a href="#">Forgot password?</a>
                </div>
            </div>
            
            <button type="submit" name="login" class="btn">Login</button>
            <hr>
            <button class="btn" ><a class="btn" href="../index.html">Home</a> </button>
        </form>
    </div>
    
    <!-- Font Awesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>