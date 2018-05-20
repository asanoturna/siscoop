<?php
use yii\helpers\Html;
use kartik\sidenav\SideNav;
use yii\data\SqlDataProvider;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

$this->title = 'Aniversariantes do Mês';
?>
<div class="site-about">

    <div class="row">
    <div class="col-sm-2">
    <?php  echo $this->render('_menu'); ?>
    </div>

    <div class="col-sm-10">
    <h1><i class="fa fa-birthday-cake" aria-hidden="true"></i> <?= Html::encode($this->title) ?></h1>
    <hr/>
  
    <?php
    $dataProviderBirthdate = new SqlDataProvider([
        'sql' => "SELECT
        avatar, user.fullname as fullname, day(birthdate) as dia,
        location.fullname as localization
        FROM user   
        INNER JOIN location
        ON user.location_id = location.id
        WHERE MONTH(birthdate) = MONTH(Now()) AND user.status = 1
        ORDER BY day(birthdate)",
        'totalCount' => 300,
        'key'  => 'fullname',
        'pagination' => [
            'pageSize' => 300,
        ],
    ]);
    ?>  

    <div class="row" style="background: url(<?php echo Yii::$app->request->baseUrl;?>/images/birthdate.png) !important;background-repeat: repeat-y;background-size: cover;">
      <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
          <div class="panel-body" >
                <?= GridView::widget([
                  'dataProvider' => $dataProviderBirthdate,
                  'emptyText'    => '</br><p class="text-danger">Nenhum aniversariante encontrado</p>',
                  'summary'      =>  '',
                  'showHeader'   => true,        
                  'tableOptions' => ['class'=>'table'],
                  'columns' => [     
                        [
                            'attribute' => 'avatar',
                            'label' => false,
                            'format' => 'raw',
                            'value' => function ($data) {
                                return Html::img(Yii::$app->params['usersAvatars'].$data["avatar"],
                                    ['width' => '50px', 'class' => 'img-rounded img-thumbnail img-responsive']);
                            },
                            'contentOptions'=>['style'=>'width: 10%;text-align:middle'],                    
                        ],                                 
                        [
                            'attribute' => 'fullname',
                            'format' => 'raw',
                            'header' => 'Colaborador',
                            'value' => function ($data) {                      
                                return "<h5>".$data["fullname"]."</h5><p>"."<em class=\"text-muted\">".$data["localization"]."</em>";
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
        
    </div>
    </div>
</div>
