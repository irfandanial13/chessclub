<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Security extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * CSRF Protection
     * --------------------------------------------------------------------------
     */
    public $tokenName = 'csrf_token_name';
    public $headerName = 'X-CSRF-TOKEN';
    public $cookieName = 'csrf_cookie_name';
    public $expire = 7200;
    public $regenerate = true;
    public $redirect = false;
    public $samesite = 'Lax';

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy
     * --------------------------------------------------------------------------
     */
    public $cspEnabled = true;
    public $cspReportOnly = false;
    public $cspReportURI = null;
    public $cspStyleSrc = ["'self'", "'unsafe-inline'", 'https://fonts.googleapis.com', 'https://cdnjs.cloudflare.com'];
    public $cspScriptSrc = ["'self'", "'unsafe-inline'", "'unsafe-eval'", 'https://code.jquery.com', 'https://cdnjs.cloudflare.com'];
    public $cspImageSrc = ["'self'", 'data:', 'https:'];
    public $cspFontSrc = ["'self'", 'https://fonts.gstatic.com'];
    public $cspConnectSrc = ["'self'"];
    public $cspFrameSrc = ["'none'"];
    public $cspObjectSrc = ["'none'"];
    public $cspMediaSrc = ["'self'"];
    public $cspManifestSrc = ["'self'"];
    public $cspWorkerSrc = ["'self'"];
    public $cspChildSrc = ["'self'"];
    public $cspFormAction = ["'self'"];
    public $cspBaseURI = ["'self'"];
    public $cspFrameAncestors = ["'none'"];
    public $cspUpgradeInsecureRequests = false;
    public $cspBlockAllMixedContent = false;

    /**
     * --------------------------------------------------------------------------
     * Security Headers
     * --------------------------------------------------------------------------
     */
    public $headers = [
        'X-Content-Type-Options' => 'nosniff',
        'X-Frame-Options' => 'DENY',
        'X-XSS-Protection' => '1; mode=block',
        'Referrer-Policy' => 'strict-origin-when-cross-origin',
        'Permissions-Policy' => 'geolocation=(), microphone=(), camera=()',
        'Strict-Transport-Security' => 'max-age=31536000; includeSubDomains',
    ];

    /**
     * --------------------------------------------------------------------------
     * Session Security
     * --------------------------------------------------------------------------
     */
    public $sessionDriver = 'CodeIgniter\Session\Handlers\FileHandler';
    public $sessionCookieName = 'ci_session';
    public $sessionExpiration = 7200;
    public $sessionSavePath = null;
    public $sessionMatchIP = false;
    public $sessionTimeToUpdate = 300;
    public $sessionRegenerateDestroy = false;

    /**
     * --------------------------------------------------------------------------
     * Cookie Security
     * --------------------------------------------------------------------------
     */
    public $cookiePrefix = '';
    public $cookieDomain = '';
    public $cookiePath = '/';
    public $cookieSecure = false;
    public $cookieHTTPOnly = true;
    public $cookieSameSite = 'Lax';

    /**
     * --------------------------------------------------------------------------
     * Input Filtering
     * --------------------------------------------------------------------------
     */
    public $globalFilters = [
        'htmlspecialchars',
        'trim'
    ];

    /**
     * --------------------------------------------------------------------------
     * File Upload Security
     * --------------------------------------------------------------------------
     */
    public $maxFileSize = 2048; // 2MB
    public $allowedFileTypes = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];
    public $uploadPath = WRITEPATH . 'uploads/';
    public $createThumbnails = true;
    public $thumbnailSize = [150, 150];

    /**
     * --------------------------------------------------------------------------
     * Rate Limiting
     * --------------------------------------------------------------------------
     */
    public $rateLimitEnabled = true;
    public $rateLimitRequests = 100; // requests per minute
    public $rateLimitWindow = 60; // seconds
    public $rateLimitStorage = 'file'; // file, redis, database

    /**
     * --------------------------------------------------------------------------
     * Password Security
     * --------------------------------------------------------------------------
     */
    public $passwordMinLength = 8;
    public $passwordRequireUppercase = true;
    public $passwordRequireLowercase = true;
    public $passwordRequireNumbers = true;
    public $passwordRequireSpecialChars = true;
    public $passwordHashCost = 12;

    /**
     * --------------------------------------------------------------------------
     * Login Security
     * --------------------------------------------------------------------------
     */
    public $maxLoginAttempts = 5;
    public $lockoutDuration = 900; // 15 minutes
    public $requireCaptchaAfter = 3; // attempts
    public $sessionTimeout = 3600; // 1 hour
    public $rememberMeDuration = 2592000; // 30 days

    /**
     * --------------------------------------------------------------------------
     * API Security
     * --------------------------------------------------------------------------
     */
    public $apiRateLimit = 1000; // requests per hour
    public $apiKeyRequired = true;
    public $apiKeyHeader = 'X-API-Key';
    public $apiCorsEnabled = false;
    public $apiCorsOrigins = ['*'];

    /**
     * --------------------------------------------------------------------------
     * Database Security
     * --------------------------------------------------------------------------
     */
    public $dbEncryption = false;
    public $dbEncryptionKey = null;
    public $dbQueryLogging = false;
    public $dbSlowQueryThreshold = 1.0; // seconds

    /**
     * --------------------------------------------------------------------------
     * Logging Security
     * --------------------------------------------------------------------------
     */
    public $logFailedLogins = true;
    public $logSuccessfulLogins = false;
    public $logFileAccess = true;
    public $logDatabaseQueries = false;
    public $logSecurityEvents = true;
    public $logRetentionDays = 30;

    /**
     * --------------------------------------------------------------------------
     * Backup Security
     * --------------------------------------------------------------------------
     */
    public $backupEnabled = true;
    public $backupFrequency = 'daily'; // daily, weekly, monthly
    public $backupRetention = 7; // days
    public $backupEncryption = true;
    public $backupPath = WRITEPATH . 'backups/';

    /**
     * --------------------------------------------------------------------------
     * Maintenance Mode
     * --------------------------------------------------------------------------
     */
    public $maintenanceMode = false;
    public $maintenanceAllowedIPs = ['127.0.0.1', '::1'];
    public $maintenanceMessage = 'Site is under maintenance. Please check back later.';
}
