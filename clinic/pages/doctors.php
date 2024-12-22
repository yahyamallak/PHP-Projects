
<?php include_once __DIR__ . "/includes/header.php" ?>

<?php include_once __DIR__ . "/includes/sidebar.php" ?>


<main class="body">
    <h3>Doctors</h3>
    <div class="doctors-add">
        <button id="add-doctor-btn"><i class="fa-solid fa-user-plus"></i> Add doctor</button>
        <div class="add-doctor-popup">
            <form action="" method="post">
                <input type="text" name="name" placeholder="Name of doctor...">
                <input type="text" name="specialization" placeholder="Specialization of doctor...">
                <input type="date" name="date_of_birth" placeholder="Date of birth of doctor...">
                <select name="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
                <input type="phone" name="phone" placeholder="Phone of doctor...">
                <input type="email" name="email" placeholder="Email of doctor...">
                <textarea name="address" placeholder="Address of doctor..."></textarea>
                <button type="submit"><i class="fa-solid fa-user-plus"></i> Add doctor</button>
            </form>
        </div>
        <div class="search-doctor">
            <form action="" method="GET">
                <input type="text" name="search" placeholder="Search doctor...">
                <button>
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
    </div>
    <div class="doctors-table">
        <table>
            <thead>
            <?php  

                $caretId = $caretName = $caretSpecialization = $caretDateOfBirth = $caretGender = $caretEmail = $caretCreatedAt = 'fa-caret-down';

                if(array_key_exists("id", $sorting)) {
                    $caretId = $sorting["id"] == 'asc' ? 'fa-caret-up': 'fa-caret-down';
                }

                if(array_key_exists("name", $sorting)) {
                    $caretName = $sorting["name"] == 'asc' ? 'fa-caret-up': 'fa-caret-down';
                }

                if(array_key_exists("specialization", $sorting)) {
                    $caretSpecialization = $sorting["specialization"] == 'asc' ? 'fa-caret-up': 'fa-caret-down';
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
                    <th data-sort="3"><span>Specialization</span><i class="fa-solid <?= $caretSpecialization ?>"></i></th>
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
            <?php if(!empty($doctors)): ?>
                <?php foreach($doctors as $doctor): ?>
                <tr>
                    <td><?= $doctor["doctor_id"]?></td>
                    <td><?= $doctor["name"]?></td>
                    <td><?= $doctor["specialization"]?></td>
                    <td><?= $doctor["date_of_birth"]?></td>
                    <td><?= $doctor["gender"]?></td>
                    <td><?= $doctor["phone"]?></td>
                    <td><?= $doctor["email"]?></td>
                    <td><?= $doctor["address"]?></td>
                    <td><?= $doctor["created_at"]?></td>
                    <td>
                        <a href="/doctors/edit/<?= $doctor["doctor_id"]?>">
                           <button>
                               <i class="fa-solid fa-pen-to-square"></i>
                           </button> 
                        </a>

                        <button class="delete-doctor" data-id="<?= $doctor["doctor_id"] ?>">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                        <div class="delete-doctor-popup delete-doctor-popup-<?= $doctor["doctor_id"] ?>">
                            <h3>Are you sure you want to delete this doctor?</h3>
                            <form action="/doctors/delete/<?= $doctor["doctor_id"]?>" method="post">
                                <button type="button" class="cancel-delete-doctor">Cancel</button>
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
