<nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark">
    <div class="container-fluid" style="display:flex">
        <a href="/tut/home.php" class="navbar-brand text-light ml-5">
            Inicio
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list" style="font-size: 30px; color: white;"></i>
        </button>
        <div class="collapse navbar-collapse mr-5 pr-3" id="navbarNav" style="justify-content:end">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Perfil
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="./views/auth/config_usuario.php">Configuración</a></li>
                        <li><a class="dropdown-item" href="./controller/auth/logout.php">Cerrar sesión</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>