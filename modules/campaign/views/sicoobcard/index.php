<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Location;
use app\modules\campaign\models\Sicoobcard;
use app\models\User;

$this->title = 'Campanha Sicoobcard Todo Dia';
?>
<div class="campaign-sicoobcard-index">

    <div class="row">
      <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
      <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;"><?php  echo $this->render('_menu'); ?></span></div></div>
    </div>
    <hr/>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php foreach (Yii::$app->session->getAllFlashes() as $key=>$message):?>
        <?php $alertClass = substr($key,strpos($key,'-')+1); ?>
        <div class="alert alert-dismissible alert-<?=$alertClass?>" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p><?=$message?></p>
        </div>
    <?php endforeach ?>

    <p>
    <?php
    use kartik\export\ExportMenu;
              $gridColumns = [
                  ['attribute'=>'id', 'hAlign'=>'right', 'width'=>'90px'],  
                  [
                  'attribute'=>'product_type',
                  'label'=> 'Produto',
                  'vAlign'=>'middle',
                  'width'=>'100px',
                  'value' => function($data) {
                      return $data->getProductType();
                  },
                  'format'=>'raw'
                  ],                                      
                  [
                    'attribute'=>'location_id',
                    'label'=> 'PA',
                    'vAlign'=>'middle',
                    'width'=>'100px',
                    'value'=>function ($model, $key, $index, $widget) { 
                        return Html::a($model->location->shortname, '#', []);
                    },
                    'format'=>'raw'
                  ], 
                  ['attribute'=>'name', 'hAlign'=>'right', 'width'=>'90px'],
                  ['attribute'=>'card', 'hAlign'=>'right', 'width'=>'50px'],
                  ['attribute'=>'purchasedate','format'=>['date'], 'hAlign'=>'right', 'width'=>'110px'],                 
                  ['attribute'=>'purchasevalue','format'=>['decimal',2], 'hAlign'=>'right', 'width'=>'110px'],
                  ['attribute'=>'purchaselocal', 'hAlign'=>'right', 'width'=>'90px'], 
                  [
                    'attribute'=>'user_id',
                    'label'=> 'Usuário',
                    'vAlign'=>'middle',
                    'width'=>'100px',
                    'value'=>function ($model, $key, $index, $widget) { 
                        return Html::a($model->user->username, '#', []);
                    },
                    'format'=>'raw'
                  ],   
                  [
                  'attribute'=>'status',
                  'label'=> 'Situação',
                  'vAlign'=>'middle',
                  'width'=>'100px',
                  'value' => function($data) {
                      return $data->getStatus();
                  },
                  'format'=>'raw'
                  ],                                                                      
              ];
              echo ExportMenu::widget([
              'dataProvider' => $dataProvider,
              'columns' => $gridColumns,
              'fontAwesome' => true,
              'emptyText' => 'Nenhum registro',
              'showColumnSelector' => true,
              'asDropdown' => true,
              'target' => ExportMenu::TARGET_BLANK,
              'showConfirmAlert' => false,
              'exportConfig' => [
                ExportMenu::FORMAT_HTML => false,
                ExportMenu::FORMAT_CSV => false,
                ExportMenu::FORMAT_TEXT => false,
                ExportMenu::FORMAT_PDF => false
            ],
            'columnSelectorOptions' => [
              'class' => 'btn btn-success',
            ],
            'dropdownOptions' => [
              'icon' => false,
              'label' => 'Exportar Registros',
              'class' => 'btn btn-success',
            ],
            'filename' => 'relatorio-campanha-sicoobcard-todo-dia',
            ]);
    ?> 
    </p>      

    <div class="panel panel-default">
        <div class="panel-body">     
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                  'attribute' => 'id',
                  'enableSorting' => true,
                  'contentOptions'=>['style'=>'width: 3%;text-align:center'],
                ], 
                [
                  'attribute' => 'product_type',
                  'enableSorting' => true,
                  'value' => function($data) {
                      return $data->getProductType();
                  },
                  'filter' => Sicoobcard::$Static_product_type,
                  'contentOptions'=>['style'=>'width: 6%;text-align:center'],
                ], 
                [
                  'attribute' => 'location_id',
                  'format' => 'raw',
                  'enableSorting' => true,
                  'value' => function ($model) {                      
                      return $model->location ? $model->location->shortname : '<span class="text-danger"><em>Nenhum</em></span>';
                  },
                  'filter' => ArrayHelper::map(Location::find()->orderBy('shortname')->asArray()->all(), 'id', 'shortname'),
                  'contentOptions'=>['style'=>'width: 6%;text-align:center'],
                ],                                             
                [
                  'attribute' => 'name',
                  'enableSorting' => true,
                  'contentOptions'=>['style'=>'width: 12%;text-align:letf'],
                ],                 
                [
                  'attribute' => 'card',
                  'enableSorting' => true,
                  'contentOptions'=>['style'=>'width: 10%;text-align:center'],
                ],                
                [
                  'attribute' => 'purchasedate',
                  'enableSorting' => true,
                  'contentOptions'=>['style'=>'width: 4%;text-align:center'],
                  'format' => ['date', 'php:d/m/Y'],
                ],                  
                [
                  'attribute' => 'purchasevalue',
                  'format'=>['decimal',2],
                  'enableSorting' => true,
                  'contentOptions'=>['style'=>'width: 4%;text-align:center'],
                ],                 
                [
                  'attribute' => 'purchaselocal',
                  'enableSorting' => true,
                  'contentOptions'=>['style'=>'width: 12%;text-align:center'],
                ],                  
                [
                  'attribute' => 'user_id',
                  'format' => 'raw',
                  'enableSorting' => true,
                  'value' => function ($model) {                      
                      return $model->user ? $model->user->username : '<span class="text-danger"><em>Nenhum</em></span>';
                  },
                  'filter' => ArrayHelper::map(User::find()->orderBy('username')->asArray()->all(), 'id', 'username'),
                  'contentOptions'=>['style'=>'width: 8%;text-align:left'],
                ],
                [
                  'attribute' => 'status',
                  'format' => 'raw',
                  'enableSorting' => true,
                  'value' => function($data) {
                      return $data->getStatus() == 'APROVADO' ? "<span class=\"label label-success\">".$data->getStatus()."</span>" : "<span class=\"label label-warning\">".$data->getStatus()."</span>";
                  },
                  'filter' => Sicoobcard::$Static_status,
                  'contentOptions'=>['style'=>'width: 6%;text-align:center'],
                ],   
                [
                    'attribute' => 'approved_by',
                    'format' => 'raw',
                    'enableSorting' => true,
                    'value' => function ($model) {                      
                        return $model->approvedby ? $model->approvedby->username : '<span class="text-danger"><em>Nenhum</em></span>';
                    },
                    'filter' => ArrayHelper::map(User::find()->orderBy('username')->asArray()->all(), 'id', 'username'),
                    'contentOptions'=>['style'=>'width: 6%;text-align:left'],
                ],                              
                [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Ações',  
                'contentOptions'=>['style'=>'width: 10%;text-align:right'],
                'headerOptions' => ['class' => 'text-center'],                            
                'template' => '{view} {update} {delete} {manager}',
                'buttons' => [
                  'view' => function ($url, $model) {
                      return Html::a('<span class="glyphicon glyphicon-list-alt" ></span>', $url, [
                                  'title' => 'Detalhes',
                                  'class' => 'btn btn-default btn-xs',
                      ]);
                  },                                                
                  'update' => function ($url, $model) {
                      return $model->user_id === Yii::$app->user->identity->id ? Html::a('<span class="glyphicon glyphicon-pencil" ></span>', $url, [
                                  'title' => 'Alterar',
                                  'class' => 'btn btn-default btn-xs',
                      ]): Html::a('<span class="glyphicon glyphicon-pencil" ></span>', "#", [
                                  'title' => 'Registro pertence a outro usuário!',
                                  'class' => 'btn btn-default btn-xs',
                                  'disabled' => true,
                      ]);
                  },
                  'delete' => function ($url, $model) {
                      return Yii::$app->user->identity->role_id == 2 ? Html::a('<span class="glyphicon glyphicon-trash" ></span>', $url, [
                                  'title' => 'Excluir',
                                  'class' => 'btn btn-default btn-xs',
                                  'data-confirm' => 'Tem certeza que deseja excluir?',
                                  'data-method' => 'post',
                                  'data-pjax' => '0',
                      ]): Html::a('<span class="glyphicon glyphicon-trash" ></span>', "#", [
                                  'title' => 'Registro pertence a outro usuário!',
                                  'class' => 'btn btn-default btn-xs',
                                  'disabled' => true,
                      ]);
                  },  
                  'manager' => function ($url, $model) {
                      return Yii::$app->user->identity->role_id == 2 ? Html::a('<span class="glyphicon glyphicon-cog" ></span>', $url, [
                                  'title' => 'Alterar Situação',
                                  'class' => 'btn btn-default btn-xs',
                      ]): Html::a('<span class="glyphicon glyphicon-cog" ></span>', "#", [
                                  'title' => 'Acesso não permitido!',
                                  'class' => 'btn btn-default btn-xs',
                                  'disabled' => true,
                      ]);
                  },                                                    
                    ],                
              ],
            ],
        ]); ?>
        </div>
    </div>
</div>
