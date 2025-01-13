<?php 

namespace Google\Classes;

use Google\Database\Database;

class WebCrawler extends Database {

    private $document;

    private $db;

    private $alreadyCrawled = [];
    private $alreadyCrawledImages = [];

    private $toCrawl = [];

    public function __construct() {
        $this->db = Database::connect();
    }

    private function loadHTML($url) {

        $options = [
            "http" => [
                "method" => "GET",
                "header" => "User-agent: googlyBot/0.1\r\n"
            ]
        ];
        
        $context = stream_context_create($options);
        
        // Fetch the HTML content from the URL
        $htmlContent = file_get_contents($url, false, $context);
        
        if ($htmlContent === false) {
            throw new \Exception("Failed to fetch the content from the URL: $url");
        }
        
        $this->document = new \DOMDocument();
        @$this->document->loadHTML($htmlContent);
    }

    private function getLinks() {
        return $this->document->getElementsByTagName("a");
    }

    private function getTitleTags() {
        return $this->document->getElementsByTagName("title");
    }

    private function getMetaTags() {
        return $this->document->getElementsByTagName("meta");
    }

    private function getImages() {
        return $this->document->getElementsByTagName("img");
    }

    private function getTitle()  {

        $titles = $this->getTitleTags();

        if($titles->length == 0) {
            return "Untitled";
        }

        $title = $titles->item(0)->nodeValue;

        
        return empty(trim($title)) ? "Untitled" : trim($title);
    }

    private function doesURLExist($url) {
        $sql = "SELECT 1 FROM sites WHERE url = :url";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":url", $url);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    private function doesImageExist($url) {
        $sql = "SELECT 1 FROM images WHERE imageUrl = :url";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":url", $url);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    private function insertURL($url, $title, $description, $keywords) {
        $sql = "INSERT INTO sites (url, title, description, keywords) VALUES (:url, :title, :description, :keywords)";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(":url", $url);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":keywords", $keywords);

        return $stmt->execute();
    
    }

    private function insertImage($url, $src, $alt, $title) {
        $sql = "INSERT INTO images (siteUrl, imageUrl, alt, title) VALUES (:url, :src, :alt, :title)";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(":url", $url);
        $stmt->bindParam(":src", $src);
        $stmt->bindParam(":alt", $alt);
        $stmt->bindParam(":title", $title);

        return $stmt->execute();
    
    }

    private function getDetails($url) {

        try {
            $this->loadHTML($url);
        } catch(\Exception $e) {
            echo "Exception : ". $e->getMessage();
        }

        $title = $this->getTitle();
        $description = "";
        $keywords = "";

        $metaTags = $this->getMetaTags();

        foreach($metaTags as $metaTag) {
            if($metaTag->getAttribute("name") == "description") {
                $description = $metaTag->getAttribute("content");
            } else if($metaTag->getAttribute("name") == "keywords") {
                $keywords = $metaTag->getAttribute("content");
            }
        }
        
        if(!$this->doesURLExist($url)) {
            $this->insertURL($url, $title, $description, $keywords);          
        }
        
        $images = $this->getImages();

        if($images->count() > 0) {
            foreach($images as $image) {
                $src = $image->getAttribute("src");
                $imageTitle = $image->getAttribute("title");
                $alt = $image->getAttribute("alt");

                if(empty($alt) && empty($imageTitle)) {
                    continue;
                }

                $src = $this->formatLink($src, $url);

                if(!in_array($src, $this->alreadyCrawledImages)) {
                    $this->alreadyCrawledImages[] = $src;

                    if(!$this->doesImageExist($src)) {
                        $this->insertImage($url, $src, $alt, $imageTitle);
                    }
                }
            }
        }
    
    }

    private function formatLink($link, $url) {

        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new \InvalidArgumentException("Invalid URL: $url");
        }
    
        $scheme = parse_url($url, PHP_URL_SCHEME);
        $host = parse_url($url, PHP_URL_HOST);
    
        if (empty($link)) {
            return $url;
        }
    
        if (parse_url($link, PHP_URL_SCHEME)) {
            return $link;
        }


        if (substr($link, 0, 2) == "//") {
            return $scheme . ":" . $link;
        }

        if (substr($link, 0, 1) == "/") {
            return $scheme . "://" . $host . $link;
        }

        return $scheme ."://". $host . $link;
    }


    public function crawl($url) {

        if(!in_array($url, $this->alreadyCrawled)) {

            $this->getDetails($url);

            try {
                $this->loadHTML($url);
            } catch(\Exception $e) {
                echo "Exception : ". $e->getMessage();
            }
            
            $links = $this->getLinks();
    
            foreach ($links as $link) {
    
                $href = $link->getAttribute("href");
    
                if(substr($href, 0, 1) == "#") {
                    continue;
                } else if(substr($href, 0,11) == "javascript:") {
                    continue;
                }
    
                $formatedLink = $this->formatLink($href, $url);
    
                if(!in_array($formatedLink, $this->alreadyCrawled)) {
                    $this->toCrawl[] = $formatedLink;
                }
                
            }
    
            $this->alreadyCrawled[] = $url;


            foreach ($this->toCrawl as $link) {
                $this->crawl($link);
            }


        }

        
    }
}
