<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pay</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="Styl pay.css">
    <link rel="stylesheet" href="style-nav.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="addcart.js"></script>
    <!-- <script src="script.js" type="text/javascript"></script> -->
   
</head>
<body>
    <div>
   <!--==========================================================nav bar===========================================================================-->
   <div class="navbar">
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

   <!--===========================================================payment=================================================================================--> 
   <div class="row">
      <div class="col-75">
        <div class="container">
          <form>
          
            <div class="row">
              <div class="col-50">
                <h3>Billing Address</h3>
                <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                <input type="text" id="fname" name="firstname" placeholder="John M. Doe">
                <label for="email"><i class="fa fa-envelope"></i> Email</label>
                <input type="text" id="email" name="email" placeholder="john@example.com">
                <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                <input type="text" id="adr" name="address" placeholder="542 W. 15th Street">
                <label for="city"><i class="fa fa-institution"></i> City</label>
                <input type="text" id="city" name="city" placeholder="New York">
    
                <div class="row">
                  <div class="col-50">
                    <label for="state">State</label>
                    <input type="text" id="state" name="state" placeholder="NY">
                  </div>
                  <div class="col-50">
                    <label for="zip">Zip</label>
                    <input type="text" id="zip" name="zip" placeholder="10001">
                  </div>
                </div>
              </div>
    
              <div class="col-50">
                <h3>Payment</h3>
                <label for="fname">Accepted Cards</label>
                <div class="icon-container">
                  <i class="fa fa-cc-visa" style="color:navy;"></i>
                  <i class="fa fa-cc-amex" style="color:blue;"></i>
                  <i class="fa fa-cc-mastercard" style="color:red;"></i>
                  <i class="fa fa-cc-discover" style="color:orange;"></i>
                </div>
                <label for="cname">Name on Card</label>
                <input type="text" id="cname" name="cardname" placeholder="John More Doe">
                <label for="ccnum">Credit card number</label>
                <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
                <label for="expmonth">Exp Month</label>
                <input type="text" id="expmonth" name="expmonth" placeholder="September">
                <div class="row">
                  <div class="col-50">
                    <label for="expyear">Exp Year</label>
                    <input type="text" id="expyear" name="expyear" placeholder="2018">
                  </div>
                  <div class="col-50">
                    <label for="cvv">CVV</label>
                    <input type="text" id="cvv" name="cvv" placeholder="352">
                  </div>
                </div>
              </div>
              
            </div>
            <label>
              <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
            </label>
           
            <button  class="btn" id="btn-checkout">checkout</button>
          </form>
        </div>
      </div>
      <div class="col-25">
        <div class="container">

        <?php
                  $C_ID=$_COOKIE["customerID"];
                  include 'db.php';
                    $i=0;
                    $query = "SELECT * FROM cart_items  WHERE Cus_ID = '$C_ID'";
                    $result = mysqli_query($con,$query);
                    while($row = mysqli_fetch_assoc($result)) {
                      $i++;
                      }
                        ?>


          <h4>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b><?php echo $i?></b></span></h4>
          <?php
                  include 'db.php';
                 
                //  $C_ID=$_COOKIE["customerID"];

                //$C_ID='Cus001';

                    $tot=0;
                    
                    
                    $query = "SELECT * FROM cart_items  WHERE Cus_ID = '$C_ID'";
                    $result = mysqli_query($con,$query);
                    while($row = mysqli_fetch_assoc($result)) {

                      
                        $I_ID= $row['Item_ID'];
                        $I_prz= $row['Price'];
                        ?>

          <p><?php echo $I_ID?></a> <span class="price"><?php echo $I_prz?></span></p>
          <?php
        $tot=$tot+($I_prz); 

            }
          ?>

          
          <hr>
          <p>Total <span class="price" style="color:black"><b><?php echo $tot?></b></span></p>
        </div>
      </div>
    </div>
    
    
    </html>
    
</div>

</div>


    </div>
</body>
      </html>
