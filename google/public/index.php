<?php

use Google\Controllers\CrawlerController;
use Google\Controllers\HomeController;
use Masar\Exceptions\NotFoundException;
use Masar\Http\Request;
use Masar\Routing\Router;

require_once dirname(__DIR__) . "/vendor/autoload.php";


$config = [
    "controllers" => "Google\Controllers",
    "middlewares" => "Google\Middlewares"
];


$router = new Router($config);

$router->get('/', [HomeController::class,'index']);
$router->get('/search', [HomeController::class,'search']);
$router->get('/crawl', [CrawlerController::class,'crawl']);

$request = new Request();

try {
    $router->dispatch($request);
} catch (NotFoundException $e) {
    echo $e->getMessage();
}