<?php 
        require 'header.php';
 ?>

<?php 
require "conn.php";

if(isset($_SESSION['username'])){

    header("location: main.php");

}

if (isset($_POST['verify'])) {
    
    $otp = $_SESSION['otp'];
    $email = $_SESSION['email'];
    $otp_code = $_POST['otp_code'];

    if($otp != $otp_code){
    ?>
       <script>
           alert("Invalid OTP code");
       </script>
    <?php
    }else{
        $sql = "UPDATE users SET status=? WHERE email=?";
        $stmt= $conn->prepare($sql);
        $stmt->execute([1, $email]);

            ?>
             <script>
                 alert("Account verified, you may log in now ♡");
                   window.location.replace("login.php");
             </script>
             <?php
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
                                Mail verification
                            </span>
                        </div>
        
                        <form class="login100-form validate-form" method="post">
                            <div class="wrap-input100 validate-input m-b-26" data-validate="OTP is required">
                                <span class="label-input100">OTP</span>
                                <input class="input100" type="number" name="otp_code" placeholder="Enter OTP">
                                <span class="focus-input100"></span>
                            </div>
                            <span class="text-danger"><?php /*if (isset($error['u'])){
                                echo $error['u'];}elseif(isset($error['p'])){
                                    echo $error['p'];
                                } */?></span>
                            <div class="container-login100-form-btn">
                                <button class="login100-form-btn" name="verify">
                                    Verify
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
