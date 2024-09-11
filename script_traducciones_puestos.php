<?php

require_once 'conexion.php';

$arraypuestos = [9184, 9185, 9186, 9187, 9188, 9189, 9190, 9191];


foreach ($arraypuestos as $puesto) {
    $sql_es = "INSERT INTO `puestos_traducciones` (`puesto_id`, `codigo_idioma`, `nombre_idioma`) VALUES ($puesto, 'es', 'Español')";
    $sql_gl = "INSERT INTO `puestos_traducciones` (`puesto_id`, `codigo_idioma`, `nombre_idioma`) VALUES ($puesto, 'gl', 'Gallego')";
    $sql_en = "INSERT INTO `puestos_traducciones` (`puesto_id`, `codigo_idioma`, `nombre_idioma`) VALUES ($puesto, 'en', 'Inglés')";
    $sql_fr = "INSERT INTO `puestos_traducciones` (`puesto_id`, `codigo_idioma`, `nombre_idioma`) VALUES ($puesto, 'fr', 'Francés')";

    $conexion->query($sql_es);
    $conexion->query($sql_gl);
    $conexion->query($sql_en);
    $conexion->query($sql_fr);
}

$conexion->close();



// SELECT
// p.id,pt.id, pt.codigo_idioma, p.caseta, pt.descripcion, 
// p.contacto, p.telefono, 
// p.id_nave, p.nombre, p.tipo_unity, pt.tipo
// FROM puestos p 
// LEFT JOIN puestos_traducciones pt ON p.id = pt.puesto_id
// WHERE p.caseta BETWEEN 'NC252' AND 'NC291' OR p.caseta
// AND p.id_nave = '4' 
// AND p.caseta_padre IS NULL
// ORDER BY p.caseta
