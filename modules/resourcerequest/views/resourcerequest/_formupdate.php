<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Location;
use app\models\Resourcerequest;
use app\models\Resourcestatus;
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
               
      </div>
    </div>   

    </div>
    <div class="col-md-6">  

    <?= $form->field($model, 'observation')->textarea(['rows' => 9]) ?>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Gravar' : 'Gravar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
