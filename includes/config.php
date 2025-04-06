<?php
// Database
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'think');

// Site
define('SITE_NAME', 'Think');
define('SITE_URL', 'http://think/');
define('DEBUG_MODE', true);

// Paths
define('ROOT_DIR', dirname(__DIR__));
define('INCLUDES_DIR', ROOT_DIR . '/includes');
define('PAGES_DIR', ROOT_DIR . '/pages');
define('TEMPLATES_DIR', ROOT_DIR . '/templates');
define('ASSETS_DIR', ROOT_DIR . '/assets');
define('COMPONENTS_DIR', ROOT_DIR . '/includes');

// DB Connection
function db_connect() {
    static $connection;
    if (!$connection) {
        $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($connection->connect_error) {
            die("Ошибка подключения: " . $connection->connect_error);
        }
        $connection->set_charset("utf8");
    }
    return $connection;
}
