<?php
function getProyectos($typeNomProyecto)
{
    try {
        include($_SERVER['DOCUMENT_ROOT'] . '/tut/database/config_login.php');

        $sql = "";

        if($typeNomProyecto){
            $sql = "SELECT * FROM proyecto WHERE nombre_proyecto LIKE '%". $typeNomProyecto ."%'";
        }else{
            $sql = "SELECT * FROM proyecto";
        }
        

        $sentencia = $conn->prepare($sql);
        $sentencia->execute();

        $proyectos_Alumnos = $sentencia->fetchAll();
        return $proyectos_Alumnos;
    } catch (PDOException $e) {
        return "<h1>Algo ha salido al momento de cargar la infromación <br> error: " . $e . "</h1>";
    }
}
?>