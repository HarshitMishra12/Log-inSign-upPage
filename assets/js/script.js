// Marketing Agency Login System - Interactive JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Initialize all interactive elements
    initFormAnimations();
    initPasswordToggle();
    initFormValidation();
    initFloatingShapes();
    initSmoothScrolling();
    initLoadingStates();
});

// Form Animations
function initFormAnimations() {
    const inputs = document.querySelectorAll('input, select');
    
    inputs.forEach(input => {
        // Add focus/blur animations
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            if (!this.value) {
                this.parentElement.classList.remove('focused');
            }
        });
        
        // Check if input has value on load
        if (input.value) {
            input.parentElement.classList.add('focused');
        }
    });
}

// Password Toggle Functionality
function initPasswordToggle() {
    const passwordToggles = document.querySelectorAll('.password-toggle');
    
    passwordToggles.forEach(toggle => {
        toggle.addEventListener('click', function() {
            const input = this.parentElement.querySelector('input');
            const icon = this.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
}

// Global password toggle function for onclick attributes
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const toggle = input.parentElement.querySelector('.password-toggle i');
    
    if (input.type === 'password') {
        input.type = 'text';
        toggle.classList.remove('fa-eye');
        toggle.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        toggle.classList.remove('fa-eye-slash');
        toggle.classList.add('fa-eye');
    }
}

// Form Validation
function initFormValidation() {
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!validateForm(this)) {
                e.preventDefault();
            } else {
                showLoadingState(this);
            }
        });
    });
}

function validateForm(form) {
    let isValid = true;
    const inputs = form.querySelectorAll('input[required], select[required]');
    
    inputs.forEach(input => {
        if (!input.value.trim()) {
            showFieldError(input, 'This field is required');
            isValid = false;
        } else {
            clearFieldError(input);
        }
    });
    
    // Email validation
    const emailInput = form.querySelector('input[type="email"]');
    if (emailInput && emailInput.value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(emailInput.value)) {
            showFieldError(emailInput, 'Please enter a valid email address');
            isValid = false;
        }
    }
    
    // Password validation
    const passwordInput = form.querySelector('input[name="password"]');
    if (passwordInput && passwordInput.value) {
        if (passwordInput.value.length < 6) {
            showFieldError(passwordInput, 'Password must be at least 6 characters');
            isValid = false;
        }
    }
    
    // Confirm password validation
    const confirmPasswordInput = form.querySelector('input[name="confirm_password"]');
    if (confirmPasswordInput && confirmPasswordInput.value) {
        if (confirmPasswordInput.value !== passwordInput.value) {
            showFieldError(confirmPasswordInput, 'Passwords do not match');
            isValid = false;
        }
    }
    
    return isValid;
}

function showFieldError(input, message) {
    clearFieldError(input);
    
    const errorDiv = document.createElement('div');
    errorDiv.className = 'field-error';
    errorDiv.textContent = message;
    errorDiv.style.cssText = `
        color: var(--error-color);
        font-size: 12px;
        margin-top: 4px;
        animation: slideDown 0.3s ease-out;
    `;
    
    input.parentElement.appendChild(errorDiv);
    input.style.borderColor = 'var(--error-color)';
}

function clearFieldError(input) {
    const existingError = input.parentElement.querySelector('.field-error');
    if (existingError) {
        existingError.remove();
    }
    input.style.borderColor = '';
}

// Floating Shapes Animation
function initFloatingShapes() {
    const shapes = document.querySelectorAll('.shape');
    
    shapes.forEach((shape, index) => {
        // Add random movement
        setInterval(() => {
            const randomX = Math.random() * 20 - 10;
            const randomY = Math.random() * 20 - 10;
            shape.style.transform = `translate(${randomX}px, ${randomY}px) rotate(${Math.random() * 360}deg)`;
        }, 3000 + index * 500);
    });
}

// Smooth Scrolling
function initSmoothScrolling() {
    const links = document.querySelectorAll('a[href^="#"]');
    
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

// Loading States
function initLoadingStates() {
    const buttons = document.querySelectorAll('.auth-btn');
    
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            if (this.type === 'submit') {
                showButtonLoading(this);
            }
        });
    });
}

function showButtonLoading(button) {
    const originalText = button.innerHTML;
    button.innerHTML = '<span class="loading"></span> Processing...';
    button.disabled = true;
    
    // Re-enable after 3 seconds (in case of errors)
    setTimeout(() => {
        button.innerHTML = originalText;
        button.disabled = false;
    }, 3000);
}

function showLoadingState(form) {
    const submitButton = form.querySelector('button[type="submit"]');
    if (submitButton) {
        showButtonLoading(submitButton);
    }
}

// Message Animations
function showMessage(message, type) {
    const messageDiv = document.createElement('div');
    messageDiv.className = `message ${type}`;
    messageDiv.innerHTML = `
        <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
        ${message}
    `;
    
    const form = document.querySelector('.auth-form');
    if (form) {
        form.insertBefore(messageDiv, form.firstChild);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            messageDiv.remove();
        }, 5000);
    }
}

// Social Login Handlers
document.addEventListener('click', function(e) {
    if (e.target.closest('.social-btn')) {
        const button = e.target.closest('.social-btn');
        const provider = button.classList.contains('google') ? 'Google' : 'LinkedIn';
        
        // Show loading state
        const originalContent = button.innerHTML;
        button.innerHTML = '<span class="loading"></span> Connecting...';
        button.disabled = true;
        
        // Simulate API call
        setTimeout(() => {
            showMessage(`${provider} login is not implemented yet`, 'error');
            button.innerHTML = originalContent;
            button.disabled = false;
        }, 2000);
    }
});

// Form Input Effects
document.addEventListener('input', function(e) {
    if (e.target.matches('input, select')) {
        const container = e.target.closest('.input-container');
        if (e.target.value) {
            container.classList.add('has-value');
        } else {
            container.classList.remove('has-value');
        }
    }
});

// Keyboard Navigation
document.addEventListener('keydown', function(e) {
    if (e.key === 'Enter' && e.target.matches('input')) {
        const form = e.target.closest('form');
        if (form) {
            const inputs = Array.from(form.querySelectorAll('input, select'));
            const currentIndex = inputs.indexOf(e.target);
            const nextInput = inputs[currentIndex + 1];
            
            if (nextInput) {
                nextInput.focus();
            } else {
                form.submit();
            }
        }
    }
});

// Add CSS for field errors
const style = document.createElement('style');
style.textContent = `
    .field-error {
        color: var(--error-color);
        font-size: 12px;
        margin-top: 4px;
        animation: slideDown 0.3s ease-out;
    }
    
    .input-container.has-value label {
        top: 0;
        left: 42px;
        font-size: 12px;
        color: var(--primary-color);
        transform: translateY(-50%);
    }
    
    .input-container.focused label {
        top: 0;
        left: 42px;
        font-size: 12px;
        color: var(--primary-color);
        transform: translateY(-50%);
    }
`;
document.head.appendChild(style);
