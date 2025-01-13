<?php 

namespace Google\Controllers;

use Google\Models\Image;
use Google\Models\Site;

class HomeController {

    public function index() {

        require_once __DIR__ ."/../pages/home.php";
    }

    public function search() {

        if(isset($_GET["q"]) && !empty($_GET["q"])) {
            $query = $_GET["q"];
        } else {
            header("Location: /");
            exit;
        }

        if(isset($_GET["type"])) {
            $type = $_GET["type"];
        } else {
            $type = "";
        }

        if(isset($_GET["page"]) && !empty($_GET["page"])) {
            $page = $_GET["page"];
        } else {
            $page = 1;
        }

        if($type == 'images') {
            $limit = 30;
            $imageModel = new Image();
            $imagesFound = $imageModel->getNumberOfImagesFound($query);
            $images = $imageModel->getImages($query, $page, $limit);

        } else {
            $limit = 20;
            $siteModel = new Site();
            $sitesFound = $siteModel->getNumberOfSitesFound($query);
            $sites = $siteModel->getSites($query, $page, $limit);
        }


        $founds = isset($sitesFound) ? $sitesFound: (isset($imagesFound) ? $imagesFound: null);        

        $pages = ceil($founds / $limit);
        $pagesToShow = 10;

        $halfrange = floor($pagesToShow /2);
        $startPage = max(1, $page - $halfrange);
        $endPage = min($pages, $startPage + $pagesToShow - 1);

        if($endPage - $startPage + 1 < $pagesToShow) {
            $startPage = max(1, $endPage - $pagesToShow + 1);
        }

        require_once __DIR__ ."/../pages/search.php";
    }
}