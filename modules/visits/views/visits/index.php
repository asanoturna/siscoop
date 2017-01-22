<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Location;
use app\models\Person;
use app\modules\visits\models\Visitsfinality;
use app\modules\visits\models\Visitsstatus;
use app\modules\visits\models\Visitsimages;
use app\modules\visits\models\Visits;
use app\models\User;
use yii\bootstrap\Modal;


$this->title = 'Visitas dos Gerentes';
?>
<div class="visits-index">

    <div class="row">
      <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
      <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;"><?php  echo $this->render('_menu'); ?></span></div>
    </div>
    <hr/>

  <div class="alert alert-info fade in" align="center">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <i class="fa fa-info-circle fa-lg" aria-hidden="true"></i> <strong >Prezados, conforme solicitado pela diretoria, a partir de 14/09/2016 foi incluído uma nova coluna chamada APROVADO, onde o gerente Otávio irá aprovar ou não os registros de visita.
</strong>
  </div>      

  <div class="alert alert-danger fade in" align="center">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i> <strong >É NECESSÁRIO CADASTRAR AS VISITAS REALIZADAS NO DIA ATÉ AS 17:00H DE CADA DIA</strong>
  </div>    

    <?php foreach (Yii::$app->session->getAllFlashes() as $key=>$message):?>
        <?php $alertClass = substr($key,strpos($key,'-')+1); ?>
        <div class="alert alert-dismissible alert-<?=$alertClass?>" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p><?=$message?></p>
        </div>
    <?php endforeach ?>    

    <div class="row">
    <div class="col-md-6">
      <div class="panel panel-default">
      <div class="panel-heading"><b>Pesquisar</b></div>
        <div class="panel-body">
          <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
      </div>
    </div>      
    <div class="col-md-6">
      <div class="panel panel-default">
      <div class="panel-heading"><b>Opções</b></div>
        <div class="panel-body">
          <?php
          Modal::begin([
              'header' => '<h3>Tipos de Situação das Visitas</h3>',
              'toggleButton' => ['label' => '<span class="glyphicon glyphicon-flag" aria-hidden="true"></span> Tipos de Situação', 'class' => 'btn btn-success'],
          ]);

          echo $this->render('liststatus');

          Modal::end();
          ?>
          <?php
          use kartik\export\ExportMenu;
              $gridColumns = [
                  ['attribute'=>'id', 'hAlign'=>'right', 'width'=>'100px'],  
                  ['attribute'=>'date','format'=>['date'], 'hAlign'=>'right', 'width'=>'110px'],  
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
                  ['attribute'=>'company_person', 'hAlign'=>'right', 'width'=>'140px'], 
                  [
                      'attribute'=>'visits_finality_id',
                      'label'=> 'Finalidade',
                      'vAlign'=>'middle',
                      'width'=>'180px',
                      'value'=>function ($model, $key, $index, $widget) { 
                          return Html::a($model->visitsFinality->name, '#', []);
                      },
                      'format'=>'raw'
                  ],                    
                  [
                      'attribute'=>'visits_status_id',
                      'label'=> 'Situação',
                      'vAlign'=>'middle',
                      'width'=>'120px',
                      'value'=>function ($model, $key, $index, $widget) { 
                          return Html::a($model->visitsStatus->name, '#', []);
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
            'filename' => 'relatorio-visitas',
            ]);
          ?>
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
            'contentOptions'=>['style'=>'width: 4%;text-align:center'],
            'headerOptions' => ['class' => 'text-center'],
            ],
            [
            'attribute' => 'date',
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
                         return Html::a($model->user->username, ['/visits/report_user', 'user_id' => $model->user_id]);
                     },            
            'filter' => ArrayHelper::map(User::find()->where(['status' => 1])->orderBy('username')->asArray()->all(), 'id', 'username'),
            'filterInputOptions' => ['class' => 'form-control', 'style'=>'text-transform: lowercase'],
            'contentOptions'=>['style'=>'width: 8%;text-align:left;text-transform: lowercase'],
            'headerOptions' => ['class' => 'text-center'],
            ],
            [
            'attribute' => 'location_id',
            'format' => 'raw',
            'enableSorting' => true,
            'value' => function ($model) {                      
                    return $model->location->shortname;
                    },  
            'filter' => ArrayHelper::map(Location::find()->orderBy('shortname')->asArray()->all(), 'id', 'shortname'),
            'contentOptions'=>['style'=>'width: 3%;text-align:center'],
            'headerOptions' => ['class' => 'text-center'],
            ],
            [
            'attribute' => 'company_person',
            'contentOptions'=>['style'=>'width: 18%;text-align:left;text-transform: uppercase'],
            'headerOptions' => ['class' => 'text-center'],
            ],
            [
            'attribute' => 'person_id',
            'format' => 'raw',
            'enableSorting' => true,
            'value' => function ($model) {                      
                    return $model->person->name;
                    },  
            'filter' => ArrayHelper::map(Person::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
            'contentOptions'=>['style'=>'width: 3%;text-align:center'],
            'headerOptions' => ['class' => 'text-center'],
            ],
            [
            'attribute' => 'visits_finality_id',
            'format' => 'raw',
            'enableSorting' => true,
            'value' => function ($model) {                      
                    return $model->visitsFinality->name;
                    },
            'filter' => ArrayHelper::map(VisitsFinality::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
            'contentOptions'=>['style'=>'width: 15%;text-align:center'],
            'headerOptions' => ['class' => 'text-center'],
            ],
            [
            'attribute' => 'visits_status_id',
            'format' => 'raw',
            'enableSorting' => true,
            'value' => function ($model) {                      
                  return '<span style="color:'.$model->visitsStatus->hexcolor.'">'.$model->visitsStatus->name.'</span>';
                  },
            'filter' => ArrayHelper::map(VisitsStatus::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
            'contentOptions'=>['style'=>'width: 10%;text-align:center'],
            'headerOptions' => ['class' => 'text-center'],
            ],
            [
            'attribute' => 'approved',
            'format' => 'raw',
            'enableSorting' => true,
            // 'value' => function($data) {
            //   return $data->getApproved();
            // },
            'value' => function ($data) {                      
                    return $data->getApproved() == 'SIM' ? '<span class="label label-success">SIM</span>' : '<span class="label label-danger">NÃO</span>';
                    },            
            'filter' => Visits::$Static_approved,
            'contentOptions'=>['style'=>'width: 5%;text-align:center'],
            ],            
            [
            'class' => 'yii\grid\ActionColumn',
            'header' => 'Ações',
            'contentOptions'=>['style'=>'width: 10%;text-align:right'],
            'headerOptions' => ['class' => 'text-center'],
            'template' => '{has_map} {has_attach} {has_img} {view} {update} {delete} {manager}',
                'buttons' => [
                    'has_attach' => function ($url, $model) {
                        return $model->attachment <> null ? Html::a('<span class="glyphicon glyphicon-paperclip" ></span>', ['view', 'id' => $model->id], [
                                    'title' => 'Possui anexo',
                                    'class' => 'btn btn-default btn-xs',
                        ]): Html::a('<span class="glyphicon glyphicon-ban-circle" ></span>', "#", [
                                    'title' => 'Não possui anexo!',
                                    'class' => 'btn btn-default btn-xs',
                                    'disabled' => true,
                        ]);
                    },
                    'has_map' => function ($url, $model) {
                        return $model->localization_map <> '' ? Html::a('<span class="glyphicon glyphicon-map-marker" ></span>', ['view', 'id' => $model->id,'#' => 'map'], [
                                    'title' => 'Possui mapa',
                                    'class' => 'btn btn-default btn-xs',
                        ]): Html::a('<span class="glyphicon glyphicon-ban-circle" ></span>', "#", [
                                    'title' => 'Não possui mapa!',
                                    'class' => 'btn btn-default btn-xs',
                                    'disabled' => true,
                        ]);
                    },
                    'has_img' => function ($url, $model) {
                        return $model->visitsImages <> null ? Html::a('<span class="glyphicon glyphicon-camera" ></span>', ['view', 'id' => $model->id,'#' => 'img'], [
                                    'title' => 'Possui imagem',
                                    'class' => 'btn btn-default btn-xs',
                        ]): Html::a('<span class="glyphicon glyphicon-ban-circle" ></span>', "#", [
                                    'title' => 'Não possui imagem!',
                                    'class' => 'btn btn-default btn-xs',
                                    'disabled' => true,
                        ]);
                    },
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open" ></span>', $url, [
                                    'title' => 'Visualizar',
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
                                    'title' => 'Alterar',
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
                        return Yii::$app->user->identity->role_id == 3 ? Html::a('<span class="glyphicon glyphicon-cog" ></span>', $url, [
                                    'title' => 'Aprovar Registro',
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