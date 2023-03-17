<div class="header box">
    <h3>Parâmetros:</h3>
    <form method="post">
        <div>
            <span>Nome</span>
            <input type="text" name="nome" id="search-input" class="input" value="<?=$_POST['nome'];?>" />
        </div>

        <div class="container-chackbox">
            <label class="label-checkbox">
                <input class="checkbox" type="checkbox" name="geral" value="yes" <?=($_POST['geral'] ? 'checked' : '');?> /> 
                <span>Geral</span>
            </label>

            <label class="label-checkbox">
                <input class="checkbox" type="checkbox" name="liberdade" value="yes" <?=($_POST['liberdade'] ? 'checked' : '');?> /> 
                <span>Liberdade</span>
            </label>

            <label class="label-checkbox">
                <input class="checkbox" type="checkbox" name="paciente" value="yes" <?=($_POST['paciente'] ? 'checked' : '');?> /> 
                <span>Paciente</span>
            </label>

            <label class="label-checkbox">
                <input class="checkbox" type="checkbox" name="claro" value="yes" <?=($_POST['claro'] ? 'checked' : '');?> /> 
                <span>Claro</span>
            </label>

            <label class="label-checkbox">
                <input class="checkbox" type="checkbox" name="recorrente" value="yes" <?=($_POST['recorrente'] ? 'checked' : '');?> /> 
                <span>Recorrente</span>
            </label>

            <label class="label-checkbox">
                <input class="checkbox" type="checkbox" name="resposta" value="yes" <?=($_POST['resposta'] ? 'checked' : '');?> /> 
                <span>Resposta</span>
            </label>

            <label class="label-checkbox">
                <input class="checkbox" type="checkbox" name="falhas" value="yes" <?=($_POST['falhas'] ? 'checked' : '');?> /> 
                <span>Falhas</span>
            </label>

            <label class="label-checkbox">
                <input class="checkbox" type="checkbox" name="informa" value="yes" <?=($_POST['informa'] ? 'checked' : '');?> /> 
                <span>Informação</span>
            </label>

            <label class="label-checkbox">
                <input class="checkbox" type="checkbox" name="sugest" value="yes" <?=($_POST['sugest'] ? 'checked' : '');?> /> 
                <span>Sugestão</span>
            </label>
        </div>

        <div>
            <input class="btn btn-success" type="submit" name="send" value="Gerar" />
        </div>
    </form>
</div>

<?php if ($_POST['nome']) { ?>
    <div class="result box">
        <h3>Feedbacks:</h3>

        <div>
            <?php
            $nome = $_POST['nome'];
            $geral = $_POST['geral'];
            $liberdade = $_POST['liberdade'];
            $paciente = $_POST['paciente'];
            $claro = $_POST['claro'];
            $recorrente = $_POST['recorrente'];
            $resposta = $_POST['resposta'];
            $falhas = $_POST['falhas'];
            $informa = $_POST['informa'];
            $sugest = $_POST['sugest'];

            $feedback = array();

            if ($geral) {
                $feedback[] = array(
                    "texto" => "Tudo correu conforme o combinado",
                    "tag" => "Geral"
                );

                $feedback[] = array(
                    "texto" => "Tudo correu conforme combinado, a troca de informações foi rápida e objetiva.",
                    "tag" => "Geral"
                );

                $feedback[] = array(
                    "texto" => "Cliente bastante sério e comprometido.",
                    "tag" => "Geral"
                );

                $feedback[] = array(
                    "texto" => "Muito bom trabalhar com o {$nome}, tranquilo, objetivo e é uma pessoa ótima de se lidar.",
                    "tag" => "Geral"
                );

                $feedback[] = array(
                    "texto" => "Cliente nota 10. Muito atencioso com os detalhes.",
                    "tag" => "Geral"
                );
            }

            if ($liberdade || $paciente) {
                $feedback[] = array(
                    "texto" => " O {$nome} me deu total liberdade no desenvolvimento do site,
                        Não economizou informações em nenhuma das etapas do processo e foi bastante paciente durante a execução do projeto.
                        Ótimo cliente!",
                    "tag" => "Liberdade, Paciente"
                );
            }

            if ($claro || $recorrente) {
                $feedback[] = array(
                    "texto" => "O {$nome}, como sempre, muito claro quanto ao que precisava e também ofereceu prazo suficiente para conclusão do projeto. Excelente!",
                    "tag" => "Claro, Recorrente"
                );
            }

            if ($claro || $resposta) {
                $feedback[] = array(
                    "texto" => "Foi ótimo trabalhar com o {$nome}! Em todas as dúvidas que tive no andamento do projeto, ele respondeu imediatamente e sempre com muita clareza",
                    "tag" => "Claro, Resposta"
                );
            }

            if ($claro || $paciente) {
                $feedback[] = array(
                    "texto" => "Passou todas as informações necessários para a execução do projeto e foi bastante paciente durante a execução. Ótimo cliente!",
                    "tag" => "Claro, Paciente"
                );
            }

            if ($geral || $claro || $paciente) {
                $feedback[] = array(
                    "texto" => "O {$nome} é um excelente cliente, sabe se comunicar, sabe o que quer e entende cada etapa do projeto. Paciente e comunicativo.",
                    "tag" => "Claro, Paciente"
                );
            }

            if ($claro || $resposta || $falhas || $paciente) {
                $feedback[] = array(
                    "texto" => "Muito claro e objetivo, sempre disponível para esclarecimentos e muito paciente.
                        Além disso ajudou muito reportando todas as falhas que encontrou durante a execução do projeto.
                        Ótimo cliente!",
                    "tag" => "Claro, Falhas, Paciente, Resposta"
                );
            }

            if ($claro || $informa || $sugest) {
                $feedback[] = array(
                    "texto" => "O {$nome} foi extremamente claro em relação às suas demandas. Não economizou informações em nenhuma das etapas do processo, além de estar aberto a sugestões.",
                    "tag" => "Claro, Informação, Sugestão"
                );
            }

            if ($claro || $resposta || $recorrente) {
                $feedback[] = array(
                    "texto" => "Ótimo cliente, especificou com clareza todos os detalhes do projeto. Sempre presente para eventuais dúvidas. Recomendo.",
                    "tag" => "Claro"
                );

                $feedback[] = array(
                    "texto" => "Sempre fala com clareza e profissionalismo, responde rapidamente e tem uma visão clara do como quer o projeto. É sempre bom trabalhar com ele.",
                    "tag" => "Claro, Recorrente, Resposta"
                );
            }

            if ($claro || $geral || $recorrente) {
                $feedback[] = array(
                    "texto" => "Decidido e claro. Certamente desenvolveria outros trabalhos com ele.",
                    "tag" => "Geral, Claro"
                );

                $feedback[] = array(
                    "texto" => "Ótimo Cliente. Parceria muito produtiva. Agradeço muito pelo trabalho e pela confiança",
                    "tag" => "Geral, Recorrente"
                );
            }

            if ($claro || $geral) {
                $feedback[] = array(
                    "texto" => "O {$nome} sabia exatamente qual era o problema e me passou todas as informações necessárias para soluciona-lo.
                        O conhecimento dele sobre a estrutura HTML do site me ajudou a agilizar o serviço.
                        Recomento ele como cliente!",
                    "tag" => "Geral, Claro"
                );

                $feedback[] = array(
                    "texto" => "O {$nome} soube especificar bem a necessidade e concluímos sem problemas. Ótimo cliente!",
                    "tag" => "Geral, Claro"
                );
            }

            if ($geral || $resposta) {
                $feedback[] = array(
                    "texto" => "O {$nome} foi atencioso em todo o processo.
                        Sempre que precisei falar com ele, estava pronto para me responder e acompanhou todas as etapas do projeto.",
                    "tag" => "Geral, Resposta"
                );
            }

            if ($claro || $resposta) {
                $feedback[] = array(
                    "texto" => "Foi ótimo trabalhar com o {$nome}! Sempre claro e objetivo, além de responder rápido as minhas dúvidas.",
                    "tag" => "Claro, Resposta"
                );
            }

            if ($recorrente && $paciente) {
                $feedback[] = array(
                    "texto" => "O {$nome} é muito comunicativo, paciente e aberto à sugestões! Estamos fazendo um ótimo trabalho juntos.",
                    "tag" => "Paciente, Recorrente"
                );
            }

            if ($recorrente) {
                $feedback[] = array(
                    "texto" => "Mais um projeto feito com sucesso, já conhecia o {$nome} de outro projeto. Sempre presente para qualquer dúvida ou esclarecimento.",
                    "tag" => "Recorrente"
                );
            }

            if ($sugest) {
                $feedback[] = array(
                    "texto" => "Claro e objetivo! Adorei as dicas que me foram repassadas pelo {$nome}, ótimo cliente.",
                    "tag" => "Claro, Resposta, Sugestão"
                );
                    
                $feedback[] = array(
                    "texto" => "O {$nome} é bem comunicativo e aberto à sugestões! Trabalharia novamente com ele sem problemas.",
                    "tag" => "Sugestão"
                );
            }

            shuffle($feedback);

            foreach ($feedback as $key) {
                ?>
                <div class="item">
                    <p>
                        <?= $key['texto']; ?>
                    </p>
            
                    <p class="tag">Tags: <?= $key['tag']; ?></p>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
<?php } ?>