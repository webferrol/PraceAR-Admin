<nav style="display: flex; justify-content: space-around; align-items: center;">
    <a href="./?lang=<?= $_REQUEST['lang'] ?? 'gl' ?>" style="text-align: center; margin-right: 10px;">Inicio</a>
    <a href="./?page=ships&lang=<?= $_REQUEST['lang'] ?? 'gl' ?>" style="text-align: center; margin-right: 10px;">Naves</a>
    <a href="./?page=change_password&lang=<?= $_REQUEST['lang'] ?? 'gl' ?>" style="text-align: center; margin-right: 10px;">Cambiar contraseña</a>
    <a href="./admin/logout_session.php" class="enlace_cierre_sesion">Cerrar sesión</a>
</nav>
