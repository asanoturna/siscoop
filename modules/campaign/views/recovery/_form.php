<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Location;
use kartik\money\MaskMoney;
use app\modules\campaign\models\Recovery;
use yii\widgets\Pjax;

?>

<div class="recovery-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
      <div class="col-md-6">

    <div class="row">
      <div class="col-md-6">

        <?= $form->field($model, 'expirationdate')->widget('trntv\yii\datetime\DateTimeWidget',
            [
                'phpDatetimeFormat' => 'yyyy-MM-dd',
                'clientOptions' => [
                    'minDate' => new \yii\web\JsExpression('new Date("2016-01-01")'),
                    'allowInputToggle' => true,
                    'widgetPositioning' => [
                       'horizontal' => 'auto',
                       'vertical' => 'auto'
                    ]
                ]
            ]
        ) ?>      

        <?= $form->field($model, 'clientname')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'clientdoc')->textInput(['maxlength' => true]) ?>

      </div>
      <div class="col-md-6">

        <?= $form->field($model, 'location_id')->dropDownList(ArrayHelper::map(Location::find()->where(['is_active' => 1])->orderBy("shortname ASC")->all(), 'id', 'fullname'))  ?> 

        <?php 
        echo $form->field($model, 'referencevalue')->widget(MaskMoney::classname(), [
            'pluginOptions' => [
                'affixesStay' => true,
                'thousands' => '.',
                'decimal' => ',',
                'precision' => 2, 
                'allowZero' => true,
                'allowNegative' => false,
                'value' => 0.01
            ],
        ]); 
        ?>

        <?= $form->field($model, 'typeofdebt')->dropDownList(Recovery::$Static_typeofdebt) ?>

      </div>
    </div>

      </div>
      <div class="col-md-6">

      </div>
    </div>

    <hr/>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Gravar' : 'Gravar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
