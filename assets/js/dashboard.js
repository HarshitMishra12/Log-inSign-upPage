// Marketing Agency Dashboard - Interactive JavaScript

document.addEventListener('DOMContentLoaded', function() {
    initDashboard();
    initNavigation();
    initStatsAnimation();
    initQuickActions();
    initUserMenu();
    initResponsiveMenu();
});

// Initialize Dashboard
function initDashboard() {
    // Add entrance animations
    const elements = document.querySelectorAll('.stat-card, .activity-item, .action-card');
    elements.forEach((element, index) => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(30px)';
        
        setTimeout(() => {
            element.style.transition = 'all 0.6s ease-out';
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
        }, index * 100);
    });
}

// Navigation Functions
function initNavigation() {
    const navLinks = document.querySelectorAll('.nav-link');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all links
            navLinks.forEach(l => l.classList.remove('active'));
            
            // Add active class to clicked link
            this.classList.add('active');
            
            // Add click animation
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
            
            // Simulate page navigation
            const section = this.getAttribute('href').substring(1);
            showSection(section);
        });
    });
}

function showSection(sectionName) {
    // Hide all sections
    const sections = document.querySelectorAll('.dashboard-section');
    sections.forEach(section => {
        section.style.display = 'none';
    });
    
    // Show target section
    const targetSection = document.getElementById(sectionName);
    if (targetSection) {
        targetSection.style.display = 'block';
        targetSection.style.animation = 'fadeInUp 0.6s ease-out';
    } else {
        // Show default dashboard content
        showDashboardContent();
    }
}

function showDashboardContent() {
    // This would show the main dashboard content
    console.log('Showing dashboard content');
}

// Stats Animation
function initStatsAnimation() {
    const statNumbers = document.querySelectorAll('.stat-content h3');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateNumber(entry.target);
                observer.unobserve(entry.target);
            }
        });
    });
    
    statNumbers.forEach(stat => {
        observer.observe(stat);
    });
}

function animateNumber(element) {
    const target = parseInt(element.textContent.replace(/[^\d]/g, ''));
    const duration = 2000;
    const start = performance.now();
    
    function updateNumber(currentTime) {
        const elapsed = currentTime - start;
        const progress = Math.min(elapsed / duration, 1);
        
        const current = Math.floor(progress * target);
        const formatted = formatNumber(current, element.textContent);
        element.textContent = formatted;
        
        if (progress < 1) {
            requestAnimationFrame(updateNumber);
        }
    }
    
    requestAnimationFrame(updateNumber);
}

function formatNumber(num, originalText) {
    if (originalText.includes('K')) {
        return (num / 1000).toFixed(1) + 'K';
    } else if (originalText.includes('$')) {
        return '$' + num.toLocaleString();
    } else {
        return num.toLocaleString();
    }
}

// Quick Actions
function initQuickActions() {
    const actionCards = document.querySelectorAll('.action-card');
    
    actionCards.forEach(card => {
        card.addEventListener('click', function() {
            const action = this.querySelector('span').textContent;
            handleQuickAction(action);
            
            // Add click animation
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    });
}

function handleQuickAction(action) {
    switch(action) {
        case 'Create Campaign':
            showModal('Create Campaign', 'Campaign creation form would open here');
            break;
        case 'Add Client':
            showModal('Add Client', 'Client registration form would open here');
            break;
        case 'View Reports':
            showModal('View Reports', 'Analytics dashboard would open here');
            break;
        case 'Settings':
            showModal('Settings', 'Settings panel would open here');
            break;
        default:
            console.log(`Action: ${action}`);
    }
}

// User Menu
function initUserMenu() {
    const userMenuBtn = document.querySelector('.user-menu-btn');
    const userDropdown = document.querySelector('.user-dropdown');
    
    if (userMenuBtn && userDropdown) {
        userMenuBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            userDropdown.classList.toggle('show');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!userMenuBtn.contains(e.target) && !userDropdown.contains(e.target)) {
                userDropdown.classList.remove('show');
            }
        });
    }
}

// Responsive Menu
function initResponsiveMenu() {
    const menuToggle = document.createElement('button');
    menuToggle.className = 'menu-toggle';
    menuToggle.innerHTML = '<i class="fas fa-bars"></i>';
    menuToggle.style.cssText = `
        display: none;
        position: fixed;
        top: 20px;
        left: 20px;
        z-index: 1001;
        background: var(--primary-color);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 12px;
        cursor: pointer;
        font-size: 18px;
    `;
    
    document.body.appendChild(menuToggle);
    
    const nav = document.querySelector('.dashboard-nav');
    
    menuToggle.addEventListener('click', function() {
        nav.classList.toggle('open');
    });
    
    // Show/hide menu toggle based on screen size
    function checkScreenSize() {
        if (window.innerWidth <= 768) {
            menuToggle.style.display = 'block';
        } else {
            menuToggle.style.display = 'none';
            nav.classList.remove('open');
        }
    }
    
    window.addEventListener('resize', checkScreenSize);
    checkScreenSize();
}

// Modal System
function showModal(title, content) {
    const modal = document.createElement('div');
    modal.className = 'modal';
    modal.innerHTML = `
        <div class="modal-overlay">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>${title}</h3>
                    <button class="modal-close">&times;</button>
                </div>
                <div class="modal-body">
                    <p>${content}</p>
                </div>
                <div class="modal-footer">
                    <button class="btn-secondary modal-close">Close</button>
                </div>
            </div>
        </div>
    `;
    
    modal.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 2000;
        animation: fadeIn 0.3s ease-out;
    `;
    
    document.body.appendChild(modal);
    
    // Close modal handlers
    modal.querySelectorAll('.modal-close').forEach(btn => {
        btn.addEventListener('click', () => {
            modal.remove();
        });
    });
    
    modal.querySelector('.modal-overlay').addEventListener('click', (e) => {
        if (e.target === e.currentTarget) {
            modal.remove();
        }
    });
}

// Add modal styles
const modalStyles = document.createElement('style');
modalStyles.textContent = `
    .modal-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    
    .modal-content {
        background: var(--card-bg);
        border-radius: 16px;
        max-width: 500px;
        width: 100%;
        max-height: 80vh;
        overflow-y: auto;
        animation: slideUp 0.3s ease-out;
    }
    
    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 24px;
        border-bottom: 1px solid var(--border-color);
    }
    
    .modal-header h3 {
        margin: 0;
        font-size: 20px;
        font-weight: 600;
    }
    
    .modal-close {
        background: none;
        border: none;
        color: var(--text-secondary);
        font-size: 24px;
        cursor: pointer;
        padding: 0;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.3s ease;
    }
    
    .modal-close:hover {
        background: var(--border-color);
        color: var(--text-primary);
    }
    
    .modal-body {
        padding: 24px;
    }
    
    .modal-footer {
        padding: 24px;
        border-top: 1px solid var(--border-color);
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }
    
    .user-dropdown.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
    
    @media (max-width: 768px) {
        .modal-content {
            margin: 20px;
            max-width: none;
        }
    }
`;
document.head.appendChild(modalStyles);

// Real-time Updates Simulation
function initRealTimeUpdates() {
    // Simulate real-time data updates
    setInterval(() => {
        updateStats();
        addActivityItem();
    }, 30000); // Update every 30 seconds
}

function updateStats() {
    const statNumbers = document.querySelectorAll('.stat-content h3');
    statNumbers.forEach(stat => {
        const current = parseInt(stat.textContent.replace(/[^\d]/g, ''));
        const change = Math.floor(Math.random() * 10) - 5; // Random change between -5 and +5
        const newValue = Math.max(0, current + change);
        
        if (newValue !== current) {
            stat.style.transition = 'all 0.3s ease';
            stat.style.color = change > 0 ? 'var(--success-color)' : 'var(--error-color)';
            
            setTimeout(() => {
                stat.style.color = '';
                stat.textContent = formatNumber(newValue, stat.textContent);
            }, 300);
        }
    });
}

function addActivityItem() {
    const activities = [
        { icon: 'fas fa-plus-circle', title: 'New campaign created', desc: 'Q4 Holiday Campaign launched', time: 'Just now' },
        { icon: 'fas fa-user-plus', title: 'New client onboarded', desc: 'StartupXYZ joined as premium client', time: '2 minutes ago' },
        { icon: 'fas fa-chart-line', title: 'Performance update', desc: 'Campaign ROI increased by 15%', time: '5 minutes ago' },
        { icon: 'fas fa-bell', title: 'System notification', desc: 'Weekly report is ready', time: '10 minutes ago' }
    ];
    
    const randomActivity = activities[Math.floor(Math.random() * activities.length)];
    const activityList = document.querySelector('.activity-list');
    
    if (activityList) {
        const newItem = document.createElement('div');
        newItem.className = 'activity-item';
        newItem.innerHTML = `
            <div class="activity-icon">
                <i class="${randomActivity.icon}"></i>
            </div>
            <div class="activity-content">
                <h4>${randomActivity.title}</h4>
                <p>${randomActivity.desc}</p>
                <span class="activity-time">${randomActivity.time}</span>
            </div>
        `;
        
        newItem.style.opacity = '0';
        newItem.style.transform = 'translateY(20px)';
        
        activityList.insertBefore(newItem, activityList.firstChild);
        
        // Animate in
        setTimeout(() => {
            newItem.style.transition = 'all 0.6s ease-out';
            newItem.style.opacity = '1';
            newItem.style.transform = 'translateY(0)';
        }, 100);
        
        // Remove old items if too many
        const items = activityList.querySelectorAll('.activity-item');
        if (items.length > 5) {
            items[items.length - 1].remove();
        }
    }
}

// Initialize real-time updates
initRealTimeUpdates();
