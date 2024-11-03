<?php

use Yahya\Auth\Session;


Session::destroy();

header("Location: /");
exit;