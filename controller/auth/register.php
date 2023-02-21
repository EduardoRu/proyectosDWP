<?php
if(
    isset($_POST['unombre']) &&
    isset($_POST['uapellido']) &&
    isset($_POST['uemail']) &&
    isset($_POST['upassword'])
){
    include($_SERVER['DOCUMENT_ROOT']."/tut/database/config_login.php");

    $unombre    = $_POST['unombre'];
    $uapellido  = $_POST['uapellido'];
    $uemail     = $_POST['uemail'];
    $upass      = $_POST['upassword'];

    $data = "unombre=".$unombre."&uemail=".$uemail;

    if(empty($unombre)){
        $em = "El nombre es requerido";
        header("Location: ./register.php?=error$em&$data");
        exit;
    }else if(empty($uapellido)){
        $em = "El apellido es requerido";
        header("Location: ./register.php?=error$em&$data");
        exit;
    }else if(empty($uemail)){
        $em = "El email es requerido";
        header("Location: ./register.php?=error$em&$data");
        exit;
    }else if(empty($upass)){
        $em = "La contraseña es requerida";
        header("Location: ./register.php?=error$em&$data");
        exit;
    }else{
        $pass = password_hash($upass, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nombre, apellido, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(
            [
                $unombre, 
                $uapellido, 
                $uemail,
                $pass
            ]
            );

        header("Location: ../../register.php?success=Tu cuenta se ha creado exitosamente");
        exit;
    }
}else{
    header("Location: ./register.php?error=error");
    exit;
}
?>