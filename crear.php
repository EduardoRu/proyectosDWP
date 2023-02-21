<?php include('./function/funciones.php') ?>
<?php
if(isset($_POST['submit'])){
    $resultado = [
        'error' => false,
        'mensaje' => 'Usuario '.escapar($_POST['nombre']).'  ha sido agregado con éxito'
    ];

    $config = include('./database/config.php');

    try{
        $dns = 'mysql:host='
        .$config['db']['host']
        .';dbname='.$config['db']['name'];

        $conn = new PDO(
            $dns, 
            $config['db']['user'],
            $config['db']['pass'],
            $config['db']['options']);

        // Codigo que insertara al alumnbo

        $alumno = [
            "nombre"    => $_POST['nombre'],
            "apellido"  => $_POST['apellido'],
            "email"     => $_POST['email'],
            "edad"      => $_POST['edad']
        ];

        $consultaSQL = "INSERT INTO alumnos 
        (nombre, apellido, email, edad) VALUES
        (:".implode(", :", array_keys($alumno)).")";

        $sentencia = $conn->prepare($consultaSQL);
        $sentencia->execute($alumno);

    }catch(PDOException $error){
        $resultado['error'] = true;
        $resultado['mensaje'] = $error->getMessage();
    }
}
?>
<?php include('./template/header.php');?>
<?php 
if(isset($resultado)){
    ?>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-<?= $resultado['error'] ? 'danger' : 'success' ?>" role="alert">
                <?= $resultado['mensaje'] ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mt-4">Crear un alumno</h2>
            <hr>
            <form method="POST">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control">
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" name="apellido" id="apellido" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="edad">Edad</label>
                    <input type="text" name="edad" id="edad" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-primary" value="Crear">
                    <a href="./index.php" class="btn btn-primary"> Regresar </a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include('./template/footer.php');?>