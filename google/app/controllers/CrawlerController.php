<?php 


namespace Google\Controllers;

use Google\Classes\WebCrawler;

class CrawlerController {

    public function crawl() {

        $url = "https://www.ebay.com";

        $crawler = new WebCrawler();
        $crawler->crawl($url);
    }
}