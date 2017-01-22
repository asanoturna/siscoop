<?php

use yii\bootstrap\Nav;

    echo Nav::widget([
        'activateItems' => true,
        'encodeLabels' => false,
        'items' => [ 
            // [
            //     'label' => '<span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Desempenho',
            //     'items' => [

            //         [
            //             'label' => 'Resumo Diário',
            //             'url' => ['visits/dailysummary'],
            //         ],
            //         [
            //             'label' => 'Desempenho Por Usuário', 
            //             'url' => ['visits/report_user'],
            //         ],
            //         // [
            //         //     'label' => 'Desempenho Por Agência', 
            //         //     'url' => ['visits/ranking_user'],
            //         // ],
            //     ],
            // ],
            [
                'label'   => '<span class="glyphicon glyphicon-download-alt text-danger" aria-hidden="true"></span> <strong class="text-danger">Gestão da Base</strong>',
                'url'     => ['/reportbase/index'],
            ],         
            [
                'label'   => '<span class="glyphicon glyphicon-equalizer" aria-hidden="true"></span> Resumo Diário',
                'url'     => ['visits/dailysummary'],
            ],                 
            [
                'label'   => '<span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Desempenho',
                'url'     => ['visits/report_user'],
            ],                      
            [
                'label'   => '<span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span> Lista das Visitas',
                'url'     => ['visits/index'],
            ],  
            [
                'label'   => '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Inserir',
                'url'     => ['visits/create'],
                'visible' => Yii::$app->user->identity->role_id == 1,
            ],                                                                                         
        ],
    'options' => ['class' =>'nav-pills'],
    ]);
?>