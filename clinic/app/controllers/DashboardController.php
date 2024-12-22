<?php


namespace Clinic\Controllers;

use Clinic\Models\Appointment;
use Clinic\Models\Doctor;
use Clinic\Models\Patient;

class DashboardController {


    public function index() {

        $patient = new Patient();
        $patientsCount = $patient->number();

        $doctor = new Doctor();
        $doctorsCount = $doctor->number();

        $appointment = new Appointment();
        $appointmentsCount = $appointment->getAppointmentsNumber();

        $medicalRecordsCount = 0;
        $prescriptionsCount = 0;

        require_once __DIR__ . "/../../pages/dashboard.php";
    }
}