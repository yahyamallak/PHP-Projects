<?php

namespace Google\Models;

use Google\Database\Database;


class Site extends Database {

    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getNumberOfSitesFound($term) {
        $sql = "SELECT count(1) as Total FROM sites WHERE url LIKE :term 
        OR title LIKE :term OR description LIKE :term OR keywords LIKE :term";

        $stmt = $this->db->prepare($sql);

        $term = "%" . $term ."%";

        $stmt->bindParam(":term", $term);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result["Total"];
    }

    public function getSites($term, $page, $limit) {

        $offset = ($page - 1) * $limit;

        $sql = "SELECT * FROM sites WHERE url LIKE :term 
        OR title LIKE :term OR description LIKE :term OR keywords LIKE :term
        ORDER BY clicks DESC LIMIT :offset, :theLimit";

        $stmt = $this->db->prepare($sql);

        $term = "%" . $term ."%";

        $stmt->bindParam(":term", $term);
        $stmt->bindParam(":offset", $offset, \PDO::PARAM_INT);
        $stmt->bindParam(":theLimit", $limit, \PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }


    public function trimField($field, $limit) {
        $dots = strlen($field) > $limit ? "..." : "";
        return substr($field,0, $limit) . $dots;
    }
}