<?php

namespace Clinic\Models;

use PDO;

class MedicalRecord extends Model{

    protected $table = "medical_records";

    public function all() {
        return $this->getAll($this->table);
    }

    public function find( $id ) {
        $sql = "SELECT * FROM $this->table where appointment_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam("id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function add($data) {

        $sql = "INSERT INTO $this->table (". implode(",", array_keys($data)) . ") VALUES (". implode(",", array_map(fn($key) => ":$key", array_keys($data))) .")";

       $stmt = $this->db->prepare($sql);
       foreach ($data as $key => $value) {
         $stmt->bindValue(":$key", $value);
       }

       $stmt->execute();

       return $this->db->lastInsertId();

    }

}