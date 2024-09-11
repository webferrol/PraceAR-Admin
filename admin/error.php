<?php

ob_start();
session_start();
if (isset($_SESSION[""]) && $_SESSION[""]) {
    if (isset($_REQUEST[""])) {
        echo "Acceso denegado. Serás redirigido en 5 segundos...";
        // Redirigir tras 5 segundos a la página de administración
        header("refresh:5;url=$servidor/$subdominio/admin/");
        require_once(ADMIN . "");
        exit;
    }
    echo "Acceso denegado. Serás redirigido en 5 segundos...";
    // Redirigir tras 5 segundos a la página de administración
    header("refresh:5;url=$servidor/$subdominio/admin/");
    exit;
}