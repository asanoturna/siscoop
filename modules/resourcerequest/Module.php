<?php

namespace app\modules\resourcerequest;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\resourcerequest\controllers';

    //public $layout = 'main';

    public function init()
    {
        parent::init();

        \Yii::configure($this, require(__DIR__ . '/config/main.php'));
    }
}
