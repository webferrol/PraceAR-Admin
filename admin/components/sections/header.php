<?php
require_once(HELPERS . 'get-language.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de administración</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <link rel='icon' href='./img/favicon.png' type='image/png'>
</head>

<body class="container">
    <header style="display:flex; justify-content: space-around">
        <h1 id="cabecera_pagina_edicion">Admin: PraceAR
        <strong style="font-size: .8rem">Idioma actual: <img style="box-shadow: 0 0 2px 1px black;" width="15"
                height="15" src="<?= FLAG_IMAGES_URL . (getLanguage()) . ".png" ?>" alt="<?= getLanguage() ?>"></strong></h1>
        <?php
        require_once(COMPONENT_ADMIN . "main-menu.php");
        require_once(COMPONENT_ADMIN . "languages.php");
        ?>

    </header>
</body>