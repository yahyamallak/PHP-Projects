
<?php include_once __DIR__ . "/includes/header.php" ?>

<?php include_once __DIR__ . "/includes/sidebar.php" ?>


<main class="body">
    <h3>Edit Appointment #<?= $id ?> :</h3>
    <div class="edit-appointment">
        <form action="/appointments/edit/<?= $id ?>" method="post">
            <select name="patient">
                <?php foreach($patients as $patient): ?>
                <option value="<?= $patient['patient_id'] ?>" <?php echo $patient['patient_id'] == $appointmentInfo['patient_id'] ? 'selected' : '' ?>><?= $patient['name'] ?></option>
                <?php endforeach; ?>
            </select>
            <select name="doctor">
                <?php foreach($doctors as $doctor): ?>
                <option value="<?= $doctor['doctor_id'] ?>" <?php echo $doctor['doctor_id'] == $appointmentInfo['doctor_id'] ? 'selected' : '' ?>><?= $doctor['name'] ?></option>
                <?php endforeach; ?>
            </select>
            <select name="status">
                <option value="Pending" <?php echo $appointmentInfo['status'] == "Pending" ? 'selected' : '' ?>>Pending</option>
                <option value="Confirmed" <?php echo $appointmentInfo['status'] == "Confirmed" ? 'selected' : '' ?>>Confirmed</option>
                <option value="Completed" <?php echo $appointmentInfo['status'] == "Completed" ? 'selected' : '' ?>>Completed</option>
                <option value="Canceled" <?php echo $appointmentInfo['status'] == "Canceled" ? 'selected' : '' ?>>Canceled</option>
                <option value="Rescheduled" <?php echo $appointmentInfo['status'] == "Rescheduled" ? 'selected' : '' ?>>Rescheduled</option>
                <option value="No show" <?php echo $appointmentInfo['status'] == "No show" ? 'selected' : '' ?>>No show</option>
            </select>
            <input type="date" name="date" value="<?= $date ?>">
            <input type="time" name="time" value="<?= $time ?>">
            <button type="submit">Edit appointment</button>
        </form>
    </div>
</main>




<?php include_once __DIR__ . "/includes/footer.php" ?>
