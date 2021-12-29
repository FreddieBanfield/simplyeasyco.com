<?php
    session_start();
    //Set login/Myaccount link String
    require_once "scripts/login_accountName.php";
    $loginString = getString();
        //Check if user filled out form
        if (isset($_POST["login"])){ //If user is asking to log in
            //Set database variables
            $servername = "localhost";
            $username = "root";
            $password = "9ubJDsdUBnz2";
            $database = "simplyeasyco";

            //"SELECT * FROM users WHERE username = '" .filter_input(INPUT_POST, 'username'). "' AND password = PASSWORD('" . filter_input(INPUT_POST, 'password') . "';";
            //Insert username SQL query string
            $sqlExists = "SELECT * FROM users WHERE username = '" .filter_input(INPUT_POST, 'username'). "' AND password = PASSWORD('" . filter_input(INPUT_POST, 'password') . "');";


            //connect to server and select database
            $mysqli = mysqli_connect($servername, $username, $password, $database);

            // Check connection
            if (!$mysqli) {
              die("Connection failed: " . mysqli_connect_error());
            }


            //Query the table
            $result = mysqli_query($mysqli, $sqlExists) or die(print mysqli_error($mysqli));


            if (mysqli_num_rows($result) == 1) {
                $_SESSION['user'] = true;
                $_SESSION['username'] = filter_input(INPUT_POST, 'username');
                //End connection with database
                $mysqli->close();
                header("location: login.php");
            }else{ //Routes to page that lets the user know their login failed
                //End connection with database
                $mysqli->close();
                header("location: incorrectLogin.php");
            }
                  
        }else if (isset($_POST["logout"])){ //If user is logging out
                  $_SESSION['user'] = false;
                  unset($_POST["logout"]);
                  unset($_POST["login"]);
                  unset($_SESSION["username"]);
                  header("location: login.php"); 
        }else if ($_SESSION['user'] == true){ //If user is logged in
            //Set database variables
            $servername = "localhost";
            $username = "root";
            $password = "9ubJDsdUBnz2";
            $database = "simplyeasyco";

            //SELECT prod_name FROM wishlist_prod wp, wishlist w WHERE w.username = 'test' AND wp.wish_id = w.wish_id
            //Insert username SQL query string WHERE w.username = '" .$SESSION_ID['username']. "' AND wp.wish_id = w.wish_id
            $sqlwishlist = "SELECT prod_name FROM wishlist_prod wp, wishlist w WHERE w.username = '" .$_SESSION['username']. "' AND wp.wish_id = w.wish_id;";
            //connect to server and select database
            $mysqli = mysqli_connect($servername, $username, $password, $database);

            //Query the table
            $result = mysqli_query($mysqli, $sqlwishlist) or die($wishlistContents =  mysqli_error($mysqli));
            if (mysqli_num_rows($result) > 0) {
                $i = 0;
                while ($info = mysqli_fetch_array($result)) {
                    $wLNames[$i] = stripslashes($info['prod_name']);
                    $i += 1;
                }
                foreach($wLNames as $value){
                    //Get name for each wishlisted product
                    $wishlistContents .=''
                            . '<div class="wishlist-img"><div class="prod_overlay">'
                            . '<p>' . $value . '</p>'
                            . '<form action="removeFromWishlist.php" method="POST" name="rmWishList">'
                            . '<input type="hidden" value="'. $value .'" name="prod_name">'
                            . '<input type="submit" value="Remove" name="remove">'
                            . '</form>'
                            . '</div>';
                    
                    //Get image for each wishlisted product
                    //Query the product image table
                    //Get the array ($results) and save into $images
                    //Grab the first image ($images[0]) and display
                    $sqlwishlistImg = "SELECT img_url FROM prod_img WHERE '" . $value . "' = prod_name;";
                    $result = mysqli_query($mysqli, $sqlwishlistImg) or die($wishlistContents =  mysqli_error($mysqli));
                    $images = mysqli_fetch_array($result);
                    $wishlistContents .='<img src="' . $images[0] . '" alt="Product image unable to load" style="max-width: 10em; vertical-align: middle;"/></div>';
                }
            }else{
                $wishlistContents = "You have no items in your wishlist!";
            }
            //End connection with database
            $mysqli->close();

            //connect to server and select database
            $mysqli = mysqli_connect($servername, $username, $password, $database);
                $output = '           
                   <div class="box-layout bg-white">
                      <h1 class="text-center light-font"> Welcome ' . $_SESSION['username'] . '</h1>
                      <br>
                      <div class="wishlist align-items-center text-center">
                        <h3>Wishlist</h3>
                        <br>'
                        . $wishlistContents .
                        '
                      </div>
                      <div id="contact-form" class="enlarge">
                        <form action="login.php" method="POST" name="logoutuser">
                            <input type="submit" value="Sign Out" name="logout">
                        </form>
                      </div>
                   </div>';
        }
        else { //Display if user needs to log in
            $output = '
                <div class="box-layout bg-white">
                    <h1 class="text-center light-font">Login</h1>
                    <h3 class="text-center light-font">Please fill in the boxes bellow!</h3>
                    <div id="contact-form" class="enlarge">
                        <form action="login.php" method="POST" name="loginuser">
                            Username:<br>
                            <input type="text" size="25" name="username" required>
                            <br><br>
                            Password:<br>
                            <input type="password" size="25" name="password" required>
                            <br><br>
                            <input type="submit" value="Submit" name="login">
                        </form>
                    </div>
                </div>';
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
            <?php echo $output ?>
        </div>
    </body>
    
</html>