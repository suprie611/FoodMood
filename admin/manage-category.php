<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
    <h1>Manage Category</h1>
    <br>
        <br>

        <?php

            if(isset($_SESSION['addi']))
            {
                echo $_SESSION['addi'];
                ?>
                 <script>
                    setTimeout(function(){
                        window.location.href = 'manage-category.php'
                    },3000)
                </script>  
                  <?php
                unset($_SESSION['addi']);
            }

            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                ?>
                 <script>
                    setTimeout(function(){
                        window.location.href = 'manage-category.php'
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
                        window.location.href = 'manage-category.php'
                    },3000)
                </script>  
                  <?php
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['category-not-found']))
            {
                echo $_SESSION['category-not-found'];
                ?>
                 <script>
                    setTimeout(function(){
                        window.location.href = 'manage-category.php'
                    },3000)
                </script>  
                  <?php
                unset($_SESSION['category-not-found']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                ?>
                 <script>
                    setTimeout(function(){
                        window.location.href = 'manage-category.php'
                    },3000)
                </script>  
                  <?php
                unset($_SESSION['update']);
            }
        ?>
        <br>
        <br>
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
        <br>
        <br>
    <table class="tbl-full">
        <tr>
            <th>S.No</th>
            <th>Title </th>
            <th>Image</th>
            <th>Featured</th>
            <th>Active</th>
            <th>Actions</th>
        </tr>

        <?php

            //query to get all categories from db
            $sql = "SELECT * FROM tbl_category";

            $res = mysqli_query($conn,$sql);

            //count rows

            $count = mysqli_num_rows($res);

            //check wheather data is there in db or not

            if($count>0)
            {
                //we have data
                //get the data and display
                $sno = 1;
                while($row = mysqli_fetch_assoc($res))
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

                    ?>

                        <tr>

                        <td><?php echo $sno++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td>

                            <?php

                                //check whether img is available or not
                                if($image_name!="")
                                {
                                    //display the image
                                    ?>

                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">
                                    <?php
                                }
                                else
                                {
                                    //display the msg
                                    echo "<div class='fail'>Image Not Added!</div>";
                                }
                            ?>
                        </td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id;?>" class="btn-secondary">Update Category</a>
                            <a href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                        </td>
                        </tr>

                    <?php
                }

            }
            else
            {
                //no data
                //display msg inside table

                ?>
                <tr>
                    <td colspan="6"><div class="fail">No Category Added</div></td>
                </tr>
                <?php
            }

        
        ?>

       
       
    </table>
    </div>
</div>
<?php include('partials/footer.php')?>