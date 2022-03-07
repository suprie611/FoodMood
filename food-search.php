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

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php

                    //get the search keyword
                    //$search = $_POST['search'];
                    $search = mysqli_real_escape_string($conn, $_POST['search']);
            ?>
            
            <h2>Foods on Your Search <a href="#" class="text-white"><?php echo $search;?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php 

                //get the search keyword
               
                //sql query to get food based on search keyword

                //$search = burger '; DROP database name;   //sql injection used by hackers ... they can delete whole database
                //"SELECT * FROM tbl_food WHERE title LIKE '%burger'%' OR description LIKE '%burger%'";
                $sql = "SELECT * from tbl_food WHERE title LIKE '%$search%' or description LIKE '%$search%'";
                $res = mysqli_query($conn,$sql);
                $count= mysqli_num_rows($res);

                //check whether food availble or not
                if($count>0)
                {
                    //food available
                    while($row=mysqli_fetch_assoc($res))
                    {
                    $id=$row['id'];
                    $title=$row['title'];
                    $price=$row['price'];
                    $description=$row['description'];
                    $image_name = $row['image_name'];
                    ?>
                     <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                                if($image_name=="")
                                {
                                    echo "<div class='fail'>Image not available!</div>";
                                }
                                else
                                {
                                    ?>
                                     <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name;?>" alt="<?php echo $title;?>" class="img-responsive">

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
                    echo "<div class='fail'>Could not get your search result! Why not try something else.</div>";
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