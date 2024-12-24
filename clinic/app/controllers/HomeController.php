<?php

namespace Clinic\Controllers;

class HomeController {


    public function index() {
        require_once dirname(__DIR__) . '/../pages/home.php'; 
    }
}