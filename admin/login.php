<?php include('../config/constants.php');?>

<html>

<head>
    <title>Admin-Login</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body style="background-color: pink;">
<div class="login ">
    <h1 class="text-center">Login</h1>
    <br>
    <br>
    <?php

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

        if(isset($_SESSION['logout']))
        {
            echo $_SESSION['logout'];

            ?>
                 <script>
                    setTimeout(function(){
                        window.location.href = 'login.php'
                    },3000)
                </script>  
             <?php
            unset($_SESSION['logout']);
        }

        if(isset($_SESSION['no-login-message']))
        {
            echo $_SESSION['no-login-message'];

            ?>
                 <script>
                    setTimeout(function(){
                        window.location.href = 'login.php'
                    },3000)
                </script>  
            <?php
            unset($_SESSION['no-login-message']);
        }
    ?>
    <br>
<form action="" method="POST" class='text-center'>
    <p >Username</p>
    <br>
    
    <input class="text-center" type="text" name="username" placeholder="enter your username" required>
    <br>
    <br>
    <p >Password</p>
    <br>
    <input class="text-center" type="password" name="password" placeholder="enter your password" required>

    <br>
    <br>
    <input class="btn-primary" type="submit" name="submit"  value="Login">
</form>
</div>
</body>
</html>

<?php
    if(isset($_POST['submit']))
    {

        //$username = $_POST['username'];
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        //$password = $_POST['password'];
        
        $raw_password = $_POST['password'];
        $password = mysqli_real_escape_string($conn, $raw_password);

        $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
        $res = mysqli_query($conn,$sql);

        if($res==TRUE)
        {
            $count = mysqli_num_rows($res);
            
            if($count==1)
            {
                $_SESSION['login'] = "<div class='success'>Login Successfull</div>";
                $_SESSION['user'] = $username;    //check whether user is logged in or not and unsets it

                header('location:'.SITEURL.'admin/');
            }
            else
            {
                $_SESSION['login'] = "<div class='fail text-center'>Incorrect username or password</div>";
                header('location:'.SITEURL.'admin/login.php');
            }
        }
    }

?>