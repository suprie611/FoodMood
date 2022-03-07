<?php include("../config/constants.php"); 


    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name!="")
        {
            $path = "../images/food/".$image_name;

            //remove img

            $remove = unlink($path);

            if($remove==FALSE)
            {
                $_SESSION['remove'] = "<div class='fail'>Failed to remove image!</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                die();
            }


        }

        $sql = "DELETE FROM tbl_food WHERE id=$id ";
        $res = mysqli_query($conn,$sql);
        if($res==FALSE)
        {
            $_SESSION['delete']="<div class='fail'>Failed to delete food! Try Again.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');

        }
        else
        {
            $_SESSION['delete']="<div class='success'>Food deleted successfully!</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }

    }
    else
    {
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>
