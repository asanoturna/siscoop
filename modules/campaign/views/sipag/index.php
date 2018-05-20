<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\modules\campaign\models\Sipag;
use app\models\User;

$this->title = 'Ação Foco SIPAG';
?>
<div class="opcredit-index">

    <div class="row">
      <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
      <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;"><?php  echo $this->render('_menu'); ?></span></div>
    </div>
    <hr/>

  <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

  <p>
  <?php use kartik\export\ExportMenu;
              $gridColumns = [
                  ['attribute'=>'id', 'hAlign'=>'right', 'width'=>'20px'], 
                 [
                  'attribute'=>'establishmenttype',
                  'vAlign'=>'middle',
                  'width'=>'100px',
                  'value' => function($data) {
                      return $data->getEstablishmenttype();
                  },
                  'format'=>'raw'
                  ],
                  ['attribute'=>'establishmentname', 'hAlign'=>'right', 'width'=>'100px'], 
                  ['attribute'=>'address', 'hAlign'=>'right', 'width'=>'100px'],
                  [
                  'attribute'=>'flag_sipag',
                  'label'=> 'SIPAG',
                  'vAlign'=>'middle',
                  'width'=>'100px',
                  'value' => function($data) {
                      return $data->getFlagsipag();
                  },
                  'format'=>'raw'
                  ],
                  [
                  'attribute'=>'flag_sipag_locked',
                  'label'=> 'Travado SIPAG',
                  'vAlign'=>'middle',
                  'width'=>'100px',
                  'value' => function($data) {
                      return $data->getFlagsipaglocked();
                  },
                  'format'=>'raw'
                  ],
                 [
                  'attribute'=>'flag_rede',
                  'label'=> 'REDE',
                  'vAlign'=>'middle',
                  'width'=>'100px',
                  'value' => function($data) {
                      return $data->getFlagrede();
                  },
                  'format'=>'raw'
                  ],
                 [
                  'attribute'=>'flag_rede_locked',
                  'label'=> 'Travado REDE',
                  'vAlign'=>'middle',
                  'width'=>'100px',
                  'value' => function($data) {
                      return $data->getFlagredelocked();
                  },
                  'format'=>'raw'
                  ],
                 [
                  'attribute'=>'flag_cielo',
                  'label'=> 'CIELO',
                  'vAlign'=>'middle',
                  'width'=>'100px',
                  'value' => function($data) {
                      return $data->getFlagcielo();
                  },
                  'format'=>'raw'
                  ],
                 [
                  'attribute'=>'flag_cielo_locked',
                  'label'=> 'Travado CIELO',
                  'vAlign'=>'middle',
                  'width'=>'100px',
                  'value' => function($data) {
                      return $data->getFlagcielolocked();
                  },
                  'format'=>'raw'
                  ],
                 [
                  'attribute'=>'visited',
                  'vAlign'=>'middle',
                  'width'=>'100px',
                  'value' => function($data) {
                      return $data->getVisited();
                  },
                  'format'=>'raw'
                  ],
                 [
                  'attribute'=>'accredited',
                  'vAlign'=>'middle',
                  'width'=>'100px',
                  'value' => function($data) {
                      return $data->getAccredited();
                  },
                  'format'=>'raw'
                  ],
                 [
                  'attribute'=>'locked',
                  'vAlign'=>'middle',
                  'width'=>'100px',
                  'value' => function($data) {
                      return $data->getLocked();
                  },
                  'format'=>'raw'
                  ],
                 [
                  'attribute'=>'anticipation',
                  'vAlign'=>'middle',
                  'width'=>'100px',
                  'value' => function($data) {
                      return $data->getAnticipation();
                  },
                  'format'=>'raw'
                  ],
                 [
                  'attribute'=>'status',
                  'vAlign'=>'middle',
                  'width'=>'100px',
                  'value' => function($data) {
                      return $data->getStatus();
                  },
                  'format'=>'raw'
                  ],
                  [
                    'attribute'=>'user_id',
                    'label'=> 'Usuário',
                    'vAlign'=>'middle',
                    'width'=>'100px',
                    'value' => function ($model) {                      
                        return $model->user ? $model->user->username : null;
                    },
                    'format'=>'raw'
                  ],
                  [
                    'attribute'=>'checkedby_id',
                    'label'=> 'Aprovador Por',
                    'vAlign'=>'middle',
                    'width'=>'100px',
                    'value' => function ($model) {                      
                        return $model->checkedby ? $model->checkedby->username : null;
                    },
                    'format'=>'raw'
                  ],
                  ['attribute'=>'date','format'=>['date'], 'hAlign'=>'right', 'width'=>'110px'],
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
            'filename' => 'relatorio-campanha-sipag',
            ]);
    ?> </p>

    <div class="panel panel-default">
    <div class="panel-body">
    <?php
    yii\bootstrap\Modal::begin(['id' =>'modal']);
    yii\bootstrap\Modal::end();
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class'=>'table table-striped table-hover'],
        'emptyText'    => '</br><p class="text-info">Nenhum registro encontrado!</p>',  
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '<span class="not-set">(não informado)</span>'],
        'columns' => [
            [
                'attribute' => 'id',
                'enableSorting' => true,
                'contentOptions'=>['style'=>'width: 3%;text-align:center'],
            ],
            [
                'attribute' => 'establishmentname',
                'format' => 'raw',
                'value' => function ($model) {
                      return $model->establishmentname."<p class=\"text-muted\">".$model->expedient."</p>";
                },
                'contentOptions'=>['style'=>'width: 10%;text-align:left'],
            ],
            [
                'attribute' => 'address',
                'value'=> function($model){
                      return  '<span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> '.Html::a($model->address, ['view','id'=>$model->id,'#' => 'map'], [
                                    'title' => 'Clique para ver o mapa']);
                },
                'format' => 'raw',
                'contentOptions'=>['style'=>'width: 10%;text-align:left'],
            ],
            [
                'attribute' => 'flag_sipag',
                'enableSorting' => true,
                'format' => 'raw',
                'value' => function ($data) {                      
                        return $data->getFlagsipag() == 'SIM' ?  '<span class="glyphicon glyphicon-ok text-success" aria-hidden="true"></span>' : '<span class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></span>';
                        },
                'filter' => Sipag::$Static_flag_sipag,
                'contentOptions'=>['style'=>'width: 5%;text-align:center'],
            ],
            [
                'label' => '<img src="'.Yii::$app->request->baseUrl.'/images/locked.png" style="height:25px;" >',
                'encodeLabel' => false,
                'headerOptions'=>['style'=>'width: 5%;text-align:center'],
                'attribute' => 'flag_sipag_locked',
                'enableSorting' => true,
                'format' => 'raw',
                'value' => function ($data) {                      
                        return $data->getFlagsipaglocked() == 'SIM' ?  '<span class="glyphicon glyphicon-ok text-success" aria-hidden="true"></span>' : '<span class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></span>';
                        },
                'filter' => Sipag::$Static_flag_sipag_locked,
                'contentOptions'=>['style'=>'width: 5%;text-align:center'],
            ],
            [
                'attribute' => 'flag_rede',
                'enableSorting' => true,
                'format' => 'raw',
                'value' => function ($data) {                      
                        return $data->getFlagrede() == 'SIM' ?  '<span class="glyphicon glyphicon-ok text-success" aria-hidden="true"></span>' : '<span class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></span>';
                        },
                'filter' => Sipag::$Static_flag_rede,
                'contentOptions'=>['style'=>'width: 5%;text-align:center'],
            ],
            [
                'label' => '<img src="'.Yii::$app->request->baseUrl.'/images/locked.png" style="height:25px;" >',
                'encodeLabel' => false,
                'headerOptions'=>['style'=>'width: 5%;text-align:center'],            
                'attribute' => 'flag_rede_locked',
                'enableSorting' => true,
                'format' => 'raw',
                'value' => function ($data) {                      
                        return $data->getFlagredelocked() == 'SIM' ?  '<span class="glyphicon glyphicon-ok text-success" aria-hidden="true"></span>' : '<span class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></span>';
                        },
                'filter' => Sipag::$Static_flag_rede_locked,
                'contentOptions'=>['style'=>'width: 5%;text-align:center'],
            ],
            [
                'attribute' => 'flag_cielo',
                'enableSorting' => true,
                'format' => 'raw',
                'value' => function ($data) {                      
                        return $data->getFlagcielo() == 'SIM' ?  '<span class="glyphicon glyphicon-ok text-success" aria-hidden="true"></span>' : '<span class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></span>';
                        },
                'filter' => Sipag::$Static_flag_cielo,
                'contentOptions'=>['style'=>'width: 5%;text-align:center'],
            ],
            [
                'label' => '<img src="'.Yii::$app->request->baseUrl.'/images/locked.png" style="height:25px;" >',
                'encodeLabel' => false,
                'headerOptions'=>['style'=>'width: 5%;text-align:center'],
                'attribute' => 'flag_cielo_locked',
                'enableSorting' => true,
                'format' => 'raw',
                'value' => function ($data) {                      
                        return $data->getFlagcielolocked() == 'SIM' ?  '<span class="glyphicon glyphicon-ok text-success" aria-hidden="true"></span>' : '<span class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></span>';
                        },
                'filter' => Sipag::$Static_flag_cielo_locked,
                'contentOptions'=>['style'=>'width: 5%;text-align:center'],
            ],
            [
                'attribute' => 'visited',
                'enableSorting' => true,
                'value' => function($data) {
                  return $data->getVisited();
                },
                'filter' => Sipag::$Static_visited,
                'contentOptions'=>['style'=>'width: 5%;text-align:center'],
            ],
            [
                'attribute' => 'accredited',
                'enableSorting' => true,
                'value' => function($data) {
                  return $data->getAccredited();
                },
                'filter' => Sipag::$Static_accredited,
                'contentOptions'=>['style'=>'width: 5%;text-align:center'],
            ],
            [
                'attribute' => 'locked',
                'enableSorting' => true,
                'value' => function($data) {
                  return $data->getLocked();
                },
                'filter' => Sipag::$Static_locked,
                'contentOptions'=>['style'=>'width: 5%;text-align:center'],
            ],
            [
                'attribute' => 'anticipation',
                'enableSorting' => true,
                'value' => function($data) {
                  return $data->getAnticipation();
                },
                'filter' => Sipag::$Static_anticipation,
                'contentOptions'=>['style'=>'width: 5%;text-align:center'],
            ],  
            [
                'attribute' => 'status',
                'enableSorting' => true,
                'value' => function($data) {
                  return $data->getStatus();
                },
                'filter' => Sipag::$Static_status,
                'contentOptions'=>['style'=>'width: 5%;text-align:center'],
            ],                      
            [
                'attribute' => 'user_id',
                'format' => 'raw',
                'enableSorting' => true,
                'value' => function ($model) {                      
                    return $model->user ? $model->user->username : null;
                },
                'filter' => ArrayHelper::map(User::find()->orderBy('username')->asArray()->all(), 'id', 'username'),
                'contentOptions'=>['style'=>'width: 8%;text-align:left'],
            ],
            // [
            //     'attribute' => 'checkedby_id',
            //     'format' => 'raw',
            //     'enableSorting' => true,
            //     'value' => function ($model) {                      
            //         return $model->checkedby ? $model->checkedby->username : null;
            //     },
            //     'filter' => ArrayHelper::map(User::find()->orderBy('username')->asArray()->all(), 'id', 'username'),
            //     'contentOptions'=>['style'=>'width: 8%;text-align:left'],
            // ],
            [
                'attribute' => 'situation',
                'enableSorting' => true,
                'format' => 'raw',
                'value' => function ($data) {                      
                        return $data->getSituation() == 'SIM' ? '<span class="label label-success">SIM</span>' : '<span class="label label-danger">NÃO</span>';
                        },  
                'filter' => Sipag::$Static_situation,
                'contentOptions'=>['style'=>'width: 5%;text-align:center'],
            ],             
            [
              'class' => 'yii\grid\ActionColumn',
              'header' => 'Ações',  
              'contentOptions'=>['style'=>'width: 8%;text-align:right'],
              'headerOptions' => ['class' => 'text-center'],                            
              'template' => ' {view} {update} {manager}',
              'buttons' => [
                  'view' => function ($url, $model) {
                      return Html::a('<span class="glyphicon glyphicon-list-alt" ></span>', $url, [
                                  'title' => 'Detalhes',
                                  'class' => 'btn btn-default btn-xs',
                      ]);
                  },                                                
                  'update' => function ($url, $model) {
                      return Html::a('<span class="glyphicon glyphicon-pencil" ></span>', $url, [
                                  'title' => 'Alterar',
                                  'class' => 'btn btn-default btn-xs',
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
                                  'title' => 'Conferir Registro',
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
    ]); 
    $this->registerJs("$(function() {
    $('#popupModal').click(function(e) {
     e.preventDefault();
     $('#modal').modal('show').find('.modal-content')
     .load($(this).attr('href'));
    });
    });");
    ?>
    </div>
    </div>
</div>