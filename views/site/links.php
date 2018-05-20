<?php
use yii\helpers\Html;
use kartik\sidenav\SideNav;
use yii\data\SqlDataProvider;
use yii\grid\GridView;
use yii\bootstrap\Tabs;
use yii\helpers\ArrayHelper;
use app\models\User;

$this->title = 'Links Uteis';
?>
<div class="site-links">

    <div class="row">
    <div class="col-sm-2">
    <?php  echo $this->render('_menu'); ?>
    </div>

    <div class="col-sm-10">
    <h1><span class="glyphicon glyphicon-link" aria-hidden="true"></span> <?= Html::encode($this->title) ?></h1>
    <hr/>
    
    <div class="panel panel-default">
    <div class="panel-body">

    <!--   
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#site">Links da Intranet</a></li>
        <li><a data-toggle="tab" href="#custom">Meus Links Pessoais</a></li>
    </ul> 
    -->

  <div class="tab-content">
  <div id="site" class="tab-pane fade in active">
    <p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showHeader'   => true,        
        'tableOptions' => ['class'=>'table table-hover'],        
        'columns' => [
            [
            'attribute' => 'id',
            'label' => 'Nº',
            'enableSorting' => true,
            'contentOptions'=>['style'=>'width: 3%;text-align:center'],
            ],
            [
            'attribute' => 'name',
            'enableSorting' => true,
            'format'=>'raw',
            'contentOptions'=>['style'=>'width: 50%;text-align:left'],
            'value'=>function ($model, $key, $index, $widget) { 
                return Html::a($model->name, $model->url, ['target'=> '_blank', 'title'=>$model->url])."<br/><p class=\"text-muted\">".$model->description."</p>";
                },            
            ],                 
        ],
    ]); ?>

    </p>
  </div>
  <div id="custom" class="tab-pane fade">
    <p>
    <?php
    // $user = Yii::$app->user->identity->id;
    // $page = Html::a('Acesse aqui', ['/user/profile'], ['class'=>'btn btn-link']);
    // $dataProviderUsers = new SqlDataProvider([
    //     'sql' => "SELECT
    //                 name, 
    //                 url
    //             FROM links
    //             WHERE status = 1 AND user_id  = $user
    //             ORDER BY name",
    //     'key'  => 'name',
    //     'totalCount' => 100,
    //     'pagination' => [
    //         'pageSize' => 100,
    //     ],         
    // ]);
    // echo GridView::widget([
    //   'dataProvider' => $dataProviderUsers,
    //   'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '<span class="not-set">(não informado)</span>'],
    //   'emptyText'    => '</br><p class="text-danger">Nenhum link encontrado! Crie sua lista de links pessoais acessível de qualquer computador.'.$page.'</p>',
    //   'summary'      =>  '',
    //   'showHeader'   => false,        
    //   'tableOptions' => ['class'=>'table'],
    //   'columns' => [                                    
    //         [
    //             'attribute' => 'name',
    //             'format' => 'raw',
    //             'label'=> '',
    //             'value' => function ($data) {                      
    //                 return $data["name"];
    //             },
    //             'contentOptions'=>['style'=>'width: 50%;text-align:left;vertical-align: middle;text-transform: uppercase'],
    //         ],  
    //         'url:url',                                                                                
    //     ],
    // ]); 
    ?> 

    </p>
  </div>
</div> 
    <br/>
    
    </div>
    </div>

    </div>
    </div>
</div>