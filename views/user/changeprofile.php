<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use app\models\Location;
use app\models\Department;
use yii\widgets\MaskedInput;

$this->title = 'Alterar Informações';
?>
<div class="site-profile">

    <div class="row">
    <div class="col-sm-2">
    <?php  echo $this->render('//site/_menu'); ?>
    </div>

    <div class="col-sm-10">
    <div class="row">
      <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
      <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;"><?php  echo $this->render('_menu'); ?></span></div>
    </div>
    <hr/>

    <?php foreach (Yii::$app->session->getAllFlashes() as $key=>$message):?>
        <?php $alertClass = substr($key,strpos($key,'-')+1); ?>
        <div class="alert alert-dismissible alert-<?=$alertClass?>" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p><?=$message?></p>
        </div>
    <?php endforeach ?>     

    <div class="panel panel-default">
      	<div class="panel-body">    

		 <?php $form = ActiveForm::begin(); ?>

<div class="row">
  <div class="col-md-6">

            <?= $form->field($model, 'location_id')->dropDownList(ArrayHelper::map(Location::find()->where(['is_active' => 1])->orderBy("fullname ASC")->all(), 'id', 'fullname'),['prompt'=>'--'])  ?> 

            <?= $form->field($model, 'department_id')->dropDownList(ArrayHelper::map(Department::find()->where(['is_active' => 1])->orderBy("name ASC")->all(), 'id', 'name'),['prompt'=>'--'])  ?> 

  </div>
  <div class="col-md-6">

            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'celphone')->widget(\yii\widgets\MaskedInput::classname(), [
                'mask' => ['(99)99999-9999'],
            ]) ?> 

  </div>
</div>         

    <hr/>
    <div class="form-group">
        <?= Html::submitButton('Gravar', ['class' => 'btn btn-success', 'name' => 'signup-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>         

		</div>
	</div>
  
    </div>
    </div>
</div>
