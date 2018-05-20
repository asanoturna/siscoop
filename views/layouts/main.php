<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ;
    AppAsset::register($this);
    $js = <<< 'SCRIPT'
    /* To initialize BS3 tooltips set this below */
    $(function () {
    $("[data-toggle='tooltip']").tooltip();
    });;
    /* To initialize BS3 popovers set this below */
    $(function () {
    $("[data-toggle='popover']").popover();
    });
SCRIPT;
    // Register tooltip/popover initialization javascript
    $this->registerJs($js);
    ?>
    <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl;?>/favicon.ico">
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="topbar">
    <?php
    NavBar::begin([
        'brandLabel' => '<img src="'.Yii::$app->request->baseUrl.'/images/logo.png" style="height:60px;" > ',
        'brandUrl' => Yii::$app->homeUrl,
        'innerContainerOptions' => ['class'=>'container-fluid'],
        'options' => [
            'class' => 'navbar-inverse navbar-static-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => [
            [
            'label' => '<span class="glyphicon glyphicon-home" aria-hidden="true"></span> Início', 
            'url' => ['/site/index']
            ],
            [
            'label' => '<span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Administração', 
            'url' => ['/administrator/dashboard/index'], 
            'visible' => @Yii::$app->user->identity->role_id == 99,
            ],
            Yii::$app->user->isGuest ?
            [
            'label' => '<span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Entrar', 
            'url' => ['user/login'],
            ]
            :
            [
            'label' => '<img src="'.Yii::$app->params['usersAvatars'].Yii::$app->user->identity->avatar.'" class="profile-image img-avatar" > '. Yii::$app->user->identity->username,
            'items' => 
                [
                    ['label' => '<span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Alterar Senha', 'url' => ['user/resetpassword']],
                    ['label' => '<span class="glyphicon glyphicon-user" aria-hidden="true"></span> Perfil', 'url' => ['user/profile']],
                    '<li class="divider"></li>',
                    ['label' => '<span class="glyphicon glyphicon-off" aria-hidden="true"></span> Sair',
                        'url' => ['/user/logout'],
                        'linkOptions' => ['data-method' => 'post']],
                ],
            ],
        ],
    ]);
    NavBar::end();
    ?>
    </div>
    <div class="container-fluid">
        <?= $content ?>
    </div>
</div>

<div style="background-image: url(<?php echo Yii::$app->homeUrl;?>/images/footer-dark.jpg); height: 5px;"></div>
<footer class="footer">
    <div class="container-fluid">
        <p class="pull-center">&copy; 
        <?= Yii::$app->params['company'] ?> 
        <?= date('Y') ?> - 
        <?= Yii::$app->params['appname']?>
        <?= Html::mailto('<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Dúvidas e Sugestões', Yii::$app->params['supportEmail'], [
            'class' => 'pull-right',
            'title' => 'Envie Dúvidas e Sugestões ',
            'style' => 'color: #97afb3;',
            ]) ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
