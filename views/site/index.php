<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Location;
use app\models\Product;
use app\models\Modality;
use app\models\User;
use yii\data\SqlDataProvider;
use yii\bootstrap\Progress;

$thisyear  = date('Y');
$thismonth = date('m');   

$this->title = Yii::$app->params['appname'];
?>
<div class="site-index">

    <div class="row">
    
    <div class="col-sm-2">

    <?php  echo $this->render('_menu'); ?>

    </div>
    <div class="col-sm-10">

    <div class="row"><!-- LINE 1 -->
      <div class="col-md-8">

<div class="panel panel-default">
      <div class="panel-heading"><b>Top 3 Produtividade do Mês</b></div>
      <div class="panel-body" style="height: 300px;max-height: 10;">
        <?php
        $dataProviderValor = new SqlDataProvider([
            'sql' => "SELECT user.id, avatar, username as seller, sum(companys_revenue) as total
                    FROM daily_productivity
                    INNER JOIN `user` ON daily_productivity.seller_id = `user`.id
                    WHERE daily_productivity_status_id = 2 AND MONTH(date) = $thismonth AND YEAR(date) = $thisyear
                    GROUP BY seller_id
                    ORDER BY sum(companys_revenue) DESC",
            'totalCount' => 3,
            'sort' =>false,
            'key'  => 'seller',
            'pagination' => [
                'pageSize' => 3,
            ],
        ]);
        $dataProviderQtde = new SqlDataProvider([
            'sql' => "SELECT user.id, avatar, username as seller, sum(quantity) as total
                    FROM daily_productivity
                    INNER JOIN `user` ON daily_productivity.seller_id = `user`.id
                    WHERE daily_productivity_status_id = 2 AND MONTH(date) = $thismonth AND YEAR(date) = $thisyear
                    GROUP BY seller_id
                    ORDER BY sum(quantity) DESC",
            'totalCount' => 3,
            'sort' =>false,
            'key'  => 'seller',
            'pagination' => [
                'pageSize' => 3,
            ],
        ]);        
        ?>
        <div class="col-md-6">
        <!-- ranking por valor -->
        <h4>Ranking de Vendas por Receita</h4>
        <?= GridView::widget([
          'dataProvider' => $dataProviderValor,
          'emptyText'    => '</br><p class="text-danger">Nenhuma informação encontrada</p>',
          'summary'      =>  '',
          'showHeader'   => false,        
          'tableOptions' => ['class'=>'table table-striped table-hover '],
          'columns' => [   
                [
                'format' => 'raw',
                'header' => 'Rank',
                'value' => function($model, $key, $index, $column) {
                    if ($index == 0) {
                       return Html::img(Yii::$app->request->BaseUrl.'/images/medal-gold-icon.png');
                    }elseif ($index == 1) {
                       return Html::img(Yii::$app->request->BaseUrl.'/images/medal-silver-icon.png'); 
                    }elseif ($index == 2) {
                       return Html::img(Yii::$app->request->BaseUrl.'/images/medal-bronze-icon.png'); 
                    }else {
                       return Html::img(Yii::$app->request->BaseUrl.'/images/no-medal-icon.png'); 
                    }
                }],                  
                [
                    'attribute' => 'avatar',
                    'format' => 'html',
                    'value' => function ($data) {
                        return Html::img(Yii::$app->params['usersAvatars'].$data["avatar"],
                            ['width' => '50px', 'class' => 'img-rounded img-thumbnail img-responsive']);
                    },
                    'contentOptions'=>['style'=>'width: 20%;text-align:center;'],                    
                ],                                 
                [
                    'attribute' => 'seller',
                    'format' => 'raw',
                    'value' => function ($data) { 
                        return Html::a( $data["seller"], ['productivity/dailyproductivity/performance_user', 'seller_id' => $data["id"]], ['title' => 'Clique para ver o desempenho']);
                    },
                    'contentOptions'=>['style'=>'width: 50%;text-align:left;vertical-align: middle;text-transform: uppercase'],
                ],  
                [
                    'attribute' => 'total',
                    'format' => 'raw',
                    'value' => function ($data) {                      
                        return "<b>R$ ".$data["total"]."</b>";
                    },
                    'contentOptions'=>['style'=>'width: 30%;text-align:right;vertical-align: middle;font-size: 15px'],
                ],                        

            ],
        ]); ?>
        </div>
        <div class="col-md-6">
        <!-- ranking por quantidade -->
        <h4>Ranking de Vendas por Quantidade</h4>
        <?= GridView::widget([
          'dataProvider' => $dataProviderQtde,
          'emptyText'    => '</br><p class="text-danger">Nenhuma informação encontrada</p>',
          'summary'      =>  '',
          'showHeader'   => false,        
          'tableOptions' => ['class'=>'table table-striped table-hover '],
          'columns' => [   
                [
                'format' => 'raw',
                'header' => 'Rank',
                'value' => function($model, $key, $index, $column) {
                    if ($index == 0) {
                       return Html::img(Yii::$app->request->BaseUrl.'/images/medal-gold-icon.png');
                    }elseif ($index == 1) {
                       return Html::img(Yii::$app->request->BaseUrl.'/images/medal-silver-icon.png'); 
                    }elseif ($index == 2) {
                       return Html::img(Yii::$app->request->BaseUrl.'/images/medal-bronze-icon.png'); 
                    }else {
                       return Html::img(Yii::$app->request->BaseUrl.'/images/no-medal-icon.png'); 
                    }
                }],                 
                [
                    'attribute' => 'avatar',
                    'format' => 'html',
                    'value' => function ($data) {
                        return Html::img(Yii::$app->params['usersAvatars'].$data["avatar"],
                            ['width' => '50px', 'class' => 'img-rounded img-thumbnail img-responsive']);
                    },
                    'contentOptions'=>['style'=>'width: 20%;text-align:center'],                    
                ],                                 
                [
                    'attribute' => 'seller',
                    'format' => 'raw',
                    'value' => function ($data) { 
                        return Html::a( $data["seller"], ['productivity/dailyproductivity/performance_user', 'seller_id' => $data["id"]], ['title' => 'Clique para ver o desempenho']);
                    },
                    'contentOptions'=>['style'=>'width: 50%;text-align:left;vertical-align: middle;text-transform: uppercase'],
                ],   
                [
                    'attribute' => 'total',
                    'format' => 'raw',
                    'value' => function ($data) {                      
                        return "<b>".$data["total"]."</b>";
                    },
                    'contentOptions'=>['style'=>'width: 20%;text-align:right;vertical-align: middle;font-size: 15px'],
                ],                        

            ],
        ]); ?>
        </div>
      </div>
    </div>

      </div>
      <div class="col-md-4">

        <div class="panel panel-default">
          <div class="panel-heading"><b>Aniversariantes da Semana</b>
            <!--             
            <button class="btn btn-default btn-xs pull-right">Mensal</button>
            <div class="clearfix"></div>
            -->
          </div>
          <div class="panel-body" style="height: 300px;max-height: 10;overflow-y: scroll;">

        <?php
        $dataProviderBirthdate = new SqlDataProvider([
            'sql' => "SELECT 
                    avatar, user.fullname as fullname, day(birthdate) as dia,
                    day(birthdate) as dia
                    FROM `user`
                    WHERE WEEKOFYEAR( CONCAT( YEAR(NOW()),'-',MONTH(birthdate),'-',DAY(birthdate) ) ) = WEEKOFYEAR( NOW() )
                    ORDER BY day(birthdate)",
            'totalCount' => 300,
            'key'  => 'fullname',
            'pagination' => [
                'pageSize' => 300,
            ],
        ]);
        ?> 
        <?= GridView::widget([
                  'dataProvider' => $dataProviderBirthdate,
                  'emptyText'    => '</br><p class="text-danger">Nenhum aniversariante esta semana!</p>',
                  'summary'      =>  '',
                  'showHeader'   => true,        
                  'tableOptions' => ['class'=>'table'],
                  'columns' => [     
                        [
                            'attribute' => 'avatar',
                            'label' => false,
                            'format' => 'raw',
                            'value' => function ($data) {
                                return Html::img(Yii::$app->params['usersAvatars']."thumb/".$data["avatar"],
                                    ['width' => '40px', 'class' => 'img-rounded img-thumbnail img-responsive']);
                            },
                            'contentOptions'=>['style'=>'width: 10%;text-align:middle'],                    
                        ],                                 
                        [
                            'attribute' => 'fullname',
                            'format' => 'raw',
                            'header' => 'Colaborador',
                            'value' => function ($data) {                      
                                return "<h5>".$data["fullname"]."</h5><p>";
                            },
                            'contentOptions'=>['style'=>'width: 60%;text-align:left;vertical-align: middle;text-transform: uppercase'],
                        ],
                        [
                            'attribute' => 'dia',
                            'format' => 'raw',
                            'header' => 'Dia',
                            'value' => function ($data) {                      
                                return $data["dia"] <> date('d') ? "<h5>".$data["dia"]."</h5>" : "<h5 class=\"label label-default\">Hoje</h5>";
                            },
                            'headerOptions' => ['class' => 'text-center', 'style' => 'text-align:center;vertical-align: middle;'],
                            'contentOptions'=>['style'=>'width: 30%;text-align:center;vertical-align: middle;'],
                        ],                                                                             
                    ],
                ]); ?>        

          </div>
        </div>

      </div>
    </div>

    <div class="row"><!-- LINE 2 -->
      <div class="col-md-8">

<div class="panel panel-default">
          <div class="panel-heading"><b>Ranking da Campanha Interna 2016 Sicoobcard</b>
          <?= Html::a('Ver Ranking Completo', ['campaign/sicoobcard/performance'], ['class' => 'btn btn-default btn-xs pull-right']) ?>
            <div class="clearfix"></div>
            
          </div>
          <div class="panel-body" style="height: 300px;max-height: 10;overflow-y: scroll;">

    <?php
    $dataProviderCampaign1 = new SqlDataProvider([
        'sql' => "SELECT user.id, avatar, username as fullname, 
                COUNT(if(campaign_sicoobcard.status = 1, campaign_sicoobcard.id, NULL)) as  confirmed
                FROM campaign_sicoobcard
                INNER JOIN `user` ON campaign_sicoobcard.user_id = `user`.id
                GROUP BY user_id
                ORDER BY confirmed DESC",
        'key'  => 'fullname',
        'totalCount' => 3,
        'pagination' => [
            'pageSize' => 3,
        ],         
    ]);

    $dataProviderCampaign2 = new SqlDataProvider([
        'sql' => "SELECT user.id, avatar, username as fullname, 
              COUNT(if(daily_productivity_status_id = 2 AND daily_productivity.product_id = 503, daily_productivity.id, NULL)) as  confirmed
              FROM daily_productivity
              INNER JOIN `user` ON daily_productivity.seller_id = `user`.id
              GROUP BY seller_id
              ORDER BY confirmed DESC",
        'key'  => 'fullname',
        'totalCount' => 3,
        'pagination' => [
            'pageSize' => 3,
        ],         
    ]);

    ?>
    <div class="col-md-6">
    <h4>Sicoobcard Todo Dia</h4>
    <?= GridView::widget([
      'dataProvider' => $dataProviderCampaign1,
      'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '<span class="not-set">(não informado)</span>'],
      'emptyText'    => '</br><p class="text-danger">Nenhuma informação encontrada</p>',
      'summary'      =>  '',
      'showHeader'   => false,        
      'tableOptions' => ['class'=>'table table-hover'],
      'columns' => [          
            [
                'attribute' => 'avatar',
                'label' => false,
                'format' => 'html',
                'value' => function ($data) {
                    return Html::img(Yii::$app->params['usersAvatars'].$data["avatar"],
                        ['width' => '50px', 'class' => 'img-rounded img-thumbnail']);
                },
                'contentOptions'=>['style'=>'width: 20%;text-align:middle'],                    
            ],                                
            [
                'attribute' => 'fullname',
                'format' => 'raw',
                'label'=> '',
                'value' => function ($data) {                      
                    return $data["fullname"].
                        Progress::widget([
                        'percent' => (($data["confirmed"]*100)/70),
                        'label' => round(($data["confirmed"]*100)/70)."%",
                        'barOptions' => ['class' => 'progress-bar-success'],
                        'clientOptions' => [
                            'value' => round(($data["confirmed"]*100)/70),
                        ],
                    ]);
                },
                'contentOptions'=>['style'=>'width: 50%;text-align:left;vertical-align: middle;text-transform: uppercase'],
            ],  
            [
                'attribute' => 'confirmed',
                'header' => 'Aprovado',
                'format' => 'raw',
                'value' => function ($data) {                      
                    return "<b class=\"text-success\">".$data["confirmed"]."</b>";
                },
                'headerOptions' => ['class' => 'text-success','style'=>'width: 20%;text-align:right;vertical-align: middle;'],
                'contentOptions'=>['style'=>'width: 20%;text-align:right;vertical-align: middle;'],
            ],  
        ],
    ]); ?>      
    </div>
    <div class="col-md-6">
    <h4>CDC Sicoobcard</h4>
    <?= GridView::widget([
      'dataProvider' => $dataProviderCampaign2,
      'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '<span class="not-set">(não informado)</span>'],
      'emptyText'    => '</br><p class="text-danger">Nenhuma informação encontrada</p>',
      'summary'      =>  '',
      'showHeader'   => false,        
      'tableOptions' => ['class'=>'table table-hover'],
      'columns' => [          
            [
                'attribute' => 'avatar',
                'label' => false,
                'format' => 'html',
                'value' => function ($data) {
                    return Html::img(Yii::$app->params['usersAvatars'].$data["avatar"],
                        ['width' => '50px', 'class' => 'img-rounded img-thumbnail']);
                },
                'contentOptions'=>['style'=>'width: 20%;text-align:middle'],                    
            ],                                
            [
                'attribute' => 'fullname',
                'format' => 'raw',
                'label'=> '',
                'value' => function ($data) {                      
                    return $data["fullname"].
                        Progress::widget([
                        'percent' => (($data["confirmed"]*100)/50),
                        'label' => round(($data["confirmed"]*100)/50)."%",
                        'barOptions' => ['class' => 'progress-bar-success'],
                        'clientOptions' => [
                            'value' => round(($data["confirmed"]*100)/50),
                        ],
                    ]);
                },
                'contentOptions'=>['style'=>'width: 50%;text-align:left;vertical-align: middle;text-transform: uppercase'],
            ],  
            [
                'attribute' => 'confirmed',
                'header' => 'Aprovado',
                'format' => 'raw',
                'value' => function ($data) {                      
                    return "<b class=\"text-success\">".$data["confirmed"]."</b>";
                },
                'headerOptions' => ['class' => 'text-success','style'=>'width: 20%;text-align:right;vertical-align: middle;'],
                'contentOptions'=>['style'=>'width: 20%;text-align:right;vertical-align: middle;'],
            ],                                                                                 
        ],
    ]); ?></div>

          </div>
    </div>

      </div>
      <div class="col-md-4">

        <div class="panel panel-default">
          <div class="panel-heading"><b>Destaques</b></div>
          <div class="panel-body" style="height: 310px;max-height: 10;">

<div class="list-group">
  <a href="http://172.19.37.4/intranet/index.php/arquivos-a-manuais/doc/421/raw" class="list-group-item"><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Apresentação PAGI</a>
  <a href="http://172.19.37.4/intranet/index.php/arquivos-a-manuais/category/69/2015-07-31-17-44-50" class="list-group-item"><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Projetos Estratégicos</a>
  <a href="http://172.19.37.4/intranet/index.php/arquivos-a-manuais/category/68/caderno-de-indicadores" class="list-group-item"><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Caderno de Indicadores</a>
  <a href="http://172.19.37.4/intranet/index.php/arquivos-a-manuais/category/67/sig" class="list-group-item"><span class="glyphicon glyphicon-star" aria-hidden="true"></span> APN Explicado</a>
  <a href="http://172.19.37.4/intranet/index.php/arquivos-a-manuais/category/62/2014-07-14-21-07-06" class="list-group-item"><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Gestão de Desempenho</a>
  <a href="http://172.19.37.4/intranet/index.php/arquivos-a-manuais/doc/255/raw" class="list-group-item"><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Planilha de Cobrança</a>
</div>
</p>         
          </div>
        </div>

      </div>
    </div>    

    </div>

    </div>
</div>