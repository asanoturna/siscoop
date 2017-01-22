<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ResourcestatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Resourcestatuses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resourcestatus-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Resourcestatus', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'hexcolor',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
