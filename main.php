<?php 
  require 'header.php';
  require 'conn.php';
  $idOwner = $_SESSION['id'];

  $data = $conn->query("select * from tasks where idPerson = '$idOwner'");

  if(!isset($_SESSION['username'])){
     header("location: index.php");
   }
  
  ?>

  <?php
    
    $insert = $conn->prepare("insert into tasks (idPerson,theTask) values (:id,:task)");
  if (isset($_POST['add'])) {
    if ($_POST['myTask'] != '') {
      $task = $_POST['myTask'];
  
      $insert->execute(
        [
        ':id' => $idOwner,
        ':task' => $task,
        ]
        );

      header("Refresh:0");
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
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&family=Playfair+Display&display=swap" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-icons.css" rel="stylesheet">
        <link href="css/magnific-popup.css" rel="stylesheet">
        <link href="css/tooplate-wedding-lite.css" rel="stylesheet">
        <link href="css/table.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">

    </head>
    
    <body>
        <main>
            <div class="container-login100">
            <div class="container-x">
                <div class="t" style="margin-bottom: 2%;">
                    <form class="form-inline" method="post">                     
                        <input type="text" id="mytask" placeholder="Enter task" style="width: 500px;" name="myTask"> 
                             <button class="button-3" type="submit" name="add">+</button>            
                    </form>
                </div>
                <ul class="responsive-table">
                  <li class="table-header">
                    <div class="col-6" style="text-align: center;">Task</div>
                    <div class="col-6" style="text-align: center;">Action</div>
                    
                  </li>
                  <?php while ($rows = $data -> fetch(PDO::FETCH_OBJ)): ?>
                  <li class="table-row">
                    <div class="col-6" style="text-align: center; overflow-wrap: break-word;" data-label="Task"><?php echo $rows->theTask; ?></div>
                    <div class="col-6" style="text-align: center;" data-label="Action">
                        <a href="delete.php?del_id=<?php echo $rows->idTask;?>" class="button-3">Delete</a>
                    </div>
                  </li> 
                  <?php endwhile;?>
                  
                </ul>
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
