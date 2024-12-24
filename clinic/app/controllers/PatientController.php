<?php

namespace Clinic\Controllers;

use Clinic\Models\Patient;
use Clinic\Models\User;

class PatientController {

    public function index() {
        
        $patient = new Patient();
        $paginationData = $patient->paginate(5);
        
        $patients = $paginationData['patients'];
        $pagination = $paginationData['pagination'];
        $sorting = $paginationData['sorting'];

        require_once __DIR__."/../../pages/patients.php";
    }

    public function add() {
        
        $userData = [
            "name" => $_POST["name"],
            "date_of_birth" => $_POST["date_of_birth"],
            "gender" => $_POST["gender"],
            "phone" => $_POST["phone"],
            "email" => $_POST["email"],
            "address" => $_POST["address"],
        ];

        $user = new User();
        $userId = $user->add($userData);

        $dataPatient = [
            "patient_id" => $userId,
            "disease" => $_POST["disease"],
        ];

        $patient = new Patient();
        $patient->add($dataPatient);

        header("Location: /patients");
        exit;
    }


    public function editPage($id) {

        $patient = new Patient();

        $patientData = $patient->find($id);

        if(empty($patientData)) {
            header("Location: /patients");
            exit;
        }

        $patientInfo = $patientData[0];

        require_once __DIR__."/../../pages/editPatient.php";
    }

    public function edit($id) {

        $user = new User();
        $patient = new Patient();

    
        $patientData = $patient->find($id);
        
        if(!empty($patientData)) {

            $userData = [
                "name" => $_POST["name"],
                "date_of_birth" => $_POST["date_of_birth"],
                "gender" => $_POST["gender"],
                "phone" => $_POST["phone"],
                "email" => $_POST["email"],
                "address" => $_POST["address"],
            ];

            $user->edit($userData, $id);

            $dataPatient = [
                "disease" => $_POST["disease"],
            ];

            $patient->edit($dataPatient, $id);
            
            header("Location: /patients/edit/$id");
            exit;
        }

        header("Location: /patients");
        exit;
    }


    public function delete($id) {
        
        $patient = new Patient();

        $patientData = $patient->find($id);

        if($patientData) {
            $patient->delete($id);
        }

        header("Location: /patients");
        exit;
    }

}