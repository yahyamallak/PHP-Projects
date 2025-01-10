<?php require_once __DIR__ . "/includes/header.php" ?>




<section class="home">
    <div class="home-container">
        <div class="logo">
            <img src="assets/images/google.png" alt="">
        </div>
        <form id="search-form" action="search" method="get">
            <div class="search-bar">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" name="q">
            </div>
        </form>
        <div class="search-buttons">
            <button type="submit" form="search-form">Google search</button>
            <button>I'm feeling lucky</button>
        </div>
    </div>
</section>







<?php require_once __DIR__ . "/includes/footer.php" ?>