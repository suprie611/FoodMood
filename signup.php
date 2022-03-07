

<?php include('config/constants.php');?>

<html>

<head>
    <title>Sign Up</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/style.css">
    
</head>







<body>
<a href="index.php" style="font-size:20px; margin-left:20px;">Home</a>
<h1 class="text-center">Sign Up</h1>
<br>


<br>

<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-login-form/draw2.svg" class="img-fluid"
          alt="Sample image" style="width:70%;">
      </div>
      <br>
      <br>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">

      <?php
            if(isset($_SESSION['signup']))
            {
                echo $_SESSION['signup'];
                ?>
                <script>
                    setTimeout(function(){
                        window.location.href = 'signup.php'
                    },3000)
                </script>  
                <?php
                unset($_SESSION['signup']);
            }

            if(isset($_SESSION['not-unique']))
            {
                echo $_SESSION['not-unique'];
                ?>
                <script>
                    setTimeout(function(){
                        window.location.href = 'signup.php'
                    },3000)
                </script>  
                <?php
                unset($_SESSION['not-unique']);
            }
    ?>


        <form action="" method="POST">

        <div class="form-outline mb-4">
             <input  id="form3Example3" class="form-control form-control-lg" type="text" name="full_name" placeholder="enter your full name" required>
            <label class="form-label" for="form3Example3"></label>
          </div>
         

          <!-- username input -->
          <div class="form-outline mb-4">
             <input  id="form3Example3" class="form-control form-control-lg" type="text" name="user_name" placeholder="enter your username" required>
            <label class="form-label" for="form3Example3"></label>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
           <input id="form3Example4" class="form-control form-control-lg" type="password" name="password" placeholder="enter your password" required>
            <label class="form-label" for="form3Example4"></label>
          </div>

          

          <br>
          <br>

          <div class="text-center text-lg-start mt-4 pt-2">
          
              <input class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;" type="submit" name="submit"  value="sign up">
              <br>
            
                
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
        $full_name=$_POST['full_name'];
        $username = $_POST['user_name'];
        $password = $_POST['password'];

        $sql0 = "SELECT * FROM tbl_customer WHERE username = '$username' ";
        $res0 = mysqli_query($conn,$sql0);
        $count = mysqli_num_rows($res0);

        if($count==1)
        {
            $_SESSION['not-unique'] = "<div class ='fail text-center'>Username not available! Try something else.</div>";
            header('location:'.SITEURL.'signup.php');
            
        }
        else
        {

        $sql = "INSERT INTO tbl_customer SET
                    full_name='$full_name',
                    username = '$username',
                    password = '$password'
                    ";
        $res= mysqli_query($conn,$sql);
        if($res==TRUE)
        {
            $_SESSION['signup']="<div class='success text-center'>Account Created successfully!</div>";
            header('location:'.SITEURL.'login.php');

        }
        else
        {
            $_SESSION['signup']="<div class='fail text-center'>Failed to create account. Try Again!</div>";
            header('location:'.SITEURL.'signup.php');

        }
        }
    }
?>
