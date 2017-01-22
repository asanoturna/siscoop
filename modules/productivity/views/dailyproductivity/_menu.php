<?php
use yii\bootstrap\Nav;
    echo Nav::widget([
        'activateItems' => true,
        'encodeLabels' => false,
        'items' => [
            [
                'label' => '<span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Desempenho',
                'items' => [
                    [
                        'label' => 'Ranking por Usuário', 
                        'url' => ['ranking_user'],
                    ],
                    [
                        'label' => 'Ranking por Agência',
                        'url' => ['ranking_location'],
                    ],
                    [
                        'label' => 'Desempenho por Usuário',
                        'url' => ['performance_user'],
                    ],                            
                    [
                        'label' => 'Visão Geral dos Produtos',
                        'url' => ['performance_overview'],
                    ],                            
                ],
            ],   
            [
                'label'   => '<span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span> Listar',
                'url'     => ['index'],
            ],  
            [
                'label'   => '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Inserir',
                'url'     => ['create'],
            ],                                                                                                 
            [
                'label'   => '<span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> Gerenciar',
                'url'     => ['/productivity/managerdailyproductivity/index'],
                'visible' => Yii::$app->user->identity->role_id == 2,
            ], 
        ],
    'options' => ['class' =>'nav-pills'],
    ]);
?>