<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update admin</h1>
        <br>
        <br>
        <?php
 
            //1. get the id of the selected admin

            if(isset($_GET['id']))
            {

            $id = $_GET['id'];
            }
            else
            {
                header('location:'.SITEURL.'admin/manage-admin.php');
                die();
            }

            //2. create sql query to get the details

            $sql= "SELECT * FROM tbl_admin WHERE id=$id";

            //3. execute the query

            $res = mysqli_query($conn, $sql);

            //4. check whether query is executed or not

            if($res== TRUE)
            {
                //check whether the data is available or not

                $count = mysqli_num_rows($res);

                //check whether we have admin or not
                if($count==1)
                {
                //get the details
                //echo "admin available";

                $row = mysqli_fetch_assoc($res);

                $full_name = $row['full_name'];
                $username = $row['username'];
                }
                else
                {
                    //redirecting to manage admin page
    
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
           
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
            <tr>
                <td>Full Name:</td>
                <td><input required type="text" name="full_name"  value="<?php echo $full_name; ?>" placeholder="Enter Your Name"></td>
            </tr>
            <tr>
                <td>Username:</td>
                <td><input  required  type="text" name="username"  value="<?php echo $username; ?>" placeholder="Enter Your Username"></td>
            </tr>

            <br>

            <tr>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <td colspan="2" ><input type="submit" name="submit" value="Update Admin" class="btn-secondary"></td>
            </tr>
            </table>    

        </form>

    </div>
</div>

<?php

if(isset($_POST['submit']))
{
    //button clicked 
    //echo "button clicked";

    //1. get the data from form

    $id = mysqli_real_escape_string($conn,$_POST['id']);
    $full_name = mysqli_real_escape_string($conn,$_POST['full_name']);
    $username = mysqli_real_escape_string($conn,$_POST['username']);
   
    
    
    //2. SQL query to save the data into database
    $sql = "UPDATE tbl_admin SET 
    full_name = '$full_name',
    username = '$username'
    WHERE id=$id
    ";

    //3. executing the query and saving data into database

    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    //4. check whether the (query is executed) data is inserted or not and display appropriate message

    if($res==TRUE)
    {
        //data inserted
       //echo "Data Inserted";
       //Create a session variable to display message
       $_SESSION['add'] = "<div class='success'>Admin updated Successfully</div>";
       //Redirect page to manage admin
       header("location:".SITEURL.'admin/manage-admin.php');
    }
    else 
    {
        //Failed to insert data
        //echo "Failed to insert data";
        //create a session variable to display message
        $_SESSION['add'] = "<div class='fail'>Failed to update Admin</div>";
        //Redirect page to add admin
        header("location:".SITEURL.'admin/add-admin.php');
    }
   
}    


?>

<?php include('partials/footer.php');?>