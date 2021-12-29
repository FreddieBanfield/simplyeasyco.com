<?php
//Set login/Myaccount link String
    require_once "scripts/login_accountName.php";
    $loginString = getString();
//Set database variables
$servername = "localhost";
$username = "root";
$password = "9ubJDsdUBnz2";
$database = "simplyeasyco";

//Insert username SQL query string
$sqlProducts = "SELECT * FROM products p, prod_img pi WHERE p.name = pi.prod_name AND name = '" . $_POST['product'] . "';";
//$sqlProducts = "SELECT * FROM products WHERE name = 'Beer Flight with Glasses';";
//connect to server and select database
$mysqli = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}


//Query the table
$result = mysqli_query($mysqli, $sqlProducts) or die(print mysqli_error($mysqli));

if (mysqli_num_rows($result) > 0) {
    //if authorized, get the values of f_name l_name
    while ($info = mysqli_fetch_array($result)) {
        $name = stripslashes($info['name']);
        $desc = stripslashes($info['description']);
        $price = stripslashes($info['price']);
        $quant = stripslashes($info['quantity']);
        $url = stripslashes($info['img_url']);
    }
}
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
                        <div class="prod_structure align-items-center">
                        <h1 class="text-center light-font" style="padding-bottom: 40px;"><?php echo $name ?></h1>
        <?php
                echo '
                <div class="prod_content_box">
                    <img src="' . $url . '" alt="Failed to load image" class="prod_img_slide">
                    <div class="prod_desc">
                        <h3 class="text-left light-font">Description:<br>' . $desc . '</h3>
                        <br><br><br><br>
                        <h4 class="text-left light-font">Price: $' . $price . ' </h4>
                        <br>
                        <h4 class="text-left light-font">In Stock: ' . $quant .'</h4>
                        <br>
                        <form action="addToWishlist.php" method="POST" name="addproduct">
                          <input type="hidden" value="' . $name . '" name="prodName"/>
                          <input type="hidden" value="' . $price . '" name="prodCost"/>
                          <input type="submit" value="Add To Wishlist" class="wishlist_form_content"/>
                        </form>
                    </div>
                </div>

                ';

        ?>
                </div>
            </div>
        </div>
    </body>

</html>