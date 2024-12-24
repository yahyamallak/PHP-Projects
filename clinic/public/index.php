<?php

require_once dirname(__DIR__) . "/vendor/autoload.php";

use Clinic\Controllers\AppointmentController;
use Clinic\Controllers\DashboardController;
use Clinic\Controllers\DoctorController;
use Clinic\Controllers\HomeController;
use Clinic\Controllers\LoginController;
use Clinic\Controllers\MedicalRecordController;
use Clinic\Controllers\PatientController;
use Masar\Exceptions\NotFoundException;
use Masar\Http\Request;
use Masar\Routing\Router;


$config = [
    "controllers" => "Clinic\Controllers",
    "middlewares" => "Clinic\Middlewares"
];


$router = new Router($config);

$router->get('/', [LoginController::class, 'index']);

$router->get('/home', [HomeController::class, 'index']);

$router->get('/dashboard', [DashboardController::class,'index']);

$router->get('/patients', [PatientController::class,'index']);
$router->post("/patients", [PatientController::class ,"add"]);
$router->get("/patients/edit/{id}", [PatientController::class ,"editPage"]);
$router->post("/patients/edit/{id}", [PatientController::class ,"edit"]);
$router->post("/patients/delete/{id}", [PatientController::class ,"delete"]);

$router->get('/doctors', [DoctorController::class,'index']);
$router->post('/doctors', [DoctorController::class,'add']);
$router->get('/doctors/edit/{id}', [DoctorController::class,'editPage']);
$router->post('/doctors/edit/{id}', [DoctorController::class,'edit']);
$router->post('/doctors/delete/{id}', [DoctorController::class,'delete']);

$router->get('/appointments', [AppointmentController::class,'index']);
$router->post('/appointments', [AppointmentController::class,'add']);
$router->get('/appointments/edit/{id}', [AppointmentController::class,'editPage']);
$router->post('/appointments/edit/{id}', [AppointmentController::class,'edit']);
$router->post('/appointments/delete/{id}', [AppointmentController::class,'delete']);


$router->get('/medical_records', [MedicalRecordController::class,'index']);
$router->post('/medical_records', [MedicalRecordController::class,'add']);


$router->get('/prescriptions', function() {
    require_once __DIR__ . "/../pages/prescriptions.php";
});

$router->get('/payments', function() {
    require_once __DIR__ . "/../pages/payments.php";
});

$request = new Request();

try {
    $router->dispatch($request);
} catch (NotFoundException $e) {
    echo $e->getMessage();
}
