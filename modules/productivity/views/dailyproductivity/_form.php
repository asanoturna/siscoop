<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Location;
use app\modules\productivity\models\Product;
use app\models\Person;
use app\models\User;
use yii\widgets\MaskedInput;
use yii\helpers\Url;

?>

<div class="dailyproductivity-form">

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
        'id' => 'dailyproductivityform',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-4\">{input}</div>\n<div class=\"col-lg-4\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-4 control-label'],
        ],
    ]); ?>

<div class="row">

  <div class="col-xs-6">
  <div class="panel panel-default">
  <div class="panel-heading"><b>Informações do Cliente</b></div>
  <div class="panel-body">

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

    <hr/>

    <?= $form->field($model, 'person_id')->radioList(
(ArrayHelper::map(Person::find()->where('id != :id', ['id'=>7])->orderBy("name ASC")->all(), 'id', 'name'))
            , ['itemOptions' => ['class' =>'radio-inline','labelOptions'=>array('style'=>'padding:4px;')]])->label('Pessoa');
        ?>
    <?= $form->field($model, 'buyer_document')->widget(\yii\widgets\MaskedInput::classname(), [
            'mask' => ['999.999.999-99', '99.999.999/9999-99'],
        ]) ?>

    <?= $form->field($model, 'buyer_name')->textInput(['maxlength' => true]) ?>    

  </div></div></div>

  <div class="col-xs-6">
  <div class="panel panel-default">
  <div class="panel-heading"><b>Informações da Venda</b></div>
  <div class="panel-body">

  <?php //echo $form->field($model, 'value')->textInput(['maxlength' => true]) 
        use kartik\money\MaskMoney;
        echo $form->field($model, 'value')->widget(MaskMoney::classname(), [
            'pluginOptions' => [
                //'prefix' => 'R$ ',
                //'suffix' => ' c',
                'affixesStay' => true,
                'thousands' => '.',
                'decimal' => ',',
                'precision' => 2, 
                'allowZero' => true,
                'allowNegative' => false,
                'value' => 0.01
            ],
        ]); 
        ?>
        <br/>

<?php
$productId = Html::getInputId($model, 'product_id');
$comissionId = Html::getInputId($model, 'commission_percent');
$prazoId = Html::getInputId($model, 'prazo');
$valueId = Html::getInputId($model, 'value');
$js = <<<JS
$('#{$productId}').on('change', function () {
    var id = $(this).val();
    
    if (id == 2) { //Auto
        var min = 10;
        var max = 25;
        prazomin = 1;
        prazomax = 1;
    }else if (id == 3){ //Residencial Comum
        var min = 10;
        var max = 40;
        prazomin = 1;
        prazomax = 1;       
    }else if (id == 4){ //Residencial Simplificado
        var min = 30;
        var max = 30;
        prazomin = 1;
        prazomax = 1;   
    }else if (id == 5){ //Empresarial Simplificado
        var min = 20;
        var max = 20;
        prazomin = 1;
        prazomax = 1;   
    }else if (id == 6){ //Empresarial Comum
        var min = 20;
        var max = 40;
        prazomin = 1;
        prazomax = 1;
    }else if (id == 7){ //Vida Apolice 105
        var min = 40;
        var max = 40;
        prazomin = 1;
        prazomax = 1;
    }else if (id == 8){ //Vida Mulher
        var min = 35;
        var max = 35;
        prazomin = 1;
        prazomax = 1;
    }else if (id == 9){ //Viagem
        var min = 35;
        var max = 35;
        prazomin = 1;
        prazomax = 1;
    }else if (id == 10){ //Passageiro 
        var min = 40;
        var max = 40;
        prazomin = 1;
        prazomax = 1;
    }else if (id == 11){ //AP Não Nominado
        var min = 40;
        var max = 40;
        prazomin = 1;
        prazomax = 1;
    }else if (id == 12){ //Estagiario 
        var min = 40;
        var max = 40;
        prazomin = 1;
        prazomax = 1;
    }else if (id == 13){ //Vida Individual
        var min = 35;
        var max = 35;
        prazomin = 1;
        prazomax = 1;
    }else if (id == 14){ //Vida Empresarial
        var min = 35;
        var max = 35;
        prazomin = 1;
        prazomax = 1;
    }else if (id == 15){ //Vida Empresarial Uniforme
        var min = 30;
        var max = 30;
        prazomin = 1;
        prazomax = 1;
    }else if (id == 16){ // Prestamista Mongeral    
        var min = 40;
        var max = 40;
        prazomin = 1;
        prazomax = 1;
    }else if (id == 17){ // Prestamista Quitacred   
        var min = 40;
        var max = 40;
        prazomin = 1;
        prazomax = 1;
    }else if (id == 18){ // Prestamista Apolice 106 
        var min = 42;
        var max = 42;
        prazomin = 1;
        prazomax = 1;
    }else if (id == 19){ // Outros 
        var min = 0;
        var max = 40;
        prazomin = 1;
        prazomax = 1;

    }else if (id == 101){ //Auto tabela B
        var min = 3.5;
        var max = 3.5;
        prazomin = 1;
        prazomax = 1;   
    }else if (id == 102){ //Auto tabela C
        var min = 5.5;
        var max = 5.5;
        prazomin = 1;
        prazomax = 1;   
    }else if (id == 103){ //Moto tabela B
        var min = 3.5;
        var max = 3.5;
        prazomin = 1;
        prazomax = 1;
    }else if (id == 104){ //Moto tabela C
        var min = 5.5;
        var max = 5.5;
        prazomin = 1;
        prazomax = 1;
    }else if (id == 105){ //Imovel tabela B
        var min = 3.5;
        var max = 3.5;
        prazomin = 1;
        prazomax = 1;
    }else if (id == 106){ //Imovel tabela C
        var min = 5.5;
        var max = 5.5;
        prazomin = 1;
        prazomax = 1;
    }else if (id == 107){ //Equipamentos tabela B
        var min = 3.5;
        var max = 3.5;
        prazomin = 1;
        prazomax = 1;
    }else if (id == 108){ //Equipamentos tabela C
        var min = 5.5;
        var max = 5.5;
        prazomin = 1;
        prazomax = 1;
    }else if (id == 109){ //Servicos tabela B
        var min = 3.5;
        var max = 3.5;
        prazomin = 1;
        prazomax = 1;
    }else if (id == 110){ //Servicos tabela C
        var min = 5.5;
        var max = 5.5;
        prazomin = 1;
        prazomax = 1;
   
    }else if (id == 201){ //Cielo
        var min = 10;
        var max = 10;
        prazomin = 1;
        prazomax = 1;
    }else if (id == 202){ //Redecard
        var min = 10;
        var max = 10;
        prazomin = 1;
        prazomax = 1;
    }else if (id == 203){ //Sipag
        var min = 1;
        var max = 1;
        prazomin = 1;
        prazomax = 1;
    
    }else if (id == 301){ //Cabal Vale
        var min = 1;
        var max = 1;
        prazomin = 1;
        prazomax = 1;

    }else if (id == 401){ //Travel Money
        var min = 1;
        var max = 1;
        prazomin = 1;
        prazomax = 1;

    }else if (id == 501){ //Seguro PPR
        var min = 1;
        var max = 1;
        prazomin = 1;
        prazomax = 1;
    }else if (id == 502){ //SMS Ilimitado
        var min = 1;
        var max = 1;
        prazomin = 1;
        prazomax = 1;
    }else if (id == 503){ //CDC Sicoobcard
        var min = 1;
        var max = 1;
        prazomin = 2;
        prazomax = 12;        
        
    }else if (id == 601){ //Capital de Giro
        var min = 1;
        var max = 1;
        prazomin = 1;
        prazomax = 1;
    }else if (id == 602){ //Finame
        var min = 1;
        var max = 1;
        prazomin = 1;
        prazomax = 1;       
        
    }else if (id == 701){ //Sicoob Previ
        var min = 75;
        var max = 75;
        prazomin = 1;
        prazomax = 1;
        
    }else if (id == 801){ //Consignado Seplag
        var min = 1;
        var max = 1;
        prazomin = 6;
        prazomax = 60;
    
    }else if (id == 802){ //Consignado INSS 
        var min = 1;
        var max = 1;
        prazomin = 6;
        prazomax = 72;

    }else if (id == 803){ //CDL
        var min = 1;
        var max = 1;
        prazomin = 3;
        prazomax = 24;      

    }else if (id == 804){ //Presbiteriano
        var min = 1;
        var max = 1;
        prazomin = 3;
        prazomax = 24;  

    }else if (id == 805){ //Prefeitura
        var min = 1;
        var max = 1;
        prazomin = 6;
        prazomax = 60;                  

    }else if (id == 901){ //Cedente
        var min = 1;
        var max = 1;
        prazomin = 1;
        prazomax = 1;
    }

    $("#{$comissionId}").data('slider').options.min = min;
    $("#{$comissionId}").data('slider').options.max = max;
    $("#{$comissionId}").slider('setValue', min);
    
    $("#{$prazoId}").data('slider').options.min = prazomin;
    $("#{$prazoId}").data('slider').options.max = prazomax;
    $("#{$prazoId}").slider('setValue', min);
    
});
JS;
$this->registerJs($js);
?>

        <?php
            use kartik\slider\Slider;
            echo $form->field($model, 'commission_percent')->widget(Slider::classname(), [
            'name'=>'commission_percent',
            'value'=>7,
            'sliderColor'=>Slider::TYPE_GREY,
            'handleColor'=>Slider::TYPE_SUCCESS,
            'pluginOptions'=>[
                'handle'=>'round',
                'tooltip'=>'always',
                // 'min'=>0,
                // 'max'=>100,
                'step'=>1,
            ]
        ]);
        ?>   
        <br/> 
        
        <?php
            echo $form->field($model, 'prazo')->widget(Slider::classname(), [
            'name'=>'prazo',
            'value'=>7,
            'sliderColor'=>Slider::TYPE_GREY,
            'handleColor'=>Slider::TYPE_SUCCESS,
            'pluginOptions'=>[
                'handle'=>'round',
                'tooltip'=>'always',
                // 'min'=>0,
                // 'max'=>100,
                'step'=>1,
            ]
        ]);
        ?>
        
        <?php //echo $form->field($model, 'quantity')->textInput(['value' => 1,'maxlength' => true]) ?>
        <?php //echo $form->field($model, 'companys_revenue', ['inputOptions' => ['value' => 5, 'class' => 'form-control']])->textInput(['readonly' => true]) ?>  

    <hr/>          
        
    <?= $form->field($model, 'seller_id')->dropDownList(ArrayHelper::map(User::find()->where(['status' => 1])->orderBy("username ASC")->all(), 'id', 'username'),['prompt'=>'-- Selecione --'])?>

    <?= $form->field($model, 'operator_id')->dropDownList(ArrayHelper::map(User::find()->where(['status' => 1])->orderBy("username ASC")->all(), 'id', 'username'),['prompt'=>'-- Selecione --'])?>                

    </div></div></div>

    </div>    

    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
        <?= Html::submitButton($model->isNewRecord ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Gravar' : '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Gravar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>