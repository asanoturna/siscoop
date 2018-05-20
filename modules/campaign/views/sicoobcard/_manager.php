<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Location;
use app\modules\campaign\models\Sicoobcard;
use kartik\money\MaskMoney;

?>

<div class="campaign-sicoobcard-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
      <div class="col-md-2 col-md-offset-5">
    <?= $form->field($model, 'status')->dropDownList(Sicoobcard::$Static_status,['prompt'=>'--']) ?>
      </div>
    </div>  
    <hr/>
<div class="row">
      <div class="col-md-6">

    <div class="row">
      <div class="col-md-6"><?= $form->field($model, 'product_type')->dropDownList(Sicoobcard::$Static_product_type,['prompt'=>'--']) ?></div>
      <div class="col-md-6"><?= $form->field($model, 'location_id')->dropDownList(ArrayHelper::map(Location::find()->where(['is_active' => 1])->orderBy("shortname ASC")->all(), 'id', 'shortname'),['prompt'=>'--'])  ?></div>
    </div>    

    <div class="row">
      <div class="col-md-6"><?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?></div>
      <div class="col-md-6"><?= $form->field($model, 'card')->textInput(['maxlength' => true]) ?></div>
    </div>

      </div>
      <div class="col-md-6">

    <div class="row">
      <div class="col-md-6">

    <?= $form->field($model, 'purchasedate')->widget('trntv\yii\datetime\DateTimeWidget',
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

      </div>
      <div class="col-md-6">

    <?php 
    echo $form->field($model, 'purchasevalue')->widget(MaskMoney::classname(), [
        'pluginOptions' => [
            //'prefix' => 'R$ ',
            //'suffix' => ' c',
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

      </div>
    </div>

    <?= $form->field($model, 'purchaselocal')->textInput() ?>

      </div>
    </div> 
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Gravar' : 'Gravar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>