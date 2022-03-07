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
            
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                    $sql = "SELECT * FROM tbl_food WHERE active='Yes'";
                    $res = mysqli_query($conn,$sql);
                    $count = mysqli_num_rows($res);
                    if($count>0)
                    {
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id = $row['id'];
                            $title = $row['title'];
                            $description = $row['description'];
                            $price = $row['price'];
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
                                                      href="<?php echo SITEURL;?>manage-cart.php?id=<?php echo $id;?>&title=<?php echo $title;?>&price=<?php echo $price;?>" 
                                                      <?php
                                                  }  
                                                  else
                                                  {
                                                      ?>
                                                       href="<?php echo SITEURL;?>login.php" 
                                                      <?php
                                                  }
                                        ?>
                                         class="btn btn-primary">Add to Cart</a>
                                    </div>
                                </div>

                            <?php
                        }

                    }
                    else
                    {
                        echo "<div class='fail'>Food not found!</div>";
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