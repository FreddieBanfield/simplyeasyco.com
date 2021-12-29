<?php
session_start();
//Set login/Myaccount link String
    require_once "scripts/login_accountName.php";
    $loginString = getString();
 $url = "images/fredandgrace.jpg";
 //Set login/Myaccount link String
 require_once "scripts/login_accountName.php";
 $loginString = getString();
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
                <h1 class="text-center light-font">About Us</h1>
                <div class="prod_structure">
                    <div class="about_box">
                        <h2 class="text-center light-font">Freddie and Grace</h2>
                        <br>
                        <h4 class="text-center light-font">Thank you for checking out our website.</h4>
                        <br>
                        <h4 class="text-center light-font">Freddie is the hands on woodworker, whilst Grace is the Cricut machine expert. Together we
                                                           create simple and easy products to help you live life!
                        </h4>
                        <br>
                        <img src=" <?php echo $url ?>" alt="Failed to load image" class="prod_img">
                    </div>
                </div>
            </div>
        </div>
    </body>
    
</html>