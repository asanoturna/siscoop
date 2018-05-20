<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="reportbase-form">

	<div class="col-xs-3">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?php echo $form->field($model, 'spreadsheetname')->dropDownList([
            'PA_00' => 'PA_00',
            'PA_02' => 'PA_02',
            'PA_03' => 'PA_03',
            'PA_04' => 'PA_04',            
            'PA_05' => 'PA_05',
            'PA_06' => 'PA_06',
            'PA_07' => 'PA_07',
            'PA_08' => 'PA_08',
            'PA_09' => 'PA_09',
            'PA_10' => 'PA_10',            
            'PA_11' => 'PA_11',
            'PA_13' => 'PA_13',
            'PA_14' => 'PA_14',
            'PA_15' => 'PA_15',
            'PA_16' => 'PA_16',
            'PA_17' => 'PA_17',            
            'PA_18' => 'PA_18',
            'PA_19' => 'PA_19', 
            'PA_20' => 'PA_20', 
			'Consolidado' => 'Consolidado',                                                                       
            //'PA_20' => 'PA_20',             
    ])->label('Selecione o nome do arquivo'); ?>

    <?= $form->field($model, 'file')->fileInput()->hint('Apenas arquivos com extensão .ZIP')->label('Selecione a Planilha') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Gravar' : '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Alterar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    </div>

</div>
