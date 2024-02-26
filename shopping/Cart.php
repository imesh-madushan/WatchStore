
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="style-nav.css">
    <link rel="stylesheet" href="Style-cart.css">
    
    <script src="https://kit.fontawesome.com/b1d9791c79.js" crossorigin="anonymous"></script>
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="addcart.js"></script>

</head>
<body>
    <div>
        <div class="navbar">
            <!--========================================nav bar====================================================!-->

        <nav id="nav">
            <a href="#">
                <div class="navBegin">
                    <img class="imgLogo" src="logo3.png" alt="">
                    <h2>ONE'O CLOCK</h2>
                </div>
            </a>
            <div class="navMiddle">
                <ul>
                    <li><a href="#" id="navHome">Home</a></li>
                    <li><a href="#" id="navAbout">About</a></li>
                    <li><a href="#" id="navRatings">Ratings</a></li>
                    <li><a href="#" id="navServices">Services</a></li>
                    <li><a href="#" id="navContact">Contact</a></li>
                </ul>
            </div>
            <div class="navEnd">
                <button id="btnLogin">Login</button>
                <button id="btnRegister">Register</button>
            </div>
            <div id="btnDropdownArea">
                <svg id="btnDropdown" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>
            </div>
        </nav>
        </div>
    
        <div id="navDropdown">
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="">About</a></li>
                <li><a href="">Ratings</a></li>
                <li><a href="">Services</a></li>
                <li><a href="">Contact</a></li>
            </ul>
        </div>


 <!--========================================Cart====================================================!-->
 
 <div class="container">
    <div class="small-contaner cartp-page" >
          <table class="cart-table">
            <tr>
                <th>Number</th>
              <th>Product</th>
              <th>Quantity</th>
              <th>Subtotal</th>
            </tr>
            <tr >
                    <?php
                  include 'db.php';
                 
                   $C_ID=$_COOKIE["customerID"];

                //$C_ID='Cus001';

                    $tot=0;
                    $i=0;
                    $query = "SELECT * FROM cart_items  WHERE Cus_ID = '$C_ID'";
                    $result = mysqli_query($con,$query);
                    while($row = mysqli_fetch_assoc($result)) {

                        $I_ID= $row['Item_ID'];
                        $I_Qty= $row['Cart_Qty'];

                        $query1 = "SELECT * FROM items WHERE Item_ID = '$I_ID'";
                        $result1 = mysqli_query($con,$query1);

                    while($row1 = mysqli_fetch_assoc($result1)) {
                        $i++;
                       //echo $row1;
                    ?>

                <td><?php echo $i?></td>
              <td>
                    <div class="class-infor">
                      <img class="img-cart" src="<?php echo $row1['Img_Link']; ?>">
                      <div>
                      <?php $price= $row1['Item_Price']; ?>
                          <p>Name:<?php echo $I_ID; ?></p>
                           <small>price: <?php echo $price; ?></small>
                          <p><?php echo $row1['Item_Des1']; ?></p>
                          <br>
                          <i class="fa-solid fa-trash"></i>
                          <button id="remove" value="<?php echo $row['Item_ID']; ?>" onclick="removeCartRequest()">Remove</button>
                          
                      </div>
                    </div>

              </td>
                <td ><input type="number" value="<?php echo $I_Qty ?>" class="td-input">
</td>
                <td> <?php echo $price*$I_Qty; ?></td>
                <?php
                $tot=$tot+($price*$I_Qty);
                ?>
            </tr>
            <?php
            
        
    }
}
        ?>
          </table>
    </div>
<!--=====================================================Total price table====================================================-->
    <div class="total-price">
          <table class="cart-table">
                <tr>
                  <td><h3>Subtotal</h3></td>
                  <td><h3><?php echo $tot?></h3></td>
                </tr>
                <tr>
                  <td><h3>Delivery fee</h3></td>
                  <td><h3>250.00</h3></td>
                </tr>
                <tr>
                  <td><h3>Total</h3></td>
                  <td><h3><?php echo $tot+250?></h3></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <div class="cart-button" >
                            <form action="Pay.html" method="post">
                            <button type="submit">Check Out</button>
                            <button type="button" >Back</button>
                          </div>
                        
                    </td>

                </tr>
          </table>
          
    </div>
    




</div>


    </div>


    </div>


</body>
</html>