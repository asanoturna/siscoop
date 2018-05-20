<?php

use yii\helpers\Html;

$this->title = 'Produtividade Diária';
?>
<div class="dailyproductivity-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr/>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
