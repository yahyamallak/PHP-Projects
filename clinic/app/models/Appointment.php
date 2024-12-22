<?php

namespace Clinic\Models;

class Appointment extends Model{

    protected $table = "appointments";

    protected $appointments = [];

    protected $search = false;

    public function add($data){
        return $this->insert($this->table, $data);
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


    public function getAppointmentsPaginate($number, $offset) {
        $sql = "SELECT a.id, u.name AS patient, us.name AS doctor, a.appointment_date, a.`status` FROM appointments a 
            JOIN users u ON a.patient_id = u.id
            JOIN users us ON a.doctor_id = us.id
            LIMIT :num OFFSET :offs";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":num", (int)$number, \PDO::PARAM_INT);
        $stmt->bindValue(":offs", (int)$offset, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function paginate($number) {

        if(isset($_GET['search'])) {
            $search = $_GET['search'];
            $this->search($search);
        }
        
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

        if(empty($this->appointments) && !$this->search) {
            $offset = ($page - 1) * $number;
            $this->appointments = $this->getAppointmentsPaginate($number, $offset);
        }
        
        $appointments = $this->appointments;
        $appointmentsNumber = $this->getAppointmentsNumber();
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
        
        $pagination[] = "<a href='?page=1'><li>1</li></a>";

        if(($k = $start - $range) >= 1) {
            $k = ($k == 1) ? $k + 1 : $k;
            $pagination[] = "<a href='?page=$k'><li>...</li></a>";;
        }

        for ($i = $start; $i <= $end; $i++) {
            $pagination[] = "<a href='?page=$i'><li>$i</li></a>";;
        }

        if(($j = $end + $range) < $totalPages) {
            $pagination[] = "<a href='?page=$j'><li>...</li></a>";;
        }

        if($totalPages > 1) {
            $pagination[] = "<a href='?page=$totalPages'><li>$totalPages</li></a>";;
        }


        $paginationData = [
            "appointments"=> $appointments,
            "pagination" => $pagination
        ];

        return $paginationData;
    }

    private function searchAppointments($words) {
        
        $sql = "SELECT a.id, u.name AS patient, us.name AS doctor, a.appointment_date, a.`status` FROM appointments a 
            JOIN users u ON a.patient_id = u.id
            JOIN users us ON a.doctor_id = us.id WHERE ";

        foreach ($words as $key => $word) {
            $likeClause[] = "u.name LIKE :search".$key+1;
        }

        $sql .= implode(" OR ", $likeClause);

        $stmt = $this->db->prepare($sql);

        foreach ($words as $key => $word) {
            $stmt->bindValue(":search".$key+1, "%$word%");
        }

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }

    public function search($search) {
        $this->search = true;
        $words = explode(" ", $search);
        $this->appointments = $this->searchAppointments($words); 
    }
}