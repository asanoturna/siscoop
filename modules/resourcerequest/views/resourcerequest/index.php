<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Location;
use app\modules\resourcerequest\models\Resourcerequest;
use app\modules\resourcerequest\models\Resourcestatus;
use app\models\User;

$this->title = 'Recursos Solicitados';
?>
<div class="resourcerequest-index">

    <div class="row">
      <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
      <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;"><?php  echo $this->render('_menu'); ?></span></div>
    </div>
    <hr/>

    <?php foreach (Yii::$app->session->getAllFlashes() as $key=>$message):?>
        <?php $alertClass = substr($key,strpos($key,'-')+1); ?>
        <div class="alert alert-dismissible alert-<?=$alertClass?>" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p><?=$message?></p>
        </div>
    <?php endforeach ?>

    <div class="row">
    <div class="col-md-8">
      <div class="panel panel-default">
      <div class="panel-heading"><b>Pesquisar</b></div>
        <div class="panel-body">
          <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
      </div>
    </div>      
    <div class="col-md-4">
      <div class="panel panel-default">
      <div class="panel-heading"><b>Opções</b></div>
        <div class="panel-body">
          <?php
          use kartik\export\ExportMenu;
              $gridColumns = [
                  ['attribute'=>'id', 'hAlign'=>'right', 'width'=>'100px'],  
                  ['attribute'=>'created','format'=>['date'], 'hAlign'=>'right', 'width'=>'110px'],  
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
                      'attribute'=>'location_id',
                      'label'=> 'PA',
                      'vAlign'=>'middle',
                      'width'=>'100px',
                      'value'=>function ($model, $key, $index, $widget) { 
                          return Html::a($model->location->shortname, '#', []);
                      },
                      'format'=>'raw'
                  ], 
                  ['attribute'=>'client_name', 'hAlign'=>'right', 'width'=>'140px'], 
                  ['attribute'=>'value_request', 'hAlign'=>'right', 'width'=>'50'],   
                  ['attribute'=>'value_capital', 'hAlign'=>'right', 'width'=>'50'], 
                  [
                      'attribute'=>'requested_month',
                      'label'=> 'Mês',
                      'vAlign'=>'middle',
                      'width'=>'100px',
                      'value'=>function ($data) { 
                          return Html::a($data->getRequestedMonthValue(), '#', []);
                      },
                      'format'=>'raw'
                  ],       
                  [
                      'attribute'=>'requested_year',
                      'label'=> 'Mês',
                      'vAlign'=>'middle',
                      'width'=>'100px',
                      'value'=>function ($data) { 
                          return Html::a($data->getRequestedYearValue(), '#', []);
                      },
                      'format'=>'raw'
                  ], 
                  [
                      'attribute'=>'resource_purposes',
                      'label'=> 'Finalidade',
                      'vAlign'=>'middle',
                      'width'=>'100px',
                      'value'=>function ($data) { 
                          return Html::a($data->getResourcePurposes(), '#', []);
                      },
                      'format'=>'raw'
                  ],   
                  [
                      'attribute'=>'resource_type',
                      'label'=> 'Finalidade',
                      'vAlign'=>'middle',
                      'width'=>'100px',
                      'value'=>function ($data) { 
                          return Html::a($data->getResourceType(), '#', []);
                      },
                      'format'=>'raw'
                  ],    
                 [
                      'attribute'=>'add_insurance',
                      'label'=> 'Seguro?',
                      'vAlign'=>'middle',
                      'width'=>'100px',
                      'value'=>function ($model, $key, $index, $widget) { 
                          return Html::a(($model->add_insurance == 1 ? 'SIM' : 'NÃO'), '#', []);
                      },
                      'format'=>'raw'
                  ],                                                   
                  [
                      'attribute'=>'resource_status_id',
                      'label'=> 'Situação',
                      'vAlign'=>'middle',
                      'width'=>'100px',
                      'value'=>function ($model, $key, $index, $widget) { 
                          return Html::a($model->resourceStatus->name, '#', []);
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
            'filename' => 'relatorio-recursos',
            ]);
          ?>
          <?= Html::a('<span class="glyphicon glyphicon-save" ></span> Registros antigos', [Yii::$app->params['reportbasePath'].'/baseantiga.xls'], ['class'=>'btn btn-success']) ?>
        </div>
      </div>
    </div>
    </div>    

    <div class="panel panel-default">
        <div class="panel-body"> 
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class'=>'table table-striped table-hover'],
        'emptyText'    => '</br><p class="text-info">Nenhum registro encontrado!</p>',
        'columns' => [
            [
              'attribute' => 'id',
              'enableSorting' => true,
              'contentOptions'=>['style'=>'width: 4%;text-align:center'],
              'headerOptions' => ['class' => 'text-center'],
            ], 
            [
              'attribute' => 'created',
              'enableSorting' => true,
              'contentOptions'=>['style'=>'width: 5%;text-align:center'],
              'headerOptions' => ['class' => 'text-center'],
              'format' => ['date', 'php:d/m/Y'],
            ],   
            [
              'attribute' => 'user_id',
              'format' => 'raw',
              'enableSorting' => true,
              'value' => function ($model) {                      
                  return $model->user ? $model->user->username : '<span class="text-danger"><em>Nenhum</em></span>';
              },
              'filter' => ArrayHelper::map(User::find()->orderBy('username')->asArray()->all(), 'id', 'username'),
              'headerOptions' => ['class' => 'text-center'],
              'contentOptions'=>['style'=>'width: 8%;text-align:left'],
            ],   
            [
              'attribute' => 'location_id',
              'enableSorting' => true,
              'value' => function ($model) {                      
                      return $model->location->shortname;
                      },
              'filter' => ArrayHelper::map(Location::find()->orderBy('shortname')->asArray()->all(), 'id', 'shortname'),
              'contentOptions'=>['style'=>'width: 3%;text-align:center'],
              'headerOptions' => ['class' => 'text-center'],
            ],                                   
            [
              'attribute' => 'client_name',
              'contentOptions'=>['style'=>'width: 15%;text-align:left;text-transform: uppercase'],
              'headerOptions' => ['class' => 'text-center'],
            ],
            [
              'attribute' => 'value_request',
              'enableSorting' => true,
              'format'=>['decimal',2],
              'contentOptions'=>['style'=>'width: 5%;text-align:center'],
              'headerOptions' => ['class' => 'text-center'],
            ],     
            [
              'attribute' => 'requested_month',
              'enableSorting' => true,
              'value' => function($data) {
                  return $data->getRequestedMonthValue(); // OR use magic property $data->requestedMounthValue;
              },
              'filter' => Resourcerequest::$Static_requested_month,
              'contentOptions'=>['style'=>'width: 10%;text-align:center'],
              'headerOptions' => ['class' => 'text-center'],
            ],     
            [
              'attribute' => 'requested_year',
              'enableSorting' => true,
              'value' => function($data) {
                  return $data->getRequestedYearValue(); // OR use magic property $data->requestedMounthValue;
              },
              'filter' => Resourcerequest::$Static_requested_year,
              'contentOptions'=>['style'=>'width: 5%;text-align:center'],
              'headerOptions' => ['class' => 'text-center'],
            ],             
            [
              'attribute' => 'resource_purposes',
              'enableSorting' => true,
              'value' => function($data) {
                  return $data->getResourcePurposes(); // OR use magic property $data->requestedMounthValue;
              },
              'filter' => Resourcerequest::$Static_resource_purposes,
              'contentOptions'=>['style'=>'width: 10%;text-align:center'],
              'headerOptions' => ['class' => 'text-center'],
            ],            
            [
              'attribute' => 'resource_type',
              'enableSorting' => true,
              'value' => function($data) {
                  return $data->getResourceType(); // OR use magic property $data->requestedMounthValue;
              },
              'filter' => Resourcerequest::$Static_resource_type,
              'contentOptions'=>['style'=>'width: 10%;text-align:center'],
              'headerOptions' => ['class' => 'text-center'],
            ],                                     
            [
              'attribute' => 'add_insurance',
              'label' => 'Seguro?',
              'enableSorting' => true,
              'value' => function($model) {
                  return $model->add_insurance == 1 ? 'SIM' : 'NÃO';
              },
              'filter' => Resourcerequest::$Static_add_insurance,
              'contentOptions'=>['style'=>'width: 5%;text-align:center'],
              'headerOptions' => ['class' => 'text-center'],
            ], 
            [
              'attribute' => 'resource_status_id',
              'enableSorting' => true,
              'format' => 'raw',          
              // 'value' => function ($model) {                      
              //         return '<span style="color:'.$model->resourceStatus->hexcolor.'">'.$model->resourceStatus->name.'</span>';
              //         },
              'value'=>function($model) {
                  if(isset($model->manager)) {
                      return Html::tag('div', '<span style="color:'.$model->resourceStatus->hexcolor.'">'.$model->resourceStatus->name.'</span>', ['data-toggle'=>'tooltip','data-placement'=>'bottom','title'=>'Alterado por '.$model->manager->username]);
                  } else {
                      return Html::tag('div', '<span style="color:'.$model->resourceStatus->hexcolor.'">'.$model->resourceStatus->name.'</span>', ['data-toggle'=>'tooltip','data-placement'=>'bottom','title'=>'Aguardando atendimento']);
                  }
              },                      
              'filter' => ArrayHelper::map(Resourcestatus::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
              'contentOptions'=>['style'=>'width: 10%;text-align:center'],
              'headerOptions' => ['class' => 'text-center'],
            ],
            [
              'class' => 'yii\grid\ActionColumn',
              'header' => 'Ações',  
              'contentOptions'=>['style'=>'width: 15%;text-align:right'],
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
                      return $model->user_id === Yii::$app->user->identity->id ? Html::a('<span class="glyphicon glyphicon-trash" ></span>', $url, [
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