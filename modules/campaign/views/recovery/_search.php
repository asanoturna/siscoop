<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\campaign\models\RecoverySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="recovery-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'negotiator_id') ?>

    <?= $form->field($model, 'location_id') ?>

    <?= $form->field($model, 'clientname') ?>

    <?= $form->field($model, 'clientdoc') ?>

    <?php // echo $form->field($model, 'contracts') ?>

    <?php // echo $form->field($model, 'value_traded') ?>

    <?php // echo $form->field($model, 'value_input') ?>

    <?php // echo $form->field($model, 'type_proposed') ?>

    <?php // echo $form->field($model, 'commission') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'approvedby') ?>

    <?php // echo $form->field($model, 'approvedin') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
