<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Location;
use app\modules\productivity\models\Product;
use app\models\Modality;
use app\models\Person;
use app\modules\productivity\models\Dailyproductivitystatus;
use app\models\User;
use yii\widgets\MaskedInput;
use yii\helpers\Url;

?>

<div class="managerdailyproductivity-form">

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-5\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-4 control-label'],
        ],
    ]); ?>

    <div class="row">
    <div class="col-md-6">
    <?= $form->field($model, 'daily_productivity_status_id')->dropDownList(ArrayHelper::map(Dailyproductivitystatus::find()->where(['is_active' => 1])->orderBy("name ASC")->all(), 'id', 'name'),['prompt'=>'--'])  ?>  
    </div>
    <div class="col-md-6">
    <?= $form->field($model, 'is_commission_received')->radioList([
        '1' => 'Sim', 
        '0' => 'Não',
        ], ['itemOptions' => ['class' =>'radio-inline','labelOptions'=>array('style'=>'padding:5px;')]])->label('Comissão Recebida') ?>  
    </div>
    </div>
    <hr/>

    <div class="row">
    <div class="col-md-6">
        <?php echo $form->field($model, 'date')->widget('trntv\yii\datetime\DateTimeWidget',
            [
                'phpDatetimeFormat' => 'yyyy-MM-dd',
                'clientOptions' => [
                    'minDate' => new \yii\web\JsExpression('new Date("2015-01-01")'),
                    'allowInputToggle' => true,
                    'widgetPositioning' => [
                       'horizontal' => 'auto',
                       'vertical' => 'auto'
                    ]
                ]
            ]
        ); ?>

        <?= $form->field($model, 'location_id')->dropDownList(ArrayHelper::map(Location::find()->where(['is_active' => 1])->orderBy("shortname ASC")->all(), 'id', 'shortname'),['prompt'=>'--'])  ?>    

        <?=
        $form->field($model, 'product_id', [
            'inputOptions' => [
                'class' => 'selectpicker '
            ]
        ]
        )->dropDownList(app\modules\productivity\models\Product::getHierarchy(), ['prompt' => 'Selecione', 'class'=>'form-control required']);
        ?>

        <?php //echo $form->field($model, 'valor')->textInput(['maxlength' => true]) 
        use kartik\money\MaskMoney;
        echo $form->field($model, 'value')->widget(MaskMoney::classname(), [
            'pluginOptions' => [
                //'prefix' => 'R$ ',
                //'suffix' => ' c',
                'affixesStay' => true,
                'thousands' => '.',
                'decimal' => ',',
                'precision' => 2, 
                'allowZero' => false,
                'allowNegative' => false,
            ],
        ]); 
        ?>

        <?php echo $form->field($model, 'commission_percent')->textInput(['maxlength' => true])?>

        <?php echo $form->field($model, 'companys_revenue', ['inputOptions' => ['class' => 'form-control']]) ?>

    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'person_id')->dropDownList(ArrayHelper::map(Person::find()->orderBy("name ASC")->all(), 'id', 'name'),['prompt'=>''])  ?>    

        <?= $form->field($model, 'buyer_document')->widget(\yii\widgets\MaskedInput::classname(), [
            'mask' => ['999.999.999-99', '99.999.999/9999-99'],
        ]) ?>

        <?= $form->field($model, 'buyer_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'seller_id')->dropDownList(ArrayHelper::map(User::find()->orderBy("username ASC")->all(), 'id', 'username'),['prompt'=>'-- Selecione --'])  ?>

        <?= $form->field($model, 'operator_id')->dropDownList(ArrayHelper::map(User::find()->orderBy("username ASC")->all(), 'id', 'username'),['prompt'=>'-- Selecione --'])  ?>

        <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(User::find()->orderBy("username ASC")->all(), 'id', 'username'),['prompt'=>'-- Selecione --'])  ?>

    </div>

    </div>

    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
        <?= Html::submitButton($model->isNewRecord ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Gravar' : '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Gravar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>

        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
