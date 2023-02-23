<?php
$sName = "localhost:6060";
$uName = "root";
$pass = "1q2w3e4r5t";
$db_name = "alupros";
try{
    $conn = new PDO (
    "mysql:host=$sName;dbname=$db_name",
    $uName,
    $pass
    );

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo "Conexión fallida: ".$e->getMessage();
}
?>