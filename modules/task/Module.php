<?php

namespace app\modules\task;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\task\controllers';

    //public $layout = 'main';

    public function init()
    {
        parent::init();

        \Yii::configure($this, require(__DIR__ . '/config/main.php'));
    }
}