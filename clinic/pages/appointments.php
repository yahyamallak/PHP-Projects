
<?php include_once __DIR__ . "/includes/header.php" ?>

<?php include_once __DIR__ . "/includes/sidebar.php" ?>


<main class="body">
    <h3>Appointments</h3>
    <div class="appointments-add">
        <button id="add-appointment-btn">Add appointment</button>
        <div class="add-appointment-popup">
            <form action="" method="post">
                <select name="patient">
                    <?php foreach($patients as $patient): ?>
                    <option value="<?= $patient['patient_id'] ?>"><?= $patient['name'] ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="doctor">
                    <?php foreach($doctors as $doctor): ?>
                    <option value="<?= $doctor['doctor_id'] ?>"><?= $doctor['name'] ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="status">
                    <option value="Pending">Pending</option>
                    <option value="Confirmed">Confirmed</option>
                    <option value="Completed">Completed</option>
                    <option value="Canceled">Canceled</option>
                    <option value="Rescheduled">Rescheduled</option>
                    <option value="No show">No show</option>
                </select>
                <input type="date" name="date">
                <input type="time" name="time">
                <button type="submit">Add appointment</button>
            </form>
        </div>
        <div class="search-appointment">
            <form action="" method="GET">
                <input type="text" name="search" placeholder="Search appointment...">
                <button>
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
    </div>
    <div class="appointments-table">
        <table>
            <thead>
                <tr>
                    <th><span>ID</span><i class="fa-solid fa-caret-up"></i></th>
                    <th><span>Patient</span><i class="fa-solid fa-caret-up"></i></th>
                    <th><span>Doctor</span><i class="fa-solid fa-caret-up"></i></th>
                    <th><span>Appointment date</span><i class="fa-solid fa-caret-up"></i></th>
                    <th><span>Status</span><i class="fa-solid fa-caret-up"></i></th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($appointments as $appointment): ?>
                <tr>
                    <td><?= $appointment["id"]?></td>
                    <td><?= $appointment["patient"]?></td>
                    <td><?= $appointment["doctor"]?></td>
                    <td><?= $appointment["appointment_date"]?></td>
                    <td><?= $appointment["status"]?></td>
                    <td>
                        <a href="/patients/edit/<?= $patient["patient_id"]?>">
                           <button>
                               <i class="fa-solid fa-pen-to-square"></i>
                           </button> 
                        </a>
                        <button class="delete-appointment" data-id="<?= $patient["patient_id"]?>">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                        <div class="delete-appointment-popup delete-appointment-popup-<?= $patient["patient_id"]?>">
                            <h3>Are you sure you want to delete this appointment?</h3>
                            <form action="/patients/delete/<?= $patient["patient_id"]?>" method="post">
                                <button type="button" class="cancel-delete-appointment">Cancel</button>
                                <button class="delete" type="submit">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <div class="pagination">
        <ul>
            <?php foreach($pagination as $link) {
                echo $link;
            } ?>
        </ul>
    </div>
</main>




<?php include_once __DIR__ . "/includes/footer.php" ?>
