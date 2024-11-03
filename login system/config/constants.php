<?php

define("DS", DIRECTORY_SEPARATOR);


// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'login');


define("PAGES", dirname(__DIR__) . DS . 'pages' . DS);
define("PARTIALS", PAGES . 'partials' . DS);
define("CONTROLLERS", dirname(__DIR__) . DS . 'controllers' . DS);