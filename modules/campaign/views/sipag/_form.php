<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\money\MaskMoney;
use app\modules\campaign\models\Sipag;

?>
<div class="capitalaction-form">

    <div class="panel panel-default">
    <div class="panel-body">  

    <?php $form = ActiveForm::begin(); ?>

<div class="row">
  <div class="col-md-6">

    <?= $form->field($model, 'establishmenttype')->dropDownList(Sipag::$Static_establishmenttype,['prompt'=>'--']) ?> 

    <?= $form->field($model, 'establishmentname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'expedient')->textInput(['maxlength' => true]) ?>

    <fieldset >
    <legend>Dominílios já existentes</legend>
    <div class="row">
      <div class="col-md-6"><?= $form->field($model, 'flag_sipag')->checkbox() ?></div>
      <div class="col-md-6"><?= $form->field($model, 'flag_sipag_locked')->checkbox() ?></div>
    </div>

    <div class="row">
      <div class="col-md-6"><?= $form->field($model, 'flag_rede')->checkbox() ?></div>
      <div class="col-md-6"><?= $form->field($model, 'flag_rede_locked')->checkbox() ?></div>
    </div>    

    <div class="row">
      <div class="col-md-6"><?= $form->field($model, 'flag_cielo')->checkbox() ?></div>
      <div class="col-md-6"><?= $form->field($model, 'flag_cielo_locked')->checkbox() ?></div>
    </div>
    </fieldset>
    <hr/>

    <?= $form->field($model, 'visited')->dropDownList(Sipag::$Static_visited,['prompt'=>'--']) ?>     

    <?= $form->field($model, 'accredited')->dropDownList(Sipag::$Static_accredited,['prompt'=>'--']) ?>     

    <?= $form->field($model, 'locked')->dropDownList(Sipag::$Static_locked,['prompt'=>'--']) ?>     

    <?= $form->field($model, 'anticipation')->dropDownList(Sipag::$Static_anticipation,['prompt'=>'--']) ?>     

    <?= $form->field($model, 'status')->dropDownList(Sipag::$Static_status,['prompt'=>'--']) ?> 

    <?= $form->field($model, 'observation')->textarea(['rows' => 6]) ?>        

  </div>
  <div class="col-md-6">
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <strong>SIPAG - Taxas</strong></a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
          <table class="table">
            <tr class="active">
                <td>Tipo do Estabelecimento</td>
                <td>Débito</td>
                <td>Crédito à vista</td>
                <td>Crédito parcelado 2 a 6</td>
                <td>Crédito Parcelado 7 a 12</td>
            </tr>
            <tr>
                <td>RESTAURANTE</td>
                <td>2%</td>
                <td>3,45%</td>
                <td>3,97%</td>
                <td>4,24%</td>
            </tr>
            <tr>
                <td>HOTEIS</td>
                <td>1,85%</td>
                <td>2,89%</td>
                <td>3,32%</td>
                <td>3,55%</td>
            </tr>
            <tr>
                <td>ALIMENTAÇÃO EMERCADOS ESPECIAIS</td>
                <td>1,76%</td>
                <td>3,24%</td>
                <td>3,73%</td>
                <td>3,99%</td>
            </tr>   
            <tr>
                <td>SUPERMERCADOS</td>
                <td>1,55%</td>
                <td>2,35%</td>
                <td>2,70%</td>
                <td>2,89%</td>
            </tr>
            <tr>
                <td>POSTO DE COMBUSTIVEL</td>
                <td>1,45%</td>
                <td>2,37%</td>
                <td>2,8%</td>
                <td>3,1%</td>
            </tr>
            <tr>
                <td>ACADEMIA</td>
                <td>2,09%</td>
                <td>3,06%</td>
                <td>3,52%</td>
                <td>3,76%</td>
            </tr> 
            <tr>
                <td>ESCOLAS PARTICULARES</td>
                <td>2,03%</td>
                <td>3,24%</td>
                <td>3,73%</td>
                <td>3,99%</td>
            </tr> 
            <tr>
                <td>LOJAS</td>
                <td>1,85%</td>
                <td>2,89%</td>
                <td>3,32%</td>
                <td>3,56%</td>
            </tr>         
            <tr>
                <td>DENTISTAS</td>
                <td>1,73%</td>
                <td>2,89%</td>
                <td>3,45%</td>
                <td>3,65%</td>
            </tr>
            <tr>
                <td>MEDICOS</td>
                <td>1,73%</td>
                <td>2,89%</td>
                <td>3,45%</td>
                <td>3,65%</td>
            </tr>
            <tr>
                <td>LABORATORIOS</td>
                <td>1,73%</td>
                <td>2,89%</td>
                <td>3,45%</td>
                <td>3,65%</td>
            </tr>
            <tr>
                <td>HOSPITAIS</td>
                <td>1,73%</td>
                <td>2,89%</td>
                <td>3,45%</td>
                <td>3,65%</td>
            </tr> 
          </table>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><strong>REDE - Taxas</strong></a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
<table class="table">
            <tr class="active">
                <td>Tipo do Estabelecimento</td>
                <td>Débito</td>
                <td>Crédito à vista</td>
                <td>Crédito parcelado 2 a 6</td>
                <td>Crédito Parcelado 7 a 12</td>
            </tr>
            <tr>
                <td>RESTAURANTE</td>
                <td>2%</td>
                <td>3,45%</td>
                <td>3,97%</td>
                <td>4,24%</td>
            </tr>
            <tr>
                <td>HOTEIS</td>
                <td>1,85%</td>
                <td>2,89%</td>
                <td>3,32%</td>
                <td>3,55%</td>
            </tr>
            <tr>
                <td>ALIMENTAÇÃO EMERCADOS ESPECIAIS</td>
                <td>1,76%</td>
                <td>3,24%</td>
                <td>3,73%</td>
                <td>3,99%</td>
            </tr>   
            <tr>
                <td>SUPERMERCADOS</td>
                <td>1,55%</td>
                <td>2,35%</td>
                <td>2,70%</td>
                <td>2,89%</td>
            </tr>
            <tr>
                <td>POSTO DE COMBUSTIVEL</td>
                <td>1,45%</td>
                <td>2,37%</td>
                <td>2,8%</td>
                <td>3,1%</td>
            </tr>
            <tr>
                <td>ACADEMIA</td>
                <td>2,09%</td>
                <td>3,06%</td>
                <td>3,52%</td>
                <td>3,76%</td>
            </tr> 
            <tr>
                <td>ESCOLAS PARTICULARES</td>
                <td>2,03%</td>
                <td>3,24%</td>
                <td>3,73%</td>
                <td>3,99%</td>
            </tr> 
            <tr>
                <td>LOJAS</td>
                <td>1,85%</td>
                <td>2,89%</td>
                <td>3,32%</td>
                <td>3,56%</td>
            </tr>
            <tr>
                <td>DENTISTAS</td>
                <td>2,68%</td>
                <td>3,69%</td>
                <td>4,13%</td>
                <td>4,38%</td>
            </tr>
            <tr>
                <td>MEDICOS</td>
                <td>2,68%</td>
                <td>3,68%</td>
                <td>4,38%</td>
                <td>4,63%</td>
            </tr>
            <tr>
                <td>LABORATORIOS</td>
                <td>3,70%</td>
                <td>2,70%</td>
                <td>4,40%</td>
                <td>4,55%</td>
            </tr>
            <tr>
                <td>HOSPITAIS</td>
                <td>2,66%</td>
                <td>3,66%</td>
                <td>4,36%</td>
                <td>4,61%</td>
            </tr> 
          </table>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><strong>CIELO - Taxas</strong></a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
<table class="table">
            <tr class="active">
                <td>Tipo do Estabelecimento</td>
                <td>Débito</td>
                <td>Crédito à vista</td>
                <td>Crédito parcelado 2 a 6</td>
                <td>Crédito Parcelado 7 a 12</td>
            </tr>
            <tr>
                <td>RESTAURANTE</td>
                <td>2%</td>
                <td>3,45%</td>
                <td>3,97%</td>
                <td>4,24%</td>
            </tr>
            <tr>
                <td>HOTEIS</td>
                <td>1,85%</td>
                <td>2,89%</td>
                <td>3,32%</td>
                <td>3,55%</td>
            </tr>
            <tr>
                <td>ALIMENTAÇÃO EMERCADOS ESPECIAIS</td>
                <td>1,76%</td>
                <td>3,24%</td>
                <td>3,73%</td>
                <td>3,99%</td>
            </tr>   
            <tr>
                <td>SUPERMERCADOS</td>
                <td>1,55%</td>
                <td>2,35%</td>
                <td>2,70%</td>
                <td>2,89%</td>
            </tr>
            <tr>
                <td>POSTO DE COMBUSTIVEL</td>
                <td>1,45%</td>
                <td>2,37%</td>
                <td>2,8%</td>
                <td>3,1%</td>
            </tr>
            <tr>
                <td>ACADEMIA</td>
                <td>2,09%</td>
                <td>3,06%</td>
                <td>3,52%</td>
                <td>3,76%</td>
            </tr> 
            <tr>
                <td>ESCOLAS PARTICULARES</td>
                <td>2,03%</td>
                <td>3,24%</td>
                <td>3,73%</td>
                <td>3,99%</td>
            </tr> 
            <tr>
                <td>LOJAS</td>
                <td>1,85%</td>
                <td>2,89%</td>
                <td>3,32%</td>
                <td>3,56%</td>
            </tr>
            <tr>
                <td>DENTISTAS</td>
                <td>2,70%</td>
                <td>3,70%</td>
                <td>4,45%</td>
                <td>4,70%</td>
            </tr>
            <tr>
                <td>MEDICOS</td>
                <td>2,70%</td>
                <td>3,70%</td>
                <td>4,45%</td>
                <td>4,70%</td>
            </tr>
            <tr>
                <td>LABORATORIOS</td>
                <td>2,70%</td>
                <td>3,70%</td>
                <td>4,45%</td>
                <td>4,70%</td>
            </tr>
            <tr>
                <td>HOSPITAIS</td>
                <td>2,70%</td>
                <td>3,70%</td>
                <td>4,45%</td>
                <td>4,70%</td>
            </tr> 
          </table>
      </div>
    </div>
  </div>
</div>  
  <?php //echo $form->field($model, 'tax')->textInput() ?>
  
  </div>

  <div class="col-md-4"></div>
</div>            

    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
        <?= Html::submitButton($model->isNewRecord ? 'Gravar' : 'Gravar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

    </div></div>

</div>