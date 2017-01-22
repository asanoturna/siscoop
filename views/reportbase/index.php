<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;

$this->title = 'Planilha Base';
?>
<div class="reportbase-index">

    <div class="row">
      <div class="col-md-6"><h1><i class="fa fa-file-excel-o"></i> <?= Html::encode($this->title) ?></h1></div>
        <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;">
            <?= Html::a('Novo', ['create'], ['class' => 'btn btn-success']) ?></span>
        </div>
    </div>
    <hr/>

    <?php foreach (Yii::$app->session->getAllFlashes() as $key=>$message):?>
        <?php $alertClass = substr($key,strpos($key,'-')+1); ?>
        <div class="alert alert-dismissible alert-<?=$alertClass?>" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p><?=$message?></p>
        </div>
    <?php endforeach ?>    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        //'tableOptions' => ['class'=>'table table-striped table-bordered table-hover'],
        'tableOptions' => ['class'=>'table table-hover'],
        'emptyText'    => 'Nenhum arquivo encontrado!',
        'summary'      =>  '',
        'headerRowOptions' => ['class' => 'text-center', 'style' => 'background-color: #cde1a4;text-align:center'],        
        'columns' => [
            [
            'attribute' => 'attachment',
            'contentOptions'=>['style'=>'width: 40%;text-align:left;'],
            'headerOptions' => ['class' => 'text-center'],
            ],             
            [
                'attribute' => 'updated',
                'enableSorting' => true,
                'contentOptions'=>['style'=>'width: 15%;text-align:center'],
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
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions'=>['style'=>'width: 15%;text-align:center'],
            ],                
            'downloads',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{download} {update} ',
                'header' => 'Ações',
                'headerOptions' => ['class' => 'text-center'],
                'visibleButtons' => [
                    'download' => true,
                    'update' => Yii::$app->user->can("productmanager"),
                ],
                'buttons' => [
                    'download' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-cloud-download" ></span>', Yii::$app->params['reportbasePath'].'/'. $model->attachment, [
                                    'title' => 'Baixar Arquivo',
                                    'target' => '_blank',
                                    'class' => 'btn btn-default btn-xs',
                        ]);
                    },                
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-refresh" ></span>', $url, [
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
                'contentOptions'=>['style'=>'width: 20%;text-align:center'],
            ],
        ],
    ]); ?>

</div>
