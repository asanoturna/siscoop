<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\campaign\models\Recovery;
use yii\helpers\ArrayHelper;
use app\models\Location;
use app\models\User;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\SeriesDataHelper;

$this->title = 'Ranking da Campanha Recupere e Ganhe';
?>
<div class="recovery-index">

    <div class="row">
      <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
      <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;"><?php  echo $this->render('_menu'); ?></span></div>
    </div>
    <hr/>

    <div class="panel panel-default">
    <div class="panel-body">

<div class="row">
    <div class="col-md-2">
    <div class="panel panel-default">
      <div class="panel-heading"><b>Desempenho</b></div>
      <div class="panel-body">
        <?php
        echo Highcharts::widget([
                'options' => [
                    'credits' => ['enabled' => false],
                    'chart'=> [
                    'height'=> 200,
                    ],
                    'title' => [
                        'text' => '',
                    ],
                    'colors'=> ['#d43f3a','#0CA293'],
                    'xAxis' => [
                        'categories' => ['R$']
                    ],
                    'yAxis' => [
                        'min' => 0,
                        'title' => '',
                    ],                        
                    'series' => [
                        [
                            'type' => 'bar',
                            'name' => 'Total Dívida',
                            'data' => $d,
                        ], 
                        [
                            'type' => 'bar',
                            'name' => 'Total Negociado',
                            'data' => $n,
                        ], 
                    ],
                ]
            ]);
                ?></div></div>
<div class="panel panel-default">
  <div class="panel-heading"><b>Total por Tipo de Dívida</b></div>
  <div class="panel-body">
        <?php
        echo Highcharts::widget([
                'options' => [
                    'credits' => ['enabled' => false],
                    'chart'=> [
                    'height'=> 200,
                    ],
                    'title' => [
                        'text' => '',
                    ],
                    'colors'=> ['#00A295','#BDD530'],
                    'xAxis' => [
                        'categories' => ['R$']
                    ],
                    'yAxis' => [
                        'min' => 0,
                        'title' => '',
                    ],                        
                    'series' => [
                        [
                            'type' => 'column',
                            'name' => 'Acima de 180 dias',
                            'data' => $typeofdebt1,
                        ], 
                        [
                            'type' => 'column',
                            'name' => 'Ajuizado',
                            'data' => $typeofdebt2,
                        ], 
                        [
                            'type' => 'column',
                            'name' => 'Perdas',
                            'data' => $typeofdebt3,
                        ], 
                        [
                            'type' => 'column',
                            'name' => 'Prejuizo',
                            'data' => $typeofdebt4,
                        ], 
                    ],
                ]
            ]);
        ?></div></div>

    </div>
    <div class="col-md-5">

<div class="panel panel-default">
<div class="panel-heading"><b>Ranking por Negociador</b></div>
<div class="panel-body" style="height: 550px;max-height: 500;overflow-y: scroll;">
<?= GridView::widget([
              'dataProvider' => $dataRankingUser,
              'emptyText'    => '</br><p class="text-danger">Nenhuma informação encontrada</p>',
              'summary'      =>  '',
              'showHeader'   => true,        
              'tableOptions' => ['class'=>'table table-striped table-hover '],
              'columns' => [     
                [
                    'attribute' => 'avatar',
                    'label' => false,
                    'format' => 'html',
                    'value' => function ($data) {
                        return Html::img(Yii::$app->params['usersAvatars'].$data["avatar"],
                            ['width' => '50px', 'class' => 'img-rounded img-thumbnail']);
                    },
                    'contentOptions'=>['style'=>'width: 10%;text-align:middle'],                    
                ],
                [
                    'attribute' => 'fullname',
                    'format' => 'raw',
                    'label' => false,
                    'value' => function ($data) { 
                        return $data["fullname"];
                    },
                    'contentOptions'=>['style'=>'width: 50%;text-transform: uppercase;text-align:left;vertical-align: middle;'],
                ],
                [
                    'attribute' => 'value_traded',
                    'header' => 'Negociado',
                    'format' => 'raw',
                    'value' => function ($data) {                      
                        return "<b class=\"text-success\">".$data["value_traded"]."</b>";
                    },
                    'headerOptions' => ['class' => 'text-success','style'=>'width: 20%;text-align:right;vertical-align: middle;'],
                    'contentOptions'=>['style'=>'width: 20%;text-align:right;vertical-align: middle;'],
                ],
                [
                    'attribute' => 'value_input',
                    'header' => 'Quit./Entrada',
                    'format' => 'raw',
                    'value' => function ($data) {                      
                        return "<b class=\"text-info\">".$data["value_input"]."</b>";
                    },
                    'headerOptions' => ['class' => 'text-info','style'=>'width: 20%;text-align:right;vertical-align: middle;'],
                    'contentOptions'=>['style'=>'width: 20%;text-align:right;vertical-align: middle;'],
                ],
                ],
            ]); ?>
</div></div>

  </div>
  <div class="col-md-5">

    <div class="panel panel-default">
      <div class="panel-heading"><b>Ranking por Agência</b></div>
      <div class="panel-body" style="height: 550px;max-height: 500;overflow-y: scroll;">
        <?= GridView::widget([
          'dataProvider' => $dataRankingLocation,
          'emptyText'    => '</br><p class="text-danger">Nenhuma informação encontrada</p>',
          'summary'      =>  '',
          'showHeader'   => true,        
          'tableOptions' => ['class'=>'table table-striped table-hover '],
          'columns' => [ 
                [
                    'attribute' => 'fullname',
                    'label' => false,
                    'format' => 'html',
                    'value' => function ($data) {                      
                        return $data["fullname"];
                    },
                    'contentOptions'=>['style'=>'width: 50%;text-align:left'],                    
                ],                                  
                [
                    'attribute' => 'value_traded',
                    'header' => 'Negociado',
                    'format' => 'raw',
                    'value' => function ($data) {                      
                        return "<b class=\"text-success\">".$data["value_traded"]."</b>";
                    },
                    'headerOptions' => ['class' => 'text-success','style'=>'width: 20%;text-align:right;vertical-align: middle;'],
                    'contentOptions'=>['style'=>'width: 20%;text-align:right;vertical-align: middle;'],
                ],
                [
                    'attribute' => 'value_input',
                    'header' => 'Quit./Entrada',
                    'format' => 'raw',
                    'value' => function ($data) {                      
                        return "<b class=\"text-info\">".$data["value_input"]."</b>";
                    },
                    'headerOptions' => ['class' => 'text-info','style'=>'width: 20%;text-align:right;vertical-align: middle;'],
                    'contentOptions'=>['style'=>'width: 20%;text-align:right;vertical-align: middle;'],
                ],
            ],
        ]); ?>
      </div>
    </div>


 </div>
</div>

    </div>
    </div>
</div>