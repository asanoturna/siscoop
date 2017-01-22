<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Location;
use app\modules\productivity\models\Product;
use app\models\Modality;
use app\models\User;
use app\modules\productivity\models\Dailyproductivitystatus;

$this->title = 'Gestão Produtividade Diária';
?>
<div class="managerdailyproductivity-index">

<div class="row">
  <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
  <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;"><?php  echo $this->render('_menu'); ?></span></div>
</div>

<hr/>
    <div class="panel panel-default">
    <div class="panel-heading"><b>Pesquisar</b></div>
      <div class="panel-body">
        <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    </div>
    
    <div class="panel panel-default">
    <div class="panel-body">      
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class'=>'table table-striped table-bordered table-hover'],
        //'headerRowOptions' => ['class'=> 'success'],
        'headerRowOptions' => ['class' => 'text-center'],
        'columns' => [
            [
              'attribute' => 'id',
              'enableSorting' => true,
              'contentOptions'=>['style'=>'width: 3%;text-align:center'],
              'headerOptions' => ['class' => 'text-center'],
            ],          
            [
                'attribute' => 'date',
                'enableSorting' => true,
                'contentOptions'=>['style'=>'width: 4%;text-align:center'],
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
                'contentOptions'=>['style'=>'width: 7%;text-align:left'],
            ],              
            [
             'attribute' => 'location_id',
             'enableSorting' => true,
             'value' => function ($model) {                      
                    return $model->location->shortname;
                    },
             'filter' => ArrayHelper::map(Location::find()->orderBy('shortname')->asArray()->all(), 'id', 'shortname'),
             'contentOptions'=>['style'=>'width: 4%;text-align:center'],
            ],            
            [
                'attribute' => 'product_id',
                'enableSorting' => true,
                'value' => function ($model) {                      
                       return $model->product->name;
                       },
                'filter' => Product::getHierarchy(),
                'contentOptions'=>['style'=>'width: 18%;text-align:left'],
            ],              
            [
                'attribute' => 'value',
                'format' => 'raw',
                'enableSorting' => true,
                'contentOptions'=>['style'=>'width: 5%;text-align:center'],
            ],
            [
                'attribute' => 'commission_percent',
                'format' => 'raw',
                'enableSorting' => true,
                'contentOptions'=>['style'=>'width: 5%;text-align:center'],
            ],            
            [
                'label' => 'Receita',
                'attribute' => 'companys_revenue',
                'format' => 'raw',
                'enableSorting' => true,
                'contentOptions'=>['style'=>'width: 5%;text-align:center'],
            ],                       
            [
                'attribute' => 'seller_id',
                'format' => 'raw',
                'enableSorting' => true,
                'value' => function ($model) {                      
                    return $model->seller ? $model->seller->username : '<span class="text-danger"><em>Nenhum</em></span>';
                },
                'filter' => ArrayHelper::map(User::find()->orderBy('username')->asArray()->all(), 'id', 'username'),
                'contentOptions'=>['style'=>'width: 8%;text-align:left'],
            ],             
            [
                'attribute' => 'operator_id',
                'format' => 'raw',
                'enableSorting' => true,
                'value' => function ($model) {                      
                    return $model->operator ? $model->operator->username : '<span class="text-danger"><em>Nenhum</em></span>';
                },
                'filter' => ArrayHelper::map(User::find()->orderBy('username')->asArray()->all(), 'id', 'username'),
                'contentOptions'=>['style'=>'width: 8%;text-align:left'],
            ],   
            [
                'attribute' => 'daily_productivity_status_id',
                'format' => 'raw',
                'enableSorting' => true,
                'value' => function ($model) {                      
                        return $model->daily_productivity_status_id === 1 ? "<span class=\"label label-warning\">".$model->dailyProductivityStatus->name."</span>" : "<span class=\"label label-success\">".$model->dailyProductivityStatus->name."</span>";
                        },
                'filter' => ArrayHelper::map(Dailyproductivitystatus::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                'contentOptions'=>['style'=>'width: 10%;text-align:center'],
            ],     
            [
                'attribute' => 'manager_id',
                'format' => 'raw',
                'enableSorting' => true,
                'value' => function ($model) {                      
                    return $model->manager ? $model->manager->username : '<span class="text-danger"><em>Nenhum</em></span>';
                },
                'filter' => ArrayHelper::map(User::find()->orderBy('username')->asArray()->all(), 'id', 'username'),
                'contentOptions'=>['style'=>'width: 8%;text-align:left'],
            ],  
            [ 
                'attribute' => 'is_commission_received',
                'format' => 'raw',
                'value' => function ($model) {                      
                        return $model->is_commission_received == 1 ? '<b style="color:green">Sim</b>' : '<b style="color:gray">Não</b>';
                        },
                'filter'=>[0=>'Não', 1=>'Sim'],
                'contentOptions'=>['style'=>'width: 5%;text-align:center'],
            ],                                 
            [
                'class' => 'yii\grid\ActionColumn',
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
                'contentOptions'=>['style'=>'width: 10%;text-align:right'],
            ],
        ],
    ]); ?>
    </div>
    </div>
</div>