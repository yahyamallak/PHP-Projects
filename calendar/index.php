<?php

use Masar\Exceptions\NotFoundException;
use Masar\Http\Request;
use Masar\Routing\Router;

date_default_timezone_set("Africa/Casablanca");

require_once "./vendor/autoload.php";
require_once "./controllers/CalendarController.php";
require_once "Calendar.php";

$router = new Router();


$router->get("/calendar", function() {
    $calendar = new Calendar();
    require_once "pages/calendar.php";
});


$router->get("/calendar/getTime", [CalendarController::class,"getTime"]);
$router->get("/calendar/getMonth", [CalendarController::class,"getMonth"]);
$router->get("/calendar/getYear", [CalendarController::class,"getYear"]);
$router->get("/calendar/getDate", [CalendarController::class,"getDate"]);
$router->post("/calendar/getSubDate", [CalendarController::class,"getSubDate"]);
$router->post("/calendar/getLastWeekOfPreviousMonth", [CalendarController::class, "getLastWeekOfPreviousMonth"]);
$router->post("/calendar/getDaysOfMonth", [CalendarController::class, "getDaysOfMonth"]);

$request = new Request();

try {
    $router->dispatch($request);
} catch (NotFoundException $e) {
    echo $e->getMessage();
}