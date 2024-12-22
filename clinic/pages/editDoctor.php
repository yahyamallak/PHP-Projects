
<?php include_once __DIR__ . "/includes/header.php" ?>

<?php include_once __DIR__ . "/includes/sidebar.php" ?>


<main class="body">
    <h3>Edit Doctor #<?= $id ?> :</h3>
    <div class="edit-doctor">
        <form action="/doctors/edit/<?= $id ?>" method="post">
            <input type="text" name="name" placeholder="Name of doctor..." value="<?= $doctorInfo['name'] ?>">
            <input type="text" name="specialization" placeholder="Specialization of doctor..." value="<?= $doctorInfo['specialization'] ?>">
            <input type="date" name="date_of_birth" placeholder="Date of birth of doctor..." value="<?= $doctorInfo['date_of_birth'] ?>">
            <select name="gender">
                <option value="Male" <?php echo $doctorInfo['gender'] == 'Male' ? 'selected' : '' ?> >Male</option>
                <option value="Female" <?php echo $doctorInfo['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                <option value="Other" <?php echo $doctorInfo['gender'] == 'Other' ? 'selected' : '' ?>>Other</option>
            </select>
            <input type="phone" name="phone" placeholder="Phone of doctor..." value="<?= $doctorInfo['phone'] ?>">
            <input type="email" name="email" placeholder="Email of doctor..." value="<?= $doctorInfo['email'] ?>">
            <textarea name="address" placeholder="Address of doctor..."><?= $doctorInfo['address'] ?></textarea>
            <button type="submit">Edit doctor</button>
        </form>
    </div>
</main>




<?php include_once __DIR__ . "/includes/footer.php" ?>
