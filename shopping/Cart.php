<!DOCTYPE html>
<html lang="en">

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="../style-nav.css">
    <link rel="stylesheet" href="Style-cart.css">

    <script src="https://kit.fontawesome.com/b1d9791c79.js" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="addcart.js"></script>

</head>

<body>
    <div>
        <div class="navbar">
            <!--========================================nav bar====================================================!-->
            <nav id="nav"></nav>
            <div id="navDropDown"></div>
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

                            // Creating cart navbar option
                            var cartLink = document.createElement('a');
                            var cartli = document.createElement('li');
                            cartLink.href = "shopping/Cart.php";
                            cartLink.textContent = "Cart";
                            cartli.appendChild(cartLink);
                            navMidOptUl.insertBefore(cartli, navMidOptUl.childNodes[2]); // Insert cart link to the navbar
                            navMidOptUl.style.gridTemplateColumns = "repeat(6, 17%)";

                            navEnd.removeChild(document.getElementById('link-btnLogin')); // Remove login button
                            navEnd.removeChild(document.getElementById('link-btnRegister')); // Remove register button

                            profilePic.style.display = 'grid';

                            // adding created cart option for navDropdown
                            var navDropdownUl = document.getElementById('navDropdownUl');
                            navDropdownUl.insertBefore(cartli, navDropdownUl.childNodes[2]);
                        }
                    });
                });
            </script>
        </div>

        <!--========================================Cart====================================================!-->

        <div class="container">
            <div class="small-contaner cartp-page">
                <table class="cart-table">
                    <tr class="heads">
                        <th>Number</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                    <tr>
                        <?php
                        include 'db.php';

                        $C_ID = $_COOKIE["customerID"];

                        //$C_ID='Cus001';

                        $tot = 0;
                        $i = 0;
                        $query = "SELECT * FROM cart_items  WHERE Cus_ID = '$C_ID'";
                        $result = mysqli_query($con, $query);
                        while ($row = mysqli_fetch_assoc($result)) {

                            $I_ID = $row['Item_ID'];
                            $I_Qty = $row['Cart_Qty'];

                            $query1 = "SELECT * FROM items WHERE Item_ID = '$I_ID'";
                            $result1 = mysqli_query($con, $query1);

                            while ($row1 = mysqli_fetch_assoc($result1)) {
                                $i++;
                                //echo $row1;
                        ?>

                                <td><?php echo $i ?></td>
                                <td>
                                    <div class="class-infor">
                                        <img class="img-cart" src="../products/<?php echo $I_ID ?>.jpg">
                                        <div>
                                            <?php $price = $row1['Item_Price']; ?>
                                            <p>Name:<?php echo $row1['Item_Name']; ?></p>
                                            <p>price: <?php echo $price; ?></p>
                                            <br>
                                            <i class="fa-solid fa-trash"></i>
                                            <button id="remove" value="<?php echo $row['Item_ID']; ?>" onclick="removeCartRequest()">Remove</button>

                                        </div>
                                    </div>

                                </td>
                                <td><input type="number" value="<?php echo $I_Qty ?>" class="td-input">
                                </td>
                                <td> <?php echo $price * $I_Qty; ?></td>
                                <?php
                                $tot = $tot + ($price * $I_Qty);
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
                        <td>
                            <h3>Subtotal</h3>
                        </td>
                        <td>
                            <h3><?php echo $tot ?></h3>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3>Delivery fee</h3>
                        </td>
                        <td>
                            <h3>250.00</h3>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3>Total</h3>
                        </td>
                        <td>
                            <h3><?php echo $tot + 250 ?></h3>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div class="cart-button">

                                <button id="checkoutbtn" onclick="gotocheckout()">Check Out</button>

                                <button id="btnAddToCart" onclick="backToHome()">Back</button>

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