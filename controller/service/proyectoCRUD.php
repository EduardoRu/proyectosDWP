<?php
if (isset($_SESSION['id']) && $_SESSION['nombre']) {
    function getProyectos($id)
    {
        try {
            include($_SERVER['DOCUMENT_ROOT'] . '/tut/database/config_login.php');
            $sql = "SELECT * FROM proyecto WHERE id_usuario = " . $id;

            $sentencia = $conn->prepare($sql);
            $sentencia->execute();

            $proyectos_Alumnos = $sentencia->fetchAll();
            return $proyectos_Alumnos;
        } catch (PDOException $e) {
            return "<h1>Algo ha salido al momento de cargar la infromación <br> error: " . $e . "</h1>";
        }
    }

    function createProyecto($arrayProyecto)
    {
        try {
            include($_SERVER['DOCUMENT_ROOT'] . '/tut/database/config_login.php');

            $sql = "INSERT INTO proyecto (id_usuario, nombre_proyecto, descripcion, imagen_src, correo_proyecto, telefono)
            VALUES (:" . implode(", :", array_keys($arrayProyecto)) . ")";

            $setencia = $conn->prepare($sql);
            $setencia->execute($arrayProyecto);

            header('Location: ./home.php');
        } catch (PDOException $e) {
            return "<h1>Algo ha salido mal al momento de crear la infromación <br> error:" . $e . "</h1>";
        }
    }

    function editProyecto($id_pro, $id_user)
    {
        include($_SERVER['DOCUMENT_ROOT'] . '/tut/database/config_login.php');

        

        header('Location: ./home.php');
    }

    function deleteProyecto($id_pro, $id_user){
        include($_SERVER['DOCUMENT_ROOT'] . '/tut/database/config_login.php');
        // Consulta para selecciónar el proyecto
        $SQLSelect = "SELECT * FROM proyecto WHERE id_proyecto = ".$id_pro." AND id_usuario = ".$id_user;
        $sentencia_select = $conn->prepare($SQLSelect);
        $sentencia_select->execute();

        $proyecto = $sentencia_select->fetchAll();
        
        // Función para eliminar
        unlink($proyecto[0]['imagen_src']);
        
        // Eliminar el registro de la base de datos
        $SQLDELETE = "DELETE FROM proyecto WHERE id_proyecto = ".$id_pro." AND id_usuario = ".$id_user;
        $sentencia_delete = $conn->prepare($SQLDELETE);
        $sentencia_delete->execute();

        header('Location: ./home.php');
        
    }

} else {
    header("Location: ./login.php");
    exit;
}
