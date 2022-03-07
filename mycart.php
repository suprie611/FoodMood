<?php include('partials-front/menu.php');?>
<head>
    <title>My Cart</title>
</head>
<body>
    
    <div class="main-content">
        <div class="wrapper">
           
            <h1 class="text-center">My Cart</h1>
            <br>
            <br>
           
            
            <table class="tbl-full ">
                <tr>
                    <th>S.No</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Qty.</th>
                    <th>Total</th>
                    
                </tr>
               <?php
                    $total = 0;
                    
                    if(isset($_SESSION['cart']))
                    {
                        $sno=1;
                        foreach($_SESSION['cart'] as $key => $value)
                        {
                            $total = $total+$value['price'];
                            $sno= $key+1;
                            echo "

                                <tr>
                                    <td>$sno</td>
                                    <td>$value[title]</td>
                                    <td>$value[price]<input type='hidden' class='iprice' value='$value[price]'></td>
                                    <td>
                                        <form action='mod-quantity.php' method = 'POST'>

                                        <input class='text-center iquantity' name='mod-quantity' onchange='this.form.submit();' type='number' value='$value[Quantity]' min='1' max='30'>
                                        <input type='hidden' name='title' value='$value[title]'>
                                        </form>
                                    </td>
                                    <td class='itotal'></td>
                                    <td>
                                    <form action='remove-item.php' method='POST'>
                                    <button name='remove_item' class='btn-danger text-center'>remove</button>
                                    <input type='hidden' name='title' value='$value[title]'>
                                    </form>
                                    </td>
                                </tr>    
                               

                            ";
                        }
                       
                        
                    }
               ?>

                
            </table>
            <br>
            <br>
            

            <h3 class="text-center order" id='gtotal'>Order Total: &nbsp; </h3>

            <br>
            <br>
            <?php
                if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0)
                {
            ?>
            <form action="purchase.php" method="POST">

            <h3 class="text-center text-black">Fill this form to confirm your order.</h3>

            <?php
                                 if(isset($_SESSION['user']))
                                 {
                                     $username = $_SESSION['user'];
                                 }
            ?>

            <input type="hidden" name="username" value="<?php echo $username; ?>">



            <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full_name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

            </fieldset>
           
            
            
           

            <br>
           
            <fieldset>
            <legend>Payment Mode</legend>
                <div class="form-check ">
                    <input class="form-check-input" type="radio" value="onlinePayment" name="pay_mode" id="flexRadioDefault1" required>
                    <label class="form-check-label" for="flexRadioDefault1">
                        jnf
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="cashOnDelivery" name="pay_mode"  id="flexRadioDefault2" required>
                    <label class="form-check-label" for="flexRadioDefault2">
                        Cash on delivery
                    </label>
                </div>
            </fieldset>    
              

            

            <div class="text-center">

            <input class='btn-secondary' name="purchase" type="submit" value="Confirm Order">
            </div>
            
        </div>
    </div>

    <script>

            var gt=0;
            var iprice = document.getElementsByClassName('iprice');
            var iquantity = document.getElementsByClassName('iquantity');
            var itotal = document.getElementsByClassName('itotal');
            var gtotal = document.getElementById('gtotal');
           

            function subTotal()
            {
                gt=0;
                for(i=0;i<iprice.length;i++)
                {
                    itotal[i].innerText=(iprice[i].value)*(iquantity[i].value);
                    gt+=(iprice[i].value)*(iquantity[i].value);
                }
                gtotal.innerText= "Order Total:  "+gt;
            }
          
            subTotal();
            
            
    </script>
    </form>
    <?php
                }
    ?>
  
</body>


<?php include('partials-front/footer.php')?>