
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\campaign\models\Sipag;

?>

<div class="visits-search">

    <?php $form = ActiveForm::begin([
        'options' => [
                    'class' => 'form-inline',
                    ],
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-6">

        <?= $form->field($model, 'establishmenttype')->dropDownList(Sipag::$Static_establishmenttype,['prompt'=>'TODOS','onchange'=>'submit(this.value);']) ?>

        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>