<?php include('config/constants.php');?>

<html>

<head>
    <title>Login</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/style.css">
    
</head>







<body>
<a href="index.php" style="font-size:20px; margin-left:20px; ">Home</a>
    
<h1 class="text-center">Login</h1>
<br>
<br>

<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-login-form/draw2.png" class="img-fluid"
          alt="Sample image" style="width:80%;">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">

      <?php
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                ?>
                <script>
                    setTimeout(function(){
                        window.location.href = 'login.php'
                    },3000)
                </script>  
                <?php
                unset($_SESSION['login']);
            }
            if(isset($_SESSION['signup']))
            {
                echo $_SESSION['signup'];
                ?>
                <script>
                    setTimeout(function(){
                        window.location.href = 'login.php'
                    },3000)
                </script>  
                <?php
                unset($_SESSION['signup']);
            }
    ?>


        <form action="" method="POST">
         

          <!-- Email input -->
          <div class="form-outline mb-4">
             <input  id="form3Example3" class="form-control form-control-lg" type="text" name="username" placeholder="enter your username" required>
            <label class="form-label" for="form3Example3"></label>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
           <input id="form3Example4" class="form-control form-control-lg" type="password" name="password" placeholder="enter your password" required>
            <label class="form-label" for="form3Example4"></label>
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <!-- Checkbox -->
           
            <a href="#!" class="text-body">Forgot password?</a>
          </div>

          <br>
          <br>

          <div class="text-center text-lg-start mt-4 pt-2">
          
              <input class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;" type="submit" name="submit"  value="Login">
              <br>
            
                <a class="small fw-bold mt-2 pt-1 mb-0" href="<?php echo SITEURL?>signup.php">Create new account?</a>
          </div>

        </form>
      </div>
    </div>
  </div>
 
    <!-- Right -->
  </div>
</section>
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

        $sql="SELECT * FROM tbl_customer WHERE username='$username' AND password='$password'";
        $res = mysqli_query($conn,$sql);
        

        if($res==TRUE)
        {
            $count = mysqli_num_rows($res);
            
            if($count==1)
            {
              $_SESSION['user'] = $username;  
              $_SESSION['login'] = "<div class='success text-center'>Login Successful!</div>";
              header('location:'.SITEURL);
            }
            else
            {
                $_SESSION['login'] = "<div class='fail text-center'>Login failed! Incorrect username or password.</div>";
                header('location:'.SITEURL.'login.php');
            }
        }
    }

?>