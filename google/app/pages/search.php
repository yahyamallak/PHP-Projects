<?php require_once __DIR__ . "/includes/header.php" ?>



<section class="search-section">
    <header>
        <div class="logo">
            <a href="/">
                <img src="assets/images/google.png" alt="">
            </a>
        </div>
        <div class="search">
            <div class="search-container">
                <form action="search" method="get">
                    <div class="search-bar">
                        <input type="text" name="q" value="<?= $_GET['q'] ?>">
                        <button type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="search-categories">
                <ul>
                    <li>All</li>
                    <li>Images</li>
                    <li>Videos</li>
                    <li>News</li>
                    <li>Maps</li>
                    <li>Web</li>
                    <li>Books</li>
                </ul>
            </div>
        </div>
    </header>
    <main>

    </main>
</section>





<?php require_once __DIR__ . "/includes/footer.php" ?>