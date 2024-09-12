<nav style="display: flex; justify-content: space-around; align-items: center;">
    <a href="./?lang=<?= $_REQUEST['lang'] ?? 'gl' ?>" class="nav-link"
        style="text-align: center; margin-right: 10px;">Inicio</a>
    <a href="./?page=ships&lang=<?= $_REQUEST['lang'] ?? 'gl' ?>" class="nav-link"
        style="text-align: center; margin-right: 10px;">Naves</a>
    <a href="./?page=change_password&lang=<?= $_REQUEST['lang'] ?? 'gl' ?>" class="nav-link"
        style="text-align: center; margin-right: 10px;">Cambiar contraseña</a>
    <a href="./admin/logout_session.php" class="enlace_cierre_sesion" style="display: flex; align-items: center;"
        title="Cerrar sesión">
        <img src="data:image/png;base64,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"
            alt="Cerrar sesión" style="width: 24px; height: 24px;" />
        <span class="texto-azul" style="margin-left: 5px;"></span>
    </a>
</nav>

<style>
    .nav-link {
        text-decoration: none;
        color: inherit;
        position: relative;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 2px;
        bottom: -2px;
        left: 0;
        background-color: currentColor;
        visibility: hidden;
        transform: scaleX(0);
        transition: all 0.3s ease-in-out;
    }

    .nav-link:hover::after {
        visibility: visible;
        transform: scaleX(1);
    }

    .enlace_cierre_sesion img {
        width: 24px;
        height: 24px;
    }

    .texto-azul {
        color: blue;
    }
</style>