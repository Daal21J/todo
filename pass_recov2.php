<?php 
        require 'header.php';
 ?>

<?php 
require "conn.php";

if(isset($_SESSION['username'])){

    header("location: main.php");

}

if(!isset($_SESSION['token'])){
    header("location: main.php");

}

?>

    <body>



        <main>
            <div class="limiter">
                <div class="container-login100">
                    <div class="wrap-login100">
                        <div class="login100-form-title" style="background-image: url(images/bg-01.jpg);">
                            <span class="login100-form-title-1">
                                Password recovery
                            </span>
                        </div>
        
                        <form class="login100-form validate-form" method="post">
                        <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
                                <span class="label-input100">Password</span>
                                <input class="input100" type="password" name="thepass" placeholder="Enter password">
                                <span class="focus-input100"></span>
                            </div>
                            <span class="text-danger"><?php /*if (isset($error['u'])){
                                echo $error['u'];}elseif(isset($error['p'])){
                                    echo $error['p'];
                                } */?></span>
                            <div class="container-login100-form-btn">
                                <button class="login100-form-btn" name="p_verify">
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
<?php
    if(isset($_POST['p_verify'])){

        $psw = $_POST["thepass"];
        $token = $_SESSION['token'];
        $Email = $_SESSION['email'];

        $hash = password_hash( $psw , PASSWORD_BCRYPT);
        $login = $conn->query("select * from users where email='$Email'");
        $login->execute();
        $data = $login->fetch(PDO::FETCH_ASSOC);

        if($Email){
            $new_pass = $hash;
            $sql = "UPDATE users SET pass=? WHERE email=?";
            $stmt= $conn->prepare($sql);
            $stmt->execute([$new_pass, $Email]);
            ?>
            <script>
                window.location.replace("login.php");
                alert("<?php echo "Your password has been successfuly reset."?>");
            </script>
            <?php
        }else{
            ?>
            <script>
                alert("<?php echo "Please try again."?>");
            </script>
            <?php
        }
    }