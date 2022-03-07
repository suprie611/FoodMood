<?php

//setting up connection from db as menu page is not included

include("../config/constants.php");

//getting the id

if(isset($_GET['id']))
{

$id = $_GET['id'];
}

else
{
    header('location:'.SITEURL.'admin/manage-admin.php');
    die();
}


//delete query

$sql="DELETE FROM tbl_admin WHERE id=$id";

//executing the query

$res=mysqli_query($conn,$sql);


if($res==TRUE)
{
    //session message

    $_SESSION['delete']= "<div class='success'>Admin Deleted Successfully</div>";
    header("location:".SITEURL.'admin/manage-admin.php');
}
else
{
    $_SESSION['delete']= "<div class='fail'>Admin Not Deleted! Try Again </div>";
    header("location:".SITEURL.'admin/manage-admin.php');
}


?>