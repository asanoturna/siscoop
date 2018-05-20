	<?php
    use yii\bootstrap\Nav;

    echo Nav::widget([
        'activateItems' => true,
        'encodeLabels' => false,
        'items' => [ 
            [
                'label'   => '<i class="fa fa-certificate" aria-hidden="true"></i> Regulamento',
                'url'     => ['regulation'],
            ],                 
            [
                'label'   => '<i class="fa fa-bars" aria-hidden="true"></i> Histórico de Idéias',
                'url'     => ['index'],
            ],   
            [
                'label'   => '<i class="fa fa-lightbulb-o" aria-hidden="true"></i> Cadastre sua Idéia!',
                'url'     => ['create'],
            ], 
        ],
    'options' => ['class' =>'nav-pills'],
    ]);
	?>