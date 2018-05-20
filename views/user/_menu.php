<?php

use yii\bootstrap\Nav;

    echo Nav::widget([
        'activateItems' => true,
        'encodeLabels' => false,
        'items' => [  
            [
                'label'   => '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Alterar Informações',
                'url'     => ['/user/changeprofile'],
            ],                      
            // [
            //     'label'   => '<span class="glyphicon glyphicon-picture" aria-hidden="true"></span> Alterar Imagem',
            //     'url'     => ['/user/changeavatar'],
            // ],  
            [
                'label'   => '<span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Alterar Senha',
                'url'     => ['/user/resetpassword'],
            ],                                                                                         
        ],
    'options' => ['class' =>'nav-pills'],
    ]);
?>