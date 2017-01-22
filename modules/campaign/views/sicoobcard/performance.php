<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\View;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\SeriesDataHelper;
use app\modules\campaign\models\Sicoobcard;
use yii\bootstrap\Tabs;
use yii\bootstrap\Progress;
use yii\data\SqlDataProvider;

$this->title = 'Desempenho das Campanhas';
?>
<div class="campaign-sicoobcard-create">

    <div class="row">
      <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
      <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;"><?php  echo $this->render('_menu'); ?></span></div></div>      
    </div>
    <hr/>

<div class="row"><div class="col-md-12">

    <div class="panel panel-default">
    <div class="panel-body">  

    <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#user">Sicoobcard Todo Dia</a></li>
    <li><a data-toggle="tab" href="#group">CDC Sicoobcard</a></li>
    </ul>

    <div class="tab-content">
      <div id="user" class="tab-pane fade in active"><!-- Sicoobcard Todo Dia -->

<div class="row">
    <br/>
    <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading"><b>Comparação por Tipo de Produto</b></div>
      <div class="panel-body" style="height: 550px;max-height: 500;">
        <?php
                echo Highcharts::widget([
                'options' => [
                    'credits' => ['enabled' => false],
                    'chart'=> [
                    'height'=> 300,
                    ],
                    'title' => [
                        'text' => '',
                        'align' => 'center',
                        'verticalAlign' => 'middle',
                          'style' => [
                              'color' => '#0C3E45',
                          ] 
                        ],
                    'colors'=> ['#13AE9C','#BDD530'],
                    'tooltip'=> ['pointFormat'=> 'Percentual: <b>{point.percentage:.1f}%</b>'],
                    'plotOptions'=> [
                        'pie'=> [
                            'allowPointSelect'=> true,
                            'cursor'=> 'pointer',
                            'size'=> '100%',
                            'innerSize'=> '60%',
                            'dataLabels'=> [
                                'enabled'=> true,
                            ],
                            'center'=> ['50%', '55%'],
                        ]
                    ],
                    'series'=> [[
                        'type'=> 'pie',
                        'name'=> 'Valor',
                        'data'=> [
                            ['Ativação',  abs(round((int)$totalActivation))],
                            ['Reativação', abs(round((int)$totalReactivation))],
                        ]
                    ]]
                ]
                ]);
                ?>

    <br/>
    <ul class="list-group">
      <li class="list-group-item">
        <span class="badge"><?php echo $totalActivation;?></span>
        Total Ativação
      </li>
      <li class="list-group-item">
        <span class="badge"><?php echo $totalReactivation;?></span>
        Total Reativação
      </li>      
    </ul>

      </div>
    </div>   

    </div>

    <div class="col-md-4">

    <div class="panel panel-default">
      <div class="panel-heading"><b>Quantidade por Colaborador</b></div>
      <div class="panel-body" style="height: 550px;max-height: 500;overflow-y: scroll;">
        <?= GridView::widget([
              'dataProvider' => $dataPerformanceUser,
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
                        'attribute' => 'confirmed',
                        'header' => 'Aprovado',
                        'format' => 'raw',
                        'value' => function ($data) {                      
                            return "<b class=\"text-success\">".$data["confirmed"]."</b>";
                        },
                        'headerOptions' => ['class' => 'text-success','style'=>'width: 20%;text-align:right;vertical-align: middle;'],
                        'contentOptions'=>['style'=>'width: 20%;text-align:right;vertical-align: middle;'],
                    ],    
                    [
                        'attribute' => 'unconfirmed',
                        'header' => 'Pendente',
                        'format' => 'raw',
                        'value' => function ($data) {                      
                            return "<b class=\"text-danger\">".$data["unconfirmed"]."</b>";
                        },
                        'headerOptions' => ['class' => 'text-danger','style'=>'width: 20%;text-align:right;vertical-align: middle;'],
                        'contentOptions'=>['style'=>'width: 20%;text-align:right;vertical-align: middle;'],
                    ],
                ],
            ]); ?>
      </div>
    </div>

    </div>
    <div class="col-md-4">

    <div class="panel panel-default">
      <div class="panel-heading"><b>Quantidade por Local</b></div>
      <div class="panel-body" style="height: 550px;max-height: 500;overflow-y: scroll;">
        <?= GridView::widget([
          'dataProvider' => $dataPerformanceLocation,
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
                    'attribute' => 'confirmed',
                    'header' => 'Aprovado',
                    'format' => 'raw',
                    'value' => function ($data) {                      
                        return "<b class=\"text-success\">".$data["confirmed"]."</b>";
                    },
                    'headerOptions' => ['class' => 'text-success','style'=>'width: 25%;text-align:right;vertical-align: middle;'],
                    'contentOptions'=>['style'=>'width: 20%;text-align:right;vertical-align: middle;'],
                ],    
                [
                    'attribute' => 'unconfirmed',
                    'header' => 'Pendente',
                    'format' => 'raw',
                    'value' => function ($data) {                      
                        return "<b class=\"text-danger\">".$data["unconfirmed"]."</b>";
                    },
                    'headerOptions' => ['class' => 'text-danger','style'=>'width: 25%;text-align:right;vertical-align: middle;'],
                    'contentOptions'=>['style'=>'width: 20%;text-align:right;vertical-align: middle;'],
                ],                                     

            ],
        ]); ?>
      </div>
    </div>

    </div>

  </div>

      </div>
      <div id="group" class="tab-pane fade"><!-- CDC -->
          
<div class="row">
    <br/>

<?php
    $dataProviderCampaign2 = new SqlDataProvider([
        'sql' => "SELECT user.id, avatar, fullname, 
              COUNT(if(daily_productivity_status_id = 2 AND daily_productivity.product_id = 503, daily_productivity.id, NULL)) as  confirmed
              FROM daily_productivity
              INNER JOIN `user` ON daily_productivity.seller_id = `user`.id
              GROUP BY seller_id
              ORDER BY confirmed DESC",
        'key'  => 'fullname',
        'totalCount' => 100,
        'pagination' => [
            'pageSize' => 100,
        ],         
    ]);
?>
<div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading"><b>Quantidade por Colaborador</b></div>
      <div class="panel-body">
<?= GridView::widget([
      'dataProvider' => $dataProviderCampaign2,
      'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '<span class="not-set">(não informado)</span>'],
      'emptyText'    => '</br><p class="text-danger">Nenhuma informação encontrada</p>',
      'summary'      =>  '',
      'showHeader'   => false,        
      'tableOptions' => ['class'=>'table table-hover'],
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
                'label'=> '',
                'value' => function ($data) {                      
                    return $data["fullname"].
                        Progress::widget([
                        'percent' => (($data["confirmed"]*100)/50),
                        'label' => round(($data["confirmed"]*100)/50)."%",
                        'barOptions' => ['class' => 'progress-bar-success'],
                        'clientOptions' => [
                            'value' => round(($data["confirmed"]*100)/50),
                        ],
                    ]);
                },
                'contentOptions'=>['style'=>'width: 50%;text-align:left;vertical-align: middle;text-transform: uppercase'],
            ],  
            [
                'attribute' => 'confirmed',
                'header' => 'Aprovado',
                'format' => 'raw',
                'value' => function ($data) {                      
                    return "<b class=\"text-success\">".$data["confirmed"]."</b>";
                },
                'headerOptions' => ['class' => 'text-success','style'=>'width: 20%;text-align:right;vertical-align: middle;'],
                'contentOptions'=>['style'=>'width: 20%;text-align:right;vertical-align: middle;'],
            ], 
            // [
            //     'content' => function($data) {
            //         return Progress::widget([
            //             'percent' => 70,
            //             'clientOptions' => [
            //                 'value' => $data["confirmed"],
            //             ],
            //         ]);
            //     },
            // ],
        ],
    ]); ?>
    </div></div></div> 

</div>    

      </div>
    </div> 

    </div></div> 

</div></div>

</div>