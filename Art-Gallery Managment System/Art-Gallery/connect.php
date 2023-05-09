<?php
try {
    if(!isset($_SESSION)){session_start();}
$pdo=new PDO("mysql:localhost;dbname=my_gallery1","root","");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// echo "Connection Established";
}catch(PDOException $e){
    echo "ERROR : could not connect to ".$e->getMessage();
}
?>