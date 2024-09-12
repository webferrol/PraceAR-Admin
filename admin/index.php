<?php
require_once(SECTIONS . 'header.php');
require_once(HELPERS . 'truncate-text.php');
require_once(HELPERS . 'clean-input.php');
require_once(CSS_ADMIN . 'index_admin.php');

$custom_lang = getLanguage();

$results_per_page = 50;
$current_page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$start_from = ($current_page - 1) * $results_per_page;
$caseta = isset($_GET['caseta']) ? limpiarInput($_GET['caseta']) : '';

$sql_total = "SELECT COUNT(p.id) as total FROM puestos p 
              RIGHT JOIN puestos_traducciones pt ON p.id = pt.puesto_id
              INNER JOIN naves n on p.id_nave = n.id
              WHERE pt.codigo_idioma = '" . $custom_lang . "'";

if (!empty($caseta)) {
    $sql_total .= " AND p.caseta LIKE '%$caseta%'";
}

$result_total = $conexion->query($sql_total);
$row_total = $result_total->fetch_assoc();
$total_results = $row_total['total'];

$total_pages = ceil($total_results / $results_per_page);

$sql = "SELECT p.id, p.caseta, p.imagen, p.nombre, pt.descripcion, p.contacto, p.telefono, pt.tipo, p.tipo_unity, p.id_nave, n.tipo as nave, p.caseta_padre, p.activo
        FROM puestos p 
        RIGHT JOIN puestos_traducciones pt ON p.id = pt.puesto_id
        INNER JOIN naves n on p.id_nave = n.id
        WHERE pt.codigo_idioma = '" . $custom_lang . "'";

if (!empty($caseta)) {
    $sql .= " AND p.caseta LIKE '%$caseta%'";
}

$sql .= " ORDER BY p.caseta LIMIT $start_from, $results_per_page";
$result = $conexion->query($sql);
?>
<main>
    <table class="tabla_puestos">
        <caption style="font-size: 1.75rem; font-weight: bold;">Lista de puestos del Mercado de Abastos
            <search role="search">
                <form id="formularioBusqueda" action="#" method="GET" style="display: flex;">
                    <input value="<?= $_GET['caseta'] ?? "" ?>" type="text" id="inputBusqueda"
                        placeholder="P. ej. CE001, CO121, MC001, NA338, NC041" name="caseta">
                    <input type="hidden" name="lang" value="<?= getLanguage() ?>">
                    <input type="submit" value="Buscar">
                    <input id="inputReseteo" type="reset" value="Reiniciar">
                </form>
            </search>
            <!-- Paginación superior -->
            <div class="pagination" style="font-size: .7em;">
                <?php if ($current_page > 1): ?>
                    <a href="?page=<?= $current_page - 1 ?>&caseta=<?= $_GET['caseta'] ?? '' ?>&lang=<?= getLanguage() ?>">&laquo;
                        Anterior</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a class="<?= $i == $current_page ? 'active' : '' ?>"
                        href="?page=<?= $i ?>&caseta=<?= $_GET['caseta'] ?? '' ?>&lang=<?= getLanguage() ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>

                <?php if ($current_page < $total_pages): ?>
                    <a href="?page=<?= $current_page + 1 ?>&caseta=<?= $_GET['caseta'] ?? '' ?>&lang=<?= getLanguage() ?>">Siguiente
                        &raquo;</a>
                <?php endif; ?>
            </div>
        </caption>

        <thead style="font-size: .95em;">
            <tr>
                <th>Editar</th>
                <th>Activo</th>
                <th>Imagen</th>
                <th>Caseta</th>
                <th>Nombre</th>
                <th>Tipo Unity</th>
                <th>Contacto</th>
                <th>Teléfono</th>
                <th>ID Nave</th>
                <th>Puesto padre</th>
                <th style="border-style:none;"></th>
                <th>Editar</th>
                <th>Tipo</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody style="font-size: .9em;">
            <?php
            if ($result->num_rows > 0):
                while ($row = $result->fetch_assoc()):
                    ?>
                    <tr id="row_<?= $row['id'] ?>">
                        <td>
                            <a href="<?= "?page=edit&id=" . $row['id'] . "&lang=" . ($_REQUEST['lang'] ?? 'gl') ?>">
                                <img loading="lazy" width='15' height='15' src="<?= PENCIL_IMAGE_URL ?>">
                            </a>
                        </td>
                        <td>
                            <?= $row['activo'] ? "Sí" : "No" ?>
                        </td>
                        <td>
                            <?php
                            $imagenPath = "assets/" . $row["caseta"] . ".jpg";
                            if (file_exists($imagenPath)): ?>
                                <img loading="lazy" class="zoomable" style="width: 25px; aspect-ratio: 1/1; object-fit: contain;"
                                    src="<?= $imagenPath ?>" alt="Imagen del puesto">
                            <?php endif; ?>
                        </td>
                        <td><?= $row['caseta'] ?></td>
                        <td><?= $row['nombre'] ?></td>
                        <td><?= $row['tipo_unity'] ?></td>
                        <td><?= $row['contacto'] ?></td>
                        <td><?= $row['telefono'] ?></td>
                        <td><?= $row['nave'] ?></td>
                        <td><?= $row["caseta_padre"] ?? "Ninguno" ?></td>
                        <td style="border-style: none;"></td>
                        <td>
                            <a
                                href="<?= "?page=language&codigo_idioma=" . getLanguage() . "&id=" . $row['id'] . "&lang=" . ($_REQUEST['lang'] ?? 'gl') ?>">
                                <img loading="lazy" style="box-shadow: 0 0 2px 1px black;" width="15" height="15"
                                    src="<?= FLAG_IMAGES_URL . (getLanguage()) . ".png" ?>" alt="<?= getLanguage() ?>">
                            </a>
                        </td>
                        <td><?= $row['tipo'] ?></td>
                        <td>
                            <?= $row['descripcion'] ? truncateText($row['descripcion'], 30) : '' ?>
                        </td>
                    </tr>
                    <?php
                endwhile;
            endif;
            ?>
        </tbody>
    </table>

    <!-- Contenedor para mostrar la imagen ampliada y el nombre del puesto -->
    <div id="zoomed-image-container" class="zoomed-container">
        <img id="zoomed-image" src="" alt="Imagen del puesto ampliada">
        <p id="zoomed-name"></p>
    </div>

    <!-- Paginación inferior -->
    <div class="pagination">
        <?php if ($current_page > 1): ?>
            <a href="?page=<?= $current_page - 1 ?>&caseta=<?= $_GET['caseta'] ?? '' ?>&lang=<?= getLanguage() ?>">&laquo;
                Anterior</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a class="<?= $i == $current_page ? 'active' : '' ?>"
                href="?page=<?= $i ?>&caseta=<?= $_GET['caseta'] ?? '' ?>&lang=<?= getLanguage() ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>

        <?php if ($current_page < $total_pages): ?>
            <a href="?page=<?= $current_page + 1 ?>&caseta=<?= $_GET['caseta'] ?? '' ?>&lang=<?= getLanguage() ?>">Siguiente
                &raquo;</a>
        <?php endif; ?>
    </div>

</main>

<script>
    const zoomableImages = document.querySelectorAll('.zoomable');
    const zoomedContainer = document.getElementById('zoomed-image-container');
    const zoomedImage = document.getElementById('zoomed-image');
    const zoomedName = document.getElementById('zoomed-name');

    zoomableImages.forEach(image => {
        image.addEventListener('click', function () {
            zoomedImage.src = this.src;
            zoomedName.textContent = this.closest('tr').querySelector('td:nth-child(5)').textContent;
            zoomedContainer.classList.add('show');
        });
    });

    zoomedContainer.addEventListener('click', function () {
        zoomedContainer.classList.remove('show');
    });
</script>

</body>

</html>