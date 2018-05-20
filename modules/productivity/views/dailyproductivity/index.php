<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Location;
use app\modules\productivity\models\Product;
use app\models\User;
use app\modules\productivity\models\Dailyproductivitystatus;

$this->title = 'Produtividade Diária';?>
<div class="dailyproductivity-index">

  <div class="row">
    <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
    <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;"><?php  echo $this->render('_menu'); ?></span></div>
  </div>

  <hr/>
  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-default">
      <div class="panel-heading"><b>Pesquisar</b></div>
        <div class="panel-body">
          <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
      </div>
    </div>      
    <div class="col-md-6">
      <div class="panel panel-default">
      <div class="panel-heading"><b>Opções</b></div>
        <div class="panel-body">
          <?php
          use kartik\export\ExportMenu;
              $gridColumns = [
                  ['attribute'=>'date','format'=>['date'], 'hAlign'=>'right', 'width'=>'110px'],                     
                  [
                  'attribute'=>'location_id',
                  'label'=> 'PA',
                  'vAlign'=>'middle',
                  'width'=>'100px',
                  'value'=>function ($model, $key, $index, $widget) { 
                      return Html::a($model->location->shortname, '#', []);
                  },
                  'format'=>'raw'
                  ], 
                  ['attribute'=>'buyer_document', 'hAlign'=>'right', 'width'=>'90px'],
                  ['attribute'=>'buyer_name', 'hAlign'=>'right', 'width'=>'90px'],
                  [
                  'attribute'=>'product_id',
                  'label'=> 'Produto',
                  'vAlign'=>'middle',
                  'width'=>'180px',
                  'value'=>function ($model, $key, $index, $widget) { 
                      return Html::a($model->product->name, '#', []);
                  },
                  'format'=>'raw'
                  ],                    
                  ['attribute'=>'value','format'=>['decimal',2], 'hAlign'=>'right', 'width'=>'110px'],
                  ['attribute'=>'quantity', 'hAlign'=>'right', 'width'=>'90px'],
                  [
                  'attribute'=>'daily_productivity_status_id',
                  'label'=> 'Situação',
                  'vAlign'=>'middle',
                  'width'=>'120px',
                  'value'=>function ($model, $key, $index, $widget) { 
                      return Html::a($model->dailyProductivityStatus->name, '#', []);
                  },
                  'format'=>'raw'
                  ], 
                  [
                  'attribute'=>'seller_id',
                  'label'=> 'Indicador',
                  'vAlign'=>'middle',
                  'width'=>'100px',
                  'value'=>function ($model, $key, $index, $widget) { 
                      return Html::a($model->seller->username, '#', []);
                  },
                  'format'=>'raw'
                  ], 
                  [
                  'attribute'=>'operator_id',
                  'label'=> 'Angaridor',
                  'vAlign'=>'middle',
                  'width'=>'100px',
                  'value'=>function ($model, $key, $index, $widget) { 
                      return Html::a($model->operator->username, '#', []);
                  },
                  'format'=>'raw'
                  ],                                                       
              ];
              echo ExportMenu::widget([
              'dataProvider' => $dataProvider,
              'columns' => $gridColumns,
              'fontAwesome' => true,
              'emptyText' => 'Nenhum registro',
              'showColumnSelector' => true,
              'asDropdown' => true,
              'target' => ExportMenu::TARGET_BLANK,
              'showConfirmAlert' => false,
              'exportConfig' => [
                ExportMenu::FORMAT_HTML => false,
                ExportMenu::FORMAT_CSV => false,
                ExportMenu::FORMAT_TEXT => false,
                ExportMenu::FORMAT_PDF => false
            ],
            'columnSelectorOptions' => [
              'class' => 'btn btn-success',
            ],
            'dropdownOptions' => [
              'icon' => false,
              'label' => 'Exportar Registros',
              'class' => 'btn btn-success',
            ],
            'filename' => 'relatorio-produtividade',
            ]);
          ?>
        </div>
      </div>
    </div>
  </div>

    <div class="panel panel-default">
    <div class="panel-body">  
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class'=>'table table-striped table-hover'],
        'emptyText'    => '</br><p class="text-info">Nenhum registro encontrado!</p>',   
        //'summary' => "<p class=\"text-info pull-right\"><h5>Total de Registros: {totalCount} </h5></p>",  
        'rowOptions'   => function ($model, $index, $widget, $grid) {
            return [
                'id' => $model['id'], 
                'onclick' => 'location.href="'
                    . Yii::$app->urlManager->createUrl('productivity/dailyproductivity/view') 
                    . '&id="+(this.id);',
                'style' => "cursor: pointer",
            ];
        },       
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
              'filter' => ArrayHelper::map(User::find()->orderBy('username')->asArray()->all(), 'id', 'username'),
              'headerOptions' => ['class' => 'text-center'],
              'contentOptions'=>['style'=>'width: 7%;text-align:left'],
            ],                  
            [
              'attribute' => 'location_id',
              'enableSorting' => true,
              'value' => function ($model) {                      
                      return $model->location->shortname;
                      },
              'filter' => ArrayHelper::map(Location::find()->orderBy('shortname')->asArray()->all(), 'id', 'shortname'),
              'contentOptions'=>['style'=>'width: 5%;text-align:center'],
              'headerOptions' => ['class' => 'text-center'],
            ],            
            [
              'attribute' => 'product_id',
              'enableSorting' => true,
              'value' => function ($model) {                      
                      return $model->product->name;
                      },
              'filter' => Product::getHierarchy(),
              'contentOptions'=>['style'=>'width: 18%;text-align:left'],
              'headerOptions' => ['class' => 'text-center'],
            ],
            [
              'attribute' => 'value',
              'contentOptions'=>['style'=>'width: 5%;text-align:center'],
              'headerOptions' => ['class' => 'text-center'],
            ],
            [
              'attribute' => 'quantity',
              'contentOptions'=>['style'=>'width: 5%;text-align:center'],
              'headerOptions' => ['class' => 'text-center'],
            ],
            [
              'attribute' => 'seller_id',
              'format' => 'raw',
              'enableSorting' => true,
              'value' => function ($model) {                      
                  return $model->seller ? $model->seller->username : '<span class="text-danger"><em>Nenhum</em></span>';
              },
              'filter' => ArrayHelper::map(User::find()->orderBy('username')->asArray()->all(), 'id', 'username'),
              'filterInputOptions' => ['class' => 'form-control', 'style'=>'text-transform: lowercase'],
              'contentOptions'=>['style'=>'width: 8%;text-align:left;text-transform: lowercase'],
              'headerOptions' => ['class' => 'text-center'],
            ],             
            [
              'attribute' => 'operator_id',
              'format' => 'raw',
              'enableSorting' => true,
              'value' => function ($model) {                      
                  return $model->operator ? $model->operator->username : '<span class="text-danger"><em>Nenhum</em></span>';
              },
              'filter' => ArrayHelper::map(User::find()->orderBy('username')->asArray()->all(), 'id', 'username'),
              'filterInputOptions' => ['class' => 'form-control', 'style'=>'text-transform: lowercase', 'prompt'=>''],
              'contentOptions'=>['style'=>'width: 8%;text-align:left;text-transform: lowercase'],
              'headerOptions' => ['class' => 'text-center'],
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
              'headerOptions' => ['class' => 'text-center'],
            ],                         
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>
    </div>
</div>