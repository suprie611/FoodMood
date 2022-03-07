<?php
include('../config/constants.php');

     //authorization -access control
    //check whether the user is logged in or not

    if(!isset($_SESSION['user'])) //if user session is not set

    {
        //user is not logged in
        //Redirect to login page with message

        $_SESSION['no-login-message'] = "<div class='fail text-center'> Please login to access Admin Panel</div>";
        header('location:'.SITEURL.'admin/login.php');
    }

?>