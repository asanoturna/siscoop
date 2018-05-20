<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\visits\models\Visits;
use app\modules\visits\models\Visitsfinality;
use app\modules\visits\models\Visitsstatus;
use yii\widgets\DetailView;


$this->title = 'Aprovação do Registro de Visita: #'  . $model->id;
?>
<div class="resourcerequest-manager">

    <div class="row">
      <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
      <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;"><?php  echo $this->render('_menu'); ?></span></div>
    </div>
    <hr/>

	<?php $form = ActiveForm::begin(); ?>

<div class="panel panel-default">
    <div class="panel-heading">Situação</div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-6">

<div class="row">
  <div class="col-md-6"><?php // $form->field($model, 'approved')->dropDownList(Visits::$Static_approved) ?>
    
    <?= $form->field($model, 'approved')->radioList([
        '1' => 'Sim', 
        '0' => 'Não',
        ], ['itemOptions' => ['class' =>'radio-inline','labelOptions'=>array('style'=>'padding:5px;')]])->label('Comissão Recebida') ?> 
  </div>
  <div class="col-md-6"><?= $form->field($model, 'visits_status_id')->dropDownList(ArrayHelper::map(Visitsstatus::find()->orderBy("name ASC")->all(), 'id', 'name'),['prompt'=>'--'])  ?> </div>
</div>

        <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Gravar' : 'Gravar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

          </div>
        </div>
      </div>
    </div>

    <?php ActiveForm::end(); ?>	


<div class="panel panel-default">
  <div class="panel-heading">Detalhes da visita</div>
  <div class="panel-body">

<?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [ 
                        'label' => 'Data',
                        'format' => 'raw',
                        'value' => date("d/m/Y",  strtotime($model->date))
                    ],
                    'company_person',
                    'responsible',
                    'contact',
                    'email:email',
                    'phone',
                    [ 
                        'label' => 'Valor',
                        'format' => 'raw',
                        'value' => "R$ ".$model->value,
                    ],   
                ],
            ]) ?>
          <?php echo "<strong>Parecer:</strong> " . $model->observation;?>   

  </div>
</div>    

</div>