<?php include('config/constants.php');
      include('login-check-customer.php'); ?>
<?php
    if(isset($_SESSION['user']))
    {
        $username = $_SESSION['user'];
    }
?>      
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/logo.jpg" alt="Restaurant Logo" class="img-responsive " id="temp">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL;?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL;?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL;?>foods.php">Foods</a>
                    </li>
                    <li>
                        <?php
                              if(isset($_SESSION['user']))
                              {
                                  ?>
                                  <a href="<?php echo SITEURL;?>history.php?username=<?php echo $username;?>">History</a>
                                 
                                  <?php
      
                              }
                        ?>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                    <li>
                        <?php
                        if(isset($_SESSION['user']))
                        {
                            ?>
                            <a href="<?php echo SITEURL;?>logout.php">Logout</a>
                           
                            <?php

                        }
                        else
                        {
                            ?>
                            <a href="<?php echo SITEURL;?>login.php">Login/Sign Up</a>
                            <?php
                        }
                        ?>
                        
                    </li>
                    <li>
                        <?php

                            if(isset($_SESSION['user']))
                            {
                                ?>
                                 <a href="#" style="color:black;">User:<?php echo $_SESSION['user'];?></a>
                                <?php
                            }
                        ?>
                    </li>  
                    
                    <li>
                        <?php
                                $count=0;
                                if(isset($_SESSION['cart']))
                                {
                                    $count = count($_SESSION['cart']);
                                }
                        ?>
                        <a href="<?php echo SITEURL;?>mycart.php"><i class="fas fa-shopping-cart fa-lg"></i>(<?php echo $count;?>)</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
 </body>
</html>    