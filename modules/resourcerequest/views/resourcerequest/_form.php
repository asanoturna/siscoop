<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Location;
use app\modules\resourcerequest\models\Resourcerequest;
use app\modules\resourcerequest\models\Resourcestatus;
use kartik\money\MaskMoney;

?>

<div class="resourcerequest-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">

    <div class="panel panel-default">
      <div class="panel-heading">Informações do Cliente</div>
      <div class="panel-body">
        <div class="row">
        <div class="col-md-6"><?= $form->field($model, 'client_name')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-6"><?= $form->field($model, 'client_phone')->widget(\yii\widgets\MaskedInput::classname(), ['mask' => ['(99)9999-9999', '(99)99999-9999'],]) ?>
        </div>
        </div>

        <div class="row">
        <div class="col-md-6">
        <?php 
        echo $form->field($model, 'value_request')->widget(MaskMoney::classname(), [
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
        <div class="col-md-6">
        <?php
            echo $form->field($model, 'value_capital')->widget(MaskMoney::classname(), [
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

        <div class="row">
        <div class="col-md-6">
        <?= $form->field($model, 'expiration_register')->widget('trntv\yii\datetime\DateTimeWidget',
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
        <?= $form->field($model, 'lastupdate_register')->widget('trntv\yii\datetime\DateTimeWidget',
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
        </div>                
      </div>
    </div> 

    <div class="panel panel-default">
      <div class="panel-heading">Período de aplicação do recurso</div>
      <div class="panel-body">
        <div class="row">
      <div class="col-md-6"><?= $form->field($model, 'requested_month')->dropDownList(Resourcerequest::$Static_requested_month,['prompt'=>'--']) ?></div>
      <div class="col-md-6"><?= $form->field($model, 'requested_year')->dropDownList(Resourcerequest::$Static_requested_year,['prompt'=>'--']) ?></div>
        </div>
      </div>
    </div>   

    </div>
    <div class="col-md-6">

    <div class="panel panel-default">
    <div class="panel-heading">Informações Auxiliares</div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-4"><?= $form->field($model, 'location_id')->dropDownList(ArrayHelper::map(Location::find()->where(['is_active' => 1])->orderBy("shortname ASC")->all(), 'id', 'shortname'),['prompt'=>'--'])  ?> </div>
          <div class="col-md-4"><?= $form->field($model, 'resource_type')->dropDownList(Resourcerequest::$Static_resource_type,['prompt'=>'--']) ?></div>
          <div class="col-md-4"><?= $form->field($model, 'resource_purposes')->dropDownList(Resourcerequest::$Static_resource_purposes,['prompt'=>'--']) ?></div>
        </div>
        <div class="row">
          <div class="col-md-4"><?= $form->field($model, 'has_transfer')->dropDownList(Resourcerequest::$Static_has_transfer,['prompt'=>'--']) ?></div>
          <div class="col-md-4"><?= $form->field($model, 'receive_credit')->dropDownList(Resourcerequest::$Static_receive_credit,['prompt'=>'--']) ?></div>
          <div class="col-md-4"><?= $form->field($model, 'add_insurance')->dropDownList(Resourcerequest::$Static_add_insurance,['prompt'=>'--']) ?></div>
        </div>
      </div>
    </div>   

    <?= $form->field($model, 'observation')->textarea(['rows' => 9]) ?>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Gravar' : 'Gravar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
