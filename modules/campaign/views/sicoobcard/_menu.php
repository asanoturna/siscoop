<?php
use yii\bootstrap\Nav;
    echo Nav::widget([
        'activateItems' => true,
        'encodeLabels' => false,
        'items' => [ 
            [
                'label'   => '<span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Desempenho',
                'url'     => ['performance'],
            ],  
            [
                'label'   => '<span class="glyphicon glyphicon-save" aria-hidden="true"></span> Material de Apoio',
                'url'     => 'http://172.19.37.4/intranet/index.php/arquivos-a-manuais/doc/442/raw',
                //'linkOptions' => ['target'=> 'blank']
            ], 
            [
                'label'   => '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Inserir',
                'url'     => ['create'],
            ],               
        ],
    'options' => ['class' =>'nav-pills'],
    ]);
?>