<?php

use yii\helpers\Html;

$this->title = 'Nova Planilha';

?>
<div class="reportbase-create">

    <div class="row">
	    <div class="col-md-6"><h1><i class="fa fa-file-excel-o"></i> <?= Html::encode($this->title) ?></h1></div>
	    <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;">
	        <?= Html::a('<span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span> Lista de Arquivos', ['index'], ['class' => 'btn btn-success']) ?></span>
	    </div>      
    </div>
    <hr/>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
