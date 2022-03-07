
<?php include('partials-front/menu.php'); ?>
<?php
        if(isset($_GET['username']))
        {
            $username = $_GET['username'];
        }
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Order History</h1>
        <br>
        <br>
        <table class="tbl-full ">
           
            <?php
                $sql = "SELECT * FROM tbl_order WHERE username = '$username' ";
                $res = mysqli_query($conn,$sql);
                $count = mysqli_num_rows($res);
                $sn=1;
                if($count>0)
                {
                    ?>
                    <tr>
                    <th>S.No</th>
                    <th>Food </th>
                    <th>Price</th>
                    <th>Qty.</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <th>Status</th>
                </tr>
                <?php
                    while($row = mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        $order_date = $row['order_date'];
                        $status =$row['status'];
                        ?>
                        <tr>
                            <td><?php echo $sn++;?></td>
                            <td><?php echo $food;?></td>
                            <td><?php echo $price;?></td>
                            <td><?php echo $qty;?></td>
                            <td><?php echo $total;?></td>
                            <td><?php echo $order_date;?></td>
                            <td><?php echo $status;?></td>
                        </tr>

                        <?php
                    }
                }
                else
                {
                    echo "<tr><td colspan='12' class='error'>No previous Orders! Order now.</td></tr>";
                }
            ?>
        </table>
    </div>
</div>
<?php include('partials-front/footer.php'); ?>

