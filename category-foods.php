<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <?php include('partials-front/menu.php');?>
    <!-- Navbar Section Ends Here -->
    <?php
        //check whether id is passed or not
        if(isset($_GET['category_id']))
        {
            $category_id = $_GET['category_id'];
            $sql = "SELECT title FROM tbl_category WHERE id=$category_id";
            $res=mysqli_query($conn,$sql);
            $row =mysqli_fetch_assoc($res);
            $category_title=$row['title'];

        }
        else
        {
            header('location:'.SITEURL);
        }
    ?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white"><?php echo $category_title;?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php
                 if(isset($_SESSION['order']))
                 {
                     echo $_SESSION['order'];
                     ?>
                     <script>
                         setTimeout(function(){
                             window.location.href = 'index.php'
                         },3000)
                     </script>  
                     <?php
                     unset($_SESSION['order']);
                 }
            ?>



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
                    //create sql query to get food on selected category
                    $sql2= "SELECT * FROM tbl_food WHERE category_id=$category_id";
                    $res2=mysqli_query($conn,$sql2);
                    $count2 = mysqli_num_rows($res2);
                    if($count2>0)
                    {
                        while($row2=mysqli_fetch_assoc($res2))
                        {
                            $id = $row2['id'];
                            $title=$row2['title'];
                            $price=$row2['price'];
                            $description=$row2['description'];
                            $image_name=$row2['image_name'];
                            ?>
                             <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php

                                            if($image_name=="")
                                            {
                                                echo "<div class='fail'>Image not available.</div>";
                                            }
                                            else
                                            {
                                                ?>
                                                <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" alt="<?php echo $title;?>" class="img-responsive img-curve">
                                                <?php

                                            }
                                    ?>
                                    
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title;?></h4>
                                    <p class="food-price"><?php echo $price;?></p>
                                    <p class="food-detail">
                                    <?php echo $description;?>
                                    </p>
                                    <br>

                                    <a  <?php if(isset($_SESSION['user']))
                                                  {
                                                      ?>
                                                      href="<?php echo SITEURL;?>order.php?id=<?php echo $id;?>" 
                                                      <?php
                                                  }  
                                                  else
                                                  {
                                                      ?>
                                                       href="<?php echo SITEURL;?>login.php" 
                                                      <?php
                                                  }
                                        ?>
                                    class="btn btn-primary">Order Now</a>
                                </div>
                            </div>

                            <?php
                        }
                    }
                    else
                    {
                        echo "<div class='fail'>Food not available!</div>";
                    }
            ?>

           

          
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- social Section Starts Here -->
    <?php include('partials-front/footer.php')?>
    <!-- footer Section Ends Here -->

</body>
</html>