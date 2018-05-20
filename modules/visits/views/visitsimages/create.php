<?php

use yii\helpers\Html;

$this->title = 'Imagens da visita #'.Yii::$app->getRequest()->getQueryParam('id');
?>
<div class="visitsimages-create">

    <div class="row">
      <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
      <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;"><?php  echo $this->render('/visits/_menu'); ?></span></div>
    </div>
    <hr/>
    <?php foreach (Yii::$app->session->getAllFlashes() as $key=>$message):?>
        <?php $alertClass = substr($key,strpos($key,'-')+1); ?>
        <div class="alert alert-dismissible alert-<?=$alertClass?>" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p><?=$message?></p>
        </div>
    <?php endforeach ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
