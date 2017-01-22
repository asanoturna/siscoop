<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use app\models\Person;

?>

<div class="dailyproductivity-search">

    <?php $form = ActiveForm::begin([
        'options' => [
                    'class' => 'form-inline',
                    ],
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-2">
            <?php
                //echo '<label class="control-label">Período</label>';
                echo DatePicker::widget([
                    'model' => $model,
                    'attribute' => 'start_date',
                    'attribute2' => 'end_date',
                    'language' => 'pt',
                    'type' => DatePicker::TYPE_RANGE,
                    'separator' => 'até',
                    'options' => [
                        'placeholder' => '',
                    ],
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'todayHighlight' => true,
                        'format' => 'yyyy-mm-dd',
                    ]
                ]);
            ?>
        </div>

        <div class="col-md-3">
            <?php echo $form->field($model, 'buyer_name') ?>
        </div>

        <div class="col-md-2">        
        <?= $form->field($model, 'person_id')->dropDownList(ArrayHelper::map(Person::find()->where('id != :id', ['id'=>7])->orderBy("name ASC")->all(), 'id', 'name'),['prompt'=>''])  ?>  
        </div>        

        <div class="col-md-3">
            <?php echo $form->field($model, 'buyer_document') ?>
        </div>        

        <div class="form-group">
            <?= Html::submitButton('<span class="glyphicon glyphicon-search" aria-hidden="true"></span> Filtrar', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>