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

            $_SESSION['nombre'] = $user['nombre'];

            header('Location: ./config_user.php');
        }catch(PDOException $error){
            return $error;
        }
    }

    //Actualizar contraseña
    function updateUserPass($userPass, $id){
        include($_SERVER['DOCUMENT_ROOT'] . '/tut/database/config_login.php');
        try{
            $consultaUser = "SELECT * FROM usuarios WHERE id_usuarios = ".$id;
            $setencia = $conn->prepare($consultaUser);
            $setencia->execute();

            $user = $setencia->fetch(PDO::FETCH_ASSOC);

            if(password_verify($userPass['old_password'], $user['password'])){
                $pass = password_hash($userPass['new_password'], PASSWORD_DEFAULT);

                $consultaUpdatePass = "UPDATE usuarios SET password = ? WHERE id_usuarios = ?";
                $setencia_Update = $conn->prepare($consultaUpdatePass);
                $setencia_Update->execute([$pass, $id]);
                
                header('Location: ./config_user.php');
                exit;
            }else{
                return $error = "La contraseña es incorrecta";
            }
        }catch(PDOException $error){
            return $error;
        }
    }
}
