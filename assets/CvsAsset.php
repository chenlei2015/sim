<?php


namespace app\assets;

use yii\web\AssetBundle;

class CvsAsset extends AssetBundle
{
    public $basePath = '@webroot/src';
    public $baseUrl = '@web/src';
    public $jsOptions = ['position' => \yii\web\View::POS_BEGIN];
    public $css = [
    ];
    public $js = [
        'js/cvs/jquery-1.9.0.min.js',
        'js/cvs/jquery.table2excel.js',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
    ];
}