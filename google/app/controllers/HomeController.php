<?php 

namespace Google\Controllers;


class HomeController {

    public function index() {

        require_once __DIR__ ."/../pages/home.php";
    }

    public function search() {

        require_once __DIR__ ."/../pages/search.php";
    }
}