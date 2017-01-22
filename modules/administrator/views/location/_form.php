<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="location-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
      <div class="col-md-6">

        <?= $form->field($model, 'shortname')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'is_active')->radioList([
            '1' => 'Ativo', 
            '0' => 'Inativo',
            ], ['itemOptions' => ['labelOptions'=>array('style'=>'padding:5px;')]]) ?>        

      </div>
      <div class="col-md-6">

        <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'zipcode')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'num_cnpj')->textInput(['maxlength' => true]) ?>

        <div class="row">
        <div class="col-md-6"><?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?> </div>
        <div class="col-md-6"><?= $form->field($model, 'voip')->textInput(['maxlength' => true]) ?></div>
        </div>

      </div>
    </div>    

    <hr/>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Gravar' : 'Gravar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>