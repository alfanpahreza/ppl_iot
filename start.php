<?php
    session_start();
    $_SESSION['username'] = null;
    $_SESSION['count'] = 0;
    $_SESSION['room'] = 1001;
    header('Location: login.php');
?>