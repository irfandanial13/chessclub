<?php

namespace Config;

use CodeIgniter\Database\Config;

/**
 * Database Configuration
 */
class Database extends Config
{
    /**
     * The directory that holds the Migrations
     * and Seeds directories.
     */
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

    /**
     * Lets you choose which connection group to
     * use if no other is specified.
     */
    public string $defaultGroup = 'default';

    /**
     * The default database connection.
     *
     * @var array<string, array<string, mixed>>
     */
    public array $default = [
        'DSN'          => '',
        'hostname'     => 'localhost',
        'username'     => '',
        'password'     => '',
        'database'     => '',
        'DBDriver'     => 'MySQLi',
        'DBPrefix'     => '',
        'pConnect'     => false,
        'DBDebug'      => true,
        'charset'      => 'utf8',
        'DBCollate'    => 'utf8_general_ci',
        'swapPre'      => '',
        'encrypt'      => false,
        'compress'     => false,
        'strictOn'     => false,
        'failover'     => [],
        'port'         => 3306,
        'numberNative' => false,
    ];

    /**
     * This database connection is used when
     * running PHPUnit database tests.
     *
     * @var array<string, array<string, mixed>>
     */
    public array $tests = [
        'DSN'          => '',
        'hostname'     => '127.0.0.1',
        'username'     => '',
        'password'     => '',
        'database'     => ':memory:',
        'DBDriver'     => 'SQLite3',
        'DBPrefix'     => 'db_',
        'pConnect'     => false,
        'DBDebug'      => true,
        'charset'      => 'utf8',
        'DBCollate'    => 'utf8_general_ci',
        'swapPre'      => '',
        'encrypt'      => false,
        'compress'     => false,
        'strictOn'     => false,
        'failover'     => [],
        'port'         => 3306,
        'numberNative' => false,
    ];

    /**
     * Hostinger-specific production configuration
     * Uncomment and configure for production deployment
     */
    /*
    public array $production = [
        'DSN'          => '',
        'hostname'     => 'localhost',
        'username'     => 'your_hostinger_db_user',
        'password'     => 'your_hostinger_db_password',
        'database'     => 'your_hostinger_db_name',
        'DBDriver'     => 'MySQLi',
        'DBPrefix'     => '',
        'pConnect'     => false,
        'DBDebug'      => false, // Set to false in production
        'charset'      => 'utf8mb4',
        'DBCollate'    => 'utf8mb4_unicode_ci',
        'swapPre'      => '',
        'encrypt'      => false,
        'compress'     => false,
        'strictOn'     => false,
        'failover'     => [],
        'port'         => 3306,
        'numberNative' => false,
    ];
    */

    public function __construct()
    {
        parent::__construct();

        // Ensure we're using the right connection for the environment
        if (ENVIRONMENT === 'production') {
            // Use production settings if available
            if (isset($this->production)) {
                $this->default = $this->production;
            }
            
            // Disable debug in production
            $this->default['DBDebug'] = false;
        }

        // Hostinger-specific optimizations
        $this->default['charset'] = 'utf8mb4';
        $this->default['DBCollate'] = 'utf8mb4_unicode_ci';
        
        // Enable connection pooling for better performance
        $this->default['pConnect'] = true;
        
        // Set reasonable timeout values
        $this->default['connect_timeout'] = 10;
        $this->default['read_timeout'] = 30;
        $this->default['write_timeout'] = 30;
    }
}
