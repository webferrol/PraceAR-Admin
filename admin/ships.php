<?php
require_once(COMPONENT_ADMIN . 'sections' . DIRECTORY_SEPARATOR . 'header.php');
require_once(CSS_ADMIN . 'ships_admin.php');
?>

<main class="maps">
    <h2>Mapas de las Ameas, Naves y Murallones</h2>
    <!-- Sección Ameas -->
    <?php foreach (NAVES['ameas'] as $amea): ?>
        <?php
        $ameaRange = $amea['range'];
        $ameaTitle = $amea['title'];
        $ameaIndice = $amea['indice'];
        ?>
        <figure class="zoom">
            <img loading="lazy" src='./img/amea<?= $ameaIndice ?>.jpg' alt='Amea <?= $ameaIndice ?>'>
            <figcaption>Amea <?= $ameaIndice ?> / <?= implode("-", $ameaRange) ?></figcaption>
        </figure>
    <?php endforeach; ?>

    <!-- Sección Naves -->
    <?php foreach (NAVES['naves'] as $nave): ?>
        <?php
        $naveRange = $nave['range'];
        $naveTitle = $nave['title'];
        $naveIndice = $nave['indice'];
        ?>
        <figure class="zoom">
            <img loading="lazy" src='./img/nave<?= $naveIndice ?>.jpg' alt='Nave <?= $naveIndice ?>'>
            <figcaption>Nave <?= $naveIndice ?> / <?= implode("-", $naveRange) ?></figcaption>
        </figure>
    <?php endforeach; ?>

    <!-- Sección Murallones -->
    <?php foreach (NAVES['murallones'] as $murallon): ?>
        <?php
        $murallonRange = $murallon['range'];
        $murallonTitle = $murallon['title'];
        $murallonIndice = $murallon['indice'];
        ?>
        <figure class="zoom">
            <img loading="lazy" src='./img/murallon<?= $murallonIndice ?>.jpg' alt='Murallón <?= $murallonIndice ?>'>
            <figcaption>Murallón <?= $murallonIndice ?> / <?= implode("-", $murallonRange) ?></figcaption>
        </figure>
    <?php endforeach; ?>
</main>

<!-- Contenedor para mostrar la imagen ampliada y el texto -->
<div id="zoomed-container" class="zoomed-container">
    <img id="zoomed-image" src="" alt="">
    <figcaption id="zoomed-caption"></figcaption>
</div>

<script>
    const figures = document.querySelectorAll('figure');
    const zoomedContainer = document.getElementById('zoomed-container');
    const zoomedImage = document.getElementById('zoomed-image');
    const zoomedCaption = document.getElementById('zoomed-caption');

    figures.forEach(figure => {
        figure.addEventListener('click', function () {
            const img = figure.querySelector('img');
            const caption = figure.querySelector('figcaption');
            zoomedImage.src = img.src;
            zoomedCaption.textContent = caption.textContent;
            zoomedContainer.classList.add('show');
        });
    });

    zoomedContainer.addEventListener('click', function () {
        zoomedContainer.classList.remove('show');
    });
</script>

</body>

</html>