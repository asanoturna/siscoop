<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\campaign\models\Reactivation;
use app\models\User;

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
    <div class="panel-heading">Informações Supervisionadas pelo Claúdio</div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-3">

          <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(User::find()->where(['status' => 1])->orderBy("username ASC")->all(), 'id', 'username'))?>

          <hr/>

          <?= $form->field($model, 'manager_inactive_meeting')->widget('trntv\yii\datetime\DateTimeWidget',
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

          <?= $form->field($model, 'manager_approval')->dropDownList(Reactivation::$Static_managerapproval,['prompt'=>'--']) ?>

          <?= $form->field($model, 'manager_final_opinion')->dropDownList(Reactivation::$Static_managerfinalopinion,['prompt'=>'--']) ?>

          <?= $form->field($model, 'manager_observation')->textarea(['rows' => 8]) ?> 

          </div>
        </div>
      </div>
    </div>   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Gravar' : 'Gravar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?> 

</div>
