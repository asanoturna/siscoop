<?php

namespace app\modules\productivity;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\productivity\controllers';

    //public $layout = 'main';

    public function init()
    {
        parent::init();

        \Yii::configure($this, require(__DIR__ . '/config/main.php'));
    }
}
