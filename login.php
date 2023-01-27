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

            if($data['status']==0){
            ?>
            <script>alert("Please verify email account before login.");
              window.location.replace("verif.php");
        </script>
          <?php
            }else if (password_verify($password, $data['pass'])) {
                
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
                            <div class="col-md-6 offset-md-4">
                                <a href="pass_recov1.php" class="btn btn-link" style="color:goldenrod; font-size: small;" >
                                    Forgot Your Password?
                                </a>
                            </div>
                            <div class="container-login100-form-btn">
                                <button class="login100-form-btn" name="submit" style="align-self: center;">
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
