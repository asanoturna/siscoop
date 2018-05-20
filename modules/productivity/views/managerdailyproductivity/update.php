<?php

use yii\helpers\Html;


$this->title = 'Gestão Produtividade Diária';
?>
<div class="managerdailyproductivity-update">

<div class="row">
  <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
  <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;"><?php  echo $this->render('_menu'); ?></span></div>
</div>

<hr/>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
