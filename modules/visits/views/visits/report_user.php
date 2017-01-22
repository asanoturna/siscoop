<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\User;
use yii\helpers\Url;
use yii\web\View;
use yii\data\SqlDataProvider;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\SeriesDataHelper;

$this->title = "Desempenho por Usuário";
?>
<div class="visits-view">

    <div class="row">
      <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
      <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;"><?php  echo $this->render('_menu'); ?></span></div>
    </div>
    <hr/>
	<div class="row">   
        <div class="col-md-3 pull-right"> 
                <?php 
                $this->registerJs('var submit = function (val){if (val > 0) {
                    window.location.href = "' . Url::to(['visits/report_user']) . '&user_id=" + val;
                }
                }', View::POS_HEAD);
                echo Html::activeDropDownList($model, 'user_id', ArrayHelper::map(User::find()->where(['status' => 1])
                            ->orderBy("username ASC")
                            ->all(), 'id', 'username'), ['onchange'=>'submit(this.value);','prompt'=>'Selecione o usuário','class'=>'form-control', 'style' => 'text-transform: lowercase']);
                ?>
        </div>
        <div class="col-md-1 pull-right"> 
        <input class="form-control" type="text" placeholder=<?php echo date("Y");?> readonly>
        </div>        
    </div>  
    </p>  
    <div class="row">
        <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading"><b>Quantidade de Visitas por Situação</b></div>
          <div class="panel-body" style="height: 450px;">
			<?php
			echo Highcharts::widget([
                'options' => [
                    'credits' => ['enabled' => false],
                    'title' => [
                        'text' => '',
                    ],
                    //'colors'=> ['#00A295','#27cdd9'],
                    'xAxis' => [
                        'categories' => $stats,
                    ],
                    'yAxis' => [
                        'min' => 0,
                        'title' => '',
                    ],                        
                    'series' => [
                        [
                            'type' => 'column',
                            'colorByPoint'=> true,
                            'name' => 'Situação',
                            'data' => $total_s,
                            'colors' => $color,
                        ],                         
                    ],
                ]
            ]);
			?>        	
          </div>
        </div>
        </div>
        <div class="col-md-5">
        <div class="panel panel-default">
          <div class="panel-heading"><b>Quantidade de Visitas por Finalidade</b></div>
          <div class="panel-body" style="height: 450px;">
			<?php
			echo Highcharts::widget([
                    'options' => [
                        'credits' => ['enabled' => false],
                        'title' => [
                            'text' => '',
                        ],
                        'colors'=> ['#00A295','#27cdd9'],
                        'xAxis' => [
                            'categories' => $finality,
                        ],
                        'yAxis' => [
                            'min' => 0,
                            'title' => '',
                        ],                        
                        'series' => [
                            [
                                'type' => 'bar',
                                'name' => 'Finalidade',
                                'data' => $total_f,
                            ],                          
                        ],
                    ]
                ]);
				?> 
            </div>
        </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
              <div class="panel-heading"><b>Aproveitamento</b></div>
              <div class="panel-body" style="height: 450px;">
                <?php
                $t = abs(round((int)$fulltotal));
                $e = abs(round((int)$totaleffect));
                $remnant = ($t - $e) >=0 ? ($t - $e) : 0;
                echo Highcharts::widget([
                'options' => [
                    'credits' => ['enabled' => false],
                    'chart'=> [
                    'height'=> 200,
                    ],
                    'title' => [
                        'text' => $e,
                        'align' => 'center',
                        'verticalAlign' => 'middle',
                          'style' => [
                              'fontSize'=> '12px',
                              'color' => '#00A295',
                          ] 
                        ],
                    'colors'=> ['#cccccc','#00A295'],
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
                            ['Restante',  $remnant],
                            ['Efetivadas', $e],
                        ]
                    ]]
                ]
                ]);
                ?>
                <hr/>
                <ul class="list-group">
                  <li class="list-group-item">
                    <span class="badge"><?php echo $fulltotal;?></span>
                    Seu total de visitas
                  </li>
                  <li class="list-group-item">
                    <span class="badge"><?php echo $total_images;?></span>
                    Seu total de imagens
                  </li>                  
                </ul>                
              </div>
              </div>
            </div>
        </div>
    </div>    

</div>