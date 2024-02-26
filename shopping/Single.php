<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-nav.css">
    <link rel="stylesheet" href="style-single.css">
    
    <title>Single Page</title>
    <script src="addcart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="main">
        <div class="navbar">
            <!--========================================nav bar====================================================!-->

        <nav id="nav">
            <a href="#">
                <div class="navBegin">
                    <img class="imgLogo" src="Imege/logo.png" alt="">
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

<!--======================================================single item===========================================================================-->
<div class="single-product">

<table class="tb" >
    <tr>
        <th>
            <div class="col-img">
                <?php
                session_start();
                $I_ID = $_SESSION["item_id"];
                ?>
                <img src="Imege/<?php echo $I_ID?>.jpg" width="100%">
                
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
                $result = mysqli_query($con,$query);


                if (mysqli_num_rows($result) > 0) {

                    while($row = mysqli_fetch_assoc($result)) {
                       
                        $I_Name= $row['Item_Name'];
                        $I_Des1= $row['Item_Des1'];
                        $I_Price= $row['Item_Price'];
                        
     }?>
               

                <h1>Name: <?php echo $I_ID;?></h1>
                <h4>Price: <?php echo $I_Price;?></h4>
                Select Color: <select>
                    <option>Select Color</option>
                    <option>Black</option>
                    <option>White</option>
                    <option>Sliver</option>
                    <option>Gold</option>
                    <option>Brown</option>
                </select><br><br>
        
                Quentity : <input  id="qut"  name="qut" type="number" value="1" ><br>
                <button class="btnsingle" id="btnAddToCart" onclick="addtocartRequest()">Add to Cart</button>
                
                <form action="Pay.php" method="post">
                <button type="submit" class="btnsingle">Buy</button>
                </form>
                
                <h3>Product Details <i class="fa-solid fa-angle-down"></i></h3>
                <div id="des">
                <p>
                    <?php echo $I_Des1;?>
                </p>
                </div>

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