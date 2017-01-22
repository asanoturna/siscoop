<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Dailyproductivitystatus */

$this->title = 'Create Dailyproductivitystatus';
$this->params['breadcrumbs'][] = ['label' => 'Dailyproductivitystatuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dailyproductivitystatus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
