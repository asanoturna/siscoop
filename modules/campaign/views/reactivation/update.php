<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\campaign\models\Reactivation;
use kartik\money\MaskMoney;

$this->title = 'Reativação de Associados - #'  . $model->id;
?>
<div class="resourcerequest-manager">

    <div class="row">
      <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
      <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;"><?php  echo $this->render('_menu'); ?></span></div>
    </div>
    <hr/>

  <?php $form = ActiveForm::begin(); ?>

<div class="panel panel-default">
    <div class="panel-heading">Informações Gerenciadas pelos Gerentes</div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-3">

          <?= $form->field($model, 'restrictions_serasa')->dropDownList(Reactivation::$Static_serasa,['prompt'=>'--']) ?>

          <?= $form->field($model, 'restrictions_ccf')->dropDownList(Reactivation::$Static_ccf,['prompt'=>'--']) ?>

          <?= $form->field($model, 'restrictions_scr')->dropDownList(Reactivation::$Static_scr,['prompt'=>'--']) ?>

          <?= $form->field($model, 'agent_visit_number')->textInput(['maxlength' => true]) ?>

          <?= $form->field($model, 'agent_registration_renewal')->widget('trntv\yii\datetime\DateTimeWidget',
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

	    <?php 
	    echo $form->field($model, 'agent_overdraft_value')->widget(MaskMoney::classname(), [
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

	    <?php 
	    echo $form->field($model, 'agent_card_value')->widget(MaskMoney::classname(), [
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

          </div>
        </div>
      </div>
    </div>   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Gravar' : 'Gravar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?> 

</div>
