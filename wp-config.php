<?php
$wp_config = "<?php\n";
$wp_config .= "/**\n";
$wp_config .= " * As configurações básicas do WordPress\n";
$wp_config .= " *\n";
$wp_config .= " * O script de criação wp-config.php usa esse arquivo durante a instalação.\n";
$wp_config .= " * Você não precisa usar o site, você pode copiar este arquivo\n";
$wp_config .= " * para \"wp-config.php\" e preencher os valores.\n";
$wp_config .= " *\n";
$wp_config .= " * Este arquivo contém as seguintes configurações:\n";
$wp_config .= " *\n";
$wp_config .= " * * Configurações do MySQL\n";
$wp_config .= " * * Chaves secretas\n";
$wp_config .= " * * Prefixo do banco de dados\n";
$wp_config .= " * * ABSPATH\n";
$wp_config .= " *\n";
$wp_config .= " * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php\n";
$wp_config .= " *\n";
$wp_config .= " * @package WordPress\n";
$wp_config .= " */\n\n";

$wp_config .= "// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //\n";
$wp_config .= "/** O nome do banco de dados do WordPress */\n";
$wp_config .= "define('DB_NAME', '{$db_name}');\n\n";

$wp_config .= "/** Usuário do banco de dados MySQL */\n";
$wp_config .= "define('DB_USER', '{$db_user}');\n\n";

$wp_config .= "/** Senha do banco de dados MySQL */\n";
$wp_config .= "define('DB_PASSWORD', '{$db_pass}');\n\n";

$wp_config .= "/** Nome do host do MySQL */\n";
$wp_config .= "define('DB_HOST', 'localhost');\n\n";

$wp_config .= "/** Charset do banco de dados a ser usado na criação das tabelas. */\n";
$wp_config .= "define('DB_CHARSET', 'utf8mb4');\n\n";

$wp_config .= "/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */\n";
$wp_config .= "define('DB_COLLATE', '');\n\n";

$wp_config .= "/**#@+\n";
$wp_config .= " * Chaves únicas de autenticação e salts.\n";
$wp_config .= " *\n";
$wp_config .= " * Altere cada chave para um frase única!\n";
$wp_config .= " * Você pode gerá-las\n";
$wp_config .= " * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org\n";
$wp_config .= " * secret-key service}\n";
$wp_config .= " * Você pode alterá-las a qualquer momento para invalidar quaisquer\n";
$wp_config .= " * cookies existentes. Isto irá forçar todos os\n";
$wp_config .= " * usuários a fazerem login novamente.\n";
$wp_config .= " *\n";
$wp_config .= " * @since 2.6.0\n";
$wp_config .= " */\n";
$wp_config .= file_get_contents("https://api.wordpress.org/secret-key/1.1/salt/") . "\n";

$wp_config .= "/**#@-*/\n\n";

$wp_config .= "/**\n";
$wp_config .= " * Prefixo da tabela do banco de dados do WordPress.\n";
$wp_config .= " *\n";
$wp_config .= " * Você pode ter várias instalações em um único banco de dados se você der\n";
$wp_config .= " * um prefixo único para cada um. Somente números, letras e sublinhados!\n";
$wp_config .= " */\n";
$wp_config .= "\$table_prefix  = 'wp_';\n\n";

$wp_config .= "/**\n";
$wp_config .= " * Para desenvolvedores: Modo de debug do WordPress.\n";
$wp_config .= " *\n";
$wp_config .= " * Altere isto para true para ativar a exibição de avisos\n";
$wp_config .= " * durante o desenvolvimento. É altamente recomendável que os\n";
$wp_config .= " * desenvolvedores de plugins e temas usem o WP_DEBUG\n";
$wp_config .= " * em seus ambientes de desenvolvimento.\n";
$wp_config .= " *\n";
$wp_config .= " * Para informações sobre outras constantes que podem ser utilizadas\n";
$wp_config .= " * para depuração, visite o Codex.\n";
$wp_config .= " *\n";
$wp_config .= " * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress\n";
$wp_config .= " */\n";
$wp_config .= "define('WP_DEBUG', false);\n\n";

$wp_config .= "define('FS_METHOD', 'direct');\n";
$wp_config .= "define('WP_POST_REVISIONS', 3);\n\n";

$wp_config .= "/* Isto é tudo, pode parar de editar! :) */\n\n";

$wp_config .= "/** Caminho absoluto para o diretório WordPress. */\n";
$wp_config .= "if ( !defined('ABSPATH') )\n";
$wp_config .= "	define('ABSPATH', dirname(__FILE__) . '/');\n\n";

$wp_config .= "/** Configura as variáveis e arquivos do WordPress. */\n";
$wp_config .= "require_once(ABSPATH . 'wp-settings.php');\n";
