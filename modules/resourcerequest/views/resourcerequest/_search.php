<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\resourcerequest\models\Resourcerequest;

?>

<div class="resourcerequest-search">

    <?php $form = ActiveForm::begin([
        'options' => [
                    'class' => 'form-inline',
                    ],
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
    <div class="col-md-7">
    <?= $form->field($model, 'has_transfer')->dropDownList(Resourcerequest::$Static_has_transfer,['prompt'=>'--']) ?>
    <?= $form->field($model, 'receive_credit')->dropDownList(Resourcerequest::$Static_receive_credit,['prompt'=>'--']) ?>

    </div>
    <div class="form-group">
        <?= Html::submitButton('Filtrar', ['class' => 'btn btn-success']) ?>
    </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>
