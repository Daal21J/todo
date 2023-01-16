<?php
try{
$host="localhost";
$dbname="maitodo";
$user="root";
$pass="";
$port = "3308";
$charset = 'utf8mb4';
//$dsn = "mysql:host=$host;dbname=$dbname;port=$port;charset=$charset;";

$conn=new PDO("mysql:host=$host;dbname=$dbname;port=$port", $user, $pass);
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo "error is " . $e->getMessage();
}

?>
