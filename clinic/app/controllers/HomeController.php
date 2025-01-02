<?php

namespace Clinic\Controllers;

use Clinic\Models\Doctor;

class HomeController {


    public function index() {

        $doctor = new Doctor();
        $doctors = $doctor->paginate(5)["doctors"];

        $specializations = $doctor->getSpecializations();

        require_once dirname(__DIR__) . '/../pages/home.php'; 
    }

    public function getDoctors() {
        $page = $_POST['page'];
        $number = 5;

        $doctor = new Doctor();
        $doctors = $doctor->loadDoctors($page, $number);
        
        return json_encode($doctors);
    
    }

    public function searchDoctors() {

        $wordsToSearch = [];

        if(isset($_GET['category']) && !empty($_GET['category'])) {
            array_push($wordsToSearch, $_GET['category']);
        }

        if(isset($_GET['search']) && !empty($_GET['search'])) {

            $searches = explode(" ", $_GET['search']);
            array_push($wordsToSearch, ...$searches);
            
        }

        $page = isset($_POST['page']) ? $_POST['page'] : 1;
        $number = 5;


        $doctor = new Doctor();
        $doctors = $doctor->loadDoctors($page, $number, $wordsToSearch);
        return json_encode($doctors);
    }


    public function bookDoctor() {
        var_dump($_POST);
    }
}