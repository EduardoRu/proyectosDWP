<?php
session_start();

if(isset($_POST['email']) && isset($_POST['password'])){
    include($_SERVER['DOCUMENT_ROOT'].'/tut/database/config_login.php');

    $email = $_POST['email'];
    $password = $_POST['password'];

    $data = "email=".$email;

    if(empty($email)){
        $em = "Favor de escribir un email valido";
        header("Location: ./login.php?error=$em$data");
        exit;
    }else{
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email]);

        if($stmt->rowCount() == 1){
            $user = $stmt->fetch();

            $uemail = $user['email'];
            $upassword = $user['password'];
            $name = $user['nombre'];
            $id = $user['id_usuarios'];

            if($uemail === $email){
                if(password_verify($password, $upassword)){
                    $_SESSION['id'] = $id;
                    $_SESSION['nombre'] = $name;
                    
                    header("Location: ../../home.php");
                    exit;
                }else{
                    $em = "Contraseña incorrecta";
                    header("Location: ../../login.php?error=$em&$data");
                    exit;
                }
            }else {
                $em = "Email o contraseña incorrectos";
                header("Location: ../../login.php?error=$em&$data");
                exit;
             }
        }else {
            $em = "Email o contraseña incorrectos";
            header("Location: ../../login.php?error=$em&$data");
            exit;
         }
    }
}else {
	header("Location: ../../login.php?error=error");
	exit;
}
