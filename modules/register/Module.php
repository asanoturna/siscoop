<?php

namespace app\modules\register;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\register\controllers';

    //public $layout = 'main';

    public function init()
    {
        parent::init();

        \Yii::configure($this, require(__DIR__ . '/config/main.php'));
    }
}