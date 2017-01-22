<?php
use yii\helpers\Html;
use kartik\sidenav\SideNav;
use yii\data\SqlDataProvider;
use yii\grid\GridView;
use app\models\User;

$this->title = 'Arquivos';
?>
<div class="archive-index">

<div class="row">
    <div class="col-sm-2">
    <?php  echo $this->render('_menu'); ?>
    </div>

    <div class="col-sm-10">
    <h1><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> <?= Html::encode($this->title) ?></h1>
    <hr/>

    <div class="panel panel-default">
      <div class="panel-body">
        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            'id',
            'archivecategory_id',
            'name',
            'attachment',
            'description',
            'downloads',
            // 'filesize',
            // 'created',
            // 'updated',
            // 'status',
            // 'user_id',
            // 'filetype',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?> 
    </div>
    </div>

    </div>
    </div>
</div>