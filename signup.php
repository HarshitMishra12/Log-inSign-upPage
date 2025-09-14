<?php
require_once 'includes/auth.php';

$auth = new Auth();
$message = '';
$message_type = '';

// Handle form submission
if ($_POST) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $full_name = trim($_POST['full_name']);
    $role = $_POST['role'];

    // Validate password match
    if ($password !== $confirm_password) {
        $message = 'Passwords do not match';
        $message_type = 'error';
    } else {
        $result = $auth->register($username, $email, $password, $full_name, $role);
        $message = $result['message'];
        $message_type = $result['success'] ? 'success' : 'error';
        
        if ($result['success']) {
            header('Location: login.php?message=' . urlencode($message));
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Our Marketing Agency | Sign Up</title>
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

                <!-- Signup Form -->
                <form class="auth-form" method="POST" id="signupForm">
                    <div class="form-header">
                        <h2>Join Our Agency</h2>
                        <p>Create your account and start your marketing journey</p>
                    </div>

                    <?php if ($message): ?>
                        <div class="message <?php echo $message_type; ?>">
                            <i class="fas fa-<?php echo $message_type === 'success' ? 'check-circle' : 'exclamation-circle'; ?>"></i>
                            <?php echo htmlspecialchars($message); ?>
                        </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <div class="input-container">
                            <input type="text" name="full_name" id="full_name" required>
                            <label for="full_name">Full Name</label>
                            <i class="fas fa-user input-icon"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-container">
                            <input type="text" name="username" id="username" required>
                            <label for="username">Username</label>
                            <i class="fas fa-at input-icon"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-container">
                            <input type="email" name="email" id="email" required>
                            <label for="email">Email Address</label>
                            <i class="fas fa-envelope input-icon"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-container">
                            <select name="role" id="role" required>
                                <option value="">Select Role</option>
                                <option value="client">Client</option>
                                <option value="employee">Employee</option>
                                <option value="manager">Manager</option>
                            </select>
                            <label for="role">Role</label>
                            <i class="fas fa-briefcase input-icon"></i>
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

                    <div class="form-group">
                        <div class="input-container">
                            <input type="password" name="confirm_password" id="confirm_password" required>
                            <label for="confirm_password">Confirm Password</label>
                            <i class="fas fa-lock input-icon"></i>
                            <button type="button" class="password-toggle" onclick="togglePassword('confirm_password')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-group checkbox-group">
                        <label class="checkbox-label">
                            <input type="checkbox" name="terms" required>
                            <span class="checkmark"></span>
                            I agree to the <a href="#" class="link">Terms of Service</a> and <a href="#" class="link">Privacy Policy</a>
                        </label>
                    </div>

                    <button type="submit" class="auth-btn">
                        <span>Create Account</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>

                    <div class="auth-footer">
                        <p>Already have an account? <a href="login.php" class="link">Sign In</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="assets/js/script.js"></script>
</body>
</html>
