<?php 
        require 'header.php';
 ?>

<?php 
require "conn.php";

if(isset($_SESSION['username'])){

    header("location: main.php");

}

if (isset($_POST['submit'])) {

    if ($_POST['theusern'] != '' and $_POST['thepass'] != '') {
        $username = $_POST['theusern'];
        $password = $_POST['thepass'];
        $error = array();
        $login = $conn->query("select * from users where username='$username'");
        $login->execute();
        $data = $login->fetch(PDO::FETCH_ASSOC);

        if ($login->rowCount() > 0) {
          
            if (password_verify($password, $data['pass'])) {
                
                $_SESSION['username'] = $data['username'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['id'] = $data['id'];
            
                header("location: main.php");

            } else {

            $error['p'] = "Wrong password";
                
            }
        
            }else{
            $error['u'] = "Username inexistent!";
            
            }

         


        }
    }

?>




<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Maitodo</title>
          <!-- CSS FILES -->
        <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
        <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
        <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
        <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
        <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
        <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
        <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
        <link rel="stylesheet" type="text/css" href="css/util.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&family=Playfair+Display&display=swap" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-icons.css" rel="stylesheet">
        <link href="css/magnific-popup.css" rel="stylesheet">
        <link href="css/tooplate-wedding-lite.css" rel="stylesheet">
        

    </head>
    
    <body>



        <main>
            <div class="limiter">
                <div class="container-login100">
                    <div class="wrap-login100">
                        <div class="login100-form-title" style="background-image: url(images/bg-01.jpg);">
                            <span class="login100-form-title-1">
                                Log in
                            </span>
                        </div>
        
                        <form class="login100-form validate-form" method="post">
                            <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                                <span class="label-input100">Username</span>
                                <input class="input100" type="text" name="theusern" placeholder="Enter username">
                                <span class="focus-input100"></span>
                            </div>
        
                            <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
                                <span class="label-input100">Password</span>
                                <input class="input100" type="password" name="thepass" placeholder="Enter password">
                                <span class="focus-input100"></span>
                            </div>
                            <span class="text-danger"><?php if (isset($error['u'])){
                                echo $error['u'];}elseif(isset($error['p'])){
                                    echo $error['p'];
                                } ?></span>
                            <div class="container-login100-form-btn">
                                <button class="login100-form-btn" name="submit">
                                    Let's go!
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
           
        </main>

    

        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.sticky.js"></script>
        <script src="js/click-scroll.js"></script>
        <script src="js/jquery.magnific-popup.min.js"></script>
        <script src="js/magnific-popup-options.js"></script>
        <script src="js/custom.js"></script>

    </body>
</html>
