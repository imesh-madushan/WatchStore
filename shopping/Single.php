<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style-nav.css">
    <link rel="stylesheet" href="style-single.css">


    <title>Single Page</title>
    <script src="addcart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="validate.js"></script>
</head>

<body>
    <div class="main">
        <!--========================================nav bar====================================================!-->
        <div class="nav">
            <!-- getting navbar from home.html -->
            <div id="nav"></div>

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

            <div id="navDropdown">
                <ul>
                    <li><a href="">Home</a></li>
                    <li><a href="">About</a></li>
                    <li><a href="">Ratings</a></li>
                    <li><a href="">Services</a></li>
                    <li><a href="">Contact</a></li>
                </ul>
            </div>

        </div>

        <!--======================================================single item===========================================================================-->
        <div class="single-product">

            <table class="tb">
                <tr>
                    <th>
                        <div class="col-img">
                            <?php
                            session_start();
                            $I_ID = $_SESSION["item_id"];
                            ?>
                            <img src="../products/<?php echo $I_ID ?>.jpg" width="100%">
                           

                        </div>
                    </th>
                    <th>
                        <div class="singledes">
                            <p id="link">Home/ Watch</p>
                            <?php

                            include 'db.php';
                            // session_start();
                            // $I_ID = $_SESSION["item_id"];


                            $query = "SELECT * FROM items  WHERE Item_ID = '$I_ID'";
                            $result = mysqli_query($con, $query);


                            if (mysqli_num_rows($result) > 0) {

                                while ($row = mysqli_fetch_assoc($result)) {

                                    $I_Name = $row['Item_Name'];
                                    $I_Des = $row['Item_Des'];
                                    $I_Price = $row['Item_Price'];
                                } ?>


                                <h2><?php echo $I_Name; ?></h2>
                                <h2>Price: <?php echo $I_Price; ?> LKR</h2>
                                Select Color: <select>
                                    <option>Select Color</option>
                                    <option>Black</option>
                                    <option>White</option>
                                    <option>Sliver</option>
                                    <option>Gold</option>
                                    <option>Brown</option>
                                </select><br><br>

                                Quentity : <input id="qut" name="qut" type="number" value="1"><br>
                                <h3>Product Details <i class="fa-solid fa-angle-down"></i></h3>
                                <div id="des">
                                    <p>
                                        <?php echo $I_Des; ?>
                                    </p>
                                </div>

                                <button class="btnsingle" id="btnAddToCart" onclick="validate()">Add to Cart</button>

                                
                                    <button id="btnBuy" onclick="gotocheckout()" class="btnsingle">Buy</button>
                                

                               

                            <?php
                            } else {
                                echo "0 results";
                            }
                            mysqli_close($con);

                            ?>

                        </div>
                    </th>
                </tr>
            </table>

        </div>
</body>

</html>