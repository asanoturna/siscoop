<?php
use yii\helpers\Html;

$this->title = "Desempenho das Atividades";
?>
<div class="site-error">

    <div class="row">
      <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
      <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;"><?php  echo $this->render('_menu'); ?></span></div>
    </div>
    <hr/>

    <div class="panel panel-default">
    <div class="panel-body"> 

	<div class="row">
	  <div class="col-md-6">
		<div class="panel panel-default">
		  <div class="panel-heading">Atividades Concluídas</div>
		  <div class="panel-body">
		    ---
		  </div>
		</div>
	  </div>
	  <div class="col-md-6">
		<div class="panel panel-default">
		  <div class="panel-heading">Atividades Atrasadas</div>
		  <div class="panel-body">
		    ---
		  </div>
		</div>
	  </div>
	</div>

    </div>
    </div>

</div>
