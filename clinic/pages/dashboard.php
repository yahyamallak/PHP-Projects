
<?php include_once __DIR__ . "/includes/header.php" ?>

<?php include_once __DIR__ . "/includes/sidebar.php" ?>


<main class="body">
    <h3>Dashboard</h3>
    <div class="statistics">
        <div class="card">
            <h4>Patients</h4>
            <p><?= $patientsCount ?></p>
        </div>

        <div class="card">
            <h4>Doctors</h4>
            <p><?= $doctorsCount ?></p>
        </div>

        <div class="card">
            <h4>Appointments</h4>
            <p><?= $appointmentsCount ?></p>
        </div>

        <div class="card">
            <h4>Medical records</h4>
            <p><?= $medicalRecordsCount ?></p>
        </div>

        <div class="card">
            <h4>Prescriptions</h4>
            <p><?= $prescriptionsCount ?></p>
        </div>
    </div>
</main>




<?php include_once __DIR__ . "/includes/footer.php" ?>
