<?php
namespace app\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/credi-bootstrap.css',
        'css/custom-bootstrap.css',
        // 'css/bootstrap-3.3.4/css/bootstrap.css',
        'css/font-awesome-4.5.0/css/font-awesome.css',          
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
