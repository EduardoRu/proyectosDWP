<?php
session_start();
if (isset($_SESSION['id']) && $_SESSION['nombre']) {
    include('./controller/service/proyectoCRUD.php');
    include('./function/funciones.php');
    $error = false;
    // Obtener la infromaicón de los proyectos
    try {
        $pryectos = getProyectos($_SESSION['id']);
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

    if(isset($_POST['submit_edit'])){

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
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Busca tu proyecto" aria-label="Search">
                            <button class="btn btn-outline-success ml-1" type="submit">Buscar</button>
                        </form>
                    </div>
                    <div class="col-sm-3 mt-3">
                        <button type="button" class="btn bg-success text-light border rounded-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="bi bi-folder-plus"> <b>Crear un proyecto</b></i>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="modal-title fs-5" id="exampleModalLabel">Agrega un nuevo proyecto</h2>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" name="userData" id="userData" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="nombre_pro">Nombre del proyecto</label>
                                                <input type="text" name="nombre_pro" id="nombre_pro" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="desc">Descripción del proyecto</label>
                                                <textarea type="text" name="desc" id="desc" class="form-control" required> </textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="img_pro">Imagen del proyecto</label>
                                                <input type="file" name="img_pro" id="img_pro" class="form-control border border-0" accept="image/*" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email del creador</label>
                                                <input type="text" name="email" id="email" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="tel">telefono del creador</label>
                                                <input type="number" name="tel" id="tel" class="form-control" required>
                                            </div>
                                            <div style="display:flex;justify-content:center">
                                                <button type="button" class="btn btn-secondary mr-2" data-bs-dismiss="modal">Cancelar</button>
                                                <input type="submit" name="submit_create" class="btn btn-primary" value="Guardar proyecto">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                        <?php echo escapar($pros['correo_proyecto']) ?>
                                        </p>
                                        <div class="card-footer text-muted ">
                                            <div class="">
                                                <!-- Button trigger modal -->
                                                <div class="">
                                                    <button type="button" class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#exampleModal_edit">
                                                        Editar
                                                    </button>
                                                </div>
                                                <div class="modal fade" id="exampleModal_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Editar proyecto</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="post" name="userDataEdit" id="userDataEdit" enctype="multipart/form-data">
                                                                    <div class="form-group">
                                                                        <input type="number" name="id_pro" id="id_pro" class="form-control" value="<?= escapar($pros['id_proyecto']) ?>" hidden>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="nombre_pro">Nombre del proyecto</label>
                                                                        <input type="text" name="nombre_pro" id="nombre_pro" class="form-control" required value="<?= escapar($pros['nombre_proyecto']) ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="desc">Descripción del proyecto</label>
                                                                        <textarea type="text" name="desc" id="desc" class="form-control" required><?= escapar($pros['descripcion']) ?></textarea>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="img_pro">Imagen del proyecto</label>
                                                                        <input type="file" name="img_pro" id="img_pro" class="form-control border border-0" accept="image/*" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="email">Email del creador</label>
                                                                        <input type="text" name="email" id="email" class="form-control" value="<?= escapar($pros['correo_proyecto']) ?>" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="tel">telefono del creador</label>
                                                                        <input type="number" name="tel" id="tel" class="form-control" value="<?= escapar($pros['telefono']) ?>" required>
                                                                    </div>
                                                                    <div style="display:flex;justify-content:center">
                                                                        <button type="button" class="btn btn-secondary mr-2" data-bs-dismiss="modal">Cancelar</button>
                                                                        <input type="submit" name="submit_edit" class="btn btn-primary" value="Guardar proyecto">
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

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