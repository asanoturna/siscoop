<?php
use yii\bootstrap\Nav;

?>
    <div class="panel panel-default">
      <div class="panel-heading"><b>Gerenciar</b></div>
      <div class="panel-body">
    <?php      
    echo Nav::widget([
    'activateItems' => true,
    'encodeLabels' => false,
    'items' => [
        [
        'label'   => '<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span> Painel',
        'url'     => ['dashboard/index'],
        'visible' => Yii::$app->user->identity->role_id == 99,
        //'options' => ['class' => 'disabled'],
        ],
        [
        'label'   => '<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span> Usuários',
        'url'     => ['useradmin/index'],
        'visible' => Yii::$app->user->identity->role_id == 99,
        ],
        [
        'label'   => '<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span> Perfis de Acesso',
        'url'     => ['role/index'],
        'visible' => Yii::$app->user->identity->role_id == 99,
        ],
        [
        'label'   => '<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span> Unidades',
        'url'     => ['location/index'],
        'visible' => Yii::$app->user->identity->role_id == 99,
        ],
        [
        'label'   => '<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span> Departamentos',
        'url'     => ['department/index'],
        'visible' => Yii::$app->user->identity->role_id == 99,
        ],
        [
        'label'   => '<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span> Menu',
        'url'     => ['menuadmin/index'],
        'visible' => Yii::$app->user->identity->role_id == 99,
        ],
        [
        'label'   => '<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span> Links',
        'url'     => ['links/index'],
        'visible' => Yii::$app->user->identity->role_id == 99,
        ],
        // [
        // 'label'   => '<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span> Arquivos',
        // 'url'     => ['archive/index'],
        // 'visible' => Yii::$app->user->identity->role_id == 99,
        // ],  
    ],
    'options' => ['class' =>'nav-pills nav-stacked'],
    ]);
    ?>
      </div>
    </div>