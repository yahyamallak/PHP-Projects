
<?php include_once __DIR__ . "/includes/header.php" ?>

<?php include_once __DIR__ . "/includes/sidebar.php" ?>


<main class="body">
    <h3>Edit Patient #<?= $id ?> :</h3>
    <div class="edit-patient">
        <form action="" method="post">
            <input type="text" name="name" placeholder="Name of patient..." value="<?= $patientInfo["name"] ?>">
            <input type="text" name="disease" placeholder="Disease of patient..." value="<?= $patientInfo["disease"] ?>">
            <input type="date" name="date_of_birth" placeholder="Date of birth of patient..." value="<?= $patientInfo["date_of_birth"] ?>">
            <select name="gender">
                <option value="Male" <?php echo $patientInfo["gender"] == 'Male' ? 'selected': ''; ?>>Male</option>
                <option value="Female" <?php echo $patientInfo["gender"] == 'Female' ? 'selected': ''; ?>>Female</option>
                <option value="Other" <?php echo $patientInfo["gender"] == 'Other' ? 'selected': ''; ?>>Other</option>
            </select>
            <input type="phone" name="phone" placeholder="Phone of patient..." value="<?= $patientInfo["phone"] ?>">
            <input type="email" name="email" placeholder="Email of patient..." value="<?= $patientInfo["email"] ?>">
            <textarea name="address" placeholder="Address of patient..."><?= $patientInfo["address"] ?></textarea>
            <button type="submit">Edit patient</button>
        </form>
    </div>
</main>




<?php include_once __DIR__ . "/includes/footer.php" ?>
