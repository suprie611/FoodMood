<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br>
        <br>
       

        

        <form action="" method="POST">
        <table class="tbl-30">
            <tr>
                <td>Full Name:</td>
                <td><input required type="text" name="full_name" placeholder="Enter Your Name"></td>
            </tr>
            <tr>
                <td>Username:</td>
                <td><input  required  type="text" name="username" placeholder="Enter Your Username"></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input  required type="password" name="password" placeholder="Enter Your Password"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="submit" value="Add Admin" class="btn-secondary"></td>
            </tr>
        </table>
        </form>

    </div>
</div>
<?php include('partials/footer.php');?>

<?php

    //process the value from form and save it in db

    //check whether the submit button is clicked or not

   
    if(isset($_POST['submit']))
    {
        //button clicked 
        //echo "button clicked";

        //1. get the data from form

        $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn,$_POST['password']); //password encrypted with md5
        
        
        //2. SQL query to save the data into database
        $sql = "INSERT INTO tbl_admin SET 
        full_name = '$full_name',
        username = '$username',
        password = '$password'
        ";

        //3. executing the query and saving data into database

        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //4. check whether the (query is executed) data is inserted or not and display appropriate message

        if($res==TRUE)
        {
            //data inserted
           //echo "Data Inserted";
           //Create a session variable to display message
           $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
           //Redirect page to manage admin
           header("location:".SITEURL.'admin/manage-admin.php');
        }
        else 
        {
            //Failed to insert data
            //echo "Failed to insert data";
            //create a session variable to display message
            $_SESSION['add'] = "<div class='fail'>Failed to Add Admin</div>";
            //Redirect page to add admin
            header("location:".SITEURL.'admin/add-admin.php');
        }
       
    }    

?> 