<?php
        session_start();
        


        if(isset($_GET['id']) and isset($_GET['title']) and isset($_GET['price']))
        {
            $id = $_GET['id'];
            $title = $_GET['title'];
            $price = $_GET['price'];
        }

        if(isset($_SESSION['cart']))
        {
            $myitems = array_column($_SESSION['cart'],'title');
            if(in_array($title,$myitems))
            {
                echo "<script> alert('item already added');
                window.location.href='foods.php';
                </script>";
            }
            else{
                $count = count($_SESSION['cart']);
                $_SESSION['cart'][$count] = array('title'=>$title,'price'=>$price,'Quantity'=>1);
                echo "<script> alert('item added');
                window.location.href='foods.php';
                </script>";
            }
           

        }
        else
        {
            $_SESSION['cart'][0]=array('title'=>$title,'price'=>$price,'Quantity'=>1);
            echo "<script> alert('item added');
            window.location.href='foods.php';
            </script>";
            
        }

      
       
?>