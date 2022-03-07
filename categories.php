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



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>


            <?php
                    $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                    $res = mysqli_query($conn,$sql);

                    $count = mysqli_num_rows($res);

                    if($count>0)
                    {
                        while($row = mysqli_fetch_assoc($res))
                        {

                            $id = $row['id'];
                            $title = $row['title'];
                            $image_name = $row['image_name'];

                            ?>
                                      <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id;?>">
                                        <div class="box-3 float-container">
                                            <?php
                                                //check img is availble or not
                                                if($image_name=="")
                                                {
                                                    echo "<div class='fail'>Image not available</div>";

                                                }
                                                else
                                                {
                                                    ?>
                                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name;?>" alt="<?php echo $title?>" class="img-responsive">

                                                    <?php

                                                }
                                            ?>

                                            <h3 class="float-text text-white"><?php echo $title?></h3>
                                        </div>
                                      </a>

                            <?php

                        }
                    }
                    else
                    {
                        echo "<div class='fail'>Category not found</div>";
                    }
            ?>


           

          
            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <!-- social Section Starts Here -->
    <?php include('partials-front/footer.php')?>
    <!-- footer Section Ends Here -->

</body>
</html>