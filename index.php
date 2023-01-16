<?php
    
    require 'header.php';
?>

<?php
require 'conn.php';
if(isset($_SESSION['username'])){
    header("location: main.php");
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
        <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
        <!-- CSS FILES -->
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

            <section class="hero-section d-flex" id="section_1">
                <div class="hero-container container d-flex flex-column justify-content-end">
                    <div class="row h-100">

                        <div class="col-lg-6 col-12 my-auto">
                            <h2>👋 Hi there, Welcome to maitodo</h2>
                            <h1 class="text-white hero-title mb-4">For better organization</h1>
                            <a href="login.php" class="custom-link custom-btn btn mt-4">Login</a>
                        </div>

                    </div>
                </div>
            </section>

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
