<?php

function getLanguages($conexion)
{
    $sql = "SELECT DISTINCT codigo_idioma, nombre_idioma FROM puestos_traducciones";


    $resultado = $conexion->query($sql);

    return $resultado->fetch_all(MYSQLI_ASSOC);
}