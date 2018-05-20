<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\campaign\models\Sipag;

$this->title = 'Conferir registro: #'  . $model->id;
?>
<div class="resourcerequest-manager">

    <div class="row">
      <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
      <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;"><?php  echo $this->render('_menu'); ?></span></div>
    </div>
    <hr/>

	<?php $form = ActiveForm::begin(); ?>

<div class="panel panel-default">
    <div class="panel-heading">Situação</div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-3">

    <?= $form->field($model, 'date')->widget('trntv\yii\datetime\DateTimeWidget',
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

    <fieldset >
    <legend>Dominílios já existentes</legend>
    <div class="row">
      <div class="col-md-6"><?= $form->field($model, 'flag_sipag')->checkbox() ?></div>
      <div class="col-md-6"><?= $form->field($model, 'flag_sipag_locked')->checkbox() ?></div>
    </div>

    <div class="row">
      <div class="col-md-6"><?= $form->field($model, 'flag_rede')->checkbox() ?></div>
      <div class="col-md-6"><?= $form->field($model, 'flag_rede_locked')->checkbox() ?></div>
    </div>    

    <div class="row">
      <div class="col-md-6"><?= $form->field($model, 'flag_cielo')->checkbox() ?></div>
      <div class="col-md-6"><?= $form->field($model, 'flag_cielo_locked')->checkbox() ?></div>
    </div>
    </fieldset>
    <hr/>    

          </div>
        </div>
      </div>
    </div>   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Gravar' : 'Gravar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>	

</div>
