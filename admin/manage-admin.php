<html>
<!-- <head>
    <link rel="stylesheet" href="../css/admin.css">
</head> -->

<body>
    


<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br>
        <br>
        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add']; //displaying session message

                ?>
                 <script>
                    setTimeout(function(){
                        window.location.href = 'manage-admin.php'
                    },3000)
                </script>  
                  <?php
               
                unset($_SESSION['add']); //removing session message after refreshing the page
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];

                ?>
                 <script>
                    setTimeout(function(){
                        window.location.href = 'manage-admin.php'
                    },3000)
                </script>  
                  <?php
               
                
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];

                ?>
                 <script>
                    setTimeout(function(){
                        window.location.href = 'manage-admin.php'
                    },3000)
                </script>  
                  <?php
               
                unset($_SESSION['update']);  
            }

            if(isset($_SESSION['change-pwd']))
            {
                echo $_SESSION['change-pwd'];

                ?>
                 <script>
                    setTimeout(function(){
                        window.location.href = 'manage-admin.php'
                    },3000)
                </script>  
                  <?php
                
                unset($_SESSION['change-pwd']);  
            }
            if(isset($_SESSION['password-not-match']))
            {
                echo $_SESSION['password-not-match'];

                ?>
                 <script>
                    setTimeout(function(){
                        window.location.href = 'manage-admin.php'
                    },3000)
                </script>  
                  <?php
                
                unset($_SESSION['password-not-match']);  
            }
            if(isset($_SESSION['user-not-found']))
            {
                echo $_SESSION['user-not-found'];

                ?>
                 <script>
                    setTimeout(function(){
                        window.location.href = 'manage-admin.php'
                    },3000)
                </script>  
                  <?php
                
                unset($_SESSION['user-not-found']);  
            }

           


            

           


          

        ?>
        <br>
        <br>
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br>
        <br>
    <table class="tbl-full">

        <tr>
            <th>S.No</th>
            <th>Full Name </th>
            <th>Username</th>
            <th>Actions</th>
        </tr>

        <?php 

        //Query to get all Admin
        $sql = "SELECT * FROM tbl_admin";
        //Execute the Query
        $res = mysqli_query($conn,$sql);
        //check whether the query is executed or not
        if($res==TRUE)
        {
            //count rows to check whether we have data in db or not
            $count = mysqli_num_rows($res);

            if($count>0)
            {
                $sno = 1;
                while($rows=mysqli_fetch_assoc($res))
                {
                    //using while loop to get all the data from db
                    //while loop will run as long as we have data in our db

                    //get individual data
                    $id=$rows['id'];
                    $full_name=$rows['full_name'];
                    $username=$rows['username'];

                    //display the values in our table
                    ?>

                        <tr>

                        <td><?php echo $sno++; ?></td>
                        <td><?php echo $full_name; ?></td>
                        <td><?php echo $username; ?></td>
                        <td>
                            <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id?>" class="btn-primary">Update Password</a>
                            <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id?>" class="btn-secondary">Update Admin</a>
                            <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id?>" class="btn-danger" >Delete Admin</a>
                        </td>
                        </tr>

                    <?php 
                }
            }
        } 
         



        ?>

       
    </table>
    </div>
</div>
<?php include('partials/footer.php')?>
</body>
</html>