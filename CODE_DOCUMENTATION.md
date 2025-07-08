# 📚 Chess Club Management System - Code Documentation

## 📋 Table of Contents

1. [Project Overview](#project-overview)
2. [Architecture](#architecture)
3. [Controllers](#controllers)
4. [Models](#models)
5. [Views](#views)
6. [Libraries](#libraries)
7. [Helpers](#helpers)
8. [Configuration](#configuration)
9. [Security Implementation](#security-implementation)
10. [Database Design](#database-design)
11. [API Documentation](#api-documentation)
12. [Testing Strategy](#testing-strategy)
13. [Deployment Guide](#deployment-guide)

---

## 🎯 Project Overview

### Purpose
The Chess Club Management System is designed to provide a comprehensive web-based solution for managing chess club operations, including member management, event scheduling, merchandise sales, and tournament organization.

### Key Features
- **User Authentication & Authorization**: Secure login/logout with role-based access
- **Member Management**: Complete CRUD operations for club members
- **Event Management**: Create, schedule, and manage chess tournaments
- **Merchandise System**: Online store with shopping cart and payment processing
- **Leaderboard System**: Track member achievements and rankings
- **Admin Dashboard**: Comprehensive administrative interface

### Technology Stack
- **Backend**: PHP 8.0+, CodeIgniter 4, MySQL
- **Frontend**: HTML5, CSS3, JavaScript, jQuery, Bootstrap 4
- **Security**: CSRF protection, XSS prevention, password hashing
- **Validation**: Server-side and client-side validation

---

## 🏗️ Architecture

### MVC Pattern Implementation

#### Model Layer
- **UserModel**: Handles user data operations
- **EventModel**: Manages event-related data
- **MerchandiseModel**: Handles product and order data
- **PaymentModel**: Processes payment transactions

#### View Layer
- **Authentication Views**: Login, registration forms
- **Admin Views**: Dashboard, user management, event management
- **Member Views**: Profile, events, merchandise
- **Public Views**: Homepage, leaderboard, contact

#### Controller Layer
- **AuthController**: Authentication and user management
- **AdminController**: Administrative operations
- **EventController**: Event management
- **MerchandiseController**: Product and order management

### File Structure
```
app/
├── Config/           # Configuration files
├── Controllers/      # Controller classes
├── Models/          # Database models
├── Views/           # View templates
├── Libraries/       # Custom libraries
├── Helpers/         # Helper functions
└── Filters/         # Request filters
```

---

## 🎮 Controllers

### AuthController

#### Purpose
Handles all authentication-related operations including user login, registration, logout, and session management.

#### Key Methods

##### `login()`
```php
/**
 * Display the login form
 * 
 * This method renders the login view for users to enter their credentials.
 * The form includes CSRF protection and client-side validation.
 * 
 * @return \CodeIgniter\HTTP\RedirectResponse|string Login view
 */
public function login()
{
    // Check if user is already logged in
    if (session()->get('isLoggedIn')) {
        return redirect()->to('/dashboard');
    }

    return view('auth/login');
}
```

**Parameters**: None  
**Returns**: Login view or redirect to dashboard  
**Security**: Session check, CSRF protection  

##### `loginPost()`
```php
/**
 * Process user login form submission
 * 
 * This method handles the login form submission with the following steps:
 * 1. Validate input data (email and password)
 * 2. Check user credentials against database
 * 3. Verify password using password_verify()
 * 4. Upgrade plain text passwords to hash if needed
 * 5. Create user session
 * 6. Redirect based on user role
 * 
 * @return \CodeIgniter\HTTP\RedirectResponse Redirect to dashboard or back with errors
 */
public function loginPost()
```

**Security Features**:
- Input validation prevents SQL injection
- Password verification prevents brute force attacks
- Session management ensures secure authentication
- Role-based redirection

##### `registerPost()`
```php
/**
 * Process user registration form submission
 * 
 * This method handles the registration form submission with the following steps:
 * 1. Validate all input data (name, email, password, membership level)
 * 2. Check for unique email address
 * 3. Hash password securely
 * 4. Create new user account
 * 5. Handle success/error responses
 * 
 * @return \CodeIgniter\HTTP\RedirectResponse Redirect to login or back with errors
 */
public function registerPost()
```

**Security Features**:
- Strong password requirements
- Email uniqueness validation
- Secure password hashing
- Input sanitization

### AdminController

#### Purpose
Provides administrative functionality for the Chess Club application. Handles all admin-only operations with proper access control and validation.

#### Key Methods

##### `requireAdmin()`
```php
/**
 * Check if current user has admin privileges
 * 
 * This method verifies that the logged-in user has admin-level access.
 * If not, it redirects to login page with an error message.
 * 
 * @return \CodeIgniter\HTTP\RedirectResponse|null Redirect if not admin, null if admin
 */
private function requireAdmin()
```

**Security Features**:
- Session-based authentication check
- Role-based authorization
- Secure redirect handling
- Audit logging

##### `manageUsers()`
```php
/**
 * Display user management interface
 * 
 * This method shows a list of all registered users with options to
 * edit, delete, or manage their accounts.
 * 
 * @return string User management view
 */
public function manageUsers()
```

**Features**:
- Paginated user list
- Search and filter capabilities
- Bulk operations

##### `updateUser($id)`
```php
/**
 * Update user information
 * 
 * This method processes the user edit form submission and updates
 * the user's information in the database.
 * 
 * @param int $id The user ID to update
 * @return \CodeIgniter\HTTP\RedirectResponse Redirect with success/error message
 */
public function updateUser($id)
```

**Security Features**:
- Input validation
- Data sanitization
- Audit logging
- Error handling

---

## 📊 Models

### UserModel

#### Purpose
Handles all database operations related to user management, including CRUD operations, authentication, and user data validation.

#### Key Methods

##### `findByEmail($email)`
```php
/**
 * Find user by email address
 * 
 * @param string $email User's email address
 * @return array|null User data or null if not found
 */
public function findByEmail($email)
{
    return $this->where('email', $email)->first();
}
```

##### `updateUserStatus($userId, $status)`
```php
/**
 * Update user account status
 * 
 * @param int $userId User ID
 * @param string $status New status (Active, Inactive, Suspended)
 * @return bool Success status
 */
public function updateUserStatus($userId, $status)
{
    return $this->update($userId, ['status' => $status]);
}
```

### EventModel

#### Purpose
Manages event-related data operations including event creation, updates, participant management, and event queries.

#### Key Methods

##### `getUpcomingEvents()`
```php
/**
 * Get all upcoming events
 * 
 * @return array List of upcoming events
 */
public function getUpcomingEvents()
{
    return $this->where('event_date >=', date('Y-m-d'))
                ->where('status', 'Upcoming')
                ->orderBy('event_date', 'ASC')
                ->findAll();
}
```

##### `addParticipant($eventId, $userId)`
```php
/**
 * Add participant to event
 * 
 * @param int $eventId Event ID
 * @param int $userId User ID
 * @return bool Success status
 */
public function addParticipant($eventId, $userId)
{
    // Check if event has capacity
    $event = $this->find($eventId);
    if ($event['current_participants'] >= $event['max_participants']) {
        return false;
    }
    
    // Increment participant count
    return $this->update($eventId, [
        'current_participants' => $event['current_participants'] + 1
    ]);
}
```

---

## 🎨 Views

### Authentication Views

#### `auth/login.php`
```php
<!-- Login Form Structure -->
<form method="post" action="<?= base_url('login') ?>" class="elite-form" id="loginForm">
    <?= csrf_field() ?>
    
    <!-- Error Display -->
    <?php if (session()->getFlashdata('errors')): ?>
        <div class="validation-summary">
            <h4><i class="fas fa-exclamation-triangle"></i> Please correct the following errors:</h4>
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    
    <!-- Form Fields -->
    <div class="input-field">
        <input type="email" name="email" placeholder="Your Email Address" required 
               class="elite-input" value="<?= old('email') ?>">
    </div>
    
    <div class="input-field">
        <input type="password" name="password" placeholder="Your Password" required 
               class="elite-input">
    </div>
    
    <button type="submit" class="elite-button">Access Club</button>
</form>
```

**Security Features**:
- CSRF token protection
- Input validation
- XSS prevention with `esc()` function
- Form value preservation with `old()` helper

#### `auth/register.php`
```php
<!-- Registration Form Structure -->
<form method="post" action="<?= base_url('register') ?>" class="elite-form" id="registerForm">
    <?= csrf_field() ?>
    
    <!-- Form Fields with Validation -->
    <div class="input-field <?= get_field_class('name') ?>">
        <input type="text" name="name" placeholder="Full Name" required 
               class="elite-input" value="<?= get_field_value('name') ?>">
        <?= display_field_error('name') ?>
    </div>
    
    <div class="input-field <?= get_field_class('email') ?>">
        <input type="email" name="email" placeholder="Email Address" required 
               class="elite-input" value="<?= get_field_value('email') ?>">
        <?= display_field_error('email') ?>
    </div>
    
    <div class="input-field <?= get_field_class('password') ?>">
        <input type="password" name="password" placeholder="Password" required 
               class="elite-input">
        <?= display_field_error('password') ?>
        <?= display_field_help('password') ?>
    </div>
</form>
```

### Admin Views

#### `admin/dashboard.php`
```php
<!-- Admin Dashboard Structure -->
<div class="admin-dashboard">
    <h1><?= esc($title) ?></h1>
    
    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <h3>Total Users</h3>
            <p><?= esc($stats['total_users']) ?></p>
        </div>
        <div class="stat-card">
            <h3>Active Events</h3>
            <p><?= esc($stats['active_events']) ?></p>
        </div>
        <div class="stat-card">
            <h3>Pending Orders</h3>
            <p><?= esc($stats['pending_orders']) ?></p>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="quick-actions">
        <a href="<?= base_url('admin/users') ?>" class="action-btn">Manage Users</a>
        <a href="<?= base_url('admin/events') ?>" class="action-btn">Manage Events</a>
        <a href="<?= base_url('admin/orders') ?>" class="action-btn">View Orders</a>
    </div>
</div>
```

---

## 📚 Libraries

### CustomValidationRules

#### Purpose
Provides custom validation rules specific to the Chess Club application, including Malaysian-specific validations and chess-related rules.

#### Key Methods

##### `strong_password($str, &$error)`
```php
/**
 * Validate strong password requirements
 * 
 * Password must contain:
 * - At least one uppercase letter
 * - At least one lowercase letter
 * - At least one number
 * - At least one special character
 * 
 * @param string $str Password to validate
 * @param string &$error Error message reference
 * @return bool Validation result
 */
public function strong_password(string $str, string &$error = null): bool
{
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/', $str)) {
        $error = 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.';
        return false;
    }
    
    return true;
}
```

##### `valid_my_phone($str, &$error)`
```php
/**
 * Validate Malaysian phone number format
 * 
 * Supports formats:
 * - Mobile: 01xxxxxxxx
 * - Landline: 03xxxxxxx, 04xxxxxxx, etc.
 * 
 * @param string $str Phone number to validate
 * @param string &$error Error message reference
 * @return bool Validation result
 */
public function valid_my_phone(string $str, string &$error = null): bool
{
    $phone = preg_replace('/[^0-9]/', '', $str);
    
    $patterns = [
        '/^1[0-9]{8,9}$/',  // Mobile: 01xxxxxxxx
        '/^3[0-9]{7,8}$/',  // Landline: 03xxxxxxx
        '/^4[0-9]{7,8}$/',  // Landline: 04xxxxxxx
        '/^5[0-9]{7,8}$/',  // Landline: 05xxxxxxx
        '/^6[0-9]{7,8}$/',  // Landline: 06xxxxxxx
        '/^7[0-9]{7,8}$/',  // Landline: 07xxxxxxx
        '/^8[0-9]{7,8}$/',  // Landline: 08xxxxxxx
        '/^9[0-9]{7,8}$/',  // Landline: 09xxxxxxx
    ];
    
    foreach ($patterns as $pattern) {
        if (preg_match($pattern, $phone)) {
            return true;
        }
    }
    
    $error = 'Please enter a valid Malaysian phone number.';
    return false;
}
```

##### `check_future_date($str, &$error)`
```php
/**
 * Check if date is in the future
 * 
 * @param string $str Date string to validate
 * @param string &$error Error message reference
 * @return bool Validation result
 */
public function check_future_date(string $str, string &$error = null): bool
{
    $date = strtotime($str);
    $today = strtotime(date('Y-m-d'));
    
    if ($date <= $today) {
        $error = 'Date must be in the future.';
        return false;
    }
    
    return true;
}
```

---

## 🛠️ Helpers

### validation_helper.php

#### Purpose
Provides helper functions for form validation, error display, and input sanitization throughout the application.

#### Key Functions

##### `display_validation_errors($errors)`
```php
/**
 * Display validation errors in a formatted list
 * 
 * @param array|null $errors Validation errors array
 * @return string HTML formatted error list
 */
function display_validation_errors($errors = null)
{
    if ($errors === null) {
        $errors = session()->getFlashdata('errors');
    }
    
    if (empty($errors)) {
        return '';
    }
    
    $html = '<div class="validation-summary">';
    $html .= '<h4><i class="fas fa-exclamation-triangle"></i> Please correct the following errors:</h4>';
    $html .= '<ul>';
    
    foreach ($errors as $error) {
        $html .= '<li>' . esc($error) . '</li>';
    }
    
    $html .= '</ul></div>';
    
    return $html;
}
```

##### `sanitize_input($data, $type)`
```php
/**
 * Sanitize input data based on type
 * 
 * @param mixed $data Data to sanitize
 * @param string $type Sanitization type (email, url, int, float, string)
 * @return mixed Sanitized data
 */
function sanitize_input($data, $type = 'string')
{
    switch ($type) {
        case 'email':
            return filter_var(trim($data), FILTER_SANITIZE_EMAIL);
        case 'url':
            return filter_var(trim($data), FILTER_SANITIZE_URL);
        case 'int':
            return filter_var($data, FILTER_SANITIZE_NUMBER_INT);
        case 'float':
            return filter_var($data, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        case 'string':
        default:
            return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }
}
```

##### `get_field_class($field, $errors, $additional_class)`
```php
/**
 * Get CSS class for form field based on validation status
 * 
 * @param string $field Field name
 * @param array|null $errors Validation errors
 * @param string $additional_class Additional CSS classes
 * @return string CSS class string
 */
function get_field_class($field, $errors = null, $additional_class = '')
{
    if ($errors === null) {
        $errors = session()->getFlashdata('errors');
    }
    
    $classes = ['input-field'];
    
    if (!empty($additional_class)) {
        $classes[] = $additional_class;
    }
    
    if (isset($errors[$field])) {
        $classes[] = 'error';
    } elseif (old($field)) {
        $classes[] = 'success';
    }
    
    return implode(' ', $classes);
}
```

---

## ⚙️ Configuration

### App Configuration (`app/Config/App.php`)

```php
/**
 * Application Configuration
 * 
 * Main configuration file for the Chess Club application
 */
class App extends BaseConfig
{
    /**
     * Application timezone
     * @var string
     */
    public $appTimezone = 'Asia/Kuala_Lumpur';
    
    /**
     * Character set
     * @var string
     */
    public $charset = 'UTF-8';
    
    /**
     * Force global secure requests
     * @var bool
     */
    public $forceGlobalSecureRequests = false;
    
    /**
     * Session configuration
     * @var array
     */
    public $sessionDriver = 'CodeIgniter\Session\Handlers\FileHandler';
    public $sessionCookieName = 'ci_session';
    public $sessionExpiration = 7200; // 2 hours
    public $sessionSavePath = null;
    public $sessionMatchIP = false;
    public $sessionTimeToUpdate = 300;
    public $sessionRegenerateDestroy = false;
}
```

### Database Configuration (`app/Config/Database.php`)

```php
/**
 * Database Configuration
 * 
 * Configuration for database connections and settings
 */
class Database extends BaseConfig
{
    /**
     * Default database connection
     * @var array
     */
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
}
```

### Validation Configuration (`app/Config/Validation.php`)

```php
/**
 * Validation Configuration
 * 
 * Configuration for form validation rules and custom validation methods
 */
class Validation extends BaseConfig
{
    /**
     * Validation rule sets
     * @var array
     */
    public $ruleSets = [
        \CodeIgniter\Validation\Rules::class,
        \CodeIgniter\Validation\FormatRules::class,
        \CodeIgniter\Validation\FileRules::class,
        \CodeIgniter\Validation\CreditCardRules::class,
        \App\Libraries\CustomValidationRules::class, // Custom rules
    ];
    
    /**
     * User registration validation rules
     * @var array
     */
    public $userRegistration = [
        'name' => [
            'rules' => 'required|min_length[2]|max_length[100]|alpha_space',
            'errors' => [
                'required' => 'Full name is required.',
                'min_length' => 'Name must be at least 2 characters long.',
                'max_length' => 'Name cannot exceed 100 characters.',
                'alpha_space' => 'Name can only contain letters and spaces.'
            ]
        ],
        'email' => [
            'rules' => 'required|valid_email|is_unique[users.email]',
            'errors' => [
                'required' => 'Email address is required.',
                'valid_email' => 'Please enter a valid email address.',
                'is_unique' => 'This email address is already registered.'
            ]
        ],
        'password' => [
            'rules' => 'required|min_length[8]|max_length[255]|strong_password',
            'errors' => [
                'required' => 'Password is required.',
                'min_length' => 'Password must be at least 8 characters long.',
                'max_length' => 'Password cannot exceed 255 characters.',
                'strong_password' => 'Password must meet security requirements.'
            ]
        ]
    ];
}
```

---

## 🔐 Security Implementation

### Authentication Security

#### Password Hashing
```php
/**
 * Secure password hashing using PHP's password_hash() function
 * 
 * @param string $password Plain text password
 * @return string Hashed password
 */
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

/**
 * Password verification using password_verify()
 * 
 * @param string $inputPassword User input password
 * @param string $storedPassword Stored password hash
 * @return bool Verification result
 */
if (password_verify($inputPassword, $storedPassword)) {
    // Password is valid
}
```

#### Session Security
```php
/**
 * Secure session configuration
 */
public $sessionDriver = 'CodeIgniter\Session\Handlers\FileHandler';
public $sessionCookieName = 'ci_session';
public $sessionExpiration = 7200; // 2 hours
public $sessionMatchIP = false;
public $sessionTimeToUpdate = 300;
public $sessionRegenerateDestroy = false;
```

### Input Validation & Sanitization

#### Server-side Validation
```php
/**
 * Comprehensive input validation
 */
$validation->setRules([
    'email' => 'required|valid_email',
    'password' => 'required|min_length[8]|strong_password',
    'name' => 'required|alpha_space|min_length[2]|max_length[100]'
]);
```

#### XSS Prevention
```php
/**
 * Output escaping to prevent XSS attacks
 */
echo esc($user_input); // HTML entities encoding
echo htmlspecialchars($data, ENT_QUOTES, 'UTF-8'); // Manual escaping
```

#### CSRF Protection
```php
/**
 * CSRF token in forms
 */
<form method="post" action="<?= base_url('login') ?>">
    <?= csrf_field() ?>
    <!-- Form fields -->
</form>
```

### File Upload Security

#### File Validation
```php
/**
 * Secure file upload validation
 */
function validate_file_upload($file, $allowed_types = ['jpg', 'jpeg', 'png', 'gif'], $max_size = 2048)
{
    $errors = [];
    
    // Check file size
    if ($file->getSize() > ($max_size * 1024)) {
        $errors[] = 'File size cannot exceed ' . $max_size . 'KB.';
    }
    
    // Check file type
    $extension = strtolower($file->getExtension());
    if (!in_array($extension, $allowed_types)) {
        $errors[] = 'File type not allowed.';
    }
    
    return $errors;
}
```

---

## 🗄️ Database Design

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
    phone VARCHAR(20),
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_email (email),
    INDEX idx_membership_level (membership_level),
    INDEX idx_status (status)
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
    
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_event_date (event_date),
    INDEX idx_status (status),
    INDEX idx_created_by (created_by)
);
```

#### Event_Participants Table
```sql
CREATE TABLE event_participants (
    id INT PRIMARY KEY AUTO_INCREMENT,
    event_id INT NOT NULL,
    user_id INT NOT NULL,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('Registered', 'Attended', 'Cancelled') DEFAULT 'Registered',
    
    FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE KEY unique_participation (event_id, user_id),
    INDEX idx_event_id (event_id),
    INDEX idx_user_id (user_id)
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
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_category (category),
    INDEX idx_status (status),
    INDEX idx_price (price)
);
```

#### Orders Table
```sql
CREATE TABLE orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    status ENUM('Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled') DEFAULT 'Pending',
    payment_method VARCHAR(50),
    shipping_address TEXT,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_id (user_id),
    INDEX idx_status (status),
    INDEX idx_order_date (order_date)
);
```

#### Order_Items Table
```sql
CREATE TABLE order_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    merchandise_id INT NOT NULL,
    quantity INT NOT NULL,
    unit_price DECIMAL(10,2) NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (merchandise_id) REFERENCES merchandise(id) ON DELETE CASCADE,
    INDEX idx_order_id (order_id),
    INDEX idx_merchandise_id (merchandise_id)
);
```

---

## 📝 API Documentation

### Authentication Endpoints

#### POST /login
**Purpose**: Authenticate user and create session

**Request Body**:
```json
{
    "email": "user@example.com",
    "password": "SecurePass123!"
}
```

**Response**:
```json
{
    "success": true,
    "message": "Login successful",
    "redirect": "/dashboard"
}
```

**Error Response**:
```json
{
    "success": false,
    "message": "Invalid email or password",
    "errors": {
        "email": "Email address is required.",
        "password": "Password is required."
    }
}
```

#### POST /register
**Purpose**: Register new user account

**Request Body**:
```json
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "SecurePass123!",
    "confirm_password": "SecurePass123!",
    "membership_level": "Bronze",
    "terms": "1"
}
```

**Response**:
```json
{
    "success": true,
    "message": "Registration successful! Please login.",
    "redirect": "/login"
}
```

### Event Endpoints

#### GET /events
**Purpose**: Retrieve all events

**Response**:
```json
{
    "success": true,
    "events": [
        {
            "id": 1,
            "title": "Chess Tournament",
            "description": "Monthly tournament for all members",
            "event_date": "2024-02-15",
            "event_time": "14:00:00",
            "location": "Chess Club Hall",
            "max_participants": 50,
            "current_participants": 25,
            "status": "Upcoming"
        }
    ]
}
```

#### POST /events/register/{event_id}
**Purpose**: Register user for an event

**Response**:
```json
{
    "success": true,
    "message": "Successfully registered for event",
    "event": {
        "id": 1,
        "title": "Chess Tournament",
        "current_participants": 26
    }
}
```

### Admin Endpoints

#### GET /admin/users
**Purpose**: Retrieve all users (Admin only)

**Response**:
```json
{
    "success": true,
    "users": [
        {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "membership_level": "Gold",
            "status": "Active",
            "honor_points": 150,
            "created_at": "2024-01-15T10:30:00Z"
        }
    ],
    "total_users": 50
}
```

#### PUT /admin/users/{id}
**Purpose**: Update user information (Admin only)

**Request Body**:
```json
{
    "name": "John Doe Updated",
    "email": "john.updated@example.com",
    "membership_level": "Silver",
    "status": "Active"
}
```

---

## 🧪 Testing Strategy

### Unit Testing

#### AuthController Tests
```php
/**
 * Test user login functionality
 */
public function testUserLogin()
{
    // Test valid login
    $response = $this->post('/login', [
        'email' => 'test@example.com',
        'password' => 'TestPass123!'
    ]);
    
    $this->assertTrue($response->isRedirect());
    $this->assertEquals('/dashboard', $response->getRedirectUrl());
}

/**
 * Test user registration validation
 */
public function testUserRegistrationValidation()
{
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'invalid-email',
        'password' => 'weak'
    ]);
    
    $this->assertFalse($response->isRedirect());
    $this->assertArrayHasKey('email', session()->getFlashdata('errors'));
    $this->assertArrayHasKey('password', session()->getFlashdata('errors'));
}
```

#### Model Tests
```php
/**
 * Test user model operations
 */
public function testUserModel()
{
    $userModel = new UserModel();
    
    // Test user creation
    $userData = [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => password_hash('TestPass123!', PASSWORD_DEFAULT),
        'membership_level' => 'Bronze'
    ];
    
    $userId = $userModel->insert($userData);
    $this->assertIsInt($userId);
    
    // Test user retrieval
    $user = $userModel->find($userId);
    $this->assertEquals('Test User', $user['name']);
    $this->assertEquals('test@example.com', $user['email']);
}
```

### Integration Testing

#### End-to-End Tests
```php
/**
 * Test complete user registration and login flow
 */
public function testUserRegistrationAndLoginFlow()
{
    // Step 1: Register new user
    $response = $this->post('/register', [
        'name' => 'New User',
        'email' => 'newuser@example.com',
        'password' => 'SecurePass123!',
        'confirm_password' => 'SecurePass123!',
        'membership_level' => 'Bronze',
        'terms' => '1'
    ]);
    
    $this->assertTrue($response->isRedirect());
    $this->assertEquals('/login', $response->getRedirectUrl());
    
    // Step 2: Login with new credentials
    $response = $this->post('/login', [
        'email' => 'newuser@example.com',
        'password' => 'SecurePass123!'
    ]);
    
    $this->assertTrue($response->isRedirect());
    $this->assertEquals('/dashboard', $response->getRedirectUrl());
    
    // Step 3: Verify session data
    $this->assertTrue(session()->get('isLoggedIn'));
    $this->assertEquals('New User', session()->get('user_name'));
}
```

### Security Testing

#### Authentication Tests
```php
/**
 * Test admin access control
 */
public function testAdminAccessControl()
{
    // Test non-admin user trying to access admin area
    $this->withSession(['membership_level' => 'Bronze'])
         ->get('/admin/dashboard');
    
    $this->assertTrue($this->response->isRedirect());
    $this->assertEquals('/login', $this->response->getRedirectUrl());
}

/**
 * Test CSRF protection
 */
public function testCSRFProtection()
{
    $response = $this->post('/login', [
        'email' => 'test@example.com',
        'password' => 'TestPass123!'
        // Missing CSRF token
    ]);
    
    $this->assertEquals(403, $response->getStatusCode());
}
```

---

## 🚀 Deployment Guide

### Production Deployment Checklist

#### Environment Setup
- [ ] Set environment to production
- [ ] Configure production database
- [ ] Set up SSL certificate
- [ ] Configure error logging
- [ ] Disable debug mode

#### Security Configuration
```php
// app/Config/App.php
public $displayErrors = false;
public $log = true;
public $forceGlobalSecureRequests = true;

// app/Config/Database.php
public $default['DBDebug'] = false;
```

#### File Permissions
```bash
# Set proper file permissions
chmod -R 755 writable/
chmod -R 644 writable/logs/
chmod -R 644 writable/cache/
chmod -R 755 public/uploads/
```

#### Database Migration
```bash
# Run database migrations
php spark migrate

# Seed production data
php spark db:seed ProductionData
```

#### Web Server Configuration

##### Apache (.htaccess)
```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [L]

# Security headers
Header always set X-Content-Type-Options nosniff
Header always set X-Frame-Options DENY
Header always set X-XSS-Protection "1; mode=block"
Header always set Strict-Transport-Security "max-age=31536000; includeSubDomains"
```

##### Nginx Configuration
```nginx
server {
    listen 80;
    server_name chessclub.com;
    root /var/www/chessclub/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.0-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    # Security headers
    add_header X-Content-Type-Options nosniff;
    add_header X-Frame-Options DENY;
    add_header X-XSS-Protection "1; mode=block";
    add_header Strict-Transport-Security "max-age=31536000; includeSubDomains";
}
```

### Monitoring & Maintenance

#### Log Monitoring
```bash
# Monitor application logs
tail -f writable/logs/log-*.php

# Monitor error logs
tail -f writable/logs/error-*.php
```

#### Database Backup
```bash
# Create database backup
mysqldump -u username -p chessclub_db > backup_$(date +%Y%m%d_%H%M%S).sql

# Automated backup script
#!/bin/bash
DATE=$(date +%Y%m%d_%H%M%S)
mysqldump -u username -p chessclub_db > /backups/chessclub_$DATE.sql
find /backups -name "chessclub_*.sql" -mtime +7 -delete
```

#### Performance Monitoring
```php
// Enable query logging in development
public $default['DBDebug'] = true;

// Monitor slow queries
SET GLOBAL slow_query_log = 'ON';
SET GLOBAL long_query_time = 2;
```

---

## 📚 Learning Resources

### CodeIgniter 4
- [Official Documentation](https://codeigniter4.github.io/userguide/)
- [API Reference](https://codeigniter4.github.io/api/)
- [Tutorials](https://codeigniter4.github.io/tutorials/)

### Security
- [OWASP Top 10](https://owasp.org/www-project-top-ten/)
- [PHP Security Guide](https://www.php.net/manual/en/security.php)
- [CodeIgniter Security](https://codeigniter4.github.io/userguide/concepts/security.html)

### Database Design
- [MySQL Documentation](https://dev.mysql.com/doc/)
- [Database Normalization](https://en.wikipedia.org/wiki/Database_normalization)
- [SQL Best Practices](https://www.sqlstyle.guide/)

### Testing
- [PHPUnit Documentation](https://phpunit.de/documentation.html)
- [CodeIgniter Testing](https://codeigniter4.github.io/userguide/testing/index.html)

---

## 📞 Support & Maintenance

### Issue Reporting
- Create detailed bug reports with steps to reproduce
- Include error logs and system information
- Provide screenshots for UI issues

### Code Review Process
- All code changes require peer review
- Ensure security best practices are followed
- Verify functionality works as expected
- Check for potential performance issues

### Documentation Updates
- Update documentation when adding new features
- Maintain API documentation
- Keep installation guides current
- Document configuration changes

---

**Documentation Version**: 1.0.0  
**Last Updated**: January 2024  
**Maintained By**: [Your Name] 