<nav class="navbar">
    <a href="./?lang=<?= $_REQUEST['lang'] ?? 'gl' ?>" class="nav-link">Inicio</a>
    <a href="./?page=ships&lang=<?= $_REQUEST['lang'] ?? 'gl' ?>" class="nav-link">Naves</a>
    <a href="./?page=change_password&lang=<?= $_REQUEST['lang'] ?? 'gl' ?>" class="nav-link">Cambiar contraseña</a>
    <a href="./admin/logout_session.php" class="enlace_cierre_sesion" title="Cerrar sesión">
        <img src="./img/logout_icon.png" alt="Cerrar sesión" />
        <span class="texto-azul"></span>
    </a>
</nav>

<style>
    .navbar {
        display: flex;
        justify-content: space-around;
        align-items: center;
        gap: 10px;
        padding: 10px;
        background-color: #f8f8f8;
    }

    .nav-link {
        text-decoration: none;
        color: inherit;
        position: relative;
        text-align: center;
        padding: 8px;
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

    .enlace_cierre_sesion {
        display: flex;
        align-items: center;
    }

    .enlace_cierre_sesion img {
        width: 24px;
        height: 24px;
    }

    .texto-azul {
        color: blue;
    }

    /* Responsiveness */
    @media (max-width: 768px) {
        .navbar {
            flex-direction: column;
            align-items: flex-start;
        }

        .nav-link {
            width: 100%;
            text-align: left;
        }

        .enlace_cierre_sesion {
            justify-content: flex-start;
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .navbar {
            gap: 5px;
            padding: 5px;
        }

        .nav-link {
            padding: 6px;
        }

        .enlace_cierre_sesion img {
            width: 20px;
            height: 20px;
        }
    }
</style>
