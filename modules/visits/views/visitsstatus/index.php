<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VisitsstatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Visitsstatuses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visitsstatus-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Visitsstatus', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'hexcolor',
            'about',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
