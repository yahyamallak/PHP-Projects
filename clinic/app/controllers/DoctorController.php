<?php

namespace Clinic\Controllers;

use Clinic\Models\Doctor;
use Clinic\Models\User;

class DoctorController {

    public function index() {

        $doctor = new Doctor(); 
        $paginationData = $doctor->paginate(5);
        
        $doctors = $paginationData['doctors'];
        $pagination = $paginationData['pagination'];
        $sorting = $paginationData['sorting'];

        require_once __DIR__."/../../pages/doctors.php";
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

        $dataDoctor = [
            "doctor_id" => $userId,
            "specialization" => $_POST["specialization"],
        ];

        $doctor = new Doctor();
        $doctor->add($dataDoctor);

        header("Location: /doctors");
        exit;
    }

    public function editPage($id) {

        $doctor = new Doctor();

        $doctorData = $doctor->find($id);

        $doctorInfo = $doctorData[0];

        require_once __DIR__."/../../pages/editDoctor.php";
    }


    public function edit($id) {

        $user = new User();
        $doctor = new Doctor();

    
        $doctorData = $doctor->find($id);
        
        if($doctorData) {

            $userData = [
                "name" => $_POST["name"],
                "date_of_birth" => $_POST["date_of_birth"],
                "gender" => $_POST["gender"],
                "phone" => $_POST["phone"],
                "email" => $_POST["email"],
                "address" => $_POST["address"],
            ];

            $user->edit($userData, $id);

            $dataDoctor = [
                "specialization" => $_POST["specialization"],
            ];

            $doctor->edit($dataDoctor, $id);
        }

        header("Location: /doctors/edit/$id");
        exit;
    }


    public function delete($id) {

        $doctor = new Doctor();

        $doctorData = $doctor->find($id);

        if($doctorData) {
            $doctor->delete($id);
        }

        header("Location: /doctors");
        exit;
    }

}