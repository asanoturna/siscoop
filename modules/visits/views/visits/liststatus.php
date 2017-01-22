<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\modules\visits\models\VisitsstatusSearch;

$dataProvider = new ActiveDataProvider([
    'query' => VisitsstatusSearch::find(),
    'pagination' => [
        'pageSize' => 20,
    ],
]);
?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'summary' => '',
    //'tableOptions' => ['class'=>'table table-striped'],
    'columns' => [
        //'name',
        [
        'header' => 'Situação',
        'format' => 'raw',
        //'contentOptions'=>['style' => 'background-color: '.$model->hexcolor.';'],
                    'value' => function ($model) {                      
                  return "<b style=\"color: ".$model->hexcolor.";\">$model->name</b>";
                  },
        ],         
        [
         'header' => 'Descrição',
         'format' => 'raw',
	     'value' => function ($model) {                      
	      		return "<em >$model->about</em>";
	      	},
        ],        
    ],
]); ?>
