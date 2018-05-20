<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\User;

?>
    <?php $form = ActiveForm::begin([
        'options' => [
                    'class' => 'form-inline',
                    ],
        'action' => ['performance_user'],
        'method' => 'get',
    ]); ?>

        <?= $form->field($model, 'seller_id')->dropDownList(ArrayHelper::map(User::find()->where('role_id != :id', ['id'=>1],['status' => 1])->orderBy("username ASC")->all(), 'id', 'username'),['prompt'=>'-- Selecione --'])->label('Usuário',['class'=>'label-class'])?>

        <div class="form-group">
            <?= Html::submitButton('<span class="glyphicon glyphicon-search" aria-hidden="true"></span> Filtrar', ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>