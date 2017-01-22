<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = "Solicitação de Recurso #" . $model->id;
?>
<div class="resourcerequest-view">

    <div class="row">
      <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
      <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;"><?php  echo $this->render('_menu'); ?></span></div>
    </div>
    <hr/>

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Gerenciar', ['manager', 'id' => $model->id], ['class' => 'btn btn-warning hidden-print', 'disabled' => !Yii::$app->user->identity->role_id == 2]) ?>
        <?= Html::a('<span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir', '#', ['onclick'=>"myFunction()",'class' => 'btn btn-success hidden-print']) ?>
    </p>

    <div class="row">
    <div class="col-md-9">    
    <?php foreach (Yii::$app->session->getAllFlashes() as $key=>$message):?>
        <?php $alertClass = substr($key,strpos($key,'-')+1); ?>
        <div class="alert alert-dismissible alert-<?=$alertClass?>" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p><?=$message?></p>
        </div>
    <?php endforeach ?>
    </div></div>

    <div class="row">
    <div class="col-md-6">

<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [ 
                'attribute' => 'created',
                'format' => 'raw',
                'value' => date("d/m/Y",  strtotime($model->created))
            ],            
            [ 
                'label' => 'Usuário',
                'format' => 'raw',
                'value' => $model->user->username,
            ],              
            'client_name',
            'client_phone',
            [ 
                'attribute' => 'value_request',
                'format'=>['decimal',2]
            ],             
            [ 
                'attribute' => 'value_capital',
                'format'=>['decimal',2]
            ],                       
            [ 
                'attribute' => 'expiration_register',
                'format' => 'raw',
                'value' => date("d/m/Y",  strtotime($model->expiration_register))
            ],             
            [ 
                'attribute' => 'lastupdate_register',
                'format' => 'raw',
                'value' => date("d/m/Y",  strtotime($model->lastupdate_register))
            ],
        ],
    ]) ?>

      </div>
      <div class="col-md-6">     

<?= DetailView::widget([
        'model' => $model,
        'attributes' => [                        
            'location.fullname',
            [ 
                'attribute' => 'requested_month',  
                'format' => 'raw',
                'value' => $model->RequestedMonthValue,
            ],             
            [ 
                'attribute' => 'requested_year',  
                'format' => 'raw',
                'value' => $model->RequestedYearValue,
            ],              
            [ 
                'attribute' => 'resource_type',  
                'format' => 'raw',
                'value' => $model->ResourceType,
            ], 
            [ 
                'attribute' => 'resource_purposes',  
                'format' => 'raw',
                'value' => $model->ResourcePurposes,
            ],             
            [ 
                'attribute' => 'has_transfer',  
                'format' => 'raw',
                'value' => $model->has_transfer == 1 ? 'SIM' : 'NÃO',
            ],               
            [ 
                'attribute' => 'receive_credit',  
                'format' => 'raw',
                'value' => $model->receive_credit == 1 ? 'SIM' : 'NÃO',
            ],               
            [ 
                'attribute' => 'add_insurance',  
                'format' => 'raw',
                'value' => $model->add_insurance == 1 ? 'SIM' : 'NÃO',
            ],                                   
        ],
    ]) ?>

      </div>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [         
            'observation:ntext',
        ],
    ]) ?>      

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [ 
            'label' => 'Situação',
            'format' => 'raw',
            'value' => "<strong style=\"color:".$model->resourceStatus->hexcolor."\">" . $model->resourceStatus->name . "</strong>",
            ],   
            [ 
            'attribute' => 'manager_id',
            'format' => 'raw',
                            'value' => $model->manager ? $model->manager->username : '<span class="text-danger"><em>Nenhum</em></span>',
            ],                                   
            'observation_status:ntext',
        ],
    ]) ?>    

<script>
function myFunction() {
    window.print();
}
</script>
</div>