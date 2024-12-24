<?php

namespace Clinic\Models;

use PDO;

class Doctor extends Model{

    protected $table = "doctors";

    protected $doctors = [];

    protected $search = false;

    protected $sort = ["users.id", "users.name", "doctors.specialization", "users.date_of_birth", "users.gender",  "users.email",  "users.created_at"];


    public function add($data) {
        $this->insert($this->table, $data);
    }

    public function find( $id ) {
        return $this->getJoin("users.id", "$this->table.doctor_id", $id);
    }

    public function getDoctors($option = false) {
        return $this->join("users.id", "$this->table.doctor_id", $option);
    }

    public function paginate($number) {
        
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $search = '';
        $sort = 'users.id';
        $sortType = 'asc';
        $offset = ($page - 1) * $number;

        if(isset($_GET['sort']) && !empty($_GET['sort'])) {
            $sort = $this->sort[$_GET['sort'] - 1];
        }

        if(isset($_GET['sortType']) && !empty($_GET['sortType'])) {
            $sortType = $_GET['sortType'];
        }

        if(isset($_GET['search']) && !empty($_GET['search'])) {
            $search = $_GET['search'];
            $words = explode(" ", $search);
            $this->search($search, $number, $offset, [$sort, $sortType]);
            $doctorsNumber = count($this->searchWords("users.id", "$this->table.doctor_id", $words));
        }

        if(empty($this->doctors) && !$this->search) {
            $this->doctors = $this->joinPaginate("users.id","$this->table.doctor_id", $number, $offset, [$sort, $sortType]);
            $doctorsNumber = $this->getDoctors(true);
        }
        
        $doctors = $this->doctors;
        $totalPages = ceil($doctorsNumber / $number);

        $pagination = [];

        $range = 2;
        $toAddBegin = 0;
        $toAddLast = 0;

        $diffBegin = $page - $range;
        $diffLast = $page + $range;

        if($diffBegin <= 0) {
            for ($i = $diffBegin; $i < 1; $i++) {
                $toAddBegin++;
            }
        }

        if($diffLast > $totalPages) {
            for ($i = $diffLast; $i > $totalPages; $i--) {
                $toAddLast++;
            }
        }


        $start = ($page - $range - $toAddLast) <= 1 ? 2 : $page - $range - $toAddLast;
        $end = ($page + $range + $toAddBegin) >= $totalPages ? $totalPages - 1 : $page + $range + $toAddBegin;
        
        $pagination[] = "<a href='?page=1". ($this->search ? "&search=$search": "") ."'><li>1</li></a>";

        if(($k = $start - $range) >= 1) {
            $k = ($k == 1) ? $k + 1 : $k;
            $pagination[] = "<a href='?page=$k". ($this->search ? "&search=$search": "") ."'><li>...</li></a>";;
        }

        for ($i = $start; $i <= $end; $i++) {
            $pagination[] = "<a href='?page=$i". ($this->search ? "&search=$search": "") ."'><li>$i</li></a>";;
        }

        if(($j = $end + $range) < $totalPages) {
            $pagination[] = "<a href='?page=$j". ($this->search ? "&search=$search": "") ."'><li>...</li></a>";;
        }

        if($totalPages > 1) {
            $pagination[] = "<a href='?page=$totalPages". ($this->search ? "&search=$search": "") ."'><li>$totalPages</li></a>";;
        }

        [$table, $sortColumn] = explode(".", $sort);


        $paginationData = [
            "doctors"=> $doctors,
            "pagination" => $pagination,
            "sorting" => ["$sortColumn"=> $sortType]
        ];

        return $paginationData;
    }

    public function edit($data, $id) {
        $data["id"] = $id;
        return $this->update("$this->table.doctor_id", $data);
    }

    public function number() {
        return $this->count($this->table);
    }

    public function delete($id) {
        return $this->remove("users.id", $id);
    }

    public function search($search, $number, $offset, $sort) {
        $this->search = true;
        $words = explode(" ", $search);
        $this->doctors = $this->searchWordsJoin("users.id", "$this->table.doctor_id", $words, $number, $offset, $sort);
    }


    public function loadDoctors($page, $number) {

        $offset = ($page - 1) * $number;

        $sql = "SELECT * FROM users
                JOIN doctors
                ON users.id = doctors.doctor_id
                LIMIT $number OFFSET $offset";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}