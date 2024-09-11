<?php
$mensaje = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    extract($_REQUEST);
    // Limpiar intros, tabulaciones y que haya más de un espacio en blanco,
    $descripcion = preg_replace('/\s\s+/', ' ', trim($descripcion));

    $sql_actualizacion = "UPDATE puestos_traducciones 
                          SET tipo = \"$tipo\", 
                          descripcion = \"$descripcion\" 
                          WHERE id = $id_traduccion";


    if ($conexion->query($sql_actualizacion) === TRUE) {
        //$mensaje = "<span id='mensaje_correcto'>Puesto actualizado correctamente</span>";
        $conexion->close();
        header("Location: $protocolo/$servidor/$subdominio/?lang=" . getLanguage() . "#row_" . $_GET['id']);
    } else {
        $mensaje = '<span id="mensaje_error">Error en la conexión</span>';
    }
}
