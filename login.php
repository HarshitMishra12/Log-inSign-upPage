<?php
require_once 'includes/auth.php';

$auth = new Auth();
$message = '';
$message_type = '';

// Redirect if already logged in
if ($auth->isLoggedIn()) {
    header('Location: dashboard.php');
    exit();
}

// Handle form submission
if ($_POST) {
    $email_or_username = trim($_POST['email_or_username']);
    $password = $_POST['password'];

    $result = $auth->login($email_or_username, $password);
    $message = $result['message'];
    $message_type = $result['success'] ? 'success' : 'error';
    
    if ($result['success']) {
        header('Location: dashboard.php');
        exit();
    }
}

// Get message from URL parameter
if (isset($_GET['message'])) {
    $message = $_GET['message'];
    $message_type = 'success';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MarketingFlow Agency | Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="auth-container">
        <!-- Animated Background -->
        <div class="animated-bg">
            <div class="floating-shapes">
                <div class="shape shape-1"></div>
                <div class="shape shape-2"></div>
                <div class="shape shape-3"></div>
                <div class="shape shape-4"></div>
                <div class="shape shape-5"></div>
            </div>
            <div class="gradient-overlay"></div>
        </div>

        <!-- Main Content -->
        <div class="auth-content">
            <div class="auth-card">
                <!-- Header -->
                <div class="auth-header">
                    <div class="logo-container">
                        <div class="logo">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <h1>MarketingFlow</h1>
                    </div>
                    <p class="tagline">Empowering Tomorrow, Today</p>
                </div>

                <!-- Login Form -->
                <form class="auth-form" method="POST" id="loginForm">
                    <div class="form-header">
                        <h2>Welcome Back</h2>
                        <p>Sign in to your marketing agency account</p>
                    </div>

                    <?php if ($message): ?>
                        <div class="message <?php echo $message_type; ?>">
                            <i class="fas fa-<?php echo $message_type === 'success' ? 'check-circle' : 'exclamation-circle'; ?>"></i>
                            <?php echo htmlspecialchars($message); ?>
                        </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <div class="input-container">
                            <input type="text" name="email_or_username" id="email_or_username" required>
                            <label for="email_or_username">Email or Username</label>
                            <i class="fas fa-user input-icon"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-container">
                            <input type="password" name="password" id="password" required>
                            <label for="password">Password</label>
                            <i class="fas fa-lock input-icon"></i>
                            <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-options">
                        <label class="checkbox-label">
                            <input type="checkbox" name="remember">
                            <span class="checkmark"></span>
                            Remember me
                        </label>
                        <a href="#" class="forgot-password">Forgot Password?</a>
                    </div>

                    <button type="submit" class="auth-btn">
                        <span>Sign In</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>

                    <div class="divider">
                        <span>or</span>
                    </div>

                    <div class="social-login">
                        <button type="button" class="social-btn google">
                            <i class="fab fa-google"></i>
                            <span>Continue with Google</span>
                        </button>
                        <button type="button" class="social-btn linkedin">
                            <i class="fab fa-linkedin-in"></i>
                            <span>Continue with LinkedIn</span>
                        </button>
                    </div>

                    <div class="auth-footer">
                        <p>Don't have an account? <a href="signup.php" class="link">Sign Up</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="assets/js/script.js"></script>
</body>
</html>
