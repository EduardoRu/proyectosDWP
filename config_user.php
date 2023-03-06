<?php
session_start();
if (isset($_SESSION['id']) && $_SESSION['nombre']) {
    include('./function/funciones.php');
    include('./controller/auth/userCRUD.php');

    try {
        $usuario = getUser($_SESSION['id']);
    } catch (PDOException $error) {
        $e = $error;
    }

    //Actualizar datos generales
    if(isset($_POST['submit_data_user'])){
        $user_Update = [
            'nombre'        => $_POST['name_user'],
            'apellido'      => $_POST['lastname_user'],
            'email'         => $_POST['email_user']
        ];

        updateUserData($user_Update, $_SESSION['id']);
    }
    //Actualizar contraseña
    if(isset($_POST['submit_pass_user'])){
        $user_Update_Pass = [
            'old_password'      => $_POST['pass_user_old'],
            'new_password'      => $_POST['pass_user_new']
        ];
    }
?>

    <?php
    $titulo = 'Proyectate || Configuración';
    include('./views/template/header.php');
    ?>

    <body class="d-flex flex-column min-vh-100">
        <div>
            <?php include('./views/template/nav_noLogin.php') ?>
        </div>
        <!-- Cuerpo de la estructura para la configuración del usuario -->
        <section>
            <div class="container mt-2 mb-2">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center">Datos del usuario "<?php echo $_SESSION['nombre'] ?>"</h5>
                    </div>
                    <div class="card-body">
                        <div>
                            <h5 class="text-center"> Edita tus datos </h5>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-7 mt-2">
                                <h6>Datos generales</h6>
                                <hr>
                                <form method="post">
                                    <div class="mb-3 row">
                                        <label for="name_user" class="col-sm-2 col-form-label">Nombre</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="name_user" name="name_user" placeholder="Nombre" value="<?= escapar($usuario['nombre']) ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="lastname_user" class="col-sm-2 col-form-label">Apellido</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="lastname_user" name="lastname_user" placeholder="Apellido" value="<?= escapar($usuario['apellido']) ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="email_user" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="email_user" name="email_user" placeholder="Correo electronico" value="<?= escapar($usuario['email']) ?>" required>
                                        </div>
                                    </div>

                                    <hr class="mt-2 mb-2">
                                    <div class="d-grid gap-2">
                                        <input type="submit" class="btn btn-success form-control" name="submit_data_user" id="submit_data_user" value="Guardar cambios">
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-5 mt-2">
                                <h6>Cambia tu contraseña</h6>
                                <hr>
                                <form method="post">
                                    <div class="mb-3 row">
                                        <label for="pass_user_old" class="col-sm-3 col-form-label">Contraseña antigua</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="pass_user_old" name="pass_user_old" placeholder="Antigua contraseña">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="pass_user_new" class="col-sm-3 col-form-label">Contraseña nueva</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="pass_user_new" name="pass_user_new" placeholder="Nueva contraseña">
                                        </div>
                                    </div>
                                    <hr class="mt-2 mb-1">
                                    <div class="d-grid gap-2 pt-2">
                                        <input type="submit" class="btn btn-success form-control" name="submit_pass_user" id="submit_pass_user" value="Actualizar contraseña">
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <div class="mt-auto">
            <?php include('./views/template/footer.php') ?>
        </div>
    </body>
<?php
} else {
    header("Location: ./login.php?error=error");
    exit;
}
?>