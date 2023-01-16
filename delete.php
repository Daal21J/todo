<?php
require "conn.php";

if(!isset($_SESSION['username'])){
    header("location: index.php");
}

if(isset($_GET['del_id'])){

    $id = $_GET['del_id'];
    $delete = $conn->prepare("delete from tasks where idTask=:id");
    $delete->execute([':id' => $id]);

    header("location: main.php");

}
?>