<?php
session_start();
require_once 'config/database.php';

class Auth {
    private $db;
    private $conn;

    public function __construct() {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
    }

    // User registration
    public function register($username, $email, $password, $full_name, $role = 'client') {
        try {
            // Validate inputs
            if (empty($username) || empty($email) || empty($password) || empty($full_name)) {
                return ['success' => false, 'message' => 'All fields are required'];
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return ['success' => false, 'message' => 'Invalid email format'];
            }

            if (strlen($password) < 6) {
                return ['success' => false, 'message' => 'Password must be at least 6 characters'];
            }

            // Check if user already exists
            $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
            $stmt->execute([$email, $username]);
            
            if ($stmt->rowCount() > 0) {
                return ['success' => false, 'message' => 'Email or username already exists'];
            }

            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert user
            $stmt = $this->conn->prepare("INSERT INTO users (username, email, password, full_name, role) VALUES (?, ?, ?, ?, ?)");
            $result = $stmt->execute([$username, $email, $hashed_password, $full_name, $role]);

            if ($result) {
                return ['success' => true, 'message' => 'Registration successful! Welcome to our marketing agency.'];
            } else {
                return ['success' => false, 'message' => 'Registration failed. Please try again.'];
            }

        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Database error: ' . $e->getMessage()];
        }
    }

    // User login
    public function login($email_or_username, $password) {
        try {
            // Validate inputs
            if (empty($email_or_username) || empty($password)) {
                return ['success' => false, 'message' => 'Email/username and password are required'];
            }

            // Get user by email or username
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE (email = ? OR username = ?) AND is_active = 1");
            $stmt->execute([$email_or_username, $email_or_username]);
            $user = $stmt->fetch();

            if (!$user) {
                return ['success' => false, 'message' => 'Invalid credentials'];
            }

            // Verify password
            if (password_verify($password, $user['password'])) {
                // Update last login
                $stmt = $this->conn->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
                $stmt->execute([$user['id']]);

                // Set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['full_name'] = $user['full_name'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['logged_in'] = true;

                return ['success' => true, 'message' => 'Login successful! Welcome back to our marketing agency.', 'user' => $user];
            } else {
                return ['success' => false, 'message' => 'Invalid password'];
            }

        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Database error: ' . $e->getMessage()];
        }
    }

    // Check if user is logged in
    public function isLoggedIn() {
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }

    // Logout user
    public function logout() {
        session_destroy();
        return ['success' => true, 'message' => 'Logged out successfully'];
    }

    // Get current user
    public function getCurrentUser() {
        if ($this->isLoggedIn()) {
            return [
                'id' => $_SESSION['user_id'],
                'username' => $_SESSION['username'],
                'email' => $_SESSION['email'],
                'full_name' => $_SESSION['full_name'],
                'role' => $_SESSION['role']
            ];
        }
        return null;
    }
}
?>
