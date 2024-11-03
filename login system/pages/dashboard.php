<?php

if($auth->isLoggedIn() == null) {
    header("Location: / ");
    exit;
}

include_once PARTIALS . 'header.inc.php' ?>


<h2>Welcome, Yahya!</h2>
<a href="logout">Logout</a>


<?php include_once PARTIALS . 'footer.inc.php'?>
