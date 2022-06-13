<?php

use Cake\Cache\Engine\FileEngine;
use Cake\Database\Connection;
use Cake\Database\Driver\Mysql;
use Cake\Error\ExceptionRenderer;
use Cake\Log\Engine\FileLog;
use Cake\Mailer\Transport\MailTransport;

$app = [
    'debug' => filter_var(env('DEBUG', false), FILTER_VALIDATE_BOOLEAN),
    'App' => [
        'namespace' => 'App',
        'encoding' => env('APP_ENCODING', 'UTF-8'),
        'defaultLocale' => env('APP_DEFAULT_LOCALE', 'pt_BR'),
        'defaultTimezone' => env('APP_DEFAULT_TIMEZONE', 'America/Sao_Paulo'),
        'base' => false,
        'dir' => 'src',
        'webroot' => 'webroot',
        'wwwRoot' => WWW_ROOT,
        //'baseUrl' => env('SCRIPT_NAME'),
        'fullBaseUrl' => false,
        'imageBaseUrl' => 'img/',
        'cssBaseUrl' => 'css/',
        'jsBaseUrl' => 'js/',
        'paths' => [
            'plugins' => [ROOT . DS . 'plugins' . DS],
            'templates' => [ROOT . DS . 'src' . DS . 'Templates' . DS],
            'locales' => [RESOURCES . 'locales' . DS],
        ],
    ],
    'Security' => [
        'salt' => env('SECURITY_SALT', '509b422c9d9e3ba60ad3a64a4e9eb15cca3aca5683d6b955d7c5ed7cbb6fc65e'),
    ],
    'Asset' => [
        'timestamp' => false,
    ],
    'Cache' => [
        'default' => [
            'className' => FileEngine::class,
            'path' => CACHE,
            'url' => env('CACHE_DEFAULT_URL', null),
        ],
        '_cake_core_' => [
            'className' => FileEngine::class,
            'prefix' => 'myapp_cake_core_',
            'path' => CACHE . 'persistent' . DS,
            'serialize' => true,
            'duration' => '+2 minutes',
            'url' => env('CACHE_CAKECORE_URL', null),
        ],
        '_cake_model_' => [
            'className' => FileEngine::class,
            'prefix' => 'myapp_cake_model_',
            'path' => CACHE . 'models' . DS,
            'serialize' => true,
            'duration' => '+2 minutes',
            'url' => env('CACHE_CAKEMODEL_URL', null),
        ],
        '_cake_routes_' => [
            'className' => FileEngine::class,
            'prefix' => 'myapp_cake_routes_',
            'path' => CACHE,
            'serialize' => true,
            'duration' => '+2 minutes',
            'url' => env('CACHE_CAKEROUTES_URL', null),
        ],
    ],
    'Error' => [
        'errorLevel' => E_ALL,
        'exceptionRenderer' => ExceptionRenderer::class,
        'skipLog' => [],
        'log' => true,
        'trace' => true,
        'ignoredDeprecationPaths' => [],
    ],
    'Debugger' => [
        'editor' => 'phpstorm',
    ],
    'EmailTransport' => [
        'default' => [
            'className' => MailTransport::class,
            'host' => 'localhost',
            'port' => 25,
            'timeout' => 30,
            //'username' => null,
            //'password' => null,
            'client' => null,
            'tls' => false,
            'url' => env('EMAIL_TRANSPORT_DEFAULT_URL', null),
        ],
    ],
    'Email' => [
        'default' => [
            'transport' => 'default',
            'from' => 'you@localhost',
            //'charset' => 'utf-8',
            //'headerCharset' => 'utf-8',
        ],
    ],
    'Datasources' => [
        'default' => [
            'className' => Connection::class,
            'driver' => Mysql::class,
            'persistent' => false,
            'host' => '',
            'username' => '',
            'password' => '',
            'database' => '',
            'timezone' => 'UTC',
            //'encoding' => 'utf8mb4',
            'flags' => [],
            'cacheMetadata' => true,
            'log' => false,
            'quoteIdentifiers' => false,
            //'init' => ['SET GLOBAL innodb_stats_on_metadata = 0'],
        ],
        'development' => [
            'className' => Connection::class,
            'driver' => Mysql::class,
            'persistent' => false,
            'host' => 'localhost',
            'username' => 'root',
            'password' => '123',
            'database' => 'eventos',
            'timezone' => 'UTC',
            //'encoding' => 'utf8mb4',
            'flags' => [],
            'cacheMetadata' => true,
            'log' => false,
            'quoteIdentifiers' => false,
            //'init' => ['SET GLOBAL innodb_stats_on_metadata = 0'],
        ],
        'production' => [
            'className' => Connection::class,
            'driver' => Mysql::class,
            'persistent' => false,
            'host' => '',
            'username' => '',
            'password' => '',
            'database' => '',
            'timezone' => 'UTC',
            //'encoding' => 'utf8mb4',
            'flags' => [],
            'cacheMetadata' => true,
            'log' => false,
            'quoteIdentifiers' => false,
            //'init' => ['SET GLOBAL innodb_stats_on_metadata = 0'],
        ],
        'test' => [
            'className' => Connection::class,
            'driver' => Mysql::class,
            'persistent' => false,
            'timezone' => 'UTC',
            //'encoding' => 'utf8mb4',
            'flags' => [],
            'cacheMetadata' => true,
            'quoteIdentifiers' => false,
            'log' => false,
            //'init' => ['SET GLOBAL innodb_stats_on_metadata = 0'],
        ],
    ],
    'Log' => [
        'debug' => [
            'className' => FileLog::class,
            'path' => LOGS,
            'file' => 'debug',
            'url' => env('LOG_DEBUG_URL', null),
            'scopes' => false,
            'levels' => ['notice', 'info', 'debug'],
        ],
        'error' => [
            'className' => FileLog::class,
            'path' => LOGS,
            'file' => 'error',
            'url' => env('LOG_ERROR_URL', null),
            'scopes' => false,
            'levels' => ['warning', 'error', 'critical', 'alert', 'emergency'],
        ],
        'queries' => [
            'className' => FileLog::class,
            'path' => LOGS,
            'file' => 'queries',
            'url' => env('LOG_QUERIES_URL', null),
            'scopes' => ['queriesLog'],
        ],
    ],
    'Session' => [
        'defaults' => 'database',
        'timeout' => 86400,       //in minutes
        'cookieTimeout' => 86400,    // session cookie 24 hours
        'autoRegenerate' => TRUE,    // regenerate session
        'ini' => array(
            'session.gc_maxlifetime' => 86400, // 24 horas
            'session.cookie_lifetime' => 86400, // Valid for 30 minutes
            'session.gc_divisor' => 86400,
        ),
    ],

    'DebugKit' => ['forceEnable' => TRUE]
];

if (PHP_SAPI === 'cli') {

    $path = dirname(__DIR__);

    if (strpos($path, 'Web\eventos-anhanguera.tk')) {

        $app['debug'] = filter_var(env('DEBUG', TRUE), FILTER_VALIDATE_BOOLEAN);

        $app['Datasources']['default'] = $app['Datasources']['development'];

        define('SITE_ENVIRONMENT', 'DEVELOPMENT');
        define('SITE_URL', 'http://localhost/eventos-anhanguera.tk/');

    } else {

        $app['debug'] = filter_var(env('DEBUG', FALSE), FILTER_VALIDATE_BOOLEAN);

        $app['Datasources']['default'] = $app['Datasources']['production'];

        define('SITE_ENVIRONMENT', 'PRODUCTION');
        define('SITE_URL', 'https://eventos-anhanguera.tk/');

    }

} else if (isset($_SERVER, $_SERVER['SERVER_NAME'])) {

    if (in_array($_SERVER['SERVER_NAME'], ['eventos-anhanguera.tk', 'www.eventos-anhanguera.tk'])) {

        $app['debug'] = filter_var(env('DEBUG', FALSE), FILTER_VALIDATE_BOOLEAN);

        $app['Datasources']['default'] = $app['Datasources']['production'];

        define('SITE_ENVIRONMENT', 'PRODUCTION');
        define('SITE_URL', 'https://eventos-anhanguera.tk/');

    } elseif ($_SERVER['SERVER_NAME'] === 'localhost') {

        $app['debug'] = filter_var(env('DEBUG', TRUE), FILTER_VALIDATE_BOOLEAN);
        $app['Datasources']['default'] = $app['Datasources']['development'];

        define('SITE_ENVIRONMENT', 'DEVELOPMENT');
        define('SITE_URL', 'http://localhost/eventos-anhanguera.tk/');

    } else {

        define('SITE_ENVIRONMENT', NULL);
        define('SITE_URL', 'https://eventos-anhanguera.tk/');

    }
}

return $app;
