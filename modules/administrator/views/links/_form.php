<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\User;

?>

<div class="links-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(User::find()->where(['status' => 1])->orderBy("username ASC")->all(), 'id', 'username'),['prompt'=>'-- Exibir para todos --'])?>  

    <?= $form->field($model, 'status')->radioList([
            '1' => 'Ativo', 
            '0' => 'Inativo',
            ], ['itemOptions' => ['labelOptions'=>array('style'=>'padding:5px;')]])
    ?>

            
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Gravar' : 'Gravar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
