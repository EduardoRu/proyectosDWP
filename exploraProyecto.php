<?php
$titulo = 'Proyectate || Proyectos';
include('./views/template/header.php');
include('./controller/service/proyectosExplore.php');
include('./function/funciones.php');
try {
    $proyectos = [];
    if (isset($_POST['proyecto_buscar'])) {
        $pryectos = getProyectos($_POST['proyecto_buscar']);
    } else {
        $pryectos = getProyectos("");
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

        </div>
    </div>
    <div class="mt-auto">
        <?php
        include('./views/template/footer.php')
        ?>
    </div>
</body>