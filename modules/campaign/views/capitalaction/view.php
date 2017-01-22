<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Ação Capital';
?>
<div class="capitalaction-view">

    <div class="row">
      <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
      <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;"><?php  echo $this->render('_menu'); ?></span></div>
    </div>
    <hr/>

    <p class="pull-right">
        <?= Html::a('<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Alterar', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Excluir', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem certeza que deseja excluir?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'proposed',
            'accomplished',
            'date1',
            'date2',
            'progress:ntext',
            'created',
            'updated',
            'ip',
            'location.fullname',
            [ 
            'label' => 'Usuário',
            'format' => 'raw',
            'value' => $model->user->username,
            ],  
        ],
    ]) ?>

</div>
