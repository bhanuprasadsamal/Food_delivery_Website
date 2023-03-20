<?php
    if(!isset($_SESSION['user']))
    {
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access User Panel</div>";
        header('location:'.SITEURL.'user/login.php');
    }
?>