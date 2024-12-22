
<?php include_once __DIR__ . "/includes/header.php" ?>

<?php include_once __DIR__ . "/includes/sidebar.php" ?>


<main class="body">
    <h3>Medical records</h3>
    <div class="medical-records-add">
        <button id="add-medical-record-btn">Add medical record</button>
        <div class="add-medical-record-popup">
            <form action="" method="post">
                <input type="text" name="name" placeholder="Name of patient...">
                <input type="text" name="disease" placeholder="Disease of patient...">
                <input type="date" name="date_of_birth" placeholder="Date of birth of patient...">
                <select name="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
                <input type="phone" name="phone" placeholder="Phone of patient...">
                <input type="email" name="email" placeholder="Email of patient...">
                <textarea name="address" placeholder="Address of patient..."></textarea>
                <button type="submit">Add medical record</button>
            </form>
        </div>
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
                    <th><span>ID</span><i class="fa-solid fa-caret-up"></i></th>
                    <th><span>Name</span><i class="fa-solid fa-caret-up"></i></th>
                    <th><span>Disease</span><i class="fa-solid fa-caret-up"></i></th>
                    <th><span>Date of birth</span><i class="fa-solid fa-caret-up"></i></th>
                    <th><span>Gender</span><i class="fa-solid fa-caret-up"></i></th>
                    <th><span>Phone</span><i class="fa-solid fa-caret-up"></i></th>
                    <th><span>Email</span><i class="fa-solid fa-caret-up"></i></th>
                    <th><span>Address</span><i class="fa-solid fa-caret-up"></i></th>
                    <th><span>Created at</span><i class="fa-solid fa-caret-up"></i></th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($patients as $patient): ?>
                <tr>
                    <td><?= $patient["patient_id"]?></td>
                    <td><?= $patient["name"]?></td>
                    <td><?= $patient["disease"]?></td>
                    <td><?= $patient["date_of_birth"]?></td>
                    <td><?= $patient["gender"]?></td>
                    <td><?= $patient["phone"]?></td>
                    <td><?= $patient["email"]?></td>
                    <td><?= $patient["address"]?></td>
                    <td><?= $patient["created_at"]?></td>
                    <td>
                        <a href="/patients/edit/<?= $patient["patient_id"]?>">
                           <button>
                               <i class="fa-solid fa-pen-to-square"></i>
                           </button> 
                        </a>
                        <button class="delete-medical-record" data-id="<?= $patient["patient_id"]?>">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                        <div class="delete-medical-record-popup delete-medical-record-popup-<?= $patient["patient_id"]?>">
                            <h3>Are you sure you want to delete this medical record?</h3>
                            <form action="/patients/delete/<?= $patient["patient_id"]?>" method="post">
                                <button type="button" class="cancel-delete-medical-record">Cancel</button>
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
