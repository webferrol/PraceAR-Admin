<style>
    .flags {
        display: flex;
        list-style: none;
        padding: 0;
    }

    .flags li {
        margin-right: 10px;
    }

    .flags a {
        text-decoration: none;
        color: black;

        img {
            box-shadow: 0 0 2px 1px black;
        }
    }
</style>


<nav style="position: fixed; right: 1rem;top: 1rem">
    <ul class="flags">
        <?php
        foreach (LANGUAGES as $keyLanguage => $textLanguage):
            ?>
            <li>
                <?php
                $page = isset($_REQUEST['page']) ? "&page=" . $_REQUEST['page'] : '';
                $caseta = isset($_REQUEST['caseta']) ? "&caseta=" . $_REQUEST['caseta'] : '';
                $codigo_idioma = isset($_REQUEST['codigo_idioma']) ? "&codigo_idioma=" . $_REQUEST['codigo_idioma'] : '';
                $id = isset($_REQUEST['id']) ? "&id=" . $_REQUEST['id'] : '';
                ?>
                <a href="<?= "?lang=$keyLanguage$caseta$page$id$codigo_idioma" ?>">
                    <img width="15" height="15" src="<?= FLAG_IMAGES_URL . "$keyLanguage.png" ?>" alt="<?= $textLanguage ?>">
                </a>
            </li>
            <?php
        endforeach;
        ?>
    </ul>
</nav>