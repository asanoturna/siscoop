<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Location;
use app\models\Person;
use app\modules\visits\models\Visitsfinality;
use app\modules\visits\models\Visitsstatus;
use app\models\User;
use yii\widgets\MaskedInput;

?>

<div class="visits-form">

<?php
if(preg_match('/(?i)msie [5-8]/',$_SERVER['HTTP_USER_AGENT']))
{
    // if IE<=8
    // include ( TEMPLATEPATH . '/noie.php' );
    // exit;
    echo "<div class=\"alert alert-danger\" role=\"alert\"><span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span> Você está usando o navegador Internet Explorer 8 (ou inferior) ! </br>Para melhor visualização e funcionamento do sistema, utilize o navegador Mozilla Firefox ou Google Chrome</div>";
}else{
    // if IE>8
}
?>

    <?php $form = ActiveForm::begin([
        'id' => 'visitsform',
        'options' => [
            'enctype'=>'multipart/form-data',
            'class' => 'form-horizontal',
            ],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-sm-5\">{input}</div>\n<div class=\"col-sm-3\">{error}</div>",
            'labelOptions' => ['class' => 'col-sm-4 control-label'],
        ],
    ]); ?>

    <div class="row">
        <div class="col-md-5">
        <div class="panel panel-default">
          <div class="panel-heading"><b>Informações do Cliente</b></div>
          <div class="panel-body">

        <?php //echo $form->field($model, 'location_id')->input('number', ['maxlength' => 4, 'step' => '0.1', 'min' => '0']) ?>

        <?= $form->field($model, 'date')->widget('trntv\yii\datetime\DateTimeWidget',
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

        <?= $form->field($model, 'location_id')->dropDownList(ArrayHelper::map(Location::find()->where(['is_active' => 1])->orderBy("shortname ASC")->all(), 'id', 'shortname'),['prompt'=>'--'])  ?>    

        <?= $form->field($model, 'visits_finality_id')->dropDownList(ArrayHelper::map(Visitsfinality::find()->orderBy("name ASC")->all(), 'id', 'name'),['prompt'=>'--'])  ?>    

        <?= $form->field($model, 'company_person')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'person_id')->radioList(
        (ArrayHelper::map(Person::find()->orderBy("name ASC")->all(), 'id', 'name'))
            , ['itemOptions' => ['class' =>'radio-inline','labelOptions'=>array('style'=>'padding:4px;')]])->label('Pessoa');
        ?>

        <?= $form->field($model, 'responsible')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'contact')->textInput(['maxlength' => 50]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => 100]) ?>

        <?= $form->field($model, 'phone')->textInput(['maxlength' => 15,'style'=>'width:100px']) ?>

        </div></div>
        </div>

        <div class="col-md-7">
        <div class="panel panel-default">
          <div class="panel-heading"><b>Informações da Visita</b></div>
          <div class="panel-body">

        <?= $form->field($model, 'observation')->widget(\yii\redactor\widgets\Redactor::className(), [
        'clientOptions' => [
            'minHeight' => 160,
            'lang' => 'pt_br',
            'buttons'=> ['bold', 'italic', 'deleted','unorderedlist', 'orderedlist', 'link', 'alignment'],
        ]
    ])?>  

        <?= $form->field($model, 'value')->textInput(['maxlength' => true,'style'=>'width:80px']) ?>

        <?= $form->field($model, 'num_proposal')->textInput(['maxlength' => true,'style'=>'width:80px']) ?>
             
        <?= $form->field($model, 'file')->fileInput() ?>

        <?= $form->field($model, 'localization_map')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'visits_status_id')->dropDownList(ArrayHelper::map(Visitsstatus::find()->where(['is_active' => 1])->orderBy("name ASC")->all(), 'id', 'name'),['prompt'=>'--'])  ?> 

        </div></div>
        </div>
    </div>    
    <hr/>
    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
        <?= Html::submitButton($model->isNewRecord ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Gravar Visita' : '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Alterar Visita', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?> <span class="text-muted"> * Imagens poderão ser adicionadas na próxima tela</span>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
