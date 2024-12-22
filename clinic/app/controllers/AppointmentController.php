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
        $appointmentsData = $appointment->paginate(2);	

        $appointments = $appointmentsData['appointments'];
        $pagination = $appointmentsData['pagination'];

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
}