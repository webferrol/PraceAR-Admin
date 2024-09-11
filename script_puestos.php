<?php

require_once 'conexion.php';

$arrayPuestos = [354, 355, 356, 357, 358, 360, 361, 363,];


foreach ($arrayPuestos as $puesto) {
    $sql_insercion = "INSERT INTO `puestos` (`caseta`, `imagen`, `nombre`, `contacto`, `telefono`, `tipo_unity`, `id_nave`, `caseta_padre`, `activo`)
                                    VALUES ('NA$puesto', '', '', '', '', '', 11, '', 1)";
    $conexion->query($sql_insercion);
}

$conexion->close();
