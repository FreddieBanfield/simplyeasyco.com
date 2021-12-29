<?php
//Set login/Myaccount link String
session_start();
require_once "scripts/login_accountName.php";
$loginString = getString();
//Set database variables
$servername = "localhost";
$username = "root";
$password = "9ubJDsdUBnz2";
$database = "simplyeasyco";

//Insert username SQL query string
$sqlGetID = "SELECT * FROM wishlist WHERE username = '" .$_SESSION['username']. "';";
//connect to server and select database
$mysqli = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}

//Query the tables
$result = mysqli_query($mysqli, $sqlGetID) or die($output = mysqli_error($mysqli));
if (mysqli_num_rows($result) > 0) {
    while ($info = mysqli_fetch_array($result)) {
        $wishID = stripslashes($info['wish_id']);
    }
}
$totalCost = $_POST['prodCost'];
$sqlAddToWishlist = "INSERT INTO `wishlist_prod` (`prod_name`, `quantity`, `total_price`, `wish_id`) "
        .           "VALUES ('" . $_POST['prodName'] . "', '1', '" . $_POST['prodCost'] . "', '" . $wishID . "');";
$result = mysqli_query($mysqli, $sqlAddToWishlist) or die($output =  mysqli_error($mysqli) . "wishID: " .$wishID);
$output = $_POST['prodName'] . " has been added to your wishlist!";
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
                echo $output;

        ?>
                        </div>
                    </div>
                </div>
    </body>

</html>