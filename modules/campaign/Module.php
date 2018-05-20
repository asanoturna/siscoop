<?php

namespace app\modules\campaign;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\campaign\controllers';

    //public $layout = 'main';

    public function init()
    {
        parent::init();

        \Yii::configure($this, require(__DIR__ . '/config/main.php'));
    }
}
