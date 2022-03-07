<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
    <h1>Manage Food</h1>
    <br>
    <br>
    <?php
             if(isset($_SESSION['update']))
             {
                 echo $_SESSION['update'];
                 ?>
                  <script>
                     setTimeout(function(){
                         window.location.href = 'manage-food.php'
                     },3000)
                 </script>  
                   <?php
                 unset($_SESSION['update']);
             }

            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                ?>
                <script>
                    setTimeout(function(){
                        window.location.href = 'manage-food.php'
                    },3000)
                </script>  
                <?php
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                ?>
                <script>
                    setTimeout(function(){
                        window.location.href = 'manage-food.php'
                    },3000)
                </script>  
                <?php
                unset($_SESSION['remove']);
            }
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                ?>
                <script>
                    setTimeout(function(){
                        window.location.href = 'manage-food.php'
                    },3000)
                </script>  
                <?php
                unset($_SESSION['delete']);
            }


            if(isset($_SESSION['food-not-found']))
            {
                echo $_SESSION['food-not-found'];
                ?>
                <script>
                    setTimeout(function(){
                        window.location.href = 'manage-food.php'
                    },3000)
                </script>  
                <?php
                unset($_SESSION['food-not-found']);
            }
    ?>
    <br>
        <br>
        <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">Add Food</a>
        <br>
        <br>
    <table class="tbl-full">
        <tr>
            <th>S.No</th>
            <th>Title </th>
            <th>Price</th>
            <th>Image</th>
            <th>Featured</th>
            <th>Active</th>
            <th>Actions</th>
        </tr>
        

        

        <?php

            $sql = "SELECT * FROM tbl_food";
            $res  = mysqli_query($conn,$sql);
            $count = mysqli_num_rows($res);

           
            if($count>0)
            {
                $sno=1;
                while($row=mysqli_fetch_assoc($res))
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                    ?>
                      <tr>

                            <td><?php echo $sno++;?></td>
                            <td><?php echo $title;?></td>
                            <td><?php echo $price;?></td>
                          
                            <td>
                            <?php 


                                    if($image_name=="")
                                    {
                                        echo "<div class='fail'>image not added</div>";
                                    }
                                    else
                                    {
                                        //display img
                                        ?>
                                        <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" width="100px">
                                        <?php
                                    }
                            ?>
                            </td>
                            <td><?php echo $featured;?></td>
                            <td><?php echo $active;?></td>
                            <td>
                                <a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id;?>" class="btn-secondary">Update Food</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Food</a>
                            </td>
                      </tr>
                    <?php
                }
            }
            else
            {
                echo "<tr><td colspan='7' class='fail'>Food not Added Yet.</td></tr>";
            }

        ?>

        
    </table>
    </div>
</div>
<?php include('partials/footer.php')?>