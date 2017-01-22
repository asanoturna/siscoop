<?php
use yii\helpers\Html;
use kartik\sidenav\SideNav;
use yii\data\SqlDataProvider;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Location;
use yii\bootstrap\Modal;

$this->title = 'Colaboradores';
?>
<div class="site-about">

    <div class="row">
    <div class="col-sm-2">
    <?php  echo $this->render('_menu'); ?>
    </div>

    <div class="col-sm-10">
    <h1><i class="fa fa-users" aria-hidden="true"></i> <?= Html::encode($this->title) ?></h1>
    <hr/>

    <?php
    echo kartik\grid\GridView::widget([
        'dataProvider'=>$dataProvider,
        'filterModel'=>$searchModel,
        'showPageSummary'=>false,
        'showHeader' => true,
        'pjax'=>false,
        'striped'=>false,
        'summary' => false,
        'responsive'=>true,
        'hover'=>false,
        //'panel'=>['type'=>'default', 'heading'=>'Lista agrupada por Unidades'],
        'export'=>[
            'fontAwesome' => true,
            'showConfirmAlert' => false,
            'target' => kartik\grid\GridView::TARGET_BLANK,
        ],
        'exportConfig' => [
            kartik\export\ExportMenu::EXCEL => true,
            //kartik\export\ExportMenu::PDF => false,
        ],
        //'toolbar' => true,
        //'panel'=>['type'=>'primary', 'heading'=>'Grid Grouping Example'],      
        'columns'=>[
            [
                'attribute'=>'location_id', 
                'width'=>'310px',
                'value'=>function ($model, $key, $index, $widget) { 
                    return $model->location->fullname;
                },
                //'filterType'=>GridView::FILTER_SELECT2,
                //'filter'=>ArrayHelper::map(Location::find()->orderBy('fullname')->asArray()->all(), 'id', 'fullname'), 
                // 'filterWidgetOptions'=>[
                //     'pluginOptions'=>['allowClear'=>true],
                // ],
                //'filterInputOptions'=>['placeholder'=>'Any supplier'],
                'group'=>true,
                'groupedRow'=>true,
                'groupOddCssClass'=>'h4 bg-success',
                'groupEvenCssClass'=>'h4 bg-success',
            ],
            [
            'attribute' => 'avatar',
            'label' => '',
            'filter' => false,
            'format' => 'raw',
            'value' => function ($model) {
                   return Html::a(Html::img(Yii::$app->params['usersAvatars'].'thumb/'.$model->avatar, ['width' => '50px', 'class' => 'img-rounded img-thumbnail']),['userdetail','avatar'=>$model->avatar],[
                                                'data-toggle'=>"modal",
                                                'data-target'=>"#myModal",
                                                'data-title'=> $model->fullname,
                                                'title' => $model->fullname,
                                                ]);                
            },
            'contentOptions'=>['style'=>'width: 5%;text-align:middle'], 
            ],            
            [
            'attribute' => 'fullname',
            'label' => 'Nome',
            'format' => 'html',
            'value' => function ($model) {
                return "<p class=\"text-uppercase\"><strong>".$model->fullname."</strong></p><em class=\"text-lowercase\">".$model->username."</em>";
            },               
            'contentOptions'=>['style'=>'width: 40%;text-align:left;vertical-align: middle'],
            ],     
            [
            'attribute' => 'email',
            'format' => 'raw',
            'value' => function ($model) {
                return $model->email != '' ? '<i class="fa fa-envelope" aria-hidden="true"></i> '.Html::mailto($model->email,$model->email) : '<i class="fa fa-envelope" aria-hidden="true"></i> <span class="text-danger"><em>Não informado</em></span>';
            },               
            'contentOptions'=>['style'=>'width: 30%;text-align:left;vertical-align: middle'],
            ],                      
            [
            'attribute' => 'phone',
            'format' => 'html',
            'value' => function ($model) {
                return $model->phone != '' ? '<i class="fa fa-phone" aria-hidden="true"></i> '.$model->phone : '<i class="fa fa-phone" aria-hidden="true"></i> <span class="text-danger"><em>Não informado</em></span>';
            },               
            'contentOptions'=>['style'=>'width: 25%;text-align:left;vertical-align: middle'],
            ],              
        ],
    ]);
    ?>

    <?php
    Modal::begin([
        'id' => 'myModal',
        'header' => '<h4 class="modal-title">Detalhes</h4>',
    ]);
     
    echo '...';
     
    Modal::end();

    $this->registerJs("
    $('#myModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var modal = $(this)
        var title = button.data('title') 
        var href = button.attr('href') 
        modal.find('.modal-title').html(title)
        modal.find('.modal-body').html('<i class=\"fa fa-spinner fa-spin\"></i>')
        $.post(href)
            .done(function( data ) {
                modal.find('.modal-body').html(data)
            });
        })
    ");
    ?>   
    </div>
    </div>
</div>