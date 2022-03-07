<?php include("partials/menu.php");?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Password</h1>
        <br>
        <br>
        <?php
            if(isset($_GET['id']))
            {
            $id = $_GET['id'];
            }
            else
            {
                header('location:'.SITEURL.'admin/manage-admin.php');
                die();
            }

           

        ?>
    <form action="" method="POST">

        <table class="tbl-30">
            <tr>
                <td>Current Password:</td>
               <td> <input name="cur_password" required type="password" placeholder="Current Password"></td>
            </tr>
            <tr>
                <td>New Password:</td>
                <td> <input name="new_password" required type="password" placeholder="New Password"></td>
            </tr>
            <tr>
                <td>Confirm Password:</td>
                <td> <input name="confirm_password" required type="password" placeholder="Confirm Password"></td>
            </tr>
            
            <tr >
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                
                <td colspan="2"><input type="submit" name="submit" value="Update Password" class="btn-secondary"></td>
            </tr>
        </table>
</form>

    </div>
</div>

<?php

    if(isset($_POST['submit']))
    {
        $id = mysqli_real_escape_string($conn,$_POST['id']);
        $cur_password = mysqli_real_escape_string($conn,$_POST['cur_password']);
        $new_password = mysqli_real_escape_string($conn,$_POST['new_password']);
        $confirm_password = mysqli_real_escape_string($conn,$_POST['confirm_password']);

        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$cur_password'";

        $res = mysqli_query($conn, $sql);

        if($res==TRUE)
        {

        $count = mysqli_num_rows($res);

        if($count==1)
        {
            if($new_password==$confirm_password)
            {
                $sql2 = "UPDATE tbl_admin 
                SET password= '$new_password'
                WHERE id = $id";

                $res2 = mysqli_query($conn, $sql2);

                if($res2==TRUE)
                {
                    $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');

                }
                else
                {
                    $_SESSION['change-pwd'] = "<div class='fail'>failed to change password</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }

            }
            else
            {
                $_SESSION['password-not-match'] = "<div class='fail'>Password Did Not Match</div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
        else
        {
            $_SESSION['user-not-found'] = "<div class='fail'>User not found</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        }

    }

?>

<?php include("partials/footer.php");?>
