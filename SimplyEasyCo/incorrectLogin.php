<?php
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
                <h1 class="text-center light-font">Incorrect Login</h1>
                <h3 class="text-center light-font">Username or Password was incorrect, please try again!</h3>
                <form action="login.php" method="POST" name="loginuser">
                    <input type="submit" value="Try Again"/>
                </form>
            </div>
        </div>
    </body>
    
</html>