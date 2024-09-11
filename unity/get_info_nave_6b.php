<?php

require_once 'connection.php';
$custom_lang = $_REQUEST["language"] ?? "gl";
try {
    if (!$conn) {
        echo json_encode(["codigo" => 400, "mensaje" => "Error intentando conectar", "respuesta" => ""]);
    } else {
        if (isset($_GET['id_nave'])) {
            $id_nave = $_GET['id_nave'];
			// $sql = "SELECT * FROM `puestos` WHERE id='" . $id . "';";
			$sql = "SELECT 
                    p.id, p.caseta, pt.descripcion, 
                    p.contacto, p.telefono, 
                    p.id_nave, p.nombre, p.tipo_unity, pt.tipo
                    FROM puestos p 
                    INNER JOIN puestos_traducciones pt ON p.id = pt.puesto_id
                    WHERE pt.codigo_idioma = '".$custom_lang."'
                    AND (p.caseta BETWEEN 'NC169' AND 'NC185'
                    OR p.caseta LIKE 'MC005')
                    AND p.id_nave = '" . $id_nave . "' 
                    AND p.caseta_padre IS NULL
                    AND p.activo = 1
                    ORDER BY p.caseta";
    
            $resultado = $conn->query($sql);

            if ($resultado->num_rows > 0) {
                $puesto = [];
                while ($row = $resultado->fetch_assoc()) {
                    $puesto[] = $row;
                }
                echo json_encode(["codigo" => 202, "mensaje" => "El puesto existe en el sistema", "respuesta" => $puesto]);
            } else {
                echo json_encode(["codigo" => 203, "mensaje" => "El puesto no existe en el sistema", "respuesta" => ""]);
            }
        } else {
            echo json_encode(["codigo" => 402, "mensaje" => "Faltan datos para ejecutar la acción solicitada", "respuesta" => ""]);
        }
    }
} catch (Exception $e) {
    echo json_encode(["codigo" => 400, "mensaje" => "Error intentando conectar", "respuesta" => ""]);
}
