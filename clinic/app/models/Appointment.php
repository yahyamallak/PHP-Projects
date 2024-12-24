<?php

namespace Clinic\Models;

use PDO;

class Appointment extends Model{

    protected $table = "appointments";

    protected $appointments = [];

    protected $search = false;

    protected $sort = ["a.id", "patient", "doctor", "a.appointment_date", "a.status"];

    public function add($data){
        return $this->insert($this->table, $data);
    }

    public function edit($data, $id) {
        $data["id"] = $id;
        return $this->update("$this->table.id", $data);
    }

    public function find( $id ) {
        $sql = "SELECT a.id, u.name AS patient, a.patient_id, us.name AS doctor, a.doctor_id, a.appointment_date, a.`status` FROM appointments a 
            JOIN users u ON a.patient_id = u.id
            JOIN users us ON a.doctor_id = us.id
            WHERE a.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAppointmentsNumber() {
        $sql = "SELECT count(1) FROM $this->table";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getAppointments() {
        $sql = "SELECT a.id, u.name AS patient, us.name AS doctor, a.appointment_date, a.`status` FROM appointments a 
            JOIN users u ON a.patient_id = u.id
            JOIN users us ON a.doctor_id = us.id";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    public function getAppointmentsPaginate($number, $offset, $sortArray) {
        $sql = "SELECT a.id, u.name AS patient, us.name AS doctor, a.appointment_date, a.`status` FROM appointments a 
            JOIN users u ON a.patient_id = u.id
            JOIN users us ON a.doctor_id = us.id";

        if($sortArray[0] != null && $sortArray[1] != null) {
            $sort = $sortArray[0];
            $sortType = $sortArray[1];

            $sql .= " ORDER BY $sort $sortType";
        }

        $sql .= " LIMIT :num OFFSET :offs";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":num", (int)$number, \PDO::PARAM_INT);
        $stmt->bindValue(":offs", (int)$offset, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function paginate($number) {
        
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $search = '';
        $sort = 'a.id';
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
            $appointmentsNumber = $this->searchAppointmentsNumber($words);
        }

        if(empty($this->doctors) && !$this->search) {
            $this->appointments = $this->getAppointmentsPaginate($number, $offset, [$sort, $sortType]);
            $appointmentsNumber = $this->getAppointmentsNumber();
        }
        
        $appointments = $this->appointments;
        $totalPages = ceil($appointmentsNumber / $number);

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

        
        if(str_contains($sort, ".")) {
            [$table, $sortColumn] = explode(".", $sort);
        } else {
            $sortColumn = $sort;
        }

        $paginationData = [
            "appointments"=> $appointments,
            "pagination" => $pagination,
            "sorting" => ["$sortColumn"=> $sortType]
        ];

        return $paginationData;
    }

    private function searchAppointmentsNumber($words) {
        
        $sql = "SELECT a.id, u.name AS patient, us.name AS doctor, a.appointment_date, a.`status` FROM appointments a 
            JOIN users u ON a.patient_id = u.id
            JOIN users us ON a.doctor_id = us.id WHERE ";

        foreach ($words as $key => $word) {
            $likeClause[] = "u.name LIKE :searchPatient".$key+1;
            $likeClause[] = "us.name LIKE :searchDoctor".$key+1;
            $likeClause[] = "a.appointment_date LIKE :searchAppointmentDate".$key+1;
            $likeClause[] = "a.status LIKE :searchStatus".$key+1;
        }

        $sql .= implode(" OR ", $likeClause);


        $stmt = $this->db->prepare($sql);

        foreach ($words as $key => $word) {
            $stmt->bindValue(":searchPatient".$key+1, "%$word%");
            $stmt->bindValue(":searchDoctor".$key+1, "%$word%");
            $stmt->bindValue(":searchAppointmentDate".$key+1, "%$word%");
            $stmt->bindValue(":searchStatus".$key+1, "%$word%");
        }

        $stmt->execute();

        return $stmt->rowCount();

    }

    private function searchAppointments($words, $number, $offset, $sortArray) {
        
        $sql = "SELECT a.id, u.name AS patient, us.name AS doctor, a.appointment_date, a.`status` FROM appointments a 
            JOIN users u ON a.patient_id = u.id
            JOIN users us ON a.doctor_id = us.id WHERE ";

        foreach ($words as $key => $word) {
            $likeClause[] = "u.name LIKE :searchPatient".$key+1;
            $likeClause[] = "us.name LIKE :searchDoctor".$key+1;
            $likeClause[] = "a.appointment_date LIKE :searchAppointmentDate".$key+1;
            $likeClause[] = "a.status LIKE :searchStatus".$key+1;
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
            $stmt->bindValue(":searchPatient".$key+1, "%$word%");
            $stmt->bindValue(":searchDoctor".$key+1, "%$word%");
            $stmt->bindValue(":searchAppointmentDate".$key+1, "%$word%");
            $stmt->bindValue(":searchStatus".$key+1, "%$word%");
        }

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }

    public function search($search, $number, $offset, $sort) {
        $this->search = true;
        $words = explode(" ", $search);
        $this->appointments = $this->searchAppointments($words, $number, $offset, $sort); 
    }
}