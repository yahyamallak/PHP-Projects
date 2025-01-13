<?php

namespace Google\Models;

use Google\Database\Database;


class Image extends Database {

    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getNumberOfImagesFound($term) {
        $sql = "SELECT count(1) as Total FROM images WHERE siteUrl LIKE :term 
        OR  imageUrl LIKE :term  OR title LIKE :term OR alt LIKE :term";

        $stmt = $this->db->prepare($sql);

        $term = "%" . $term ."%";

        $stmt->bindParam(":term", $term);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result["Total"];
    }

    public function getImages($term, $page, $limit) {

        $offset = ($page - 1) * $limit;

        $sql = "SELECT * FROM images WHERE siteUrl LIKE :term 
        OR  imageUrl LIKE :term  OR title LIKE :term OR alt LIKE :term
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

}