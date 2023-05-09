<?php
try {
$pdo=new PDO("mysql:localhost;dbname=my_gallery","root","");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// echo "Connection Established";
}catch(PDOException $e){
    echo "ERROR : could not connect to ".$e->getMessage();
}
?>