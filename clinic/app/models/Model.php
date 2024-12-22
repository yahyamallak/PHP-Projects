<?php

namespace Clinic\Models;

use PDO;
use Clinic\Database\Database;
class Model extends Database{

    protected $db;

    private $sqlParams;
    private $sqlParamsUpdate;

    private $sqlPlaceholders;

    public function __construct(){
        $this->db = Database::connect();
    }

    public function getJoin($table1, $table2, $id) {
        [$tableName1, $id1] = explode(".", $table1);	
        [$tableName2, $id2] = explode(".", $table2);	

        $sql = "SELECT * FROM $tableName1 JOIN $tableName2 ON $table1 = $table2 WHERE $table1 = $id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($table, $data){

        $this->prepareSqlParams($data);
       
        $sql = "INSERT INTO $table ($this->sqlParams) VALUES ($this->sqlPlaceholders)";

        $stmt = $this->db->prepare($sql);

        $this->bindValues($stmt, $data);

        $stmt->execute();

        return $this->db->lastInsertId();
    }

    private function prepareSqlParams($data) {
        foreach($data as $key => $value){
            $sqlParams[] = "$key";
            $sqlPlaceholders[] = ":$key";
        }

        $this->sqlParams = implode(",", $sqlParams);
        $this->sqlPlaceholders = implode(",", $sqlPlaceholders);
    }

    private function prepareSqlParamsForUpdate($data) {
        foreach($data as $key => $value){
            $sqlParamsUpdate[] = "$key = :$key";
        }

        $this->sqlParamsUpdate = implode(",", $sqlParamsUpdate);

    }

    private function bindValues($stmt, $data){
        foreach($data as $key => $value){
            $stmt->bindValue($key, $value);
        }
    }

    public function getAll($table) {
        $sql = "SELECT * FROM $table";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function join($table1, $table2, $option) {
    
        [$tableName1, $id1] = explode(".", $table1);	
        [$tableName2, $id2] = explode(".", $table2);	

        $sql = "SELECT * FROM $tableName1 JOIN $tableName2 ON $table1 = $table2";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        if($option) {
            return $stmt->rowCount();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function joinPaginate($table1, $table2, $limit, $offset, $sortArray = []) {
        [$tableName1, $id1] = explode(".", $table1);	
        [$tableName2, $id2] = explode(".", $table2);	

        $sql = "SELECT * FROM $tableName1 JOIN $tableName2 ON $table1 = $table2";

        if($sortArray[0] != null && $sortArray[1] != null) {
            $sort = $sortArray[0];
            $sortType = $sortArray[1];

            $sql .= " ORDER BY $sort $sortType";
        }

        $sql .= " LIMIT $limit OFFSET $offset";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function update($table, $data) {

        [$tableName, $id] = explode(".", $table);	


        $id = array_pop($data);

        $this->prepareSqlParamsForUpdate($data);
       
        $data["id"] = $id;

        $sql = "UPDATE $tableName SET $this->sqlParamsUpdate WHERE $table = :id";

        $stmt = $this->db->prepare($sql);

        $this->bindValues($stmt, $data);

        $stmt->execute();

        return $this->db->lastInsertId();
    }


    protected function count($table) {
        $sql = "SELECT * FROM $table";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->rowCount();
    }


    protected function remove($table, $id) {
       
        [$tableName1, $id1] = explode(".", $table);

        $sql1 = "DELETE FROM $tableName1 WHERE $id1 = :$id1";

        $stmt1 = $this->db->prepare($sql1);

        $stmt1->execute([":$id1"=> $id]);

        
    } 

    protected function searchWords($table1, $table2, $words) {

        [$tableName1, $id1] = explode(".", $table1);
        [$tableName2, $id2] = explode(".", $table2);

        $sql = "SELECT * FROM $tableName1 JOIN $tableName2 ON $table1 = $table2 WHERE ";

        foreach ($words as $key => $word) {
            $likeClause[] = "$table1 LIKE :searchId".$key+1;
            $likeClause[] = "$tableName1.name LIKE :searchName".$key+1;
            $likeClause[] = "$tableName1.date_of_birth LIKE :searchDateOfBirth".$key+1;
            $likeClause[] = "$tableName1.gender LIKE :searchGender".$key+1;
            $likeClause[] = "$tableName1.phone LIKE :searchPhone".$key+1;
            $likeClause[] = "$tableName1.email LIKE :searchEmail".$key+1;
            $likeClause[] = "$tableName1.address LIKE :searchAddress".$key+1;
        }

        $sql .= implode(" OR ", $likeClause);

        $stmt = $this->db->prepare($sql);

        foreach ($words as $key => $word) {
            $stmt->bindValue(":searchId".$key+1, "%$word%");
            $stmt->bindValue(":searchName".$key+1, "%$word%");
            $stmt->bindValue(":searchDateOfBirth".$key+1, "%$word%");
            $stmt->bindValue(":searchGender".$key+1, "%$word%");
            $stmt->bindValue(":searchPhone".$key+1, "%$word%");
            $stmt->bindValue(":searchEmail".$key+1, "%$word%");
            $stmt->bindValue(":searchAddress".$key+1, "%$word%");
        }

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    protected function searchWordsJoin($table1, $table2, $words,$number, $offset, $sortArray = []) {

        [$tableName1, $id1] = explode(".", $table1);
        [$tableName2, $id2] = explode(".", $table2);

        $sql = "SELECT * FROM $tableName1 JOIN $tableName2 ON $table1 = $table2 WHERE ";

        foreach ($words as $key => $word) {
            $likeClause[] = "$table1 LIKE :searchId".$key+1;
            $likeClause[] = "$tableName1.name LIKE :searchName".$key+1;
            $likeClause[] = "$tableName1.date_of_birth LIKE :searchDateOfBirth".$key+1;
            $likeClause[] = "$tableName1.gender LIKE :searchGender".$key+1;
            $likeClause[] = "$tableName1.phone LIKE :searchPhone".$key+1;
            $likeClause[] = "$tableName1.email LIKE :searchEmail".$key+1;
            $likeClause[] = "$tableName1.address LIKE :searchAddress".$key+1;
        }

        $sql .= implode(" OR ", $likeClause);

        if($sortArray[0] != null && $sortArray[1] != null) {

            $sort = $sortArray[0];
            $sortType = $sortArray[1];

            $sql .= " ORDER BY $sort $sortType";
        }

        $sql .= " LIMIT $number OFFSET $offset";

        $stmt = $this->db->prepare($sql);

        foreach ($words as $key => $word) {
            $stmt->bindValue(":searchId".$key+1, "%$word%");
            $stmt->bindValue(":searchName".$key+1, "%$word%");
            $stmt->bindValue(":searchDateOfBirth".$key+1, "%$word%");
            $stmt->bindValue(":searchGender".$key+1, "%$word%");
            $stmt->bindValue(":searchPhone".$key+1, "%$word%");
            $stmt->bindValue(":searchEmail".$key+1, "%$word%");
            $stmt->bindValue(":searchAddress".$key+1, "%$word%");
        }

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}