<?php
session_start();
?>


<section class="preloader">
            <div class="spinner">
                <span class="spinner-rotate">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                    </svg>
                </span>    
            </div>
</section>

        <nav class="navbar navbar-expand-lg">
            <div class="container">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a href="index.php" class="navbar-brand mx-auto mx-lg-0">
                    <i class="bi-heart brand-icon"></i>
                    <span>MaiTodo</span>
                </a>

                <div class="collapse navbar-collapse" id="navbarNav">
                    
                    <?php if(!isset($_SESSION['username'])): ?>
                        <ul class="navbar-nav ms-auto">
                         <li class="nav-item">
                             <a class="nav-link click-scroll" href="login.php">Login</a>   
                         </li>
                         <li class="nav-item">
                            <a class="nav-link click-scroll" href="register.php">Register</a>
                         </li>
                        </ul>

                        <?php else:  ?>
                          <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                            <a class="nav-link click-scroll">Hello <?php echo $_SESSION['username'];?></a>
                            </li>
                            <li class="nav-item">
                             <a class="nav-link click-scroll" href="logout.php">Log Out</a>
                            </li>
                           </ul>
                    <?php endif; ?>
                    
                </div>

            </div>
        </nav>