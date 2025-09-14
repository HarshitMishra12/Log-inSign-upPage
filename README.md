# MarketingFlow Agency - Login & Signup System

A modern, creative login and signup system for a marketing agency built with PHP, MySQL, HTML, CSS, and JavaScript. Features beautiful animations, responsive design, and secure authentication.

## 🚀 Features

### ✅ Completed Features
- **User Signup**: Register with username, email, password, and role selection
- **User Login**: Authenticate using email/username and password
- **Password Hashing**: Secure password storage using PHP's `password_hash()`
- **Error Handling**: Comprehensive validation and user-friendly error messages
- **Session Management**: Secure session handling with automatic redirects
- **Database Integration**: Full MySQL integration with PDO
- **Creative Design**: Modern, animated UI with marketing agency branding
- **Responsive Layout**: Works perfectly on all device sizes
- **Advanced Animations**: Smooth transitions and interactive elements

### 🎨 Design Features
- **Animated Background**: Floating shapes with gradient overlays
- **Glass Morphism**: Modern frosted glass effect on forms
- **Interactive Elements**: Hover effects, focus states, and micro-animations
- **Marketing Agency Branding**: Professional color scheme and typography
- **Dashboard Interface**: Complete admin dashboard with stats and activity feed

## 🛠️ Technologies Used

### Frontend
- **HTML5**: Semantic markup structure
- **CSS3**: Advanced styling with animations and responsive design
- **JavaScript**: Interactive functionality and form validation
- **Font Awesome**: Professional icons
- **Google Fonts**: Poppins font family

### Backend
- **PHP 7.4+**: Server-side logic and authentication
- **MySQL**: Database for user storage
- **PDO**: Secure database interactions

## 📁 Project Structure

```
Task 2/
├── assets/
│   ├── css/
│   │   ├── style.css          # Main styles with animations
│   │   └── dashboard.css      # Dashboard-specific styles
│   └── js/
│       ├── script.js          # Form interactions and validation
│       └── dashboard.js       # Dashboard functionality
├── config/
│   └── database.php           # Database configuration
├── includes/
│   └── auth.php              # Authentication class
├── database.sql              # Database schema
├── index.php                 # Entry point (redirects to login)
├── login.php                 # Login page
├── signup.php                # Registration page
├── dashboard.php             # Main dashboard
├── logout.php                # Logout handler
└── README.md                 # This file
```

## 🚀 Installation & Setup

### 1. Database Setup
1. Create a MySQL database named `marketing_agency_auth`
2. Import the `database.sql` file:
   ```sql
   mysql -u root -p marketing_agency_auth < database.sql
   ```

### 2. Database Configuration
Update `config/database.php` with your database credentials:
```php
private $host = 'localhost';
private $db_name = 'marketing_agency_auth';
private $username = 'your_username';
private $password = 'your_password';
```

### 3. Web Server Setup
1. Place all files in your web server directory (e.g., `htdocs`, `www`, etc.)
2. Ensure PHP and MySQL are running
3. Access the application via your web browser

### 4. Default Login
- **Username**: admin
- **Email**: admin@marketingagency.com
- **Password**: admin123

## 🎯 Key Features Explained

### Security Features
- **Password Hashing**: Uses PHP's `password_hash()` with default algorithm
- **SQL Injection Protection**: PDO prepared statements
- **Session Security**: Proper session management and validation
- **Input Validation**: Client-side and server-side validation

### User Experience
- **Real-time Validation**: Instant feedback on form inputs
- **Smooth Animations**: CSS transitions and JavaScript animations
- **Responsive Design**: Mobile-first approach
- **Accessibility**: Keyboard navigation and screen reader support

### Dashboard Features
- **Statistics Cards**: Animated counters and performance metrics
- **Activity Feed**: Real-time updates and notifications
- **Quick Actions**: One-click access to common tasks
- **User Management**: Profile and role-based access

## 🎨 Customization

### Colors
The color scheme can be customized by modifying CSS variables in `style.css`:
```css
:root {
    --primary-color: #6366f1;
    --secondary-color: #ec4899;
    --accent-color: #f59e0b;
    /* ... more variables */
}
```

### Animations
Animation timing and effects can be adjusted in the CSS files:
- Form animations: `style.css`
- Dashboard animations: `dashboard.css`
- JavaScript interactions: `script.js` and `dashboard.js`

## 🔧 Browser Support

- Chrome 60+
- Firefox 55+
- Safari 12+
- Edge 79+

## 📱 Responsive Breakpoints

- **Desktop**: 1024px and above
- **Tablet**: 768px - 1023px
- **Mobile**: 320px - 767px

## 🚀 Future Enhancements

- [ ] Email verification system
- [ ] Password reset functionality
- [ ] Two-factor authentication
- [ ] Social media login integration
- [ ] Advanced user roles and permissions
- [ ] API endpoints for mobile apps
- [ ] Real-time notifications
- [ ] Advanced analytics dashboard

## 📄 License

This project is created for educational purposes. Feel free to use and modify as needed.

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## 📞 Support

For questions or support, please contact the development team.

---

**MarketingFlow Agency** - Empowering Tomorrow, Today
