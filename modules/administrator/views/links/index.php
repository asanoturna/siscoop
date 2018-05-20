<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\User;

$this->title = 'Links';
?>
<div class="links-index">

    <div class="row">
    <div class="col-sm-2">
    <?php  echo $this->render('/dashboard/_menuadmin'); ?>
    </div>

    <div class="col-sm-10">

    <div class="row">
      <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
      <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;">
        <?= Html::a('<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar', ['create'], ['class' => 'btn btn-success']) ?>
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

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
            'attribute' => 'id',
            'enableSorting' => true,
            'contentOptions'=>['style'=>'width: 5%;text-align:center'],
            ],
            [
            'attribute' => 'name',
            'enableSorting' => true,
            'contentOptions'=>['style'=>'width: 10%;text-align:center'],
            ],
            [
            'attribute' => 'url',
            'enableSorting' => true,
            'contentOptions'=>['style'=>'width: 10%;text-align:left'],
            ],
            [
            'attribute' => 'description',
            'format' => 'raw',
            'enableSorting' => true,
            'contentOptions'=>['style'=>'width: 10%;text-align:left'],
            ],      
            [
              'attribute' => 'user_id',
              'format' => 'raw',
              'enableSorting' => true,
              'value' => function ($model) {                      
                  return $model->user ? $model->user->username : '<span class="text-danger"><em>Disponível a todos</em></span>';
              },
              'filter' => ArrayHelper::map(User::find()->orderBy('username')->asArray()->all(), 'id', 'username'),
              'filterInputOptions' => ['class' => 'form-control', 'style'=>'text-transform: lowercase'],
              'contentOptions'=>['style'=>'width: 8%;text-align:left;text-transform: lowercase'],
            ],                      
            [ 
            'attribute' => 'status',
            'enableSorting' => true,
            'format' => 'raw',
            'value' => function ($model) {                      
                    return $model->status == 1 ? '<b style="color:#6CAF3F">Ativo</b>' : '<b style="color:#d43f3a">Inativo</b>';
                    },
            'filter'=>[0=>'Não', 1=>'Sim'],
            'contentOptions'=>['style'=>'width: 8%;text-align:center'],
            ],             
            [
              'class' => 'yii\grid\ActionColumn',
              'header' => 'Ações',  
              'contentOptions'=>['style'=>'width: 8%;text-align:right'],
              'headerOptions' => ['class' => 'text-center'],                            
              'template' => '{view} {update} {delete}',
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

    </div>
    </div>
    </div>
  </div>
</div>