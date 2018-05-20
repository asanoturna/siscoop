<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Arquivos';
?>
<div class="file-index">

    <div class="row">
      <div class="col-md-6"><h1><?= Html::encode($this->title) ?></h1></div>
      <div class="col-md-6"><span class="pull-right" style="top: 15px;position: relative;"><?php  echo $this->render('/_menu'); ?></span></div>
    </div>
    <hr/>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="panel panel-default">
    <div class="panel-body"> 
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'archive_category_id',
            'name',
            'attachment',
            'description',
            // 'downloads',
            // 'filesize',
            // 'created',
            // 'updated',
            // 'is_active',
            // 'user_id',
            // 'filetype',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>
    </div>
</div>
