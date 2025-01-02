
<?php include_once __DIR__ . "/includes/header.php" ?>



<main>
    <div class="search">
        <input id="search-doctors" type="search" placeholder="Search doctor...">
        <select id="specializations">
            <option>Choose specialization</option>
            <?php foreach($specializations as $specialization): ?>
            <option><?= $specialization ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="doctors">
        <?php foreach($doctors as $doctor): ?>
        <div class="doctor">
            <div class="title">
                <h4><?= $doctor["name"] ?> -  <em>( <?= $doctor["specialization"] ?> )</em></h4>
                <h5>Email : <?= $doctor["email"] ?></h5>
                <h5>Phone : <?= $doctor["phone"] ?></h5>
            </div>
            <button class="book-doctor-btn" data-btn="<?= $doctor["doctor_id"] ?>">Book</button>
            <hr>
            <div class="book-doctor book-doctor-<?= $doctor["doctor_id"] ?>">
                <form action="/bookDoctor" method="post">
                    <input type="hidden" value="<?= $doctor["doctor_id"] ?>">
                    <input type="date" name="date">
                    <input type="time" name="time">
                    <button type="submit">Book</button>
                </form>
            </div>
        </div>
        <?php endforeach ?>
    </div>
</main>




<?php include_once __DIR__ . "/includes/footer.php" ?>
