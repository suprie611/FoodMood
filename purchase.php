<?php
    include('config/constants.php');
    session_start();
    

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    if(isset($_POST['purchase']))
    {
        $query1 = "INSERT INTO `order_manager`(`full_name`, `phone`, `email`, `address`, `pay_mode`) VALUES ('$_POST['full_name']','$_POST['contact']','$_POST['email']','$_POST['address']','$_POST['pay_mode']')";
        if(mysqli_query($conn,$query1))
        {
            $order_id = mysqli_insert_id($conn);
            $query2 = "INSERT INTO `user_orders`(`order_id`, `item_name`, `price`, `qty`) VALUES (?,?,?,?)";
            $stmt = mysqli_prepare($conn,$query2);
            if($stmt)
            {
                mysqli_stmt_bind_param($stmt,"isii",$order_id,$item_name,$price,$qty);
                foreach($_SESSION['cart'] as $key => $values)
                {
                    $item_name=$values['title'];

                    $price = $values['price'];
                    $qty = $values['quantity'];
                    mysqli_stmt_execute($stmt);
                }
                unset($_SESSION['cart']);
                echo"<script>
                    alert('placed');
                    window.location.href='index.php';
                </script>";

            }
            else
            {
                echo"<script>
                    window.location.href='mycart.php';
                </script> ";
            }
        }
        else
        {
            echo"<script>
                    window.location.href='mycart.php';
                </script> ";

        }

        
    }
}    
?>