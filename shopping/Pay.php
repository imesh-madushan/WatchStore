<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pay</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="Styl pay.css">
  <link rel="stylesheet" href="../style-nav.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="addcart.js"></script>
  <!-- <script src="script.js" type="text/javascript"></script> -->

</head>

<body>
  <div>
    <!--==========================================================nav bar===========================================================================-->
    <div class="navbar">
      <nav id="nav"></nav>
      <script>
        $(function() {
          $("#nav").load("../navBarForOthers/navOthers.html #nav", function() {
            $.ajax({
              url: '../login/get-login.php',
              method: 'POST',
              data: {
                functionName: 'checkCookies'
              },
              dataType: 'json',
              success: function(response) {
                if (response.status == "success") {
                  console.log("User is logged");
                  afterCookiesLogged();
                } else {
                  console.log("User is not logged");
                }
              },
              error: function(error) {
                console.error(error);
              }
            });

            function afterCookiesLogged() {
              var navEnd = document.getElementById('navEnd');
              var navMidOptUl = document.getElementById('navMidOptions');
              var profilePic = document.getElementById('navProfileArea');

              var cartLink = document.createElement('a');
              var cartli = document.createElement('li');
              cartLink.href = "Cart.php";
              cartLink.textContent = "Cart";
              cartli.appendChild(cartLink);
              navMidOptUl.insertBefore(cartli, navMidOptUl.childNodes[2]);
              navMidOptUl.style.gridTemplateColumns = "repeat(6, 17%)";

              navEnd.removeChild(document.getElementById('link-btnLogin')); // Remove login button
              navEnd.removeChild(document.getElementById('link-btnRegister')); // Remove register button
              profilePic.style.display = 'grid';
            }
          });
        });
      </script>


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
    <div class="row" style="margin-top: 80px">
      <div class="col-75">
        <div class="container">
          <div>
            <?php include 'db.php';
            $C_ID = $_COOKIE["customerID"];
            $query = "SELECT * FROM customer  WHERE Cus_ID = '$C_ID'";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);

            ?>
            <div class="row">
              <div class="col-50">
                <h3>Billing Address</h3>
                <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                <input type="text" id="fname" name="firstname" placeholder=<?php echo $row['Cus_Name'] ?>>
                <label for="email"><i class="fa fa-envelope"></i> Email</label>
                <input type="text" id="email" name="email" placeholder=<?php echo $row['Email'] ?>>
                <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                <input type="text" id="adr" name="address" placeholder=<?php echo $row['Addr'] ?>>
                <label for="city"><i class="fa fa-institution"></i> City</label>
                <input type="text" id="city" name="city" placeholder=<?php echo $row['city'] ?>>
                <label for="zip">Zip</label>
                <input type="text" id="zip" name="zip" placeholder=<?php echo $row['zip'] ?>>
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
                <input type="text" id="cname" name="cardname" placeholder=<?php echo $row['cardName'] ?>>
                <label for="ccnum">Credit card number</label>
                <input type="text" id="ccnum" name="cardnumber" placeholder=<?php echo $row['cardNumber'] ?>>
                <label for="exp">Exp</label>
                <input type="text" id="exp" name="exp" placeholder=<?php echo $row['expiryDate'] ?>>
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="">
              </div>

            </div>
            <label>
              <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
            </label>

            <button class="btn" id="btn-checkout" onclick="removeCart()">checkout</button>
          </div>
        </div>
      </div>
      <div class="col-25">
        <div class="container">

          <?php
          $C_ID = $_COOKIE["customerID"];
          $i = 0;
          $query = "SELECT * FROM cart_items  WHERE Cus_ID = '$C_ID'";
          $result = mysqli_query($con, $query);
          while ($row = mysqli_fetch_assoc($result)) {
            $i++;
          }
          ?>


          <h4>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b><?php echo $i ?></b></span></h4>
          <?php
          // include 'db.php';

          //  $C_ID=$_COOKIE["customerID"];

          //$C_ID='Cus001';

          $tot = 0;


          $query = "SELECT * FROM cart_items  WHERE Cus_ID = '$C_ID'";
          $result = mysqli_query($con, $query);
          while ($row = mysqli_fetch_assoc($result)) {


            $I_ID = $row['Item_ID'];
            $I_prz = $row['Price'];
          ?>

            <p><?php echo $I_ID ?></a> <span class="price"><?php echo $I_prz ?></span></p>
          <?php
            $tot = $tot + ($I_prz);
          }
          ?>


          <hr>
          <p>Total <span class="price" style="color:black"><b><?php echo $tot ?></b></span></p>
        </div>
      </div>
    </div>


</html>

</div>

</div>


</div>
</body>

</html>