	<?php

    use yii\bootstrap\Nav;

            echo Nav::widget([
                'activateItems' => true,
                'encodeLabels' => false,
                'items' => [ 
                    [
                        'label'   => '<span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Estatísticas',
                        'url'     => ['ranking'],
                        'active'  => false,
                    ],                 
                    // [
                    //     'label'   => '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Inserir',
                    //     'url'     => ['create'],
                    // ],
                    [
                        'label'   => '<span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span> Listar',
                        'url'     => ['index'],
                    ],                                                                               
                ],
            'options' => ['class' =>'nav-pills'],
            ]);
	?>