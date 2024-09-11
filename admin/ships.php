<?php
require_once(COMPONENT_ADMIN . 'sections' . DIRECTORY_SEPARATOR . 'header.php');
?>

<h2>Mapas de las Ameas, Naves y Murallones</h2>

<style>
    .maps {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        padding: 20px;
    }

    img {
        /* width: 100%; */
        height: auto;
        border-radius: 5px;
        transition: transform 0.3s ease;
        cursor: pointer;
    }

    h2 {
        grid-column: 1 / -1;
        text-align: center;
    }

    figure {
        margin: 0;
        padding: 0;
        text-align: center;
        position: relative;
        cursor: pointer;
    }

    figcaption {
        margin-top: 10px;
        font-size: .5rem;
    }

    .zoom {
        transition: transform 0.2s;
    }

    /* Estilo para la imagen en zoom centrada */
    .zoomed-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.8);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        visibility: hidden;
        opacity: 0;
        transition: visibility 0s, opacity 0.3s ease;
    }

    /* Hacemos la imagen más grande */
    .zoomed-container img {
        max-width: 95%;
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

    .zoomed-container figcaption {
        color: white;
        margin-top: 20px;
        font-size: 1.5rem;
        text-align: center;
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

    @media screen and (max-width: 768px) {
        .maps {
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        }
    }

    @media screen and (max-width: 480px) {
        .maps {
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
        }
    }
</style>

<main class="maps">
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
