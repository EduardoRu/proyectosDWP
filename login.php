<?php include('./views/template/header.php') ?>

<body class="d-flex flex-column min-vh-100">
    <div class="">
        <?php include('./views/template/nav_noLogin.php') ?>
    </div>
    <div class="d-flex justify-content-center align-items-center mt-5 mb-5">
        <form action="./controller/auth/login.php" class="shadow w-300 p-3" method="POST">
            <h4 class="display-4 fs-1">Inicio de sesión</h4>
            <br>
            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_GET['error']; ?>
                </div>
            <?php } ?>
            <div class="mb-3">
                <label for="" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" value="<?php echo (isset($_GET['email'])) ? $_GET['email'] : "" ?>">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="password">
            </div>

            <div class="d-grid gap-2 col-6 mx-auto" style="display:flex;justify-content:center;">
                <button type="submit" class="btn btn-primary"> Login </button>
            </div>

        </form>
    </div>
    <div class="mt-auto">
        <?php include('./views/template/footer.php') ?>
    </div>
</body>