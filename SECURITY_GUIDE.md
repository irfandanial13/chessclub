# 🔒 Chess Club Security Guide

## Overview
This document outlines the comprehensive security measures implemented to protect your Chess Club application from various threats and hide sensitive file structures from URLs.

## 🛡️ Security Features Implemented

### 1. **URL Rewriting & File Protection**
- **Clean URLs**: No more `index.php?route=controller/method` in URLs
- **Hidden File Structure**: Sensitive directories and files are completely hidden
- **Custom Error Pages**: Professional 404, 403, and 500 error pages

#### **Before (Insecure)**:
```
http://yoursite.com/app/Controllers/AuthController.php
http://yoursite.com/writable/logs/error.log
http://yoursite.com/.env
```

#### **After (Secure)**:
```
http://yoursite.com/login
http://yoursite.com/admin/users
http://yoursite.com/events
```

### 2. **Access Control**
- **Sensitive File Blocking**: Direct access to `.env`, `composer.json`, `.htaccess`, etc.
- **Directory Protection**: `app/`, `system/`, `writable/`, `vendor/`, `tests/` directories blocked
- **Hidden Files**: All files starting with `.` are blocked
- **Configuration Files**: `.ini`, `.log`, `.sql`, `.bak` files blocked

### 3. **Security Headers**
- **X-Content-Type-Options**: `nosniff` - Prevents MIME type sniffing
- **X-Frame-Options**: `DENY` - Prevents clickjacking
- **X-XSS-Protection**: `1; mode=block` - Enables XSS protection
- **Referrer-Policy**: `strict-origin-when-cross-origin`
- **Content-Security-Policy**: Comprehensive CSP rules
- **Server Signature Removal**: Hides server information

### 4. **Rate Limiting**
- **Requests per Minute**: 100 requests per IP
- **Lockout Duration**: 15 minutes for exceeded limits
- **Storage**: File-based rate limiting
- **Logging**: All rate limit violations logged

### 5. **Authentication & Authorization**
- **Session Security**: Secure session handling
- **Role-Based Access**: Admin, member, and guest roles
- **Login Attempts**: Maximum 5 failed attempts
- **Session Timeout**: 1 hour automatic logout
- **Remember Me**: 30-day secure remember me

### 6. **Input Validation & Sanitization**
- **Global Filters**: HTML special chars and trim
- **CSRF Protection**: Cross-site request forgery protection
- **XSS Prevention**: Input sanitization
- **SQL Injection**: Parameterized queries

### 7. **File Upload Security**
- **File Size Limits**: 2MB maximum
- **Allowed Types**: Only jpg, jpeg, png, gif, pdf
- **Virus Scanning**: File type validation
- **Secure Storage**: Files stored outside web root

### 8. **Logging & Monitoring**
- **Security Events**: All security events logged
- **Failed Logins**: Failed login attempts tracked
- **File Access**: Suspicious file access logged
- **Retention**: 30-day log retention

## 🔧 Configuration Files

### **1. .htaccess (public/.htaccess)**
```apache
# URL rewriting rules
RewriteRule ^login/?$ index.php?route=auth/login [L,QSA]
RewriteRule ^admin/?$ index.php?route=admin/dashboard [L,QSA]

# Security headers
Header always set X-Content-Type-Options nosniff
Header always set X-Frame-Options DENY

# Block sensitive files
<FilesMatch "\.(env|config|ini|log|sql|bak)$">
    Order Deny,Allow
    Deny from all
</FilesMatch>
```

### **2. Routes (app/Config/Routes.php)**
```php
// Clean URL routes
$routes->get('login', 'Auth::login');
$routes->get('admin', 'Admin::dashboard');

// Prevent access to sensitive files
$routes->addRedirect('app/(:any)', 'errors/403');
$routes->addRedirect('.env', 'errors/403');
```

### **3. Security Config (app/Config/Security.php)**
```php
// Rate limiting
public $rateLimitEnabled = true;
public $rateLimitRequests = 100;

// Password security
public $passwordMinLength = 8;
public $passwordRequireUppercase = true;

// Session security
public $sessionExpiration = 7200;
public $cookieHTTPOnly = true;
```

## 🚀 How to Use

### **1. Clean URLs**
Instead of using:
```php
<a href="<?= base_url('index.php?route=auth/login') ?>">Login</a>
```

Use:
```php
<a href="<?= base_url('login') ?>">Login</a>
```

### **2. Admin Access**
```php
// In controllers, check admin role
if (session()->get('user_role') !== 'admin') {
    return redirect()->to('dashboard')->with('error', 'Access denied');
}
```

### **3. Secure File Uploads**
```php
// Use the security configuration
$config = new \Config\Security();
$maxSize = $config->maxFileSize;
$allowedTypes = $config->allowedFileTypes;
```

## 🔍 Security Testing

### **1. Test URL Protection**
Try accessing these URLs (should return 403):
- `http://yoursite.com/.env`
- `http://yoursite.com/app/Controllers/AuthController.php`
- `http://yoursite.com/writable/logs/`

### **2. Test Clean URLs**
These should work:
- `http://yoursite.com/login`
- `http://yoursite.com/admin`
- `http://yoursite.com/events`

### **3. Test Rate Limiting**
Make 100+ requests quickly to see rate limiting in action.

## 📊 Security Monitoring

### **1. Check Logs**
Monitor these log files:
- `writable/logs/log-YYYY-MM-DD.php`
- `writable/logs/security-events.log`

### **2. Security Headers**
Use browser dev tools to verify security headers are present.

### **3. File Access**
Monitor for blocked file access attempts in logs.

## 🛠️ Maintenance

### **1. Regular Updates**
- Keep CodeIgniter updated
- Update security configurations
- Review and update rate limits

### **2. Backup Security**
- Encrypt backups
- Store backups securely
- Test backup restoration

### **3. Monitoring**
- Monitor failed login attempts
- Check for suspicious activity
- Review security logs regularly

## 🔐 Additional Security Recommendations

### **1. SSL/HTTPS**
```apache
# Force HTTPS in .htaccess
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

### **2. Database Security**
- Use strong database passwords
- Limit database user permissions
- Regular database backups

### **3. Server Security**
- Keep server software updated
- Use firewall rules
- Regular security audits

## 📞 Support

If you encounter any security issues:
1. Check the logs in `writable/logs/`
2. Review the security configuration
3. Test the specific functionality
4. Contact support if needed

---

**Remember**: Security is an ongoing process. Regularly review and update your security measures to stay protected against new threats. 