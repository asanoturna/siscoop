<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\color\ColorInput;

?>

<div class="department-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="row">
      <div class="col-md-6"><?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?></div>
      <div class="col-md-6">
      <?php
        echo $form->field($model, 'hexcolor')->widget(ColorInput::classname(), [
            'options' => ['placeholder' => 'Selecione'],
        ]);
        ?>
    </div>
    </div>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'is_active')->radioList([
        '1' => 'Ativo', 
        '0' => 'Inativo',
        ], ['itemOptions' => ['labelOptions'=>array('style'=>'padding:5px;')]]) ?>

    <hr/>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Gravar' : 'Gravar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
