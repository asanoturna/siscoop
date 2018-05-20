	<?php
    use yii\bootstrap\Nav;
            echo Nav::widget([
                'activateItems' => true,
                'encodeLabels' => false,
                'items' => [ 
                    [
                        'label'   => '<span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Relatórios',
                        'url'     => ['report'],
                        'options' => ['class' => 'disabled'],
                    ],                      
                    [
                        'label'   => '<span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span> Listar',
                        'url'     => ['index'],
                    ],                  
                    [
                        'label'   => '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Inserir',
                        'url'     => ['create'],
                        'visible' => Yii::$app->user->identity->role_id == 1,
                    ],                                                                                 
                ],
            'options' => ['class' =>'nav-pills'],
            ]);
	?>