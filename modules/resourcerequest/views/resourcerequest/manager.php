<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Location;
use app\modules\resourcerequest\models\Resourcerequest;
use app\modules\resourcerequest\models\Resourcestatus;
use kartik\money\MaskMoney;


$this->title = 'Gerenciar Solicitação: #'  . $model->id;
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
      <?= $form->field($model, 'resource_status_id')->dropDownList(ArrayHelper::map(ResourceStatus::find()->orderBy("name ASC")->all(), 'id', 'name')) ?> 
      <?php 
          echo $form->field($model, 'value_request')->widget(MaskMoney::classname(), [
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
        ?> </div>
        </div>
        <div class="row">
          <div class="col-md-6"><?= $form->field($model, 'observation_status')->textarea(['rows' => 9]) ?></div>
        </div>
      </div>
    </div>   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Gravar' : 'Gravar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>	

</div>
