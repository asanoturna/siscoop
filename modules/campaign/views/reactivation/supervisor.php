<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\campaign\models\Reactivation;

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
    <div class="panel-heading">Informações Gerenciadas pela Fabrícia</div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-3">

          <?= $form->field($model, 'supervisor_package_rate')->widget('trntv\yii\datetime\DateTimeWidget',
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

          <?= $form->field($model, 'supervisor_observation')->textarea(['rows' => 8]) ?> 

          </div>
        </div>
      </div>
    </div>   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Gravar' : 'Gravar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?> 

</div>
