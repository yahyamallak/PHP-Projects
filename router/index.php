<?php

require 'Router.php';

$router = new Router();

$router->add('GET', '/', function() {
    echo "Home Page";
}, 'home');

$router->add('GET', '/about', function() {
    echo "About Page";
}, 'about');

$router->add('GET', '/user/{id}', function($id) {
    echo "User ID: " . $id;
}, 'user.show');

// Generate URL for named route
echo $router->route('user.show', ['id' => 123]);

// Dispatch the request
$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
