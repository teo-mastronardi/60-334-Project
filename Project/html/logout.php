<?php

require_once 'login.php';

session_start();

    unset($_SESSION['user_login']);
    unset($_SESSION['user_level']);
    session_destroy();
    echo "<p>You have been signed out. Please click <a href='http://mastr11i.myweb.cs.uwindsor.ca/60334/project/html/index.php'>here</a> to be redirected</p>";
?>
