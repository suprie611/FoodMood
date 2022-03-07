<?php include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

        <?php

            if(isset($_SESSION['addi']))
            {
                echo $_SESSION['addi'];
                ?>
                 <script>
                    setTimeout(function(){
                        window.location.href = 'add-category.php'
                    },3000)
                </script>  
                  <?php
                unset($_SESSION['addi']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                ?>
                 <script>
                    setTimeout(function(){
                        window.location.href = 'add-category.php'
                    },3000)
                </script>  
                  <?php
                unset($_SESSION['upload']);
            }


           
        ?>
        <br>
        <br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">

                <tr>
                    <td>Title:  </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image" >
                    </td>
                </tr>

                <tr>
                    <td>Featured:  </td>
                    <td>
                        <input type="radio" name="featured" value="Yes" required>Yes
                        <input type="radio" name="featured" value="No" required>No
                    </td>
                </tr>

                <tr>
                    <td>Active:  </td>
                    <td>
                        <input type="radio" name="active" value="Yes" required>Yes
                        <input type="radio" name="active" value="No" required>No
                    </td>
                </tr>

                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Add Category" class="btn-secondary"></td>
                </tr>

            </table>
        </form>

      
    </div>
</div>




<?php include('partials/footer.php');
?>

<?php

if(isset($_POST['submit']))
{
    $title = mysqli_real_escape_string($conn,$_POST['title']);

   

   if(isset($_POST['featured']))
   {
       $featured = mysqli_real_escape_string($conn,$_POST['featured']);
   }
   else
   {
       $featured = "No";
   }
  
   if(isset($_POST['active']))
   {
       $active = mysqli_real_escape_string($conn,$_POST['active']);
   }
   else
   {
       $active = "No";
   }


//    //check image is selected or not and set value for image name accordingly
//    print_r($_FILES['image']);  //gives the information of selected img

//    die(); //break code here

   if(isset($_FILES['image']['name']))
   {
       //upload the image
       //to uplaod img we need img name , source path and destination path
       $image_name = $_FILES['image']['name'];

       //upload image only if img is selected
       if($image_name!="")
       {


            //auto rename our image
            //get extension of our image(jpg,png,gif,etc) e.g. "special.food1.jpg"
            $ext = end(explode('.',$image_name));

            //rename the image

            $image_name = "Food_Category_".rand(000,999).'.'.$ext; // e.g. Food_Category_879.jpg


            

            $source_path = $_FILES['image']['tmp_name'];

            $destination_path ="../images/category/".$image_name;

            //upload img

            $upload = move_uploaded_file($source_path,$destination_path);
            //check whether image is uploaded or not
            //and if img is not uploaded then we will stop the process and redirect with error msg

            if($upload == FALSE)
            {
                $_SESSION['upload'] = "<div class='fail'>failed to upload image</div>";
                header('location:'.SITEURL.'admin/add-category.php');
                //stop the process
                die();
            }
        }


    }
   else
   {
       //don't upload image
       $image_name="";
   }
  

  

  $sql = "INSERT INTO tbl_category SET 
        title = '$title',
        image_name = '$image_name',
        featured = '$featured',
        active = '$active'
        ";

  

  $res = mysqli_query($conn, $sql);

  if($res==TRUE)
  {
      $_SESSION['addi'] = "<div class='success'> Category Added Successfully</div>";
      header('location:'.SITEURL.'admin/manage-category.php');
  }
  else
  {
    $_SESSION['addi'] = "<div class='fail'> Category Not Added ! Try Again.</div>";
    header('location:'.SITEURL.'admin/add-category.php');
  }





  
}

?>


