<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\administrator\models\Location;
use app\modules\administrator\models\Department;
use app\modules\administrator\models\Role;
use yii\widgets\MaskedInput;

?>

<div class="useradmin-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

      <div class="col-md-6">

      <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>

      <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

      <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

      <?php // $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>

      <div class="row">
        <div class="col-md-6">
        <?= $form->field($model, 'role_id')->dropDownList(ArrayHelper::map(Role::find()->orderBy("id ASC")->all(), 'id', 'name'),['prompt'=>'--'])  ?>
        </div>
        <div class="col-md-6">
        <?= $form->field($model, 'status')->dropdownList(['0' => 'Inativo', '1' => 'Ativo'], ['prompt' => 'Selecione']) ?>
        </div>
      </div> 

      </div>

      <div class="col-md-6">

      <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

      <?= $form->field($model, 'celphone')->widget(\yii\widgets\MaskedInput::classname(), ['mask' => ['(99)99999-9999'],
            ]) ?> 

      <?= $form->field($model, 'birthdate')->textInput() ?>

      <?= $form->field($model, 'location_id')->dropDownList(ArrayHelper::map(Location::find()->where(['is_active' => 1])->orderBy("fullname ASC")->all(), 'id', 'fullname'),['prompt'=>'--'])  ?>           
      <?= $form->field($model, 'department_id')->dropDownList(ArrayHelper::map(Department::find()->where(['is_active' => 1])->orderBy("name ASC")->all(), 'id', 'name'),['prompt'=>'--'])  ?>

      </div>

    </div>      

    <hr/>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Gravar' : 'Gravar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
