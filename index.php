<?php include('partials-front/menu.php');?>

<head>
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
    <!-- Navbar Section Ends Here -->
 
   

    <!-- fOOD sEARCH Section Starts Here -->
    <body>
    <div class="container">
 
  <div id="myCarousel" class="carousel slide " data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="images/c3.png" alt="Los Angeles" style="width:100%;">
      </div>

      <div class="item">
        <img src="images/c1.png" alt="Chicago" style="width:100%;">
      </div>
    
      <div class="item">
        <img src="images/c2.png" alt="New york" style="width:100%;">
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>


    
   
        
    <section class="food-search text-center" >
        <div class="container" style="width:100%;">
            
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

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
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                ?>
                 <script>
                    setTimeout(function(){
                        window.location.href = 'index.php'
                    },3000)
                </script>  
                  <?php
                unset($_SESSION['login']);
            }
    ?>
   

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                    $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";

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
                                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name;?>" alt="<?php echo $title;?>" class="img-responsive">

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

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>


            <?php

                    //getting food from db which are featured and active
                    $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";
                    $res2 = mysqli_query($conn,$sql2);
                    $count2 = mysqli_num_rows($res2);
                    if($count2>0)
                    {
                        while($row=mysqli_fetch_assoc($res2))
                        {
                            $id=$row['id'];
                            $title=$row['title'];
                            $price=$row['price'];
                            $description=$row['description'];
                            $image_name=$row['image_name'];
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
                        echo "<div class='fail'>Food not available!</div>";
                    }
            ?>

           

          
           

            

            

            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- social Section Starts Here -->
   <?php include('partials-front/footer.php')?>
    <!-- footer Section Ends Here -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>