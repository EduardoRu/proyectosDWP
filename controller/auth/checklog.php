<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
include($_SERVER['DOCUMENT_ROOT']."/tut/database/config_login.php");
$loginst = 0;

if(isset($_SESSION['id'])){
    $user_check_id = $_SESSION['id'];

    $consultaSQL = "SELECT * FROM usuarios WHERE id_usuarios = ".$user_check_id;
    $sentencia = $conn->prepare($consultaSQL);

    $sentencia->execute();
    $usuario_logged = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    $login_user = $usuario_logged[0]['id_usuarios'];

    if(!empty($login_user)){
        $loginst = 1; 
    }
}
?>