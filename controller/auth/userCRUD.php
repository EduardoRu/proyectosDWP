<?php 
if (isset($_SESSION['id']) && $_SESSION['nombre']) {
    function getUser($id){
        include($_SERVER['DOCUMENT_ROOT'] . '/tut/database/config_login.php');
        try{
            $consultaSQLUser = "SELECT * FROM usuarios WHERE id_usuarios = ".$id;
            $sentecia = $conn->prepare($consultaSQLUser);
            $sentecia->execute();

            $user = $sentecia->fetch(PDO::FETCH_ASSOC);
            return $user;
        }catch(PDOException $error){
            return $error;
        }
    }

    //Actualizar datos
    function updateUserData($user, $id){
        include($_SERVER['DOCUMENT_ROOT'] . '/tut/database/config_login.php');
        try{
            $consultaUpdateUserData = "UPDATE usuarios SET
            nombre = :nombre,
            apellido = :apellido,
            email = :email,
            updated_at = NOW()
            WHERE id_usuarios =".$id;

            $sentencia = $conn->prepare($consultaUpdateUserData);
            $sentencia->execute($user);

            header('Location: ./config_user.php');
        }catch(PDOException $error){
            return $error;
        }
    }

    //Actualizar contraseña
    function updateUserPass($userPass, $id){

    }
}
