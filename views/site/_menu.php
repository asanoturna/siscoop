<?php
use kartik\sidenav\SideNav;
use yii\bootstrap\Nav;

?>
    <?php
    echo \cyneek\yii2\menu\Menu::widget([
        'options' => [
            'type' => SideNav::TYPE_DEFAULT,
            'heading' => false,
            'encodeLabels' => false,
            'indItem' => '<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>',
            'class'=>'active',
            ],
        ]);
    ?>