<?php
    session_start();
    //Set login/Myaccount link String
    require_once "scripts/login_accountName.php";
    $loginString = getString();
    if ((filter_input(INPUT_POST, 'username'))){
        //Set database variables
        $servername = "localhost";
        $username = "root";
        $password = "9ubJDsdUBnz2";
        $database = "simplyeasyco";
        
        //Insert username SQL query string
        $sqlinsert = "INSERT INTO `users` (`username`, `password`, `first_name`, `last_name`, `email`, `start_date`)
                      VALUES ('" . filter_input(INPUT_POST, 'username') . "', PASSWORD('" . filter_input(INPUT_POST, 'password') . "'), '" . filter_input(INPUT_POST, 'fname') . "', '" . filter_input(INPUT_POST, 'lname') . "', '" . filter_input(INPUT_POST, 'email') . "', current_timestamp());";
        
        $sqlCreateWishList = "INSERT INTO wishlist (username)
                              VALUES ('" . filter_input(INPUT_POST, 'username') . "');";
        //connect to server and select database
        $mysqli = mysqli_connect($servername, $username, $password, $database);

        // Check connection
        if (!$mysqli) {
          die("Connection failed: " . mysqli_connect_error());
        }
        
        
        //Query the table
        mysqli_query($mysqli, $sqlinsert) or die(print mysqli_error($mysqli));
        mysqli_query($mysqli, $sqlCreateWishList) or die(print mysqli_error($mysqli));
        
        //End connection with database
        $mysqli->close();
        
        header("location: login.php");
      
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
        <div class="home-main-content">
            <div class="box-layout bg-white align-items-center">
                <h1 class="text-center light-font">Sign Up</h1>
                <h3 class="text-center light-font">Please fill out the information bellow!</h3>
                <div id="contact-form" class="enlarge">
                    <form action="signup.php" method="POST" onsubmit="return userValidateForm()" name="adduser">
                      Username:<br>
                      <input type="text" size="25" name="username" required>
                      <br><br>
                      Password:<br>
                      <input type="password" size="25" name="password" required>
                      <br><br>
                      First Name:<br>
                      <input type="text" size="25" name="fname">
                      <br><br>
                      Last Name:<br>
                      <input type="text" size="25" name="lname">
                      <br><br>
                      Email:<br>
                      <input type="text" size="50" name="email">
                      <p id="email"></p>
                      <br><br>
                      <input type="submit" value="Submit">
                    </form>
                 </div>
            </div>
        </div>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script type = "text/javascript"  src = "https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
      <script type = "text/javascript"  src="formvalidation.js"></script>
    </body>
    
</html>