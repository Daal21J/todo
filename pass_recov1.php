<?php 
require 'header.php';
require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
 ?>

<?php 
require "conn.php";

if(isset($_SESSION['username'])){

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
                            <div class="wrap-input100 validate-input m-b-26" data-validate="Email is required">
                                <span class="label-input100">Email</span>
                                <input class="input100" type="email" name="email" placeholder="Enter email">
                                <span class="focus-input100"></span>
                            </div>
                            <span class="text-danger"><?php /*if (isset($error['u'])){
                                echo $error['u'];}elseif(isset($error['p'])){
                                    echo $error['p'];
                                } */?></span>
                            <div class="container-login100-form-btn">
                                <button class="login100-form-btn" name="send">
                                    Send
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
if (isset($_POST['send'])) {

    $email = $_POST["email"];
    $login = $conn->query("select * from users where email='$email'");
    $login->execute();
    $data = $login->fetch(PDO::FETCH_ASSOC);

    if ($login->rowCount() < 0) {
        ?>
            <script>
                alert("<?php echo "This email doesn't exist. " ?>");
            </script>
            <?php

    } else if ($data['status'] == 0) {
        ?>
            <script>alert("Please verify your account before.");
              window.location.replace("verif.php");
        </script>
          <?php
    } else {
        // generate token by binaryhexa 
        $token = bin2hex(random_bytes(50));

        //session_start ();
        $_SESSION['token'] = $token;
        $_SESSION['email'] = $email;
        $mail = new PHPMailer(true);

        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP(); //Send using SMTP
            $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
            $mail->SMTPAuth = true; //Enable SMTP authentication
            $mail->Username = 'pro17dal03@gmail.com'; //SMTP username
            $mail->Password = 'oinrspxfkhsvanzd';
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->SMTPSecure = 'ssl';
            //$mail->SMTPSecure='tls';           //Enable implicit TLS encryption
            $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('pro17dal03@gmail.com', 'OTP verification');
            // $mail->addAddress('pro17dal03@gmail.com', 'Joe User');     //Add a recipient
            $mail->addAddress($email); //Name is optional

            // HTML body
            $mail->isHTML(true);
            $mail->Subject = "Recover your password";
            $mail->Body = "<b>Dear User</b>
                 <h3>We received a request to reset your password.</h3>
                 <p>Kindly click the below link to reset your password</p>
                 http://localhost/todo/pass_recov2.php
                 <br><br>";

            $mail->send();
            echo '<script>alert("Please check your email."); 
                   </script>';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }


    }
}
?>
