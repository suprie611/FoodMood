<?php
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    if(isset($_POST['mod-quantity']))
    {
        foreach($_SESSION['cart'] as $key => $value)
        {
            if($value['title'] == $_POST['title'])
            {
                $_SESSION['cart'][$key]['Quantity']= $_POST['mod-quantity'];
                echo"<script>
                    window.location.href='mycart.php';
                    </script>";
            }
        }
    }
}
?>