<?php

namespace Clinic\Controllers;

use Clinic\Models\Appointment;
use Clinic\Models\Doctor;
use Clinic\Models\Patient;


class AppointmentController {

    public function index() {

        $patient = new Patient();
        $patients = $patient->getPatients();

        $doctor = new Doctor();
        $doctors = $doctor->getDoctors();

        $appointment = new Appointment();
        $appointmentsData = $appointment->paginate(5);	

        $appointments = $appointmentsData['appointments'];
        $pagination = $appointmentsData['pagination'];
        $sorting = $appointmentsData['sorting'];

        require_once __DIR__."/../../pages/appointments.php";
    }


    public function add() {

        $appointmentDate = $_POST["date"];
        $appointmentTime = $_POST["time"];

        $dateTime = new \DateTime("$appointmentDate $appointmentTime");
        
        $appointmentData = [
            "patient_id" => $_POST["patient"],
            "doctor_id" => $_POST["doctor"],
            "appointment_date" => $dateTime->format('Y-m-d H:i:s'),
            "status" => $_POST["status"],
        ];

        $appointment = new Appointment();
        $appointment->add($appointmentData);

        header("Location: /appointments");
        exit;
    }

    public function editPage($id) {

        $appointment = new Appointment();
        $appointmentInfo = $appointment->find($id);

        if(empty($appointmentInfo)) {
            header("Location: /appointments");
            exit;
        }

        $patient = new Patient();
        $patients = $patient->getPatients();

        $doctor = new Doctor();
        $doctors = $doctor->getDoctors();


        $appointmentDate = $appointmentInfo["appointment_date"];

        list($date, $time) = explode(" ", $appointmentDate);

        require_once __DIR__."/../../pages/editAppointment.php";

    }

    public function edit($id) {

        $appointment = new Appointment();
        $appointmentInfo = $appointment->find($id);

        if(!empty($appointmentInfo)) {

            $appointmentDate = $_POST["date"];
            $appointmentTime = $_POST["time"];
    
            $dateTime = new \DateTime("$appointmentDate $appointmentTime");
            
            $appointmentData = [
                "patient_id" => (int) $_POST["patient"],
                "doctor_id" => (int) $_POST["doctor"],
                "appointment_date" => $dateTime->format('Y-m-d H:i:s'),
                "status" => $_POST["status"],
            ];
    
            $appointment->edit($appointmentData, $id);
            
            header("Location: /appointments/edit/$id");
            exit;
        }

        header("Location: /appointments");
        exit;
    }


    public function delete($id) {
        $appointment = new Appointment();
        $appointmentInfo = $appointment->find($id);

        if(!empty($appointmentInfo)) {
            $appointment->delete($id);
        }

        header("Location: /appointments");
        exit;
    }
}