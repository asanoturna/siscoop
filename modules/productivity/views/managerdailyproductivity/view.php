<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


$this->title = 'Gestão Produtividade Diária';
?>
<div class="managerdailyproductivity-view">

    <div class="row">
      <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
      <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;"><?php  echo $this->render('_menu'); ?></span></div>
    </div>
    <hr/>
    <p class="pull-right">
        <?= Html::a('Alterar', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Confirmar exclusão?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',  
            'companys_revenue',
            [ 
                'label' => 'Situação',
                'format' => 'raw',
                'value' => $model->dailyProductivityStatus->name,
            ],                  
            [ 
                'label' => 'Data',
                'format' => 'raw',
                'value' => date("d/m/Y",  strtotime($model->date))
            ],           
            'location.fullname',  
            'product.name',                          
            'value',
            'commission_percent',
            'person.name', 
            'buyer_document',             
            'buyer_name',                     
            [ 
                'label' => 'Indicador',
                'format' => 'raw',
                'value' => $model->seller->username,
            ],             
            [ 
                'label' => 'Angariador',
                'format' => 'raw',
                'value' => $model->operator->username,
            ],     
            [ 
                'label' => 'Usuário',
                'format' => 'raw',
                'value' => $model->user->username,
            ],                        
        ],
    ]) ?>
    <hr/>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [              
            [ 
                'label' => 'Data de inclusão no sistema',
                'format' => 'raw',
                'value' => date("d/m/Y",  strtotime($model->created))
            ],           
            [ 
                'label' => 'Última alteração realizada',
                'format' => 'raw',
                'value' => date("d/m/Y",  strtotime($model->updated))
            ],    
            [ 
                'attribute' => 'is_commission_received',
                'label' => 'Comissão recebida?',  
                'format' => 'raw',
                'value' => $model->is_commission_received == 1 ? '<b style="color:green">Sim</b>' : '<b style="color:gray">Não</b>',
            ],                                     
        ],
    ]) ?>     

</div>
