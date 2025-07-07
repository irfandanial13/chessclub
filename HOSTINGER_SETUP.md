# 🚀 Hostinger Deployment Guide for Chess Club

## Overview
This guide provides step-by-step instructions for deploying your Chess Club application on Hostinger hosting with optimal performance and security.

## 📋 Pre-Deployment Checklist

### **1. Hostinger Account Requirements**
- ✅ Hostinger hosting plan (Shared, VPS, or Cloud)
- ✅ Domain name (or subdomain)
- ✅ PHP 8.0+ support enabled
- ✅ MySQL/MariaDB database
- ✅ SSL certificate (free with Hostinger)

### **2. File Structure for Hostinger**
```
public_html/          # Your domain root
├── index.php         # Main entry point
├── .htaccess         # URL rewriting & security
├── css/
├── js/
├── images/
└── adminlte/         # Admin theme

app/                  # Application files (outside public_html)
├── Config/
├── Controllers/
├── Models/
├── Views/
└── Filters/

writable/             # Logs and cache (outside public_html)
├── logs/
├── cache/
└── uploads/

vendor/               # Composer dependencies (outside public_html)
```

## 🚀 Deployment Steps

### **Step 1: Prepare Your Files**

1. **Create the correct directory structure:**
   ```bash
   # On your local machine
   mkdir chessclub
   cd chessclub
   ```

2. **Upload files to Hostinger:**
   - Upload `public/` contents to `public_html/`
   - Upload `app/`, `writable/`, `vendor/` to root directory (same level as `public_html/`)

### **Step 2: Configure Database**

1. **Create MySQL Database in Hostinger:**
   - Go to Hostinger Control Panel
   - Navigate to "Databases" → "MySQL Databases"
   - Create a new database
   - Create a database user
   - Assign user to database with full privileges

2. **Update Database Configuration:**
   ```php
   // app/Config/Database.php
   public $default = [
       'DSN'      => '',
       'hostname' => 'localhost', // Usually localhost on Hostinger
       'username' => 'your_db_username',
       'password' => 'your_db_password',
       'database' => 'your_database_name',
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

### **Step 3: Configure Environment**

1. **Create .env file (outside public_html):**
   ```env
   CI_ENVIRONMENT = production
   app.baseURL = 'https://yourdomain.com'
   
   database.default.hostname = localhost
   database.default.database = your_database_name
   database.default.username = your_db_username
   database.default.password = your_db_password
   database.default.DBDriver = MySQLi
   
   app.sessionDriver = 'CodeIgniter\Session\Handlers\FileHandler'
   app.sessionCookieName = 'ci_session'
   app.sessionExpiration = 7200
   app.sessionSavePath = null
   app.sessionMatchIP = false
   app.sessionTimeToUpdate = 300
   app.sessionRegenerateDestroy = false
   ```

### **Step 4: Set File Permissions**

1. **Set correct permissions:**
   ```bash
   # Via Hostinger File Manager or FTP
   chmod 755 public_html/
   chmod 644 public_html/.htaccess
   chmod 644 public_html/index.php
   chmod 755 writable/
   chmod 777 writable/logs/
   chmod 777 writable/cache/
   chmod 777 writable/uploads/
   chmod 755 app/
   chmod 755 vendor/
   ```

### **Step 5: Run Database Migrations**

1. **Access your site and run migrations:**
   - Visit: `https://yourdomain.com/migrate` (if you create a migration controller)
   - Or manually import SQL files through phpMyAdmin

## 🔧 Hostinger-Specific Optimizations

### **1. Performance Optimizations**

**Enable Hostinger Caching:**
- Go to Hostinger Control Panel
- Navigate to "Advanced" → "LiteSpeed Cache"
- Enable caching for better performance

**Optimize Images:**
- Use WebP format when possible
- Compress images before uploading
- Use lazy loading for images

### **2. Security Enhancements**

**Enable SSL:**
- Go to "SSL" in Hostinger Control Panel
- Enable free SSL certificate
- Force HTTPS redirect

**Set up Security Headers:**
- Already configured in `.htaccess`
- Monitor security logs in `writable/logs/`

### **3. Email Configuration**

**Configure SMTP (if needed):**
```php
// app/Config/Email.php
public $protocol = 'smtp';
public $SMTPHost = 'smtp.hostinger.com';
public $SMTPUser = 'your-email@yourdomain.com';
public $SMTPPass = 'your-email-password';
public $SMTPPort = 587;
public $SMTPCrypto = 'tls';
```

## 📊 Monitoring & Maintenance

### **1. Log Monitoring**
- Check `writable/logs/` regularly
- Monitor error logs for issues
- Set up log rotation

### **2. Performance Monitoring**
- Use Hostinger's built-in monitoring
- Check page load times
- Monitor database performance

### **3. Backup Strategy**
- Enable Hostinger automatic backups
- Create manual backups before updates
- Test backup restoration

## 🛠️ Troubleshooting

### **Common Issues & Solutions**

**1. 500 Internal Server Error:**
```bash
# Check error logs
tail -f writable/logs/log-YYYY-MM-DD.php

# Common causes:
# - Incorrect file permissions
# - PHP version compatibility
# - Missing .htaccess file
```

**2. Database Connection Error:**
```php
// Verify database credentials
// Check if database exists
// Ensure user has proper permissions
```

**3. URL Rewriting Not Working:**
```apache
# Ensure mod_rewrite is enabled
# Check .htaccess syntax
# Verify file permissions
```

**4. File Upload Issues:**
```php
# Check upload_max_filesize in PHP settings
# Verify writable/uploads/ permissions
# Check file type restrictions
```

### **Hostinger Support**
- **Live Chat**: Available 24/7
- **Knowledge Base**: Extensive documentation
- **Community Forum**: User discussions
- **Ticket System**: For complex issues

## 🔄 Updates & Maintenance

### **1. Regular Updates**
```bash
# Update CodeIgniter
composer update

# Update dependencies
composer update --no-dev

# Clear cache
rm -rf writable/cache/*
```

### **2. Security Updates**
- Monitor CodeIgniter security advisories
- Update PHP version when available
- Review security logs regularly

### **3. Performance Optimization**
- Optimize database queries
- Enable caching
- Compress assets
- Use CDN for static files

## 📞 Hostinger Support Resources

### **Useful Links:**
- [Hostinger Knowledge Base](https://www.hostinger.com/help)
- [Hostinger Community](https://community.hostinger.com/)
- [Hostinger Status Page](https://status.hostinger.com/)

### **Contact Information:**
- **Live Chat**: Available in Hostinger Control Panel
- **Email Support**: support@hostinger.com
- **Phone Support**: Available for premium plans

## ✅ Post-Deployment Checklist

- [ ] Website loads without errors
- [ ] All pages accessible via clean URLs
- [ ] Database connection working
- [ ] File uploads functioning
- [ ] Email system configured
- [ ] SSL certificate active
- [ ] Security headers present
- [ ] Error pages working
- [ ] Admin panel accessible
- [ ] User registration/login working
- [ ] Backup system configured
- [ ] Monitoring set up

---

**🎉 Congratulations!** Your Chess Club is now live on Hostinger with enterprise-level security and performance optimizations! 