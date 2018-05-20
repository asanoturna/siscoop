<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Location;

?>

<div class="capitalaction-form">

    <?php $form = ActiveForm::begin([
            'id' => 'capitalactionform',
            'options' => [
                'class' => 'form-horizontal',
                    ],
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-5\">{input}</div>\n<div class=\"col-lg-4\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-4 control-label'],
            ],
            ]); ?>

<div class="row">
  <div class="col-md-6">

    <?= $form->field($model, 'location_id')->dropDownList(ArrayHelper::map(Location::find()->where(['is_active' => 1])->orderBy("shortname ASC")->all(), 'id', 'shortname'),['prompt'=>'--'])  ?>    

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'proposed')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'accomplished')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date1')->textInput() ?>

    <?= $form->field($model, 'date2')->textInput() ?>

  </div>
  <div class="col-md-6">

    <?= $form->field($model, 'progress')->textarea(['rows' => 9]) ?>

  </div>
</div>            

    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
        <?= Html::submitButton($model->isNewRecord ? 'Gravar' : 'Gravar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
