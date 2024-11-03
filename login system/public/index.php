<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/constants.php';

$config = include __DIR__ . '/../config/config.php';


use Yahya\Auth\Auth;
use Yahya\Auth\Database;
use Yahya\Auth\Session;

Session::start();

$db = new Database($config);
$auth = new Auth($db);

$url = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), '/');

$parts = explode("/", $url);

$page = $parts[0];

if (empty($page)) {
    require_once PAGES . 'home.php';
} else if ($page == "dashboard") {
    require_once PAGES . 'dashboard.php';
} else if ($page == "login") {
    require_once CONTROLLERS . 'login.php';
} else if ($page == "signup") {
    require_once CONTROLLERS . 'signup.php';

} else if ($page == "logout") {
    require_once CONTROLLERS . 'logout.php';

} else {
    require_once PAGES . '404.php';
}
