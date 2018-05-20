<?php

use yii\helpers\Html;

$this->title = 'Campanha Sicoobcard Todo Dia - #' . $model->name;
?>
<div class="campaign-sicoobcard-update">

    <div class="row">
      <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
      <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;">
      <?= Html::a('<span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> Registros', ['index'], ['class' => 'btn btn-success']) ?>
      </span></div>      
    </div>
    <hr/>

    <div class="panel panel-default">
      <div class="panel-body"> 

	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>

        </div>
    </div>

</div>
