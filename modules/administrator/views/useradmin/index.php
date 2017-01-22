<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\modules\administrator\models\Role;

$this->title = 'Usuários';
?>
<div class="useradmin-index">

    <div class="row">
    <div class="col-sm-2">
    <?php  echo $this->render('/dashboard/_menuadmin'); ?>
    </div>

    <div class="col-sm-10">

    <div class="row">
      <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
      <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;">
        <?= Html::a('<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar', ['signup'], ['class' => 'btn btn-success']) ?>
      </span></div>
    </div>
    <hr/>

    <div class="panel panel-default">
      <div class="panel-body">  

    <?php foreach (Yii::$app->session->getAllFlashes() as $key=>$message):?>
        <?php $alertClass = substr($key,strpos($key,'-')+1); ?>
        <div class="alert alert-dismissible alert-<?=$alertClass?>" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p><?=$message?></p>
        </div>
    <?php endforeach ?>        

    <?php \yii\widgets\Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class'=>'table table-striped table-bordered table-hover table-responsive'],
        'columns' => [
            [
            'attribute' => 'id',
            'enableSorting' => true,
            'contentOptions'=>['style'=>'width: 5%;text-align:center'],
            ],
            [
            'attribute' => 'username',
            'enableSorting' => true,
            'contentOptions'=>['style'=>'width: 15%;text-align:lef;tvertical-align: middle;text-transform: lowercase'],
            ],             
            [
            'attribute' => 'fullname',
            'enableSorting' => true,
            'contentOptions'=>['style'=>'width: 30%;text-align:left;vertical-align: middle;text-transform: uppercase'],
            ],       
            [
            'attribute' => 'email',
            'format' => 'email',
            'enableSorting' => true,
            'contentOptions'=>['style'=>'width: 20%;text-align:left;vertical-align: middle'],
            ],
            [ 
            'attribute' => 'role_id',
            'enableSorting' => true,
            'format' => 'raw',
            'value' => function ($model) {                      
                    return $model->role->name ;
                    },
            'filter' => ArrayHelper::map(Role::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
            'contentOptions'=>['style'=>'width: 5%;text-align:left;vertical-align: middle'],
            ], 
            [ 
            'attribute' => 'status',
            'enableSorting' => true,
            'format' => 'raw',
            'value' => function ($model) {                      
                    return $model->status == 1 ? '<b style="color:#6CAF3F">Ativo</b>' : '<b style="color:#d43f3a">Inativo</b>';
                    },
            'filter'=>[0=>'Não', 1=>'Sim'],
            'contentOptions'=>['style'=>'width: 10%;text-align:left;vertical-align: middle'],
            ], 
            [
              'class' => 'yii\grid\ActionColumn',
              'header' => 'Ações',  
              'contentOptions'=>['style'=>'width: 10%;text-align:right'],
              'headerOptions' => ['class' => 'text-center'],                            
              'template' => '{view} {update} {delete}',
              'buttons' => [
                  'avatar' => function ($url, $model) {
                      return Html::a('<span class="glyphicon glyphicon-camera" ></span>', $url, [
                                  'title' => 'Alterar Foto',
                                  'class' => 'btn btn-default btn-xs',
                      ]);
                  },    
                  'password' => function ($url, $model) {
                      return Html::a('<span class="glyphicon glyphicon-lock" ></span>', $url, [
                                  'title' => 'Redefinir Senha',
                                  'class' => 'btn btn-default btn-xs',
                      ]);
                  },                                               
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
                      return Html::a('<span class="glyphicon glyphicon-trash" ></span>', $url, [
                                  'title' => 'Excluir',
                                  'class' => 'btn btn-default btn-xs',
                                  'data-confirm' => 'Tem certeza que deseja excluir?',
                                  'data-method' => 'post',
                                  'data-pjax' => '0',
                      ]);
                  },                                    
                ],
            ],
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end(); ?>
    </div>
    </div>

    </div>
  </div>
</div>