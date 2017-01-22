<?php
use yii\helpers\Html;
use kartik\sidenav\SideNav;
use yii\data\SqlDataProvider;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\helpers\ArrayHelper;

$this->title = 'Telefones e Ramais';
?>
<div class="site-about">

    <div class="row">
    <div class="col-sm-2">
    <?php  echo $this->render('_menu'); ?>
    </div>

    <div class="col-sm-10">
    <h1><span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span> <?= Html::encode($this->title) ?></h1>
    <hr/>

<div class="alert alert-info fade in">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i> Prezado colaborador, mantenha suas informações sempre atualizadas na intranet para que seja fácil entrar em contato. <?= Html::a('Clique aqui para atualizar', ['/user/changeprofile'], ['class'=>'btn btn-link']) ?>
</div>
    
    <div class="panel panel-default">
    <div class="panel-heading"><strong>Agências</strong></div>
      <div class="panel-body">
    <?php
    $dataProviderUsers = new SqlDataProvider([
        'sql' => "SELECT
            fullname, 
            phone,
            voip
        FROM location
        WHERE is_active = 1
        ORDER BY fullname",
            'key'  => 'fullname',
    ]);
    ?>   
    <?= GridView::widget([
      'dataProvider' => $dataProviderUsers,
      'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '<span class="not-set">(não informado)</span>'],
      'emptyText'    => '</br><p class="text-danger">Nenhuma informação encontrada</p>',
      'summary'      =>  '',
      //'showHeader'   => false,        
      'tableOptions' => ['class'=>'table table-hover'],
      'columns' => [                                    
            [
                'attribute' => 'fullname',
                'format' => 'raw',
                'label' => '',
                'value' => function ($data) {                      
                    return $data["fullname"];
                },
                'contentOptions'=>['style'=>'width: 50%;text-align:left;vertical-align: middle;text-transform: uppercase'],
            ],  
            [
                'attribute' => 'phone',
                'format' => 'raw',
                'label' => 'Telefone',
                'value' => function ($data) {                      
                    return $data["phone"];
                },
                'contentOptions'=>['style'=>'width: 25%;text-align:left;vertical-align: middle;'],
            ],      
            [
                'attribute' => 'voip',
                'format' => 'raw',
                'label' => 'Voip',
                'value' => function ($data) {                      
                    return $data["voip"];
                },
                'contentOptions'=>['style'=>'width: 25%;text-align:left;vertical-align: middle;'],
            ],
            // [
            //     'attribute' => 'voip',
            //     'format'    => 'raw',
            //     'value'     => function (ModelClass $model) {
            //         if ($model->some_attribute != null) {
            //             return $model->some_attribute; 
            //       //or: return Html::encode($model->some_attribute)
            //         } else {
            //             return '';
            //         }
            //     },
            // ],                                                                             
        ],
    ]); ?>   
    </div>
    </div>

    <div class="panel panel-default">
    <div class="panel-heading"><strong>Sede</strong></div>
      <div class="panel-body">
    <?php
    $dataProviderUsers = new SqlDataProvider([
        'sql' => "SELECT
                    fullname, 
                    phone,
                    celphone
                FROM user
                WHERE status = 1 AND location_id = 1 OR location_id = 20
                ORDER BY fullname",
        'key'  => 'fullname',
        'totalCount' => 300,
        'pagination' => [
            'pageSize' => 300,
        ],            
    ]);
    ?>   
    <?= GridView::widget([
      'dataProvider' => $dataProviderUsers,
      'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '<span class="not-set">(não informado)</span>'],
      'emptyText'    => '</br><p class="text-danger">Nenhuma informação encontrada</p>',
      'summary'      =>  '',
      //'showHeader'   => false,        
      'tableOptions' => ['class'=>'table table-hover'],
      'columns' => [                                    
            [
                'attribute' => 'fullname',
                'format' => 'raw',
                'label' => '',
                'value' => function ($data) {                      
                    return $data["fullname"];
                },
                'contentOptions'=>['style'=>'width: 50%;text-align:left;vertical-align: middle;text-transform: uppercase'],
            ],  
            [
                'attribute' => 'phone',
                'format' => 'raw',
                'label' => 'Telefone / Ramal',
                'value' => function ($data) {                      
                    return $data["phone"];
                },
                'contentOptions'=>['style'=>'width: 25%;text-align:left;vertical-align: middle;'],
            ],  
            [
                'attribute' => 'celphone',
                'format' => 'raw',
                'label' => 'Celular',
                'value' => function ($data) {                      
                    return $data["celphone"];
                },
                'contentOptions'=>['style'=>'width: 25%;text-align:left;vertical-align: middle;'],
            ],                                                                       
        ],
    ]); ?>   
    </div>
    </div>    

    </div>
    </div>
</div>