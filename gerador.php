<?php

if (isset($_POST['slug'])) {
    $source = "../base";
    $dest = "../{$_POST['slug']}";

    echo '<div class="result box">';
    echo '<div id="result-scroll" class="content">';
    echo "<p class=\"text-add\">Iniciando...</p>";
    ob_flush();
    flush();

    if (is_dir($dest)) {
        echo '<p class="text-remove">Este projeto já existe!</p>';
        ob_flush();
        flush();
        die();
    }

    echo "<p class=\"text-add\">Copiando instalação WordPress...</p>";
    ob_flush();
    flush();

    mkdir($dest, 0755);
    copy_dir($source, $dest);

    // Edições
    echo '<p class="text-change">Reescrevendo .htaccess...</p>';
    ob_flush();
    flush();

    $apache_config = "# BEGIN WordPress\n";
    $apache_config .= "<IfModule mod_rewrite.c>\n";
    $apache_config .= "RewriteEngine On\n";
    $apache_config .= "RewriteBase /{$_POST['slug']}/\n";
    $apache_config .= "RewriteRule ^index\.php$ - [L]\n";
    $apache_config .= "RewriteCond %{REQUEST_FILENAME} !-f\n";
    $apache_config .= "RewriteCond %{REQUEST_FILENAME} !-d\n";
    $apache_config .= "RewriteRule . /{$_POST['slug']}/index.php [L]\n";
    $apache_config .= "</IfModule>\n\n";
    $apache_config .= "# END WordPress\n\n";
    $apache_config .= "<Files xmlrpc.php>\n";
    $apache_config .= "Order Allow,Deny\n";
    $apache_config .= "Deny from all\n";
    $apache_config .= "</Files>";
    file_put_contents("{$dest}/.htaccess", $apache_config);

    echo '<p class="text-add">Configurando banco de dados...</p>';
    ob_flush();
    flush();
    $db_name = "wp_{$_POST['slug']}";
    $db_user = "wp_{$_POST['slug']}_user";
    $db_pass = generate_password();

    $user = 'USER';
    $pass = 'PASS';

    try {
        $connection = new PDO("mysql:host=localhost", $user, $pass);

        $connection->exec("CREATE SCHEMA `{$db_name}` DEFAULT CHARACTER SET utf8mb4;");
        $connection->exec("CREATE USER '{$db_user}'@'localhost' IDENTIFIED BY '{$db_pass}';");
        $connection->exec("GRANT ALL PRIVILEGES ON {$db_name}.* TO '{$db_user}'@'localhost';");
        $connection->exec("FLUSH PRIVILEGES;");
    } catch (PDOException $e) {
        echo '<p class="text-remove">' . $e->getMessage() . '</p>';
        ob_flush();
        flush();
        die();
    }

    echo '<p class="text-change">Reescrevendo wp-config.php...</p>';
    ob_flush();
    flush();

    require './wp-config.php';
    file_put_contents("{$dest}/wp-config.php", $wp_config);

    // Remoções
    remove_dir("{$dest}/wp-content/uploads", true);

    // Adições
    echo '<p class="text-add">Adicionando pasta uploads (vazia)...</p>';
    ob_flush();
    flush();
    mkdir("{$dest}/wp-content/uploads", 0755);

    echo '<p class="text-add">Adicionando .htaccess à pasta uploads...</p>';
    ob_flush();
    flush();
    $apache_upload_config = file_get_contents("{$source}/wp-content/uploads/.htaccess");
    file_put_contents("{$dest}/wp-content/uploads/.htaccess", $apache_upload_config);

    echo "<p class=\"text-change\">Renomeando pasta do tema para {$_POST['slug']}</p>";
    ob_flush();
    flush();
    rename("{$dest}/wp-content/themes/getlayer-theme", "{$dest}/wp-content/themes/{$_POST['slug']}");

    echo '<p class="text-done">Projeto criado com sucesso</p>';
    ob_flush();
    flush();

    echo '</div>';
    echo '</div>';
} else {
?>
    <div class="header box">
        <h2>Novo Projeto</h2>
        <form method="post">
            <div>
                <span>Slug</span>
                <input type="text" name="slug" id="search-input" class="input" required value="" />
            </div>

            <div>
                <input class="btn btn-success" type="submit" value="Gerar" />
            </div>
        </form>
    </div>
<?php } ?>