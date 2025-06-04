<?php
    session_start();
if (isset($_SESSION['user_login_status'])){    $sta=$_SESSION['user_login_status'];  }
    if (!isset($sta) AND $sta != 1) {
        header("location: login.php");
        exit;
        }
?>