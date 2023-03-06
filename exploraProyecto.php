<?php
$titulo = 'Proyectate || Proyectos';
include('./views/template/header.php');
include('./controller/service/proyectos_explore.php');
include('./function/funciones.php');
try {
    $proyectos = [];
    if (isset($_POST['proyecto_buscar_explora'])) {
        $pryectos = getProyectos($_POST['proyecto_buscar_explora']);
    } else {
        $pryectos = getProyectos(false);
    }
} catch (error $e) {
    $error = $e->getMessage();
}
?>

<body class="d-flex flex-column min-vh-100">
    <div>
        <?php include('./views/template/nav_noLogin.php') ?>
    </div>
    <div class="container">
        <div>
            <div class="col-sm-12 mt-3">
                <form class="d-flex" role="search" method="POST">
                    <input class="form-control me-2" type="search" name="proyecto_buscar_explora" id="proyecto_buscar_explora" placeholder="Busca algun proyecto" aria-label="Search">
                    <button class="btn btn-outline-success ml-1" type="submit">Buscar</button>
                </form>
            </div>
        </div>
        <hr>
        <div>
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
        </div>
    </div>
    <div class="mt-auto">
        <?php
        include('./views/template/footer.php')
        ?>
    </div>
</body>