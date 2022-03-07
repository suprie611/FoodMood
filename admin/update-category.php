<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br>
        <br>

        <?php
             if(isset($_SESSION['update']))
             {
                 echo $_SESSION['update'];
                 ?>
                  <script>
                     setTimeout(function(){
                         window.location.href = 'update-category.php'
                     },3000)
                 </script>  
                   <?php
                 unset($_SESSION['update']);
             }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                ?>
                <script>
                    setTimeout(function(){
                        window.location.href = 'update-category.php'
                    },3000)
                </script>  
                <?php
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove'];
                ?>
                <script>
                    setTimeout(function(){
                        window.location.href = 'update-category.php'
                    },3000)
                </script>  
                <?php
                unset($_SESSION['failed-remove']);
            }


            if(isset($_GET['id']))
            {
                $id= $_GET['id'];
                $sql = "SELECT * FROM tbl_category WHERE id=$id";
                $res= mysqli_query($conn,$sql);

                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    $row = mysqli_fetch_assoc($res);
                    $title= $row['title'];
                    $current_image= $row['image_name'];
                    $featured= $row['featured'];
                    $active= $row['active'];

                }
                else
                {
                    $_SESSION['category-not-found'] = "<div class='fail'>Category Not Found</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }

            }
            else
            {
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        ?>

       <form action="" method="POST" enctype="multipart/form-data">
           <table class="tbl-30">
               <tr>
                   <td>Title:</td>
                   <td>
                       <input type="text" name="title" value="<?php echo $title;?>">
                   </td>
               </tr>

               <tr>
                   <td>Current Image:</td>
                  

                   <td>
                       <?php
                        //check whether img is available or not
                        if($current_image!="")
                        {
                            //display the image
                            ?>

                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="100px">
                            <?php
                        }
                        else
                        {
                            //display the msg
                            echo "<div class='fail'>Image Not Added!</div>";
                        }
                       ?>
                   </td>
               </tr>

               <tr>
                   <td>New Image:</td>
                   <td>
                       <input type="file" name="image" >
                   </td>
               </tr>
               <tr>
                   <td>Featured:</td>
                   <td>
                       <input <?php if($featured =="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                       <input <?php if($featured =="No"){echo "checked";} ?>  type="radio" name="featured" value="No">No
                   </td>
               </tr>
               <tr>
                   <td>Active:</td>
                   <td>
                       <input <?php if($active =="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                       <input <?php if($active =="No"){echo "checked";} ?> type="radio" name="active" value="No">No
                   </td>
               </tr>

               <tr>
                   
                   <td colspan='2'>
                       <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                       <input type="hidden" name="id" value="<?php echo $id;?>" >
                       <input type="submit" name="submit" value="submit" class="btn-secondary">
                   </td>
               </tr>
           </table>
           
        
       </form>
    </div>
</div>
<?php include('partials/footer.php');?>

<?php

        if(isset($_POST['submit']))
        {
            $id =mysqli_real_escape_string($conn,$_POST['id']);
            $title = mysqli_real_escape_string($conn,$_POST['title']);
            $current_image = mysqli_real_escape_string($conn,$_POST['current_image']);
            $featured = mysqli_real_escape_string($conn,$_POST['featured']);
            $active = mysqli_real_escape_string($conn,$_POST['active']);

            //2.updating new image if selected
            //check whether the image is selected or not

            if(isset($_FILES['image']['name']))
            {
                //get img details

                //A. upload new img

                $image_name = $_FILES['image']['name'];
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
                        header('location:'.SITEURL.'admin/update-category.php');
                        //stop the process
                        die();
                    }

                    //B. remove old img
                    if($current_image!="")
                    {
                        $remove_path = "../images/category/".$current_image;

                        $remove = unlink($remove_path);

                        //check whether the image is removed or not
                        //if failed to remove then display msg and stop the process
                        if($remove==FALSE)
                        {
                            $_SESSION['failed-remove'] = "<div class='fail'>failed to remove current image!</div>";
                            header('location:'.SITEURL.'admin/update-category.php');
                            die(); //stop the process
                        }
                    }




                }
                else
                {
                    $image_name=$current_image;
                }

            }
            else
            {
                $image_name = $current_image;
            }

            $sql2 = "UPDATE tbl_category SET
            title='$title',
            image_name = '$image_name',
            featured = '$featured',
            active = '$active'
            WHERE id = $id
            
            ";

            $res2 = mysqli_query($conn,$sql2);

            if($res==TRUE)
            {
                $_SESSION['update'] = "<div class='success'>Category Updated Successfully!</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }
            else
            {
                $_SESSION['update'] = "<div class='fail'>Category Not Updated! Try Again. </div>";
                header('location:'.SITEURL.'admin/update-category.php');
            }

        }
?>