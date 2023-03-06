<?php
if (isset($_SESSION['id']) && $_SESSION['nombre']) {
    function getProyectos($id, $typeNomProyecto)
    {
        try {
            include($_SERVER['DOCUMENT_ROOT'] . '/tut/database/config_login.php');

            $sql = "";

            if($typeNomProyecto){
                $sql = "SELECT * FROM proyecto WHERE id_usuario = $id AND nombre_proyecto LIKE '%". $typeNomProyecto ."%'";
            }else{
                $sql = "SELECT * FROM proyecto WHERE id_usuario = " . $id;
            }
            

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

    function editProyecto($arrNew)
    {
        include($_SERVER['DOCUMENT_ROOT'] . '/tut/database/config_login.php');

        $proyecto = [
            'id_proyecto'       =>  $arrNew['id_proyecto'],
            'nombre_proyecto'   => $arrNew['nombre_proyecto'],
            'descripcion'       => $arrNew['descripcion'],
            'imagen_src'        => $arrNew['imagen_src'],
            'correo_proyecto'   => $arrNew['correo_proyecto'],
            'telefono'          => $arrNew['telefono']
        ];

        $consultaSQL = "UPDATE proyecto SET 
        nombre_proyecto = :nombre_proyecto,
        descripcion = :descripcion,
        imagen_src = :imagen_src,
        correo_proyecto = :correo_proyecto,
        telefono = :telefono,
        updated_at = NOW()
        WHERE id_proyecto = :id_proyecto";


        $sentecia = $conn->prepare($consultaSQL);
        $sentecia->execute($proyecto);

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
