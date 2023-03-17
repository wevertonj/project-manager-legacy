<?php
$release_notes = '<!DOCTYPE html>
<html>
    <head>
        <title>Notas de Lançamento | <?= $theme[\'name\']; ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="noindex, nofollow">

        <link rel="stylesheet" href="<?= BASE; ?>/assets/css/style.min.css?ver=2.0.2" />
    </head>
    <body>
        <h1 class="the-title">Notas de Lançamento do Tema <?= $theme[\'name\']; ?></h1>

        <div class="box">
            <div class="version">
                <h3>Versão:</h3>
                <h2>' . $_POST['ver'] . '</h2>
                <p>' . date('d/m/Y') . '</p>
            </div>

            <div class="description">
                <h1>Lançamento da versão final do tema</h1> 

                <p>
                    Este tema receberá atualizações de seguraça, correções e pequenas melhorias até <b>' . get_month(date('m') + 1) . ' de ' . (date('Y') + 1) . '</b>,
                    podendo receber atualizações críticas de segurança após este periodo.
                </p>
            </div>
        </div>
    </body>
</html>';

