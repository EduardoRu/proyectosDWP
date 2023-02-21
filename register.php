<?php include('./views/template/header.php'); ?>

<body>
    <div>
        <?php include('./views/template/nav_noLogin.php') ?>
    </div>
    <div class="d-flex justify-content-center align-items-center mt-5">
        <form action="controller/auth/register.php" class="shadow w-450 p-3" method="post" >
            <h4 class="display-4 fs-1">Crear cuenta</h4>
            <br>
            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_GET['error']; ?>
                </div>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    Tu cuenta se ha creado exitosamente!
                </div>
            <?php } ?>
            <div class="mb-3">
                <label for="" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="unombre" value="<?php echo (isset($_GET['unombre'])) ? $_GET['unombre'] : "" ?>">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Apellido</label>
                <input type="text" class="form-control" name="uapellido" value="<?php echo (isset($_GET['uapellido'])) ? $_GET['uapellido'] : "" ?>">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Email</label>
                <input type="text" class="form-control" name="uemail" value="<?php echo (isset($_GET['uemail'])) ? $_GET['uemail'] : "" ?>">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="upassword">
            </div>

            <div style="display:flex; justify-content:center">
                <button type="submit" class="btn btn-primary">Registrate</button>
                <a href="./login.php" class="link-secondary ml-3 mt-2">Login</a>
            </div>
        </form>
    </div>
    <div style="margin-top:5%">
        <?php include('./views/template/footer.php') ?>
    </div>
</body>