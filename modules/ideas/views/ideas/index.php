<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\modules\ideas\models\Ideas;

$this->title = 'Portal de Idéias';
?>
<div class="ideas-index">

    <div class="row">
      <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
      <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;"><?php  echo $this->render('_menu'); ?></span></div>
    </div>
    <hr/>

<div class="panel panel-default">
<div class="panel-body">
<div class="media">
  <div class="media-left media-middle">
    <a href="#">
      <img src="<?php echo Yii::$app->request->baseUrl;?>/images/logo-idea.png" class="media-object">
    </a>
  </div>
  <div class="media-body">
<p>Texto TextoTexto TextoTexto TextoTexto TextoTexto TextoTexto TextoTexto Texto
Texto TextoTexto TextoTexto TextoTexto TextoTexto TextoTexto TextoTexto TextoTexto Texto
Texto TextoTexto TextoTexto TextoTexto TextoTexto TextoTexto TextoTexto TextoTexto Texto
Texto TextoTexto TextoTexto TextoTexto TextoTexto TextoTexto TextoTexto TextoTexto Texto
</p>
<p>
Texto TextoTexto TextoTexto TextoTexto TextoTexto TextoTexto TextoTexto Texto
Texto TextoTexto TextoTexto TextoTexto TextoTexto TextoTexto TextoTexto TextoTexto Texto
Texto TextoTexto TextoTexto TextoTexto TextoTexto TextoTexto TextoTexto TextoTexto Texto
Texto TextoTexto TextoTexto TextoTexto TextoTexto TextoTexto TextoTexto TextoTexto Texto
</p>
<p>
Texto TextoTexto TextoTexto TextoTexto TextoTexto TextoTexto TextoTexto Texto
Texto TextoTexto TextoTexto TextoTexto TextoTexto TextoTexto TextoTexto TextoTexto Texto
Texto TextoTexto TextoTexto TextoTexto TextoTexto TextoTexto TextoTexto TextoTexto Texto
Texto TextoTexto TextoTexto TextoTexto TextoTexto TextoTexto TextoTexto TextoTexto Texto
</p>
<p>
<?= Html::a('<i class="fa fa-lightbulb-o" aria-hidden="true"></i> Cadastre sua Idéia!', ['create'], ['class' => 'btn btn-success']) ?>&nbsp;
<?= Html::a('<i class="fa fa-certificate" aria-hidden="true"></i> Conheça o Regulamento', ['regulation'], ['class' => 'btn btn-success']) ?>
</p>
  </div>
</div>
</div></div>

    <hr/>
    <h2>Conheça as Idéias Cadastradas</h2>

<div class="panel panel-default">
<div class="panel-body">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'tableOptions' => ['class'=>'table table-hover'],
        'emptyText'    => '</br><p class="text-info">Nenhuma idéia encontrada.. :(</p>',
        'rowOptions'   => function ($model, $index, $widget, $grid) {
            return [
                'id' => $model['id'], 
                'onclick' => 'location.href="'
                    . Yii::$app->urlManager->createUrl('ideas/ideas/view') 
                    . '&id="+(this.id);',
                'style' => "cursor: pointer",
            ];
        }, 
        'columns' => [
            // [
            //     'attribute' => 'id',
            //     'enableSorting' => true,
            //     'contentOptions'=>['style'=>'width: 5%;text-align:center'],
            // ],
            [
                'attribute' => 'title',
                'label' => 'Título da Idéia',
                'format' => 'raw',
                'contentOptions'=>['style'=>'width: 45%;text-align:left'],
            ],
            [
                'attribute' => 'type',
                'format' => 'raw',
                'value' => function ($data) {                      
                        return $data->getType();
                },
                'filter' => Ideas::$Static_type,
                'contentOptions'=>['style'=>'width: 25%;text-align:left'],
            ],
            [
                'attribute' => 'id',
                'label' => '',
                'format' => 'raw',
                'value' => function ($model) {
                            return Html::img('images/idea-'.$model->status.'.png',
                                ['width' => '32px', 'class' => 'img-rounded img-thumbnail']);
                },
                'contentOptions'=>['style'=>'width: 10%;text-align:middle'], 
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($data) {                      
                        return $data->getStatus();
                },
                'filter' => Ideas::$Static_status,
                'contentOptions'=>['style'=>'width: 25%;text-align:left'],
            ],
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div></div>
</div>
