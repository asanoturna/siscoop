<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Portal de Idéias';
?>
<div class="ideas-view">

    <div class="row">
      <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
      <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;"><?php  echo $this->render('_menu'); ?></span></div>
    </div>
    <hr/>

    <p>
        <?= Html::a('Acesso Comitê', ['#'], ['class' => 'btn btn-primary']) ?>
    </p>

    <div class="panel panel-default">
    <div class="panel-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [ 
            'attribute' => 'id',
            'format' => 'raw',
            'value' => "# ".$model->id,
            ],
            [ 
            'label' => 'Idéia enviada por',
            'format' => 'raw',
            'value' => $model->user->fullname,
            ],
            [ 
            'attribute' => 'created',
            'format' => 'raw',
            'value' => date("d/m/Y",  strtotime($model->created))
            ],
            [ 
            'attribute' => 'type',  
            'format' => 'raw',
            'value' => $model->Type,
            ],
            'title',
            'description:ntext',
            'objective:ntext',
            'viability',
            [ 
            'attribute' => 'status',  
            'format' => 'raw',
            'value' => $model->Status,
            ],
            // 'status',
            // 'created',
            // 'updated',
            // 'answer',
            // 'committee_id',
        ],
    ]) ?>
    </div></div>

</div>
