<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Department;
use app\modules\task\models\Category;
use app\modules\task\models\Priority;
use app\modules\task\models\Todolist;
use app\models\User;
use yii\widgets\MaskedInput;
use yii\helpers\ArrayHelper;
?>

<div class="todolist-form">

    <?php $form = ActiveForm::begin([
        'id' => 'visitsform',
        'options' => [
            'enctype'=>'multipart/form-data',
            //'class' => 'form-horizontal',
            ],
        ]); ?>

    <div class="row">
      <div class="col-md-6">

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(\yii\redactor\widgets\Redactor::className(), [
        'clientOptions' => [
            'minHeight' => 230,
            'lang' => 'pt_br',
            'buttons'=> ['bold', 'italic', 'deleted','unorderedlist', 'orderedlist', 'link', 'alignment'],
        ]
    ])?> 

      </div>
      <div class="col-md-6">

    <div class="row">
      <div class="col-md-6">
      <?= $form->field($model, 'department_id')->dropDownList(ArrayHelper::map(Department::find()->where(['is_active' => 1])->orderBy("name ASC")->all(), 'id', 'name'),['prompt'=>'-- Selecione --'])  ?>
      </div>
      <div class="col-md-6">
      <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(Category::find()->orderBy("name ASC")->all(), 'id', 'name'),['prompt'=>'-- Selecione --'])  ?>
      </div>
    </div>
    
    <div class="row">
      <div class="col-md-6"><?= $form->field($model, 'responsible_id')->dropDownList(ArrayHelper::map(User::find()->where(['status' => 1])->orderBy("username ASC")->all(), 'id', 'username'),['prompt'=>'-- Selecione --'])?></div>
      <div class="col-md-6"><?= $form->field($model, 'co_responsible_id')->dropDownList(ArrayHelper::map(User::find()->where(['status' => 1])->orderBy("username ASC")->all(), 'id', 'username'),['prompt'=>'-- Selecione --'])?></div>
    </div>


    <div class="row">
      <div class="col-md-6">
      <?= $form->field($model, 'deadline')->widget('trntv\yii\datetime\DateTimeWidget',
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
      
      </div>
    </div>

    <?= $form->field($model, 'file')->fileInput() ?>
          
      </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Gravar' : 'Gravar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
