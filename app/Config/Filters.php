<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;
use App\Filters\SecurityFilter;

/**
 * Filter Configuration
 *
 * Filters are classes that are invoked before and after the controller
 * execution. They can be used for authentication, logging, rate limiting,
 * and more.
 */
class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     */
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'security'      => SecurityFilter::class,
        'auth'          => \App\Filters\AuthFilter::class,
        'guest'         => \App\Filters\GuestFilter::class,
        'admin'         => \App\Filters\AdminFilter::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     */
    public array $globals = [
        'before' => [
            'security',
            'honeypot',
            'invalidchars',
        ],
        'after' => [
            'toolbar',
            'honeypot',
            'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don't expect could bypass the filter.
     */
    public array $methods = [
        'post' => ['csrf'],
    ];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     */
    public array $filters = [
        'auth' => [
            'before' => [
                'admin/*',
                'dashboard/*',
                'member/*',
                'profile/*',
                'events/join/*',
                'events/my-events',
                'merchandise/cart',
                'merchandise/checkout',
                'membership/*',
            ]
        ],
        'guest' => [
            'before' => [
                'login',
                'register',
            ]
        ],
        'admin' => [
            'before' => [
                'admin/*',
            ]
        ],
    ];
}
