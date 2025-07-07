<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Security;

class SecurityFilter implements FilterInterface
{
    protected $security;

    public function __construct()
    {
        $this->security = new Security();
    }

    public function before(RequestInterface $request, $arguments = null)
    {
        // Check if site is in maintenance mode
        if ($this->security->maintenanceMode && !$this->isAllowedIP($request)) {
            return redirect()->to('errors/maintenance');
        }

        // Rate limiting
        if ($this->security->rateLimitEnabled) {
            $this->checkRateLimit($request);
        }

        // Block suspicious requests
        $this->blockSuspiciousRequests($request);

        // Add security headers
        $this->addSecurityHeaders($request);

        return $request;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Add security headers to response
        $this->addResponseHeaders($response);

        // Log security events
        $this->logSecurityEvent($request, $response);

        return $response;
    }

    /**
     * Check if IP is allowed during maintenance
     */
    protected function isAllowedIP(RequestInterface $request): bool
    {
        $clientIP = $request->getIPAddress();
        return in_array($clientIP, $this->security->maintenanceAllowedIPs);
    }

    /**
     * Implement rate limiting
     */
    protected function checkRateLimit(RequestInterface $request): void
    {
        $clientIP = $request->getIPAddress();
        $cache = \Config\Services::cache();
        
        $key = "rate_limit_{$clientIP}";
        $requests = $cache->get($key) ?: 0;
        
        if ($requests >= $this->security->rateLimitRequests) {
            log_message('warning', "Rate limit exceeded for IP: {$clientIP}");
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Rate limit exceeded');
        }
        
        $cache->save($key, $requests + 1, $this->security->rateLimitWindow);
    }

    /**
     * Block suspicious requests
     */
    protected function blockSuspiciousRequests(RequestInterface $request): void
    {
        $uri = $request->getUri();
        $path = $uri->getPath();
        
        // Block access to sensitive files
        $sensitivePatterns = [
            '/\.env$/',
            '/composer\.(json|lock)$/',
            '/\.git/',
            '/\.svn/',
            '/\.htaccess$/',
            '/\.htpasswd$/',
            '/\.ini$/',
            '/\.log$/',
            '/\.sql$/',
            '/\.bak$/',
            '/\.backup$/',
            '/\.old$/',
            '/\.tmp$/',
            '/\.swp$/',
            '/\.swo$/',
            '/\.DS_Store$/',
            '/Thumbs\.db$/'
        ];
        
        foreach ($sensitivePatterns as $pattern) {
            if (preg_match($pattern, $path)) {
                log_message('warning', "Blocked access to sensitive file: {$path}");
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Access denied');
            }
        }
        
        // Block suspicious user agents
        $userAgent = $request->getUserAgent();
        $suspiciousAgents = [
            'bot', 'crawler', 'spider', 'scraper', 'curl', 'wget', 'python', 'java'
        ];
        
        foreach ($suspiciousAgents as $agent) {
            if (stripos($userAgent, $agent) !== false) {
                log_message('info', "Suspicious user agent detected: {$userAgent}");
                // Don't block completely, just log
            }
        }
    }

    /**
     * Add security headers to request
     */
    protected function addSecurityHeaders(RequestInterface $request): void
    {
        // Headers are typically added to response, not request
        // This is just for logging purposes
    }

    /**
     * Add security headers to response
     */
    protected function addResponseHeaders(ResponseInterface $response): void
    {
        foreach ($this->security->headers as $header => $value) {
            $response->setHeader($header, $value);
        }
        
        // Remove server signature
        $response->removeHeader('Server');
        $response->removeHeader('X-Powered-By');
        
        // Add Content Security Policy
        if ($this->security->cspEnabled) {
            $csp = $this->buildCSPHeader();
            $response->setHeader('Content-Security-Policy', $csp);
        }
    }

    /**
     * Build Content Security Policy header
     */
    protected function buildCSPHeader(): string
    {
        $csp = [];
        
        if (!empty($this->security->cspStyleSrc)) {
            $csp[] = "style-src " . implode(' ', $this->security->cspStyleSrc);
        }
        
        if (!empty($this->security->cspScriptSrc)) {
            $csp[] = "script-src " . implode(' ', $this->security->cspScriptSrc);
        }
        
        if (!empty($this->security->cspImageSrc)) {
            $csp[] = "img-src " . implode(' ', $this->security->cspImageSrc);
        }
        
        if (!empty($this->security->cspFontSrc)) {
            $csp[] = "font-src " . implode(' ', $this->security->cspFontSrc);
        }
        
        if (!empty($this->security->cspConnectSrc)) {
            $csp[] = "connect-src " . implode(' ', $this->security->cspConnectSrc);
        }
        
        if (!empty($this->security->cspFrameSrc)) {
            $csp[] = "frame-src " . implode(' ', $this->security->cspFrameSrc);
        }
        
        if (!empty($this->security->cspObjectSrc)) {
            $csp[] = "object-src " . implode(' ', $this->security->cspObjectSrc);
        }
        
        if (!empty($this->security->cspMediaSrc)) {
            $csp[] = "media-src " . implode(' ', $this->security->cspMediaSrc);
        }
        
        if (!empty($this->security->cspManifestSrc)) {
            $csp[] = "manifest-src " . implode(' ', $this->security->cspManifestSrc);
        }
        
        if (!empty($this->security->cspWorkerSrc)) {
            $csp[] = "worker-src " . implode(' ', $this->security->cspWorkerSrc);
        }
        
        if (!empty($this->security->cspChildSrc)) {
            $csp[] = "child-src " . implode(' ', $this->security->cspChildSrc);
        }
        
        if (!empty($this->security->cspFormAction)) {
            $csp[] = "form-action " . implode(' ', $this->security->cspFormAction);
        }
        
        if (!empty($this->security->cspBaseURI)) {
            $csp[] = "base-uri " . implode(' ', $this->security->cspBaseURI);
        }
        
        if (!empty($this->security->cspFrameAncestors)) {
            $csp[] = "frame-ancestors " . implode(' ', $this->security->cspFrameAncestors);
        }
        
        if ($this->security->cspUpgradeInsecureRequests) {
            $csp[] = "upgrade-insecure-requests";
        }
        
        if ($this->security->cspBlockAllMixedContent) {
            $csp[] = "block-all-mixed-content";
        }
        
        return implode('; ', $csp);
    }

    /**
     * Log security events
     */
    protected function logSecurityEvent(RequestInterface $request, ResponseInterface $response): void
    {
        if (!$this->security->logSecurityEvents) {
            return;
        }
        
        $clientIP = $request->getIPAddress();
        $userAgent = $request->getUserAgent();
        $method = $request->getMethod();
        $uri = $request->getUri()->getPath();
        $statusCode = $response->getStatusCode();
        
        $logData = [
            'ip' => $clientIP,
            'user_agent' => $userAgent,
            'method' => $method,
            'uri' => $uri,
            'status_code' => $statusCode,
            'timestamp' => date('Y-m-d H:i:s')
        ];
        
        log_message('info', 'Security event: ' . json_encode($logData));
    }
} 