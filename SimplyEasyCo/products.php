<?php
    session_start();
    //Set login/Myaccount link String
    require_once "scripts/login_accountName.php";
    $loginString = getString();
            //Set database variables
            $servername = "localhost";
            $username = "root";
            $password = "9ubJDsdUBnz2";
            $database = "simplyeasyco";

            //"SELECT * FROM users WHERE username = '" .filter_input(INPUT_POST, 'username'). "' AND password = PASSWORD('" . filter_input(INPUT_POST, 'password') . "';";
            //Insert username SQL query string
            if(!isset($_POST['sort'])){
                $sqlProducts = "SELECT * FROM products p, prod_img pi WHERE p.name = pi.prod_name;";
            } else if ($_POST['sort'] == 'high'){
                $sqlProducts = "SELECT * FROM products p, prod_img pi WHERE p.name = pi.prod_name ORDER BY price DESC;";
            } else if ($_POST['sort'] == 'low'){
                $sqlProducts = "SELECT * FROM products p, prod_img pi WHERE p.name = pi.prod_name ORDER BY price ASC;";
            } else if ($_POST['sort'] == 'alpha'){
                $sqlProducts = "SELECT * FROM products p, prod_img pi WHERE p.name = pi.prod_name ORDER BY name;";
            }else if ($_POST['sort'] == 'quant'){
                $sqlProducts = "SELECT * FROM products p, prod_img pi WHERE p.name = pi.prod_name ORDER BY quantity DESC;";
            }


            //connect to server and select database
            $mysqli = mysqli_connect($servername, $username, $password, $database);

            // Check connection
            if (!$mysqli) {
              die("Connection failed: " . mysqli_connect_error());
            }


            //Query the table
            $result = mysqli_query($mysqli, $sqlProducts) or die(print mysqli_error($mysqli));

?>

<!DOCTYPE html>
<html>
    <head>
        <title>SimplyEasyCo</title>
        <link rel="stylesheet" href="styles.css"/>
    </head>
    <body>
        <header class="sticky">
            <div class="top-header bg-secondary">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="moto text-center text-md-left">
                            <span class="text-white">Helping you make life a little easier</span>
                        </div>
                        <div class="login text-center text-md-left">
                            <ul class="list-inline d-inline-block">
                                <li class="list-inline-item"><a href="login.php" class="text-white"><?php echo $loginString?></a></li>
                                <li class="list-inline-item"><p class="text-white">   |   </P></li>
                                <li class="list-inline-item"><a href="signup.php" class="text-white">Sign Up!</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navigation bg-white position-relative">
                <div class="container">
                    <nav class="navbar bg-white">
                        <a class="navbar-logo" href="index.php"><img src="https://simplyeasyco.files.wordpress.com/2021/05/cropped-cropped-logo_black-e1621475974292.png"></a>
                            <ul class="list-inline d-inline-block text-center">
                                <li class="list-inline-item"><a href="index.php">Home</a></li>
                                <li class="list-inline-item"><p>   |   </P></li>
                                <li class="list-inline-item"><a href="products.php">Products</a></li>
                                <li class="list-inline-item"><p>   |   </P></li>
                                <li class="list-inline-item"><a href="videos.php" >Videos</a></li>
                                <li class="list-inline-item"><p>   |   </P></li>
                                <li class="list-inline-item"><a href="aboutus.php" >About Us</a></li>
                            </ul>
                    </nav>
                </div>
            </div>
        </header>
        <div class="home-main-content align-items-center">
            <div class="box-layout bg-white">
                <h1 class="text-center light-font">Products</h1>
                <h3 class="text-center light-font">Hand made products made just for you!</h3>
                <br>
                <form action="products.php" method="POST" name="sortby" class="text-center light-font">
                    <label for="sort">Sort By:</label>
                    <select id="sort" name="sort" onchange="this.form.submit()">
                      <option value=""></option>
                      <option value="high">Price: High-Low</option>
                      <option value="low">Price: Low-High</option>
                      <option value="alpha">A-Z</option>
                      <option value="quant">Quantity: High-Low</option>
                    </select>
                </form>
                <br>
                <div class="prod_structure">
                    <?php
                        if (mysqli_num_rows($result) > 0) {
                        //if authorized, get the values of f_name l_name
                            while ($info = mysqli_fetch_array($result)) {
                                $name = stripslashes($info['name']);
                                $desc = stripslashes($info['description']);
                                $price = stripslashes($info['price']);
                                $quant = stripslashes($info['quantity']);
                                $url = stripslashes($info['img_url']);

                                echo '
                                
                                <div class="prod_box enlarge">
                                    <h1 class="text-center light-font">' . $name . '</h1>
                                    <!--<br>
                                    <h3 class="text-center light-font">' . $desc . '</h3>
                                    <br>-->
                                    <h3 class="text-center light-font">Price: $' . $price . '</h3>
                                    <br>
                                    <h4 class="text-center light-font">In Stock: ' . $quant .'</h4>
                                    <br>
                                    <img src="' .$url . '" alt="Failed to load image" class="prod_img">
                                    <form action="productDetails.php" method="POST" name="addproduct">
                                        <div class="prod_overlay" onclick="javascript:this.parentNode.submit();">
                                            <div class="lm_title">Learn More!</div>
                                            <input type="hidden" value="' . $name . '" name="product"/>
                                        </div>
                                    </form>
                                </div>
                                
                                ';
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
    
</html>