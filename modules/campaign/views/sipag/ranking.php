<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\campaign\models\Sipag;
use yii\helpers\ArrayHelper;
use app\models\Location;
use app\models\User;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\SeriesDataHelper;

$this->title = 'Ranking da Campanha Ação Foco SIPAG';
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
		<div class="col-md-3">
            <div class="panel panel-default">
              <div class="panel-heading"><b>Aprovados x Não Aprovados</b></div>
              <div class="panel-body" style="height: 450px;">
                <?php
                $n = abs(round((int)$totalno));
                $y = abs(round((int)$totalyes));
                echo Highcharts::widget([
                'options' => [
                    'credits' => ['enabled' => false],
                    'chart'=> [
                    'height'=> 200,
                    ],
                    'title' => [
                        'text' => 'Situação',
                        'align' => 'center',
                        'verticalAlign' => 'middle',
                          'style' => [
                              'fontSize'=> '12px',
                              'color' => '#0D4549',
                          ] 
                        ],
                    'colors'=> ['#D9534F','#5CB85C'],
                    'tooltip'=> ['pointFormat'=> 'Percentual: <b>{point.percentage:.1f}%</b>'],
                    'plotOptions'=> [
                        'pie'=> [
                            'allowPointSelect'=> true,
                            'cursor'=> 'pointer',
                            'size'=> '100%',
                            'innerSize'=> '60%',
                            'dataLabels'=> [
                                'enabled'=> false,
                            ],
                            'center'=> ['50%', '55%'],
                        ]
                    ],
                    'series'=> [[
                        'type'=> 'pie',
                        'name'=> 'Valor',
                        'data'=> [
                            ['Não Aprovadas',  $n],
                            ['Aprovadas', $y],
                        ]
                    ]]
                ]
                ]);
                ?>
                <hr/>
                <ul class="list-group">
                  <li class="list-group-item">
                    <span class="badge"><?php echo $n;?></span>
                    Registros Não Aprovados
                  </li>
                  <li class="list-group-item">
                    <span class="badge"><?php echo $y;?></span>
                    Registros Aprovados
                  </li>                  
                </ul>                
              </div>
              </div></div>
</div>

    </div>
    </div>
</div>