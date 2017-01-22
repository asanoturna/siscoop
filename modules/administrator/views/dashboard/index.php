<?php

use yii\helpers\Html;
use yii\data\SqlDataProvider;
use yii\grid\GridView;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\SeriesDataHelper;
use app\modules\administrator\models\Department;
use app\modules\administrator\models\Location;
use app\modules\administrator\models\Useradmin;

$this->title = 'Administração';
?>
<div class="site-administration">

    <div class="row">
    <div class="col-sm-2">
    <?php  echo $this->render('_menuadmin'); ?>
    </div>

    <div class="col-sm-10">
    <h1><?= Html::encode($this->title) ?></h1>
    <hr/>

    <div class="row">
      <div class="col-md-5">
        <div class="panel panel-default">
          <div class="panel-heading">Estatísticas Gerais</div>
          <div class="panel-body">

<ul class="list-group">
    <li class="list-group-item">
    <span class="badge"><?=Useradmin::find()->where(['status'=>1])->count()?></span>Usuários Ativos
    </li>
    <li class="list-group-item">
    <span class="badge"><?=Useradmin::find()->where(['status'=>0])->count()?></span>Usuários Inativos
    </li>
    <li class="list-group-item">
    <span class="badge"><?=Location::find()->where(['is_active'=>1])->count()?></span>Unidades
    </li>
    <li class="list-group-item">
    <span class="badge"><?=Department::find()->where(['is_active'=>1])->count()?></span>Departamentos
    </li>        
</ul>              
            <?php
            /*
                    echo Highcharts::widget([
                            'options' => [
                                'chart' => ['height' => 200],
                                'credits' => ['enabled' => false],
                                'title' => [
                                    'text' => '',
                                ],
                                'colors'=> ['#00A295','#27cdd9'],
                                'xAxis' => [
                                    'categories' => $m,
                                ],
                                'yAxis' => [
                                    'min' => 0,
                                    'title' => '',
                                ],                        
                                'series' => [
                                    [
                                        'type' => 'spline',
                                        'name' => 'Quantidade de Acesso',
                                        'data' => $q,
                                    ],                          
                                ],
                            ]
                        ]);
                    */
            ?>
          </div>
        </div>      
      </div>
      <div class="col-md-5">
        <div class="panel panel-default">
          <div class="panel-heading">Novos Usuários</div>
          <div class="panel-body">
            <?php
            $dataProviderRecentUsers = new SqlDataProvider([
                'sql' => "SELECT
                        fullname,
                        id
                        FROM `user`
                        ORDER BY id desc",
                'totalCount' => 5,
                'pagination' => [
                    'pageSize' => 5,
                ],
            ]);

            ?>  
            <?= GridView::widget([
                  'dataProvider' => $dataProviderRecentUsers,
                  'emptyText'    => '</br><p class="text-danger">Nenhuma informação encontrada</p>',
                  'summary'      =>  '',
                  'showHeader'   => false,        
                  'tableOptions' => ['class'=>'table'],
                  'columns' => [                                
                        [
                            'format' => 'raw',
                            'header' => 'Usuário',
                            'value' => function ($data) {                      
                                return $data["fullname"];
                            },
                            'contentOptions'=>['style'=>'text-align:left;vertical-align: middle;text-transform: uppercase'],
                        ],  
                        // [
                        //     'format' => 'raw',
                        //     'header' => 'Contato',
                        //     'value' => function ($data) {                      
                        //         return $data["created_at"];
                        //     },
                        //     'format' => ['date', 'php:d/m/Y'],
                        // ],                                                           
                    ],
            ]); ?>
          </div>
        </div>
      </div>
    </div>

    </div>
    </div>

</div>