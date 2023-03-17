<?php
require_once(__DIR__ . '/functions.php');

$host = 'http://localhost/manager';
$page = $_GET['p'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Project Manager</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <div class="container">
        <?php if ($page) { ?>
            <div class="back-button-section">
                <a href="<?= $host; ?>" class="button back-button">
                    <svg class="back-button-icon getlayer-fa arrow-left">
                        <use xlink:href="<?= $host; ?>/img/icons.svg#arrow-left" href="<?= $host; ?>/img/icons.svg#arrow-left"></use>
                    </svg>

                    <span class="back-button-title">Voltar</span>
                </a>
            </div>
        <?php } ?>

        <?php
        switch ($page) {
            case 'new':
                require_once(__DIR__ . '/gerador.php');
                break;
            case 'update':
                require_once(__DIR__ . '/atualizador.php');
                break;
            case 'feedback':
                require_once(__DIR__ . '/feedback.php');
                break;

            default:
                require_once(__DIR__ . '/home.php');
                break;
        }


        ?>
    </div>

</body>

</html>