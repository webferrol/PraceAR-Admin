<?php
require_once(HELPERS . "updated_puestos.php");
require_once(COMPONENT_ADMIN . 'sections' . DIRECTORY_SEPARATOR . 'header.php');
?>

<form id="formulario" action="#" method="post" enctype="multipart/form-data">
    <?php
    $id = $_GET['id'];

    $conexion = new mysqli($servidor_bd, $usuario, $clave, $bd);

    if ($conexion->connect_error) {
        die('Error en la conexión: ' . $conexion->connect_error);
    }

    $sql = "SELECT * FROM puestos WHERE id = $id";

    $resultado = $conexion->query($sql);

    if ($resultado->num_rows <= 0) {
        header('Location: ' . $servidor . 'http://localhost/mercado/admin/error.php');
        echo "Error al obtener los datos del puesto";
        exit;
    }

    $resultado = $conexion->query($sql);
    $fila = $resultado->fetch_assoc();
    ?>
    <h2 id="cabecera_tabla">Datos del puesto <?= $fila["id"] ?></h2>
    <div style="display:flex; align-items: center; gap: .5em;">
        <label for="activo">Activo</label>
        <?php
        $activo = $fila["activo"];
        ?>
        <input type="checkbox" id="activo" name="activo" value="<?= $activo ?>" <?= $activo == 1 ? "checked" : "" ?>>
    </div>
    <div>
        <label for="caseta">Caseta</label>
        <input type="text" id="caseta" disabled value="<?= $fila["caseta"] ?>">
        <input type="hidden" name="caseta" value="<?= $fila["caseta"] ?>">
    </div>
    <div>
        <label for="nombre">Nombre</label>
        <input id="nombre" type="text" name="nombre" value="<?= $fila["nombre"] ?>">
    </div>
    <div>

        <label for="imagen">Imagen</label>
        <?php
        $imagenPath = "assets/" . $fila["caseta"] . ".jpg";
        if (file_exists($imagenPath)): ?>
            <div style="display: flex;gap: 2rem;">
                <button style="width: 200px; height: 96px; background-color: red" id="eliminar_imagen"
                    name="eliminar_imagen" type="submit" value="1">Eliminar</button>
                <img src="<?= $imagenPath ?>" alt="Imagen del puesto" class="zoomable" style="object-fit: cover; height: 100px;">
            </div>
        <?php else: ?>
            <input type="file" id="imagen" name="imagen" accept=".jpg, .jpeg">
        <?php endif; ?>

    </div>
    <div>
        <label for="contacto">Contacto</label>
        <input type="text" id="contacto" name="contacto" value="<?= $fila["contacto"] ?>">
    </div>
    <div>
        <label for="telefono">Teléfono</label>
        <input type="text" id="telefono" name="telefono" value="<?= $fila["telefono"] ?>">
    </div>
    <div>
        <label for="tipo_unity">Tipo en Unity</label>
        <select name="tipo_unity" id="tipo_unity">
            <?php foreach (UNITY_TYPE as $key => $value): ?>
                <?php $selected = $key === $fila["tipo_unity"] ? "selected" : ""; ?>
                <option value="<?= $key ?>" <?= $selected ?>><?= $value ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label for="id_nave">ID Nave</label>
        <select id="id_nave" name="id_nave">
            <?php
            $sql_naves = "SELECT * FROM naves";
            $resultado_naves = $conexion->query($sql_naves);
            while ($fila_naves = $resultado_naves->fetch_assoc()):
                if ($fila["id_nave"] == $fila_naves["id"]):
                    ?>
                    <option value="<?= $fila_naves["id"] ?>" selected><?= $fila_naves["tipo"] ?></option>
                <?php else: ?>
                    <option value="<?= $fila_naves["id"] ?>"><?= $fila_naves["tipo"] ?></option>
                <?php endif; ?>
            <?php endwhile; ?>
        </select>
    </div>
    <div>
        <label for="caseta_padre">Caseta padre</label>
        <input name="caseta_padre" type="text" id="caseta_padre" value="<?= $fila["caseta_padre"] ?>">
    </div>
    <div id="div-botones">
        <input id="actualizar" type="submit" value="Actualizar">
    </div>
</form>

<div id="zoomed-image-container" class="zoomed-container">
    <img id="zoomed-image" src="" alt="">
</div>

<div id="mensaje"><?= $mensaje ?></div>

<style>
    /* Estilo para la imagen ampliada */
    .zoomed-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.8);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        visibility: hidden;
        opacity: 0;
        transition: visibility 0s, opacity 0.3s ease;
    }

    .zoomed-container img {
        max-width: 90%;
        max-height: 90%;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.8);
    }

    .zoomed-container.show {
        visibility: visible;
        opacity: 1;
    }

    .zoomed-container img:hover {
        transform: scale(1.05);
    }

    .zoomable {
        cursor: pointer;
    }

    .zoomed-container::before {
        content: '×';
        position: absolute;
        top: 10px;
        right: 20px;
        font-size: 2rem;
        color: white;
        cursor: pointer;
    }
</style>

<script>
    const zoomableImage = document.querySelector('.zoomable');
    const zoomedContainer = document.getElementById('zoomed-image-container');
    const zoomedImage = document.getElementById('zoomed-image');

    if (zoomableImage) {
        zoomableImage.addEventListener('click', function () {
            zoomedImage.src = this.src;
            zoomedContainer.classList.add('show');
        });
    }

    zoomedContainer.addEventListener('click', function () {
        zoomedContainer.classList.remove('show');
    });
</script>

</body>

</html>
