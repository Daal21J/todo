<?php 
require 'header.php';
require "conn.php";
require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
      
if(isset($_SESSION['username'])){
    header("location: main.php");
}

if (isset($_POST['submit'])) {

    if ($_POST['themail'] != '' and $_POST['theusern'] != '' and $_POST['thepass'] != '') {
        //here i retrieve data
        $email = $_POST['themail'];
        $username = $_POST['theusern'];
        $password = $_POST['thepass'];

        $errors = array();
        $query = $conn->prepare("select * from users where email=?");
        $query->execute([$email]);
        $result = $query->rowCount();
        if ($result > 0) {
            $errors['e'] = "email exists already!";
        }
        $quer = $conn->prepare("select * from users where username=?");
        $quer->execute([$username]);
        $res = $quer->rowCount();
        if ($res > 0) {
            $errors['u'] = "username exists already!";
        }

        if (count($errors) == 0) {
            $insert = $conn->prepare("INSERT INTO users (email,username,pass,status) values (:email,:username,:pass,:stat)");
            $insert->execute(
            [
            ':email' => $email,
            ':username' => $username,
            ':pass' => password_hash($password, PASSWORD_BCRYPT),
            ':stat' => 0,
            ]
            );

            $otp = rand(100000,999999);
            $_SESSION['otp'] = $otp;
            $_SESSION['email'] = $email;

         $mail = new PHPMailer(true);
        
         try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'email';                     //SMTP username
            $mail->Password   = 'pass';
            $mail->SMTPOptions = array(
				'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
				)
			);                         
			$mail->SMTPSecure = 'ssl';                           
            //$mail->SMTPSecure='tls';           //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('email', 'OTP verification');
           // $mail->addAddress('email', 'Joe User');     //Add a recipient
            $mail->addAddress($email);               //Name is optional
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');
        
            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Verify your email';
            $mail->Body    = '<p>Dear user, </p> <h3>Your verify OTP code is: '.$otp.' <br></h3>';
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            echo '<script>alert("Email Verification is needed."); 
            window.location.replace("verif.php");
            </script>';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
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
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
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
                                Create account
                            </span>
                        </div>
                        
                        <form method="POST" class="login100-form validate-form" action="register.php">
                            <div class="wrap-input100 validate-input m-b-26" data-validate="Email is required">
                                <span class="label-input100">Email</span>
                                <input class="input100" type="email" name="themail" placeholder="Choose email">
                                <span class="focus-input100"></span>
                            </div>
                            <p class='text-danger'><?php if (isset($errors['e']))
                                echo $errors['e']; 
                                ?></p>
                            <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                                <span class="label-input100">Username</span>
                                <input class="input100" type="text" name="theusern" placeholder="Choose username">
                                <span class="focus-input100"></span>
                            </div>
                            <p class='text-danger'><?php if (isset($errors['u']))
                                echo $errors['u']; 
                                ?></p>
        
                            <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
                                <span class="label-input100">Password</span>
                                <input class="input100" type="password" name="thepass" placeholder="Choose password">
                                <span class="focus-input100"></span>
                            </div>
        
                            <div class="container-login100-form-btn">
                                <button class="login100-form-btn" name="submit">
                                    Register
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
           
        </main>

    

      
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.sticky.js"></script>
        <script src="js/click-scroll.js"></script>
        <script src="js/jquery.magnific-popup.min.js"></script>
        <script src="js/magnific-popup-options.js"></script>
        <script src="js/custom.js"></script>

    </body>
</html>
