<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Atividade #' . $model->id;
?>
<div class="todolist-view">

    <div class="row">
      <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
      <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;"><?php  echo $this->render('_menu'); ?></span></div>
    </div>
    <hr/>

    <p>
        <?= Html::a('<i class="fa fa-cog" aria-hidden="true"></i> Responsável', ['responsible', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fa fa-wrench" aria-hidden="true"></i> Gerenciar', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fa fa-trash-o" aria-hidden="true"></i> Excluir', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Confirma a exclusão do registro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="panel panel-default">
    <div class="panel-body"> 

    <div class="row">
      <div class="col-md-6">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'department.name',
            'category.name',
            [
            'attribute' => 'deadline',
            'value' => date("d/m/Y",  strtotime($model->deadline))
            ],
            [
            'attribute'=>'attachment',
            'format' => 'raw',
            'value' => $model->attachment == null ? "<span class=\"not-set\">(sem anexo)</span>" : '<span class="glyphicon glyphicon-paperclip"></span> '.Html::a('Visualizar Anexo', \Yii::$app->getModule('task')->params['taskAttachment'].$model->attachment, ['target' => '_blank']),
            ],
            [
            'attribute' => 'owner_id',
            'format' => 'raw',
            'value' => $model->owner->fullname,
            'contentOptions' => ['style' => 'text-align:left;text-transform: uppercase'],
            ],
            [
            'attribute' => 'created',
            'value' => date("d/m/Y",  strtotime($model->created))
            ],
            [
            'attribute' => 'responsible_id',
            'format' => 'raw',
            'value' => $model->responsible->fullname,
            'contentOptions' => ['style' => 'text-align:left;text-transform: uppercase'],
            ],
            [
            'attribute' => 'updated',
            'value' => date("d/m/Y",  strtotime($model->updated))
            ],
            [
            'attribute' => 'status_id',
            'format' => 'raw',
            'value' => $model->status_id === 1 ? "<span class=\"label label-default\">".$model->status->name."</span>" : "<span class=\"label label-success\">".$model->status->name."</span>",
            ],
            [
            'attribute' => 'notification_deadline',
            'format' => 'raw',
            'value' => $model->notification_deadline === 1 ? "<i class=\"fa fa-check\" aria-hidden=\"true\"></i> Mensagem enviada em ".date("d/m/Y",  strtotime($model->notification_deadline_date))."
" : "<i class=\"fa fa-close\" aria-hidden=\"true\"></i> Mensagem não enviada",
            ],
        ],
    ]) ?>

      </div>
      <div class="col-md-6">

    <div class="panel panel-default">
      <div class="panel-heading"><b>Descrição da Atividade</b></div>
      <div class="panel-body">
        <?= $model->description == null ? "<span class=\"not-set\">(não informado)</span>" : $model->description ?>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading"><b>Observação do Responsável</b></div>
      <div class="panel-body">
        <?= $model->responsible_note == null ? "<span class=\"not-set\">(não informado)</span>" : $model->responsible_note ?>
      </div>
    </div>

      </div>
    </div>

    </div>
    </div>

</div>
