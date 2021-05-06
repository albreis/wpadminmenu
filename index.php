<?php global $wpdb; ?>
<div class="sorteio-admin">
    <h1>Estatísticas do sistema</h1>
    <div class="row">
        <div class="col">
            <div class="sorteio-card">
                <h3>Cadastros</h3>
                <div class="card-content">
                    <strong>
                        <?php echo $wpdb->get_var("SELECT count(*) FROM {$wpdb->prefix}sorteio_cadastros"); ?>
                    </strong>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="sorteio-card">
                <h3>Segmentos</h3>
                <div class="card-content">
                    <strong>
                        <?php echo $wpdb->get_var("SELECT count(*) FROM {$wpdb->prefix}sorteio_segmentos"); ?>
                    </strong>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="sorteio-card">
                <h3>Agências</h3>
                <div class="card-content">
                    <strong>
                        <?php echo $wpdb->get_var("SELECT count(*) FROM {$wpdb->prefix}sorteio_agencias"); ?>
                    </strong>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="sorteio-card">
                <h3>Números restantes</h3>
                <div class="card-content">
                    <strong>
                        <?php echo $wpdb->get_var("SELECT count(*) FROM {$wpdb->prefix}sorteio_numeros WHERE usado = 0"); ?>
                    </strong>
                </div>
            </div>
        </div>
    </div>
    <br/>
    <br/>
    <h1>Estatísticas por data</h1>
    <div class="row">
        <div class="col">
            <div class="sorteio-card">
                <h3>Dia</h3>
                <div class="card-content">
                    <?php $cadastros = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}sorteio_cadastros GROUP BY YEAR(created_at), MONTH(created_at), DAY(created_at) LIMIT 10"); ?>
                    <div class="row">
                        <div class="col"><b>Data</b></div>
                        <div class="col"><b>Qtd. de Cadastro</b></div>
                    </div>
                    <?php foreach($cadastros as $cadastro): $data = explode(' ', $cadastro->created_at) ?>
                    <hr/>
                    <div class="row item">
                        <div class="col">
                            <?php echo date('d/m/Y', strtotime($cadastro->created_at)); ?>
                        </div>
                        <div class="col">
                            <?php echo $wpdb->get_var("SELECT count(*) FROM {$wpdb->prefix}sorteio_cadastros WHERE created_at LIKE '{$data[0]}%'"); ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="sorteio-card">
                <h3>Mês</h3>
                <div class="card-content">
                    <?php $cadastros = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}sorteio_cadastros GROUP BY YEAR(created_at), MONTH(created_at) LIMIT 10"); ?>
                    <div class="row">
                        <div class="col"><b>Data</b></div>
                        <div class="col"><b>Qtd. de Cadastro</b></div>
                    </div>
                    <?php foreach($cadastros as $cadastro): $data = substr($cadastro->created_at, 0, 7); ?>
                    <hr/>
                    <div class="row item">
                        <div class="col">
                            <?php echo date('m/Y', strtotime($cadastro->created_at)); ?>
                        </div>
                        <div class="col">
                            <?php echo $wpdb->get_var("SELECT count(*) FROM {$wpdb->prefix}sorteio_cadastros WHERE created_at LIKE '{$data[0]}%'"); ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="sorteio-card">
                <h3>Ano</h3>
                <div class="card-content">
                    <?php $cadastros = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}sorteio_cadastros GROUP BY YEAR(created_at) LIMIT 10"); ?>
                    <div class="row">
                        <div class="col"><b>Data</b></div>
                        <div class="col"><b>Qtd. de Cadastro</b></div>
                    </div>
                    <?php foreach($cadastros as $cadastro): $data = substr($cadastro->created_at, 0, 4); ?>
                    <hr/>
                    <div class="row item">
                        <div class="col">
                            <?php echo date('Y', strtotime($cadastro->created_at)); ?>
                        </div>
                        <div class="col">
                            <?php echo $wpdb->get_var("SELECT count(*) FROM {$wpdb->prefix}sorteio_cadastros WHERE created_at LIKE '{$data[0]}%'"); ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <br/>
    <br/>
    <h1>Estatísticas por localidade</h1>
    <div class="row">
        <div class="col">
            <div class="sorteio-card">
                <h3>Estados</h3>
                <div class="card-content">
                    <?php $cadastros = $wpdb->get_results("SELECT DISTINCT estado FROM {$wpdb->prefix}sorteio_cadastros LIMIT 10"); ?>
                    <div class="row">
                        <div class="col"><b>UF</b></div>
                        <div class="col"><b>Qtd. de Cadastro</b></div>
                    </div>
                    <?php foreach($cadastros as $cadastro): ?>
                    <hr/>
                    <div class="row item">
                        <div class="col">
                            <?php echo $cadastro->estado; ?>
                        </div>
                        <div class="col">
                            <?php echo $wpdb->get_var("SELECT count(*) FROM {$wpdb->prefix}sorteio_cadastros WHERE estado = '{$cadastro->estado}'"); ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="sorteio-card">
                <h3>Cidades</h3>
                <div class="card-content">
                    <?php $cadastros = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}sorteio_cadastros GROUP BY cidade LIMIT 10"); ?>
                    <div class="row">
                        <div class="col"><b>Cidade / UF</b></div>
                        <div class="col"><b>Qtd. de Cadastro</b></div>
                    </div>
                    <?php foreach($cadastros as $cadastro): ?>
                    <hr/>
                    <div class="row item">
                        <div class="col">
                            <?php echo $cadastro->cidade; ?> / <?php echo $cadastro->estado; ?>
                        </div>
                        <div class="col">
                            <?php echo $wpdb->get_var("SELECT count(*) FROM {$wpdb->prefix}sorteio_cadastros WHERE cidade = '{$cadastro->cidade}'"); ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>