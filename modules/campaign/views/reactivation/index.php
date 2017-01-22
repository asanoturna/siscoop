<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Location;
use app\models\User;
use app\modules\campaign\models\Reactivation;

$this->title = 'Reativação de Associados';
?>
<div class="capitalaction-index">

    <div class="row">
      <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
      <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;"><?php  echo $this->render('_menu'); ?></span></div>
    </div>
    <hr/>

    <div class="panel panel-default">
    <div class="panel-body">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class'=>'table table-striped table-hover'],
        'emptyText'    => '</br><p class="text-info">Nenhum registro encontrado!</p>',  
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '<span class="not-set">(não informado)</span>'],
        'rowOptions'   => function ($model, $index, $widget, $grid) {
            return [
                'id' => $model['id'], 
                'onclick' => 'location.href="'
                    . Yii::$app->urlManager->createUrl('campaign/reactivation/view') 
                    . '&id="+(this.id);',
                'style' => "cursor: pointer",
            ];
        }, 
        'columns' => [
            [
            'attribute' => 'id',
            'contentOptions'=>['class'=>'active','style'=>'width: 4%;text-align:center'],
            'headerOptions'=>['class'=>'active','style'=>'text-align:center;vertical-align: middle;'],
            ],
            [
            'attribute' => 'location_id',
            'format' => 'raw',
            'enableSorting' => true,
            'value' => function ($model) {                      
                    return $model->location->shortname;
                    },  
            'filter' => ArrayHelper::map(Location::find()->orderBy('shortname')->asArray()->all(), 'id', 'shortname'),
            'contentOptions'=>['class'=>'active','style'=>'width: 4%;text-align:center'],
            'headerOptions'=>['class'=>'active','style'=>'text-align:center;vertical-align: middle;'],
            ],
            [
            'attribute' => 'user_id',
            'format' => 'raw',
            'enableSorting' => true,
            'value' => function ($model) {                      
                return $model->user ? $model->user->username : null;
            },
            'filter' => ArrayHelper::map(User::find()->orderBy('username')->asArray()->all(), 'id', 'username'),
            'contentOptions'=>['class'=>'active','style'=>'width: 5%;text-align:center'],
            'headerOptions'=>['class'=>'active','style'=>'text-align:center;vertical-align: middle;'],
            ],
            [
            'attribute' => 'client_name',
            'encodeLabel' => false,
            'format' => 'raw',
            'label' => 'Associado / <br/>CPF',
            'value' => function ($model) {
                  return $model->client_name."<p class=\"text-muted\">/ ".$model->client_doc."</p>";
            },
            'contentOptions'=>['class'=>'active','style'=>'width: 18%;text-align:left'],
            'headerOptions'=>['class'=>'active','style'=>'text-align:center;vertical-align: middle;'],
            ],
            [
            'attribute' => 'client_risk',
            'contentOptions'=>['class'=>'active','style'=>'width: 4%;text-align:center'],
            'headerOptions'=>['class'=>'active','style'=>'text-align:center;vertical-align: middle;'],
            ],
            [
            'attribute' => 'client_last_renovated_register',
            'encodeLabel' => false,
            'label' => 'Ultima<br/>Renovação<br/>Cadastral',
            'enableSorting' => true,
            'value' => function ($model) {                      
                  return $model->client_last_renovated_register == '9999-12-31' ? null : $model->client_last_renovated_register;
            },
            'contentOptions'=>['class'=>'active','style'=>'width: 5%;text-align:center'],
            'headerOptions'=>['class'=>'active','style'=>'text-align:center;vertical-align: middle;'],
            'format' => ['date', 'php:d/m/Y'],
            ],
            [
            'attribute' => 'client_income',
            'contentOptions'=>['class'=>'active','style'=>'width: 5%;text-align:center'],
            'headerOptions'=>['class'=>'active','style'=>'text-align:center;vertical-align: middle;'],
            ],
            [
            'attribute' => 'restrictions_serasa',
            'encodeLabel' => false,
            'label' => 'Restrição<br/>Serasa',
            'value' => function($data) {
              return $data->getSerasa();
            },
            'filter' => Reactivation::$Static_serasa,
            'contentOptions'=>['class'=>'info','style'=>'width: 5%;text-align:center'],
            'headerOptions'=>['class'=>'info','style'=>'text-align:center;vertical-align: middle;'],
            ],
            [
            'attribute' => 'restrictions_ccf',
            'encodeLabel' => false,
            'label' => 'Restrição<br/>CCF',
            'value' => function($data) {
              return $data->getCcf();
            },
            'filter' => Reactivation::$Static_ccf,
            'contentOptions'=>['class'=>'info','style'=>'width: 5%;text-align:center'],
            'headerOptions'=>['class'=>'info','style'=>'text-align:center;vertical-align: middle;'],
            ],
            [
            'attribute' => 'restrictions_scr',
            'encodeLabel' => false,
            'label' => 'Restrição<br/>SCR',
            'value' => function($data) {
              return $data->getScr();
            },
            'filter' => Reactivation::$Static_scr,
            'contentOptions'=>['class'=>'info','style'=>'width: 5%;text-align:center'],
            'headerOptions'=>['class'=>'info','style'=>'text-align:center;vertical-align: middle;'],
            ],
            [
            'attribute' => 'agent_visit_number',
            'encodeLabel' => false,
            'label' => 'Número<br/>Relatório<br/>Visita',
            'contentOptions'=>['class'=>'info','style'=>'width: 5%;text-align:center'],
            'headerOptions'=>['class'=>'info','style'=>'text-align:center;vertical-align: middle;'],
            ],
            [
            'attribute' => 'agent_registration_renewal',
            'encodeLabel' => false,
            'label' => 'Feita<br/>renovação<br/>cadastro',
            'value' => function ($model) {                      
                  return $model->agent_registration_renewal == '9999-12-31' ? null : $model->agent_registration_renewal;
            },
            'contentOptions'=>['class'=>'info','style'=>'width: 5%;text-align:center'],
            'headerOptions'=>['class'=>'info','style'=>'text-align:center;vertical-align: middle;'],
            'format' => ['date', 'php:d/m/Y'],
            ],
            [
            'attribute' => 'agent_overdraft_value',
            'encodeLabel' => false,
            'label' => 'Implantado<br/>Cheque<br/>Especial',
            'contentOptions'=>['class'=>'info','style'=>'width: 5%;text-align:center'],
            'headerOptions'=>['class'=>'info','style'=>'text-align:center;vertical-align: middle;'],
            ],
            [
            'attribute' => 'agent_card_value',
            'encodeLabel' => false,
            'label' => 'Implantado<br/>C. de Crédito<br/>de R$',
            'contentOptions'=>['class'=>'info','style'=>'width: 5%;text-align:center'],
            'headerOptions'=>['class'=>'info','style'=>'text-align:center;vertical-align: middle;'],
            ],
            [
            'attribute' => 'supervisor_package_rate',
            'encodeLabel' => false,
            'label' => 'Implantado<br/>P. Tarifário<br/>Reativação',
            'contentOptions'=>['class'=>'warning','style'=>'width: 5%;text-align:center'],
            'headerOptions'=>['class'=>'warning','style'=>'text-align:center;vertical-align: middle;'],
            'format' => ['date', 'php:d/m/Y'],
            ],
            [
            'attribute' => 'manager_inactive_meeting',
            'encodeLabel' => false,
            'label' => 'Participou<br/>Reunião Mensal<br/>com Inativos',
            'contentOptions'=>['class'=>'success','style'=>'width: 5%;text-align:center'],
            'headerOptions'=>['class'=>'success','style'=>'text-align:center;vertical-align: middle;'],
            'format' => ['date', 'php:d/m/Y'],
            ],
            [
            'attribute' => 'manager_approval',
            'encodeLabel' => false,
            'label' => 'Aprovação<br/>Trabalho junto<br/>ao associado',
            'value' => function($data) {
              return $data->getManagerapproval();
            },
            'filter' => Reactivation::$Static_managerapproval,
            'contentOptions'=>['class'=>'success','style'=>'width: 5%;text-align:center'],
            'headerOptions'=>['class'=>'success','style'=>'text-align:center;vertical-align: middle;'],
            ],
            [
            'attribute' => 'manager_final_opinion',
            'encodeLabel' => false,
            'label' => 'Parecer<br/>Final',
            'value' => function($data) {
              return $data->getManagerfinalopinion();
            },
            'filter' => Reactivation::$Static_managerfinalopinion,
            'contentOptions'=>['class'=>'success','style'=>'width: 5%;text-align:center'],
            'headerOptions'=>['class'=>'success','style'=>'text-align:center;vertical-align: middle;'],
            ],
            // [
            // 'class' => 'yii\grid\ActionColumn',
            // 'contentOptions'=>['style'=>'width: 10%;text-align:center'],
            // ],
        ],
    ]); ?>
    </div></div>

</div>