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
                    <input type="hidden" name="type" value="<?= $type ?>">
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
                    <a href="<?php echo "search?q=$query" ?>"><li class="<?php echo empty($type) ? 'active' : '' ?>">All</li></a>
                    <a href="<?php echo "search?q=$query&type=images" ?>"><li class="<?php echo $type == 'images' ? 'active' : '' ?>">Images</li></a>
                    <a href="<?php echo "search?q=$query&type=videos" ?>"><li class="<?php echo $type == 'videos' ? 'active' : '' ?>">Videos</li></a>
                    <a href="<?php echo "search?q=$query&type=news" ?>"><li class="<?php echo $type == 'news' ? 'active' : '' ?>">News</li></a>
                    <a href="<?php echo "search?q=$query&type=maps" ?>"><li class="<?php echo $type == 'maps' ? 'active' : '' ?>">Maps</li></a>
                    <a href="<?php echo "search?q=$query&type=web" ?>"><li class="<?php echo $type == 'web' ? 'active' : '' ?>">Web</li></a>
                    <a href="<?php echo "search?q=$query&type=books" ?>"><li class="<?php echo $type == 'books' ? 'active' : '' ?>">Books</li></a>
                </ul>
            </div>
        </div>
    </header>
    <?php if($type == 'images'): ?>
        <main class="images">
            <div class="imagesFound">
                <p><?= $imagesFound ?> result<?php echo $imagesFound > 1 ? 's': '' ?> found.</p>
            </div>
            <div class="image-results">
                <?php foreach( $images as $image ) : ?>
                <div class="image">
                    <img src="<?= $image['imageUrl']  ?>" alt="<?= $image['alt']  ?>">  
                </div>
                <?php endforeach; ?>
            </div>
        </main>
    <?php else : ?>
    <main class="search-results">
        <div class="search-part">
                <div class="sitesFound">
                    <p><?= $sitesFound ?> result<?php echo $sitesFound > 1 ? 's': '' ?> found.</p>
                </div>
                <div class="results">
                    <?php foreach( $sites as $site ) : ?>
                    <div class="site">
                        <a href="<?= $site['url'] ?>" target="_blank">
                            <h3><?php echo $siteModel->trimField($site['title'], 52) ?></h3>
                        </a>
                        <p class="url"><?= $site['url'] ?></p>
                        <p class="description"><?php echo $siteModel->trimField($site['description'], 225) ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <div class="pagination-container">
        <div class="prev">
            <?php if ($page > 1): ?>
                <a href="?q=<?= $query ?>&type=<?= $type ?>&page=<?php echo $page -1; ?>">
                    <i class="fa-solid fa-chevron-left"></i>
                    <p>Previous</p>
                </a>
            <?php endif; ?> 
        </div>
        <div class="pagination">


            <!-- Start Button -->
            <div class="start">
                <?php if ($page > 1): ?>
                    <a href="?q=<?= $query ?>&type=<?= $type ?>&page=1">
                        <img src="assets/images/start.png" alt="First">
                    </a>
                <?php else: ?>
                    <img src="assets/images/start.png" alt="Disabled First">
                <?php endif; ?>
            </div>

            <!-- Page Numbers -->
            <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                <?php if ($i == $page): ?>
                    <div class="number selected">
                        <img src="assets/images/selected.png">
                        <p><?= $i ?></p>
                    </div>
                <?php else: ?>
                    <div class="number">
                        <a href="?q=<?= $query ?>&type=<?= $type ?>&page=<?= $i ?>">
                            <img src="assets/images/page.png">
                            <p><?= $i ?></p>
                        </a>
                    </div>
                <?php endif; ?>
            <?php endfor; ?>

            <!-- End Button -->
            <div class="end">
                <?php if ($page < $pages): ?>
                    <a href="?q=<?= $query ?>&type=<?= $type ?>&page=<?= $pages ?>">
                        <img src="assets/images/end.png" alt="Last">
                    </a>
                <?php else: ?>
                    <img src="assets/images/end.png" alt="Disabled Last">
                <?php endif; ?>
            </div>

        </div>
        <div class="next">
            <?php if ($page < $pages): ?>
                <a href="?q=<?= $query ?>&type=<?= $type ?>&page=<?php echo $page + 1; ?>">
                    <i class="fa-solid fa-chevron-right"></i>
                    <p>Next</p>
                </a>
            <?php endif; ?> 
        </div>
    </div>

</section>





<?php require_once __DIR__ . "/includes/footer.php" ?>