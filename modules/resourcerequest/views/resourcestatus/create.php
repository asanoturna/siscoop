<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Resourcestatus */

$this->title = 'Create Resourcestatus';
$this->params['breadcrumbs'][] = ['label' => 'Resourcestatuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resourcestatus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
