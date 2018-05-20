<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Detalhes da Unidade #' . $model->id;
?>
<div class="location-view">

    <div class="row">
    <div class="col-sm-2">
    <?php  echo $this->render('/dashboard/_menuadmin'); ?>
    </div>

    <div class="col-sm-10">

    <div class="row">
      <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
      <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;">
        <?= Html::a('<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Lista de Unidades', ['index'], ['class' => 'btn btn-success']) ?>
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
                'shortname',
                'fullname',
                'address',
                'zipcode',
                'num_cnpj',
                'email',
                'phone',          
                'voip', 
                [ 
                'attribute' => 'is_active', 
                'format' => 'raw',
                'value' => $model->is_active == 1 ? '<b style="color:#6CAF3F">Ativo</b>' : '<b style="color:#d43f3a">Inativo</b>',
                ],                 
            ],
        ]) ?>

        </div>
    </div>   
    </div>
    </div>
</div>