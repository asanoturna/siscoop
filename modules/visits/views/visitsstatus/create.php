<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Visitsstatus */

$this->title = 'Create Visitsstatus';
$this->params['breadcrumbs'][] = ['label' => 'Visitsstatuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visitsstatus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
