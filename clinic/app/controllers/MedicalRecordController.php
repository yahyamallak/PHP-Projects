<?php

namespace Clinic\Controllers;

use Clinic\Models\Appointment;
use Clinic\Models\MedicalRecord;

class MedicalRecordController {

    public function index() {

        $medicalRecord = new MedicalRecord();

        $medicalRecords = $medicalRecord->all();	

        require_once __DIR__."/../../pages/medicalRecords.php";
    }


    public function viewMedicalRecord($id) {

        $medicalRecord = new MedicalRecord();

        $medicalRecordInfo = $medicalRecord->find($id);

        require_once __DIR__."/../../pages/viewMedicalRecord.php";
    }

    public function add($id) {

        $appointment = new Appointment();
        $appointmentInfo = $appointment->find( $id );
        
        if($appointmentInfo) {
            
            $data = [
                "appointment_id" => $id,
                "description" => $_POST["description"],
                "diagnosis" => $_POST["diagnosis"],
                "notes" => $_POST["notes"],
            ];

            $medicalRecord = new MedicalRecord();
            if($medicalRecord->add($data)) {
                header("Location: /medical_records");
                exit;
            }

            header("Location: /medical_records/$id");
            exit;
        }
    }
}