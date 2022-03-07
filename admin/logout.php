<?php
    include('../config/constants.php');

    session_destroy();    //unsets $_SESSION['user']

    $_SESSION['logout'] = "<div class='success text-center'>Logged Out</div>";
    
   
    header('location:'.SITEURL.'admin/login.php');
?>