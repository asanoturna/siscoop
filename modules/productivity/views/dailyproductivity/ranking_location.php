<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Location;
use app\models\Product;
use app\models\Modality;
use app\models\User;
use yii\data\SqlDataProvider;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Produtividade Diária';

?>
<div class="dailyproductivity-index">

    <div class="row">
      <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
      <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;"><?php  echo $this->render('_menu'); ?></span></div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-3 pull-right">
            <?php 
            $this->registerJs('var submit = function (val){if (val > 0) {
                window.location.href = "' . Url::to(['dailyproductivity/ranking_location']) . '&product_id=" + val;
            }
            }', View::POS_HEAD);
            echo Html::activeDropDownList($model, 'product_id', app\modules\productivity\models\Product::getHierarchy(), ['onchange'=>'submit(this.value);','prompt'=>'Todos os Produtos','class'=>'form-control required']);
            ?>
        </div>
    </div>  
    <p>   
    <div class="row">
        <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading"><b>Ranking de Vendas Por Receita</b></div>
          <div class="panel-body">
        <?= GridView::widget([
          'dataProvider' => $dataProviderValor,
          'emptyText'    => '</br><p class="text-danger">Nenhuma informação encontrada</p>',
          'summary'      =>  '',
          'showHeader'   => true,        
          'tableOptions' => ['class'=>'table table-striped table-hover '],
          'columns' => [                                     
                [
                    'attribute' => 'local',
                    'label' => false,
                    'format' => 'raw',
                    'value' => function ($data) {                      
                        return $data["local"];
                    },
                    'contentOptions'=>['style'=>'width: 50%;text-align:left;vertical-align: middle;'],
                ],  
                [
                    'attribute' => 'confirmed',
                    'header' => 'Efetivado',
                    'format' => 'raw',
                    'value' => function ($data) {                      
                        return "<b class=\"text-success\">R$ ".$data["confirmed"]."</b>";
                    },
                    'headerOptions' => ['class' => 'text-success','style'=>'width: 20%;text-align:right;vertical-align: middle;'],
                    'contentOptions'=>['style'=>'width: 20%;text-align:right;vertical-align: middle;'],
                ],    
                [
                    'attribute' => 'unconfirmed',
                    'header' => 'Pendente',
                    'format' => 'raw',
                    'value' => function ($data) {                      
                        return "<b class=\"text-danger\">R$ ".$data["unconfirmed"]."</b>";
                    },
                    'headerOptions' => ['class' => 'text-danger','style'=>'width: 20%;text-align:right;vertical-align: middle;'],
                    'contentOptions'=>['style'=>'width: 20%;text-align:right;vertical-align: middle;'],
                ],                                     

            ],
        ]); ?>
            </div>
            </div>
        </div>
        <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading"><b>Ranking de Vendas Por Quantidade</b></div>
          <div class="panel-body">
        <?= GridView::widget([
          'dataProvider' => $dataProviderQtde,
          'emptyText'    => '</br><p class="text-danger">Nenhuma informação encontrada</p>',
          'summary'      =>  '',
          'showHeader'   => true,        
          'tableOptions' => ['class'=>'table table-striped table-hover '],
          'columns' => [                                
                [
                    'attribute' => 'local',
                    'label' => false,
                    'format' => 'raw',
                    'value' => function ($data) {                      
                        return $data["local"];
                    },
                    'contentOptions'=>['style'=>'width: 60%;text-align:left;vertical-align: middle;'],
                ],  
                [
                    'attribute' => 'confirmed',
                    'header' => 'Efetivado',                    
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
    </div>
</div>