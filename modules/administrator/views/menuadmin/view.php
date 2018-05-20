<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Parâmentros do Menu #' . $model->id;
?>
<div class="menuadmin-view">

    <div class="row">
    <div class="col-sm-2">
    <?php  echo $this->render('/dashboard/_menuadmin'); ?>
    </div>

    <div class="col-sm-10">

    <div class="row">
      <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
      <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;">
        <?= Html::a('<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Lista de Menu', ['index'], ['class' => 'btn btn-success']) ?>
      </span></div>
    </div>
    <hr/>

    <p>
        <?= Html::a('Alterar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Deseja realmente excluir?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="panel panel-default">
      <div class="panel-body"> 

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'label',
            'icon',
            'url:url',
            'visible',
            'options:ntext',
            'parent_id',
        ],
    ]) ?>

        </div>
    </div>   
    </div>
    </div>
</div>