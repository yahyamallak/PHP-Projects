
<?php include_once __DIR__ . "/includes/header.php" ?>

<?php include_once __DIR__ . "/includes/sidebar.php" ?>


<main class="body">
    <h3>Patients</h3>
    <div class="patients-add">
        <button id="add-patient-btn"><i class="fa-solid fa-user-plus"></i> Add patient</button>
        <div class="add-patient-popup">
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
                <button type="submit"><i class="fa-solid fa-user-plus"></i> Add patient</button>
            </form>
        </div>
        <div class="search-patient">
            <form action="" method="GET">
                <input type="text" name="search" placeholder="Search patient...">
                <button>
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
    </div>
    <div class="patients-table">
        <table>
            <thead>
                <?php  

                $caretId = $caretName = $caretDisease = $caretDateOfBirth = $caretGender = $caretEmail = $caretCreatedAt = 'fa-caret-down';
                
                if(array_key_exists("id", $sorting)) {
                    $caretId = $sorting["id"] == 'asc' ? 'fa-caret-up': 'fa-caret-down';
                }

                if(array_key_exists("name", $sorting)) {
                    $caretName = $sorting["name"] == 'asc' ? 'fa-caret-up': 'fa-caret-down';
                }

                if(array_key_exists("disease", $sorting)) {
                    $caretDisease = $sorting["disease"] == 'asc' ? 'fa-caret-up': 'fa-caret-down';
                }

                if(array_key_exists("date_of_birth", $sorting)) {
                    $caretDateOfBirth = $sorting["date_of_birth"] == 'asc' ? 'fa-caret-up': 'fa-caret-down';
                }

                if(array_key_exists("gender", $sorting)) {
                    $caretGender = $sorting["gender"] == 'asc' ? 'fa-caret-up': 'fa-caret-down';
                }

                if(array_key_exists("email", $sorting)) {
                    $caretEmail = $sorting["email"] == 'asc' ? 'fa-caret-up': 'fa-caret-down';
                }

                if(array_key_exists("created_at", $sorting)) {
                    $caretCreatedAt = $sorting["created_at"] == 'asc' ? 'fa-caret-up': 'fa-caret-down';
                }
                
                ?>

                <tr>
                    <th data-sort="1"><span>ID</span><i class="fa-solid <?= $caretId ?>"></i></th>
                    <th data-sort="2"><span>Name</span><i class="fa-solid <?= $caretName ?>"></i></th>
                    <th data-sort="3"><span>Disease</span><i class="fa-solid <?= $caretDisease ?>"></i></th>
                    <th data-sort="4"><span>Date of birth</span><i class="fa-solid <?= $caretDateOfBirth ?>"></i></th>
                    <th data-sort="5"><span>Gender</span><i class="fa-solid <?= $caretGender ?>"></i></th>
                    <th><span>Phone</span></th>
                    <th data-sort="6"><span>Email</span><i class="fa-solid <?= $caretEmail ?>"></i></th>
                    <th><span>Address</span></th>
                    <th data-sort="7"><span>Created at</span><i class="fa-solid <?= $caretCreatedAt ?>"></i></th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if(!empty($patients)): ?>
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
                        <button class="delete-patient" data-id="<?= $patient["patient_id"]?>">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                        <div class="delete-patient-popup delete-patient-popup-<?= $patient["patient_id"]?>">
                            <h3>Are you sure you want to delete this patient?</h3>
                            <form action="/patients/delete/<?= $patient["patient_id"]?>" method="post">
                                <button type="button" class="cancel-delete-patient">Cancel</button>
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
    <div class="pagination">
        <ul>
            <?php foreach($pagination as $link) {
                echo $link;
            } ?>
        </ul>
    </div>
</main>




<?php include_once __DIR__ . "/includes/footer.php" ?>
