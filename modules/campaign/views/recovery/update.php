<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Location;
use kartik\money\MaskMoney;
use app\modules\campaign\models\Recovery;
use yii\widgets\Pjax;

$this->title = 'Campanha Recupere e Ganhe - #' . $model->id;
?>
<div class="recovery-form">

    <div class="row">
      <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
      <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;"><?php  echo $this->render('_menu'); ?></span></div>
    </div>
    <hr/>

<div class="panel panel-default">
  <div class="panel-body">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
      <div class="col-md-5">

    <div class="row">
      <div class="col-md-6">
        <?= $form->field($model, 'clientname')->textInput(['maxlength' => true,'readonly' => true, 'disabled' => true]) ?>
      </div>
      <div class="col-md-6">
        <?= $form->field($model, 'clientdoc')->textInput(['maxlength' => true,'readonly' => true, 'disabled' => true]) ?>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
      <?= $form->field($model, 'location_id')->dropDownList(ArrayHelper::map(Location::find()->where(['is_active' => 1])->orderBy("shortname ASC")->all(), 'id', 'fullname'),['readonly' => true, 'disabled' => true])  ?></div>
      <div class="col-md-4">
      <?= $form->field($model, 'typeofdebt')->dropDownList(Recovery::$Static_typeofdebt,['readonly' => true, 'disabled' => true]) ?>
      </div>
      <div class="col-md-4">
        <?php 
        echo $form->field($model, 'referencevalue')->widget(MaskMoney::classname(), ['readonly' => true, 'disabled' => true,
            'pluginOptions' => [
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
        </div>
    </div>

    <hr/>

    <div class="row">
      <div class="col-md-6">

    <?php 
    echo $form->field($model, 'value_traded')->widget(MaskMoney::classname(), [
        'pluginOptions' => [
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

    <?php 
    echo $form->field($model, 'value_input')->widget(MaskMoney::classname(), [
        'pluginOptions' => [
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

      </div>
      <div class="col-md-6">

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

    <?= $form->field($model, 'contracts')->textInput(['maxlength' => true]) ?>

      </div>
    </div>

      </div>
    <div class="col-md-7">

    <div class="panel panel-default">
    <div class="panel-heading"><strong>Legenda</strong></div>
    <div class="panel-body">
<?php
        //CALCULO DAS PROPOSTAS
        $diff = strtotime(date('Y-m-d')) - strtotime($model->expirationdate);
        $days = intval($diff / 60 / 60 / 24);

        // FATOR DE MULTIPLICAÇÃO BASEADO NO TIPO DE DEBITO
        if ($model->typeofdebt == 0) {
            $factor = 1;
        } elseif ($model->typeofdebt == 1) {
            $factor = 1.2;
        } elseif ($model->typeofdebt == 2) {
            $factor = 1.1;
        } elseif ($model->typeofdebt == 3) {
            $factor = 1.1;
        }

        // FORMULAS
        $formula1 = $model->referencevalue*(pow((1+0.018),($days/30)));
        $formula2 = $model->referencevalue*(pow((1+0.01),($days/30)));
        $formula3 = ($formula1 + $formula2) * 0.02;
        $proposal = $formula1+$formula2+$formula3;
        
        // PROPOSTA A
        $proposal_A = $proposal;
        $proposal_A = "R$ " . round((($proposal_A*$factor)), 2);
        // PROPOSTA B
        $proposal_B = $formula1;
        $proposal_B = "R$ " . round((($proposal_B*$factor)), 2);
        // PROPOSTA C
        $proposal_C = ($model->referencevalue*(pow((1+0.015),($days/30))));
        $proposal_C = "R$ " . round((($proposal_C*$factor)), 2);
        // PROPOSTA D
        $proposal_D = ($model->referencevalue*(pow((1+0.013),($days/30))));
        $proposal_D = "R$ " . round((($proposal_D*$factor)), 2);
        // PROPOSTA E
        $proposal_E = ($model->referencevalue*(pow((1+0.011),($days/30))));
        $proposal_E = "R$ " . round((($proposal_E*$factor)), 2);
        // PROPOSTA F
        $proposal_F = ($model->referencevalue*(pow((1+0.0067),($days/30))));
        $proposal_F = "R$ " . round((($proposal_F*$factor)), 2);
        // PROPOSTA G
        $proposal_G = $model->referencevalue*(pow((1+0.01),($days/30)));
        $proposal_G = "R$ " . round((($proposal_G*0.7)), 2);
        // PROPOSTA H
        $proposal_H = $model->referencevalue*(pow((1+0.01),($days/30)));
        $proposal_H = "R$ " . round((($proposal_H*0.5)), 2);

        // DISTRIBUIÇÃO COMISSÃO
        $comission_f = "R$ " . round(($model->commission*0.60), 2);
        $comission_e = "R$ " . round(($model->commission*0.40), 2);
    ?>
        <table class="table">
            <tr class="active">
                <td>PROPOSTA</td>
                <td>ALÇADA</td>
                <td>PISO NEGOCIAL</td>
                <td>COMISSÃO</td>
            </tr>
            <tr>
                <td><span class="label label-default">A</span> <small>atualização a juros de 1,8 % a.m com multa e mora</small></td>
                <td>Agência</td>
                <td><?=$proposal_A;?></td>
                <td><span class="label label-primary">5%</span></td>
            </tr>
            <tr>
                <td><span class="label label-default">B</span> <small>atualização a juros de 1,8 % a.m sem multa e sem mora</small></td>
                <td>Agência</td>
                <td><?=$proposal_B;?></td>
                <td><span class="label label-primary">3%</span></td>
            </tr>
            <tr>
                <td><span class="label label-default">C</span> <small>atualização a juros de 1,5 % a.m sem multa e sem mora</small></td>
                <td>Agência</td>
                <td><?=$proposal_C;?></td>
                <td><span class="label label-primary">2%</span></td>
            </tr>   
            <tr>
                <td><span class="label label-default">D</span> <small>atualização a juros de 1,3 % a.m sem multa e sem mora</small></td>
                <td>Supervisor</td>
                <td><?=$proposal_D;?></td>
                <td><span class="label label-success">1%</span></td>
            </tr>
            <tr>
                <td><span class="label label-default">E</span> <small>atualização a juros de 1,1 % a.m sem multa e sem mora</small></td>
                <td>Diretor</td>
                <td><?=$proposal_E;?></td>
                <td><span class="label label-success">0,50%</span></td>
            </tr>
            <tr>
                <td><span class="label label-default">F</span> <small>atualização a juros de 0,6677 % a.m sem multa e sem mora</small></td>
                <td>Diretor</td>
                <td><?=$proposal_F;?></td>
                <td><span class="label label-success">0,30%</span></td>
            </tr>
            <tr>
                <td><span class="label label-default">G</span> <small>atualização a juros de 1 % a.m (s/mora e s/multa) e desconto de <b>30%</b></small></td>
                <td>Diretor</td>
                <td><?=$proposal_G;?></td>
                <td><span class="label label-default">0%</span></td>
            </tr>
            <tr>
                <td><span class="label label-default">H</span> <small>atualização a juros de 1 % a.m (s/mora e s/multa) e desconto de <b>50%</b></small></td>
                <td>Diretor</td>
                <td><?=$proposal_H;?></td>
                <td><span class="label label-default">0%</span></td>
            </tr>
        </table>
        <p class="text-warning"><i class="fa fa-info-circle" aria-hidden="true"></i> Propostas A, B e C são aprovadas automaticamente!</p> 
        <p class="text-warning"><i class="fa fa-info-circle" aria-hidden="true"></i> Propostas G e H são para pagamento à vista</p>
        </div></div>

      </div>
    </div>

    <hr/>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Gravar' : '<span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Calcular e Gravar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    </div></div>
</div>