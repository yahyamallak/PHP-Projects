<?php include_once __DIR__ . "/includes/header.php" ?>

<?php include_once __DIR__ . "/includes/sidebar.php" ?>


<section class="medical_record">

    <h1>Medical record #<?= $id ?></h1>

    <div class="medical_record_details">
        <div>
            <?php if(!empty($medicalRecordInfo)): ?>
            <div class="details">
                <div class="description">
                    <p><?= $medicalRecordInfo['description'] ?></p>
                </div>
                <div class="diagnosis">
                    <p><?= $medicalRecordInfo['diagnosis'] ?></p>
                </div>
                <div class="notes">
                    <p><?= $medicalRecordInfo['notes'] ?></p>
                </div>
                <div class="created_at">
                    <p><?= $medicalRecordInfo['created_at'] ?></p>
                </div>
            </div>
            <?php else : ?>
            <p>No medical record found.</p>
            <?php endif ?>
        </div>



        <?php if(empty($medicalRecordInfo)): ?>

        <div class="add_medical_record">
            <h3>Add medical record : </h3>
            <form action="" method="post">
                <textarea name="description" placeholder="Description..."></textarea>
                <textarea name="diagnosis" placeholder="Diagnosis..."></textarea>
                <textarea name="notes" placeholder="Notes..."></textarea>
                <button type="submit">Add medical record</button>
            </form>
        </div>

        <?php endif; ?>
    </div>
</section>

<?php include_once __DIR__ . "/includes/footer.php" ?>