<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Colaborador';

?>
<div class="site-detail">

    <?php $avatar = Yii::$app->getRequest()->getQueryParam('avatar');
    //echo Html::img(Yii::$app->params['usersAvatars'].$model->avatar, ['width' => '250px', 'class' => 'img-rounded img-thumbnail']);
    echo Html::img(Yii::$app->params['usersAvatars'].$avatar, ['width' => '250px', 'class' => 'img-rounded img-thumbnail']);
    ?>


</div>