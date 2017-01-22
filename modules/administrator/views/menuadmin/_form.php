<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\administrator\models\Menuadmin;

?>

<div class="menuadmin-form">

    <?php $form = ActiveForm::begin(); ?>

<div class="row">
  <div class="col-md-6">

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'visible')->radioList([
        '1' => 'Ativo', 
        '0' => 'Inativo',
        ], ['itemOptions' => ['labelOptions'=>array('style'=>'padding:5px;')]]) ?>    

  </div>
  <div class="col-md-6">

    <?= $form->field($model, 'icon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_id')->dropDownList(ArrayHelper::map(Menuadmin::find()->where(['parent_id' => null])->orderBy("name ASC")->all(), 'id', 'label'),['prompt'=>'Nenhum','style'=>'width:300px'])->hint('Ao selecionar um menu existente, o item criado será considerado um Sub-menu')  ?> 

  </div>
</div>    

    <?= $form->field($model, 'options')->textarea(['rows' => 6]) ?>    

    <hr/>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Gravar' : 'Gravar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
