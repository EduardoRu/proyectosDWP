<?php
session_start();
if (isset($_SESSION['id']) && $_SESSION['nombre']) {
    include('./controller/service/proyectoCRUD.php');
    include('./function/funciones.php');
    $error = false;
    //header("refresh: 0");
    // Obtener la infromaicón de los proyectos
    try {
        $proyectos = [];
        if(isset($_POST['proyecto_buscar'])){
            $pryectos = getProyectos($_SESSION['id'], $_POST['proyecto_buscar']);
        }else{
            $pryectos = getProyectos($_SESSION['id'], "");
        }
    } catch (error $e) {
        $error = $e->getMessage();
    }
    // Obtener la infromación del modal con los datos para un nuevo proyecto
    if (isset($_POST['submit_create'])) {

        $resultado = [
            'error' => false,
            'mensaje' => 'Proyecto ' . escapar($_POST['nombre_pro']) . '  ha sido agregado con éxito'
        ];

        $direccion = "./storage/proyectos_user/" . $_SESSION['id'] . "-" . $_SESSION['nombre'];
        $fileDestiantion = "";

        $file = $_FILES['img_pro'];
        $fileName = $_FILES['img_pro']['name'];
        $fileTempName = $_FILES['img_pro']['tmp_name'];
        $fileSize = $_FILES['img_pro']['size'];
        $fileError = $_FILES['img_pro']['error'];
        $fileType = $_FILES['img_pro']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $extPermititdas = array('jpg', 'jpeg', 'png');
        if (in_array($fileActualExt, $extPermititdas)) {
            if ($fileError == 0) {
                if ($fileSize < 1000000) {
                    $fileNameNew = uniqid('', true) . "." . $fileActualExt;

                    $fileDestiantion = $direccion . "/" . $fileNameNew;

                    move_uploaded_file($fileTempName, $fileDestiantion);
                }
            }
        }

        $proyecto = [
            "id_usuario"        => $_SESSION['id'],
            "nombre_proyecto"   => $_POST['nombre_pro'],
            "descripcion"       => $_POST['desc'],
            "imagen_src"        => $fileDestiantion,
            "correo_proyecto"   => $_POST['email'],
            "telefono"          => $_POST['tel']
        ];

        createProyecto($proyecto);
    }

    // Eliminar proyecto id_del_pro
    if (isset($_POST['submit_del_pro'])) {
        $resultado = [
            'error' => false,
            'mensaje' => 'Proyecto ha sido borrado con éxito'
        ];

        deleteProyecto($_POST['id_del_pro'], $_SESSION['id']);
    }

    // actualizar
    if($pryectos){
        foreach ($pryectos as $pros) {
            if (isset($_POST['submit_edit_' . $pros['id_proyecto']])) {

                $direccion = "./storage/proyectos_user/" . $_SESSION['id'] . "-" . $_SESSION['nombre'];
                $fileDestiantion = "";
                $proyecto = [
                    'id_proyecto'       => $pros['id_proyecto'],
                    'id_usuario'        => $_SESSION['id'],
                    'nombre_proyecto'   => $_POST['nombre_pro_edit_' . $pros['id_proyecto']],
                    'descripcion'       => $_POST['desc_edit_' . $pros['id_proyecto']],
                    'imagen_src'        => $pros['imagen_src'],
                    "correo_proyecto"   => $_POST['email_edit_' . $pros['id_proyecto']],
                    "telefono"          => $_POST['tel_edit_' . $pros['id_proyecto']]
                ];
            
                $file = $_FILES['img_pro_edit_' . $pros['id_proyecto']];
                $fileName = $_FILES['img_pro_edit_' . $pros['id_proyecto']]['name'];
                $fileTempName = $_FILES['img_pro_edit_' . $pros['id_proyecto']]['tmp_name'];
                $fileSize = $_FILES['img_pro_edit_' . $pros['id_proyecto']]['size'];
                $fileError = $_FILES['img_pro_edit_' . $pros['id_proyecto']]['error'];
                $fileType = $_FILES['img_pro_edit_' . $pros['id_proyecto']]['type'];
            
                $fileExt = explode('.', $fileName);
                $fileActualExt = strtolower(end($fileExt));
            
                $extPermititdas = array('jpg', 'jpeg', 'png');
                if (in_array($fileActualExt, $extPermititdas)) {
                    if ($fileError == 0) {
                        if ($fileSize < 1000000) {
                            $fileNameNew = uniqid('', true) . "." . $fileActualExt;
            
                            $fileDestiantion = $direccion . "/" . $fileNameNew;
            
                            if ($fileDestiantion != $pros['imagen_src']) {
                                unlink($pros['imagen_src']);
                                move_uploaded_file($fileTempName, $fileDestiantion);
            
                                $proyecto = [
                                    'id_proyecto'       => $pros['id_proyecto'],
                                    'id_usuario'        => $_SESSION['id'],
                                    'nombre_proyecto'   => $_POST['nombre_pro_edit_' . $pros['id_proyecto']],
                                    'descripcion'       => $_POST['desc_edit_' . $pros['id_proyecto']],
                                    'imagen_src'        => $fileDestiantion,
                                    "correo_proyecto"   => $_POST['email_edit_' . $pros['id_proyecto']],
                                    "telefono"          => $_POST['tel_edit_' . $pros['id_proyecto']]
                                ];
                            }
                        }
                    }
                }
                
                editProyecto($proyecto);
            }
        }
    }

?>
    <?php include('./views/template/header.php') ?>

    <body class="d-flex flex-column min-vh-100">
        <div>
            <?php include('./views/template/nav_login.php') ?>
        </div>
        <!-- Barra principal, aquí es posible administrar nuevos proyectos así como mostrar su busqueda -->
        <section class="mt-1">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3 mt-1">
                        <h1>Mis proyectos</h1>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <form class="d-flex" role="search" method="POST">
                            <input class="form-control me-2" type="search" name="proyecto_buscar" id="proyecto_buscar" placeholder="Busca tu proyecto" aria-label="Search">
                            <button class="btn btn-outline-success ml-1" type="submit">Buscar</button>
                        </form>
                    </div>
                    <div class="col-sm-3 mt-3">
                        <section>
                            <?php include('./views/template/form.php') ?>
                        </section>
                    </div>
                </div>
                <hr>
                <?php
                if ($error) {
                ?>
                    <div class="container mt-2">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger" role="alert">
                                    <?= $error ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
                <?php
                if (isset($resultado)) {
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
            </div>
        </section>
        <!-- Mostrado de los proyectos -->
        <section>
            <div class="container mt-1 mb-4 overflow-hidden">
                <div class="row gy-5">
                    <?php
                    if ($pryectos) {
                        foreach ($pryectos as $pros) {
                    ?>
                            <div class="col-sm-4 mt-2">
                                <div class="card border border-secondary-subtle shadow">
                                    <img src="<?php echo escapar($pros['imagen_src']) ?>" class="card-img-top img-fluid" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo escapar($pros['nombre_proyecto']) ?></h5>
                                        <p class="card-text">
                                        <h5>Descripción</h5>
                                        <?php echo escapar($pros['descripcion']) ?>
                                        <h5>Contactos</h5>
                                        <i class="bi bi-envelope"></i> <?php echo escapar($pros['correo_proyecto']) ?>
                                        <br>
                                        <i class="bi bi-telephone"></i> <?php echo escapar($pros['telefono']) ?>
                                        </p>
                                        <div class="card-footer text-muted ">
                                            <?php include('./views/template/form_edit.php'); ?>
                                            <div>
                                                <div class="mt-2">
                                                    <form method="POST">
                                                        <input type="number" value="<?php echo $pros['id_proyecto'] ?>" name="id_del_pro" id="id_del_pro" class="btn btn-primary" hidden>
                                                        <input type="submit" name="submit_del_pro" id="submit_del_pro" value="Eliminar" class="btn btn-primary" style="width:100%">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    <?php    }
                    } else {
                        echo "<h5>Aun no hay proyectos registrados <br><br> <b>comeinza agregando uno</b></h5>";
                    }
                    ?>
                </div>
            </div>
        </section>
        <div class="mt-auto">
            <?php include('./views/template/footer.php'); ?>
        </div>
    </body>

<?php
    
} else {
    header("Location: ./login.php");
    exit;
} ?>