<?php

namespace entry\assets;

use yii\web\AssetBundle;

/**
 * Main entry application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $jsOptions = array(
        'position' => \yii\web\View::POS_END
    );
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
        'js/site.js',
    ];
    public $depends = [

    ];
}
