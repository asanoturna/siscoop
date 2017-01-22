<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Location;
use kartik\money\MaskMoney;
use app\modules\campaign\models\Recovery;

$this->title = 'Gerenciar registro: #'  . $model->id;
?>
<div class="resourcerequest-manager">

    <div class="row">
      <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
      <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;"><?php  echo $this->render('_menu'); ?></span></div>
    </div>
    <hr/>

  <?php $form = ActiveForm::begin(); ?>

  <div class="panel panel-default">
    <div class="panel-heading">Gerenciar Situação do Registro</div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-3">

          <?= $form->field($model, 'status')->dropDownList(Recovery::$Static_status) ?> 

          </div>
        </div>
      </div>
    </div>   

  <div class="panel panel-default">
    <div class="panel-heading">Corrigir Informações do Registro</div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-3">

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

          </div>
        </div>
      </div>
    </div>  

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Gravar' : 'Gravar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?> 

</div>
