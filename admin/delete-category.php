

<?php

include("../config/constants.php");

    //check weather the id and image_name value is set or not

    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //set the value and delete

        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //remove physical img file if available

        if($image_name!="")
        {
            //img available so remove it

            $path = "../images/category/".$image_name;

            //remove img

            $remove = unlink($path);

            //if fail to remove img add error message and stop the process
            if($remove==FALSE)
            {
                //set the session msg 
                $_SESSION['remove'] = "<div class='fail'>Failed to remove category image.</div>";
                //redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
                //stop the process

                die();

            }
        }

        //delete data from db
        //sql query to delete data from db

        $sql = "DELETE FROM tbl_category WHERE id=$id";

        //execute the query
        $res = mysqli_query($conn,$sql);

        if($res== TRUE)
        {
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            $_SESSION['delete'] = "<div class='fail'>Category Not Deleted! Try Again.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }


        //redirect to manage category page with message
    }
    else
    {
        //redirect to manage category page

        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>