<?php
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    if(isset($_POST['remove_item']))
    {
        foreach($_SESSION['cart'] as $key => $value)
        {
            if($value['title']==$_POST['title'])
            {
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart']=array_values($_SESSION['cart']);  //arrange indexes after removing particular index
            echo"<script>
            
            window.location.href='mycart.php';
            </script>";
            }
        }
    }
}
?>