<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br>
        <br>

        <?php
              if(isset($_SESSION['upload']))
              {
                  echo $_SESSION['upload'];
                  ?>
                   <script>
                      setTimeout(function(){
                          window.location.href = 'add-food.php'
                      },3000)
                  </script>  
                    <?php
                  unset($_SESSION['upload']);
              }


              if(isset($_SESSION['add']))
              {
                  echo $_SESSION['add'];
                  ?>
                   <script>
                      setTimeout(function(){
                          window.location.href = 'add-food.php'
                      },3000)
                  </script>  
                    <?php
                  unset($_SESSION['add']);
              }
        ?>

        <br>
        <br>
        <form action="" method="POST" enctype="multipart/form-data">

                <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td><input type="text" name="title" placeholder="enter food name"></td>
                    </tr>
                    <tr>
                        <td>Description:</td>
                        <td><textarea name="description" cols="30" rows="5" placeholder="food description"></textarea></td>
                    </tr>
                    <tr>
                        <td>Price:</td>
                        <td><input type="number"  name="price" ></td>
                    </tr>
                    <tr>
                        <td>Select Image:</td>
                        <td><input type="file" name="image"></td>
                    </tr>
                    <tr>
                        <td>Category:</td>
                        <td><select name="category">

                                <?php
                                    //create php code to display categories from db
                                    //1. create sql to get all active categories from db
                                    $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                    $res=mysqli_query($conn,$sql);

                                    //count the rows to check whether we have categories or not
                                    $count = mysqli_num_rows($res);

                                    //if count greater then zero then we have active categories in db else we do not have category
                                    if($count>0)
                                    {
                                        //we have category
                                        ?>
                                        
                                        <?php
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            //get the details of categories
                                            $id = $row['id'];
                                            $title = $row['title'];
                                            ?>
                                            
                                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                            <?php
                                        }

                                    }
                                    else
                                    {
                                        //we do not have category
                                        ?>
                                        <option value="0">No Category Found</option>
                                        <?php
                                    }
                                
                                ?>
                                
                                
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Featured:</td>
                        <td><input type="radio" name="featured" value="Yes" required>Yes
                        <input type="radio" name="featured" value="No" required>No</td>
                    </tr>
                    <tr>
                        <td>Active:</td>
                        <td><input type="radio" name="active" value="Yes" required>Yes
                        <input type="radio" name="active" value="No" required>No</td>
                    </tr>

                    <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Add Food" class="btn-secondary"></td>
                </tr>
                </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php');?>

<?php


        if(isset($_POST['submit']))
        {
            $title = mysqli_real_escape_string($conn,$_POST['title']);
            $description = mysqli_real_escape_string($conn,$_POST['description']);
            $price = mysqli_real_escape_string($conn,$_POST['price']);
            $category = mysqli_real_escape_string($conn,$_POST['category']);

        

            
            $featured = mysqli_real_escape_string($conn,$_POST['featured']);
            
              
            
            
            $active = mysqli_real_escape_string($conn,$_POST['active']);
           

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

                    $image_name = "Food_Name_".rand(000,999).'.'.$ext; // e.g. Food_Category_879.jpg


                    

                    $source_path = $_FILES['image']['tmp_name'];

                    $destination_path ="../images/food/".$image_name;

                    //upload img

                    $upload = move_uploaded_file($source_path,$destination_path);
                    //check whether image is uploaded or not
                    //and if img is not uploaded then we will stop the process and redirect with error msg

                    if($upload == FALSE)
                    {
                        $_SESSION['upload'] = "<div class='fail'>failed to upload image</div>";
                        header('location:'.SITEURL.'admin/add-food.php');
                        //stop the process
                        die();
                    }
                }


            }
            else
            {
                $image_name="";  //default value
            }
            //for numerical value no need to pass value inside ''

            $sql2= "INSERT INTO tbl_food SET
                    title= '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
            ";
           
           $res2 = mysqli_query($conn,$sql2);

           if($res2==TRUE)
           {
               $_SESSION['add'] = "<div class='success'>Food added Successfully!</div>";
               header('location:'.SITEURL.'admin/manage-food.php');

           }
           else
           {
            $_SESSION['add'] = "<div class='fail'>Food Not Added! Try Again.</div>";
            header('location:'.SITEURL.'admin/add-food.php');

           }
        
          
                 
        
          
        }
?>