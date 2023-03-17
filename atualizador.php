<?php

if ($_POST['slug']) {
    $source = "../{$_POST['slug']}/wp-content/themes/{$_POST['slug']}";
    $dest = "../update/views/{$_POST['slug']}";
    $dest_origin = $dest;
    $version = 'v' . trim(str_replace('.', '-', $_POST['ver']));

    echo '<div class="result box">';
    echo '<div id="result-scroll" class="content">';
    echo "<p class=\"text-add\">Iniciando...</p>";
    ob_flush();
    flush();

    if (strpos(file_get_contents("{$source}/style.css"), $_POST['ver']) === false) {
        echo "<p class=\"text-remove\"><b>Execução interrompida:</b> style.css não atualizado.</p>";
        ob_flush();
        flush();
        die();
    }

    if (!is_dir($dest)) {
        echo "<p class=\"text-change\">Criando pasta do projeto...</p>";
        ob_flush();
        flush();
        mkdir($dest, 0755);

        echo "<p class=\"text-add\">Criando arquivo de Notas de Lançamento...</p>";
        ob_flush();
        flush();

        require './details.php';
        file_put_contents("{$dest}/details.php", $release_notes);
    }

    $dest = "../update/views/{$_POST['slug']}/{$_POST['slug']}";

    if (is_dir($dest)) {
        echo "<p class=\"text-remove\">Removendo arquivos de atualizações anteriores...</p>";
        ob_flush();
        flush();
        remove_dir($dest);
    }

    echo "<p class=\"text-add\">Copiando Tema...</p>";
    ob_flush();
    flush();

    $dest_parent = $dest;
    $dest = "{$dest}/getlayer-theme";

    mkdir($dest_parent, 0755);
    mkdir($dest, 0755);
    copy_dir($source, $dest);

    // Alterações
    echo "<p class=\"text-change\">Editando propriedades do tema...</p>";
    ob_flush();
    flush();

    $functions_file = file_get_contents("{$source}/functions.php");

    if (strpos($functions_file, 'EM DESENVOLVIMENTO') !== false) {
        $functions_file = str_ireplace("'initial' => 'EM DESENVOLVIMENTO'", "'initial' => '{$_POST['ver']}'", $functions_file);
        $functions_file = str_ireplace("'launch' => 'EM DESENVOLVIMENTO'", "'launch' => '" . get_month(date('m')) . ' de ' . date('Y') . "'", $functions_file);
        $functions_file = str_ireplace("'support' => 'EM DESENVOLVIMENTO'", "'support' => '" . get_month(date('m', strtotime('+1 month'))) . ' de ' . date('Y', strtotime('+1 year')) . "'", $functions_file);

        file_put_contents("{$source}/functions.php", $functions_file);
    }

    $functions_file = str_ireplace("'GETLAYER_DEV_MODE', true", "'GETLAYER_DEV_MODE', false", $functions_file);
    $functions_file = str_ireplace('GETLAYER_LAST_UPDATE', date('d/m/Y'), $functions_file);
    file_put_contents("{$dest}/functions.php", $functions_file);

    // Remoções
    echo "<p class=\"text-remove\">Removendo pasta com arquivos de desenvolvimento...</p>";
    ob_flush();
    flush();

    remove_dir("{$dest}/dev");

    echo '<p class="text-change">Comprimindo Arquivos...</p>';
    ob_flush();
    flush();

    zip($dest_parent, "{$dest_origin}/{$_POST['slug']}-{$version}.zip");

    echo "<p class=\"text-remove\">Removendo arquivos temporários...</p>";
    ob_flush();
    flush();
    remove_dir($dest_parent);

    echo '<p class="text-done">Atualização preparada com sucesso!</p>';
    ob_flush();
    flush();

    echo '</div>';
    echo '</div>';


    echo '<div class="result box">';
    echo '<h2>Banco de Dados</h2>';

    if (!$_POST['license']) {
        $license = genLicense();
        $token = getToken($license);
?>
        <form>
            <div>
                <span>Licença</span>
                <input type="text" class="input" onclick="this.select();" readonly value="<?= $license; ?>" />
            </div>

            <div>
                <span>Theme</span>
                <textarea class="input" onclick="this.select();" readonly rows="3"><?=
                                                                                    "INSERT INTO themes(name, slug, license, token, url, version)" .
                                                                                        " VALUES ('{$_POST['name']}', '{$_POST['slug']}', '{$license}', '{$token}', '{$_POST['url']}', '{$_POST['ver']}')";
                                                                                    ?></textarea>
            </div>
        </form>
    <?php
    } else {
        $updte = getUpdateToken();
        $update_text = "INSERT INTO updates(theme_id, version, token)" .
            " VALUES ('{$_POST['id']}', '{$_POST['ver']}', '{$updte}')";

        $theme_text = "UPDATE themes SET version = '{$_POST['ver']}' WHERE id = {$_POST['id']};";
    ?>
        <form>
            <div>
                <span>Update</span>
                <input type="text" class="input" onclick="this.select();" readonly value="<?= $update_text; ?>" />
            </div>

            <div>
                <span>Theme (atualização)</span>
                <input type="text" class="input" onclick="this.select();" readonly value="<?= $theme_text; ?>" />
            </div>
        </form>
    <?php
    }

    echo '<a class="button" href="https://br982.hostgator.com.br:2083/phpMyAdminURL/db_structure.php?server=1&db=DATABASE" target="_blank" rel="noopener nofollow">Banco de dados</a>';
    echo '</div>';
} else {
    ?>
    <div class="header box">
        <h2>Atualizar</h2>
        <form method="post">
            <div>
                <span>Slug</span>
                <input type="text" name="slug" id="search-input" class="input" required value="<?= $_POST['slug']; ?>" />
            </div>

            <div>
                <span>Versão</span>
                <input type="text" name="ver" id="search-input" class="input" required value="<?= $_POST['ver']; ?>" />
            </div>

            <div>
                <span>ID</span>
                <input type="text" name="id" class="input" value="<?= $_POST['id']; ?>" />
            </div>

            <div>
                <span>Licença</span>
                <input type="text" name="license" class="input" value="<?= $_POST['license']; ?>" />
            </div>

            <div>
                <span>Nome (N)</span>
                <input type="text" name="name" class="input" value="<?= $_POST['name']; ?>" />
            </div>

            <div>
                <span>URL (N)</span>
                <input type="url" name="url" class="input" value="<?= $_POST['url']; ?>" />
            </div>

            <div>
                <input class="btn btn-success" type="submit" value="Gerar" />
            </div>
        </form>
    </div>
<?php } ?>