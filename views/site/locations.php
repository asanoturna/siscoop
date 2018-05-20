<?php
use yii\helpers\Html;
use kartik\sidenav\SideNav;
use yii\data\SqlDataProvider;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\helpers\ArrayHelper;

$this->title = 'Agências';
?>
<div class="site-about">

    <div class="row">
    <div class="col-sm-2">
    <?php  echo $this->render('_menu'); ?>
    </div>

    <div class="col-sm-10">
    <h1><i class="fa fa-university" aria-hidden="true"></i> <?= Html::encode($this->title) ?></h1>
    <hr/>
    
    <div class="panel panel-default">
      <div class="panel-body">
    <?php
    $dataProviderUsers = new SqlDataProvider([
        'sql' => "SELECT
        			id,
					fullname, 
					address,
					email,
					phone,
                    zipcode,
                    num_cnpj
				FROM location
				WHERE is_active = 1
				ORDER BY fullname",
        'key'  => 'id',
    ]);
    ?>   
    <?= GridView::widget([
      'dataProvider' => $dataProviderUsers,
      'emptyText'    => '</br><p class="text-danger">Nenhuma informação encontrada</p>',
      'summary'      =>  '',
      'showHeader'   => false,        
      'tableOptions' => ['class'=>'table '],
      'columns' => [                                    
            [
                'attribute' => 'fullname',
                'format' => 'raw',
                'header' => '',
                'value' => function ($data) {                      
                    return '<strong>'.$data["fullname"].
                           '</strong></br><i class="fa fa-building" aria-hidden="true"></i> Endereço: '.$data["address"]. 
                           ' CEP: '.$data["zipcode"]."</br>".
                           '<i class="fa fa-book" aria-hidden="true"></i> CNPJ: ' .$data["num_cnpj"];
                },
                'contentOptions'=>['style'=>'width: 50%;text-align:left;vertical-align: middle;'],
            ],  
            [
                'attribute' => 'email',
                'format' => 'raw',
                'header' => '',
                'value' => function ($data) {                      
                    return '<i class="fa fa-envelope" aria-hidden="true"></i> '.Html::mailto($data["email"], $data["email"])."</br>".
                    '<i class="fa fa-phone" aria-hidden="true"></i> '.$data["phone"];
                },
                'contentOptions'=>['style'=>'width: 50%;text-align:left;vertical-align: middle;'],
            ],                                                           
        ],
    ]); ?>   
    </div>
    </div>

    </div>
    </div>
</div>
