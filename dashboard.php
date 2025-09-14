<?php
require_once 'includes/auth.php';

$auth = new Auth();

// Redirect if not logged in
if (!$auth->isLoggedIn()) {
    header('Location: login.php');
    exit();
}

$user = $auth->getCurrentUser();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MarketingFlow Dashboard | Welcome <?php echo htmlspecialchars($user['full_name']); ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="dashboard-body">
    <!-- Navigation -->
    <nav class="dashboard-nav">
        <div class="nav-brand">
            <div class="logo">
                <i class="fas fa-rocket"></i>
            </div>
            <h1>MarketingFlow</h1>
        </div>
        
        <div class="nav-menu">
            <a href="#dashboard" class="nav-link active">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <a href="#campaigns" class="nav-link">
                <i class="fas fa-bullhorn"></i>
                <span>Campaigns</span>
            </a>
            <a href="#analytics" class="nav-link">
                <i class="fas fa-chart-line"></i>
                <span>Analytics</span>
            </a>
            <a href="#clients" class="nav-link">
                <i class="fas fa-users"></i>
                <span>Clients</span>
            </a>
            <a href="#team" class="nav-link">
                <i class="fas fa-user-friends"></i>
                <span>Team</span>
            </a>
        </div>

        <div class="nav-user">
            <div class="user-info">
                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div class="user-details">
                    <span class="user-name"><?php echo htmlspecialchars($user['full_name']); ?></span>
                    <span class="user-role"><?php echo ucfirst($user['role']); ?></span>
                </div>
            </div>
            <div class="user-menu">
                <button class="user-menu-btn">
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="user-dropdown">
                    <a href="#profile"><i class="fas fa-user"></i> Profile</a>
                    <a href="#settings"><i class="fas fa-cog"></i> Settings</a>
                    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="dashboard-main">
        <!-- Welcome Section -->
        <section class="welcome-section">
            <div class="welcome-content">
                <h1>Welcome back, <?php echo htmlspecialchars($user['full_name']); ?>!</h1>
                <p>Ready to create amazing marketing campaigns? Let's get started.</p>
            </div>
            <div class="welcome-actions">
                <button class="btn-primary">
                    <i class="fas fa-plus"></i>
                    New Campaign
                </button>
                <button class="btn-secondary">
                    <i class="fas fa-chart-bar"></i>
                    View Analytics
                </button>
            </div>
        </section>

        <!-- Stats Cards -->
        <section class="stats-section">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <div class="stat-content">
                        <h3>24</h3>
                        <p>Active Campaigns</p>
                        <span class="stat-change positive">+12%</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-content">
                        <h3>1,234</h3>
                        <p>Total Clients</p>
                        <span class="stat-change positive">+8%</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="stat-content">
                        <h3>45.6K</h3>
                        <p>Impressions</p>
                        <span class="stat-change positive">+23%</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="stat-content">
                        <h3>$12.4K</h3>
                        <p>Revenue</p>
                        <span class="stat-change positive">+15%</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Recent Activity -->
        <section class="activity-section">
            <div class="section-header">
                <h2>Recent Activity</h2>
                <a href="#" class="view-all">View All</a>
            </div>
            
            <div class="activity-list">
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-plus-circle"></i>
                    </div>
                    <div class="activity-content">
                        <h4>New campaign created</h4>
                        <p>Summer Sale 2024 campaign launched</p>
                        <span class="activity-time">2 hours ago</span>
                    </div>
                </div>

                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="activity-content">
                        <h4>New client onboarded</h4>
                        <p>TechStart Inc. joined as premium client</p>
                        <span class="activity-time">4 hours ago</span>
                    </div>
                </div>

                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="activity-content">
                        <h4>Campaign performance update</h4>
                        <p>Q2 Campaign exceeded targets by 25%</p>
                        <span class="activity-time">1 day ago</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Quick Actions -->
        <section class="quick-actions">
            <h2>Quick Actions</h2>
            <div class="actions-grid">
                <button class="action-card">
                    <i class="fas fa-plus"></i>
                    <span>Create Campaign</span>
                </button>
                <button class="action-card">
                    <i class="fas fa-user-plus"></i>
                    <span>Add Client</span>
                </button>
                <button class="action-card">
                    <i class="fas fa-chart-bar"></i>
                    <span>View Reports</span>
                </button>
                <button class="action-card">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </button>
            </div>
        </section>
    </main>

    <script src="assets/js/script.js"></script>
    <script src="assets/js/dashboard.js"></script>
</body>
</html>
