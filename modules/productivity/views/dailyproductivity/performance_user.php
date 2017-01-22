<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Location;
use app\models\Product;
use app\models\Modality;
use app\models\User;
use yii\widgets\ActiveForm;
use yii\data\SqlDataProvider;
use yii\helpers\Url;
use yii\web\View;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\SeriesDataHelper;

$this->title = 'Produtividade Diária';
?>
<div class="dailyproductivity-index">

<div class="row">
  <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
  <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;"><?php  echo $this->render('_menu'); ?></span></div>
</div>
<hr/>
<div class="row">

    <div class="col-md-2 pull-right"> 
        <?php 
        $this->registerJs('var submit = function (val){if (val > 0) {
            window.location.href = "' . Url::to(['dailyproductivity/performance_user']) . '&seller_id=" + val;
        }
        }', View::POS_HEAD);
        echo Html::activeDropDownList($model, 'seller_id', ArrayHelper::map(User::find()->where(['status' => 1])
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
	  <div class="panel-heading"><b>Mais Vendidos</b></div>
	  <div class="panel-body">
		<?php
		echo Highcharts::widget([
            'options' => [
                'credits' => ['enabled' => false],
                'title' => [
                    'text' => '',
                ],
                'colors'=> ['#13AE9C','#BDD530'],
                'xAxis' => [
                    'categories' => $p,
                ],
                'yAxis' => [
                    'min' => 0,
                    'title' => '',
                ],                        
                'series' => [
                    [
                        'type' => 'bar',
                        'colorByPoint'=> true,
                        'name' => 'Quantidade',
                        'data' => $q,
                        
                    ],                         
                ],
            ]
        ]);
		?>
	  </div>
	</div>
  	</div>

	<div class="col-md-8">
  	<div class="panel panel-default">
	  <div class="panel-heading"><b>Evolução</b></div>
	  <div class="panel-body">
		<?php
        echo Highcharts::widget([
            'options' => [
                'credits' => ['enabled' => false],
                'title' => [
                    'text' => '',
                ],
                'colors'=> ['#18bc9c','#e74c3c'],
                'xAxis' => [
                    'categories' => $m,
                ],
                  'yAxis' => [
                     'title' => ['text' => ''],
                ],                        
                'series' => [
                    [
                        'type' => 'spline',
                        'name' => 'Aprovados',
                        'data' => $approved,
                    ],
                    [
                        'type' => 'spline',
                        'name' => 'Pendentes',
                        'data' => $pending,
                    ],
                ],
            ]
        ]);
		?>
	  </div>
	</div>
  	</div>

</div>

</div>