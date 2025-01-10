
<?php include_once __DIR__ . "/includes/header.php" ?>

<?php include_once __DIR__ . "/includes/sidebar.php" ?>


<main class="body">
    <h3>Medical records</h3>
    <div class="medical-records-add">
        <div class="search-medical-record">
            <form action="" method="GET">
                <input type="text" name="search" placeholder="Search medical record...">
                <button>
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
    </div>
    <div class="medical-records-table">
        <table>
            <thead>
                <tr>
                    <th><span>ID</span></th>
                    <th><span>Appointment</span></th>
                    <th><span>Description</span></th>
                    <th><span>Diagnosis</span></th>
                    <th><span>Notes</span></th>
                    <th><span>Created at</span></th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($medicalRecords)): ?>
                    <?php foreach($medicalRecords as $medicalRecord): ?>
                    <tr>
                        <td><?= $medicalRecord["id"]?></td>
                        <td><?= $medicalRecord["appointment_id"]?></td>
                        <td><?= $medicalRecord["description"]?></td>
                        <td><?= $medicalRecord["diagnosis"]?></td>
                        <td><?= $medicalRecord["notes"]?></td>
                        <td><?= $medicalRecord["created_at"]?></td>
                        <td>
                            <a href="/medical_records/edit/<?= $medicalRecord["id"]?>">
                            <button>
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button> 
                            </a>
                            <button class="delete-medical-record" data-id="<?= $medicalRecord["id"] ?>">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            <div class="delete-medical-record-popup delete-medical-record-popup-<?= $medicalRecord["id"] ?>">
                                <h3>Are you sure you want to delete this medical record?</h3>
                                <form action="/patients/delete/<?= $medicalRecord["id"] ?>" method="post">
                                    <button type="button" class="cancel-delete-medical-record">Cancel</button>
                                    <button class="delete" type="submit">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr>
                        <td style="text-align: center;" colspan="10">No results found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>




<?php include_once __DIR__ . "/includes/footer.php" ?>
