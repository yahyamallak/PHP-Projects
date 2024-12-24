<?php

namespace Clinic\Controllers;

use Clinic\Models\Doctor;

class HomeController {


    public function index() {

        $doctor = new Doctor();
        $doctors = $doctor->paginate(5)["doctors"];

        require_once dirname(__DIR__) . '/../pages/home.php'; 
    }

    public function getDoctors() {
        $page = $_POST['page'];
        $number = 5;

        $doctor = new Doctor();
        $doctors = $doctor->loadDoctors($page, $number);
        
        return json_encode($doctors);
    
    }
}