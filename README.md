# 🏆 Elite Chess Club Management System

## 📋 Project Overview

**Elite Chess Club Management System** is a comprehensive web application designed to manage a chess club's operations, including member management, event scheduling, merchandise sales, and tournament organization. Built using CodeIgniter 4 framework with modern security practices and responsive design.

### 🎯 Project Objectives

- **Member Management**: Complete CRUD operations for club members with role-based access
- **Event Management**: Create, schedule, and manage chess tournaments and events
- **Merchandise System**: Online store for chess-related products with payment processing
- **Leaderboard System**: Track member achievements and rankings
- **Payment Processing**: Handle membership fees and merchandise payments
- **Admin Dashboard**: Comprehensive administrative interface for club management

---

## 🛠️ Technology Stack

### Backend Technologies
- **PHP 8.0+**: Server-side programming language
- **CodeIgniter 4**: MVC framework for rapid development
- **MySQL**: Relational database management system
- **Apache/Nginx**: Web server

### Frontend Technologies
- **HTML5**: Semantic markup
- **CSS3**: Styling and responsive design
- **JavaScript (ES6+)**: Client-side interactivity
- **jQuery**: DOM manipulation and AJAX requests
- **Bootstrap 4**: CSS framework for responsive design

### Security & Validation
- **CSRF Protection**: Cross-Site Request Forgery prevention
- **XSS Prevention**: Output escaping and input sanitization
- **Password Hashing**: Secure password storage using `password_hash()`
- **Input Validation**: Server-side and client-side validation
- **Session Management**: Secure user session handling

---

## 📁 Project Structure

```
chessclub/
├── app/                          # Application core files
│   ├── Config/                   # Configuration files
│   │   ├── App.php              # Main application config
│   │   ├── Validation.php       # Validation rules
│   │   └── Database.php         # Database configuration
│   ├── Controllers/             # Controller classes
│   │   ├── AuthController.php   # Authentication handling
│   │   ├── AdminController.php  # Admin operations
│   │   └── ...                  # Other controllers
│   ├── Models/                  # Database models
│   │   ├── UserModel.php        # User data operations
│   │   ├── EventModel.php       # Event data operations
│   │   └── ...                  # Other models
│   ├── Views/                   # View templates
│   │   ├── auth/               # Authentication views
│   │   ├── admin/              # Admin interface views
│   │   ├── events/             # Event-related views
│   │   └── ...                 # Other view directories
│   ├── Libraries/              # Custom libraries
│   │   └── CustomValidationRules.php  # Custom validation methods
│   └── Helpers/                # Helper functions
│       └── validation_helper.php      # Validation helper functions
├── public/                      # Publicly accessible files
│   ├── css/                    # Stylesheets
│   ├── js/                     # JavaScript files
│   ├── images/                 # Image assets
│   └── index.php               # Front controller
├── writable/                   # Writable directories
│   ├── logs/                   # Application logs
│   ├── cache/                  # Cache files
│   └── uploads/                # File uploads
├── tests/                      # Test files
├── vendor/                     # Composer dependencies
└── README.md                   # Project documentation
```

---

## 🚀 Installation & Setup

### Prerequisites
- PHP 8.0 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- Composer (for dependency management)

### Step 1: Clone the Repository
```bash
git clone https://github.com/yourusername/chessclub.git
cd chessclub
```

### Step 2: Install Dependencies
```bash
composer install
```

### Step 3: Configure Database
1. Create a MySQL database for the project
2. Copy `app/Config/Database.php.example` to `app/Config/Database.php`
3. Update database credentials in the configuration file

### Step 4: Run Database Migrations
```bash
php spark migrate
```

### Step 5: Seed Initial Data (Optional)
```bash
php spark db:seed InitialData
```

### Step 6: Configure Web Server
Set the document root to the `public/` directory and ensure proper permissions.

### Step 7: Set Environment
Copy `.env.example` to `.env` and configure environment variables.

---

## 🔐 Security Features

### Authentication & Authorization
- **Session-based Authentication**: Secure user sessions with proper timeout
- **Role-based Access Control**: Different access levels (Admin, Gold, Silver, Bronze)
- **Password Security**: Bcrypt hashing with automatic upgrade from plain text
- **CSRF Protection**: Built-in CSRF token validation

### Input Validation & Sanitization
- **Server-side Validation**: Comprehensive validation rules for all inputs
- **Client-side Validation**: jQuery validation for immediate user feedback
- **Input Sanitization**: Type-specific sanitization functions
- **XSS Prevention**: Output escaping using `esc()` function

### File Upload Security
- **File Type Validation**: Restricted to allowed image formats
- **File Size Limits**: Configurable maximum file sizes
- **Image Dimension Validation**: Prevents oversized uploads
- **Secure File Storage**: Files stored outside web root

### Custom Validation Rules
- **Strong Password Requirements**: Uppercase, lowercase, number, special character
- **Malaysian Phone Validation**: Local phone number format validation
- **Malaysian IC Validation**: National ID number validation
- **Future Date Validation**: Ensures events are scheduled in the future
- **Chess Rating Validation**: Validates chess rating formats

---

## 📊 Database Schema

### Core Tables

#### Users Table
```sql
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    membership_level ENUM('Bronze', 'Silver', 'Gold', 'Admin') DEFAULT 'Bronze',
    status ENUM('Active', 'Inactive', 'Suspended') DEFAULT 'Active',
    honor_points INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

#### Events Table
```sql
CREATE TABLE events (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    event_date DATE NOT NULL,
    event_time TIME,
    location VARCHAR(255),
    max_participants INT,
    current_participants INT DEFAULT 0,
    status ENUM('Upcoming', 'Ongoing', 'Completed', 'Cancelled') DEFAULT 'Upcoming',
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id)
);
```

#### Merchandise Table
```sql
CREATE TABLE merchandise (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    stock_quantity INT DEFAULT 0,
    image VARCHAR(255),
    category VARCHAR(100),
    status ENUM('Available', 'Out of Stock', 'Discontinued') DEFAULT 'Available',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

---

## 🎮 Features & Functionality

### User Management
- **Registration**: New member registration with validation
- **Login/Logout**: Secure authentication system
- **Profile Management**: Update personal information
- **Membership Levels**: Bronze, Silver, Gold, and Admin tiers

### Event Management
- **Event Creation**: Admin can create new events
- **Event Registration**: Members can register for events
- **Event Scheduling**: Future date validation
- **Participant Management**: Track event registrations

### Merchandise System
- **Product Catalog**: Display available merchandise
- **Shopping Cart**: Add/remove items functionality
- **Payment Processing**: Multiple payment methods
- **Order Management**: Track order status

### Leaderboard System
- **Point Tracking**: Honor points system
- **Rankings**: Member rankings by points
- **Achievements**: Recognition for accomplishments
- **Analytics**: Performance statistics

### Admin Dashboard
- **User Management**: CRUD operations for users
- **Event Management**: Create and manage events
- **Order Processing**: Handle merchandise orders
- **Payment Approval**: Approve/reject payments
- **Analytics**: System statistics and reports

---

## 🔧 Configuration

### Environment Configuration
```php
// app/Config/App.php
public $appTimezone = 'Asia/Kuala_Lumpur';
public $charset = 'UTF-8';
public $forceGlobalSecureRequests = false;
```

### Database Configuration
```php
// app/Config/Database.php
public $default = [
    'DSN'      => '',
    'hostname' => 'localhost',
    'username' => 'your_username',
    'password' => 'your_password',
    'database' => 'chessclub_db',
    'DBDriver' => 'MySQLi',
    'DBPrefix' => '',
    'pConnect' => false,
    'DBDebug'  => (ENVIRONMENT !== 'production'),
    'charset'  => 'utf8',
    'DBCollate' => 'utf8_general_ci',
    'swapPre'  => '',
    'encrypt'  => false,
    'compress' => false,
    'strictOn' => false,
    'failover' => [],
    'port'     => 3306,
];
```

### Validation Configuration
```php
// app/Config/Validation.php
public $ruleSets = [
    \CodeIgniter\Validation\Rules::class,
    \CodeIgniter\Validation\FormatRules::class,
    \CodeIgniter\Validation\FileRules::class,
    \CodeIgniter\Validation\CreditCardRules::class,
    \App\Libraries\CustomValidationRules::class, // Custom rules
];
```

---

## 🧪 Testing

### Unit Testing
```bash
# Run all tests
php spark test

# Run specific test file
php spark test --filter AuthControllerTest

# Run tests with coverage
php spark test --coverage
```

### Manual Testing Checklist
- [ ] User registration and login
- [ ] Admin access control
- [ ] Event creation and management
- [ ] Merchandise ordering process
- [ ] Payment processing
- [ ] File upload functionality
- [ ] Validation error handling
- [ ] Responsive design testing

---

## 📝 API Documentation

### Authentication Endpoints

#### POST /login
User login endpoint
```json
{
    "email": "user@example.com",
    "password": "SecurePass123!"
}
```

#### POST /register
User registration endpoint
```json
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "SecurePass123!",
    "membership_level": "Bronze",
    "terms": "1"
}
```

### Event Endpoints

#### GET /events
Retrieve all events
```json
{
    "events": [
        {
            "id": 1,
            "title": "Chess Tournament",
            "description": "Monthly tournament",
            "event_date": "2024-02-15",
            "status": "Upcoming"
        }
    ]
}
```

---

## 🐛 Troubleshooting

### Common Issues

#### Database Connection Error
```bash
# Check database configuration
php spark db:show_tables

# Test database connection
php spark db:test
```

#### Permission Issues
```bash
# Set proper permissions
chmod -R 755 writable/
chmod -R 644 writable/logs/
```

#### Validation Errors
- Check validation rules in `app/Config/Validation.php`
- Verify custom validation methods are loaded
- Review client-side validation in `public/js/validation.js`

### Debug Mode
Enable debug mode in development:
```php
// app/Config/App.php
public $displayErrors = true;
```

---

## 📈 Performance Optimization

### Database Optimization
- Use database indexes for frequently queried columns
- Implement query caching for static data
- Optimize database queries to reduce load time

### Frontend Optimization
- Minify CSS and JavaScript files
- Optimize images for web delivery
- Implement lazy loading for images
- Use CDN for external libraries

### Caching Strategy
- Enable CodeIgniter's cache system
- Implement browser caching headers
- Use Redis/Memcached for session storage

---

## 🔄 Deployment

### Production Deployment Checklist
- [ ] Set environment to production
- [ ] Disable debug mode
- [ ] Configure error logging
- [ ] Set up SSL certificate
- [ ] Configure database backups
- [ ] Set up monitoring and alerts
- [ ] Test all functionality
- [ ] Update documentation

### Deployment Commands
```bash
# Production deployment
composer install --no-dev --optimize-autoloader
php spark migrate
php spark db:seed ProductionData
```

---

## 📚 Learning Resources

### CodeIgniter 4 Documentation
- [Official Documentation](https://codeigniter4.github.io/userguide/)
- [API Reference](https://codeigniter4.github.io/api/)
- [Tutorials](https://codeigniter4.github.io/tutorials/)

### Security Best Practices
- [OWASP Top 10](https://owasp.org/www-project-top-ten/)
- [PHP Security Guide](https://www.php.net/manual/en/security.php)
- [CodeIgniter Security](https://codeigniter4.github.io/userguide/concepts/security.html)

### Database Design
- [MySQL Documentation](https://dev.mysql.com/doc/)
- [Database Normalization](https://en.wikipedia.org/wiki/Database_normalization)
- [SQL Best Practices](https://www.sqlstyle.guide/)

---

## 👥 Contributing

### Development Workflow
1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests for new functionality
5. Submit a pull request

### Coding Standards
- Follow PSR-12 coding standards
- Add comprehensive comments and documentation
- Write unit tests for new features
- Ensure all tests pass before submitting

### Code Review Process
- All code changes require review
- Ensure security best practices are followed
- Verify functionality works as expected
- Check for potential performance issues

---

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## 👨‍💻 Author

**Your Name**
- Email: your.email@example.com
- GitHub: [@yourusername](https://github.com/yourusername)
- LinkedIn: [Your LinkedIn](https://linkedin.com/in/yourprofile)

---

## 🙏 Acknowledgments

- CodeIgniter team for the excellent framework
- Bootstrap team for the responsive CSS framework
- jQuery team for the JavaScript library
- All contributors and testers

---

## 📞 Support

For support and questions:
- Create an issue on GitHub
- Email: support@chessclub.com
- Documentation: [Project Wiki](https://github.com/yourusername/chessclub/wiki)

---

**Last Updated**: January 2024  
**Version**: 1.0.0  
**Status**: Production Ready
