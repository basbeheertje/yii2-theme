<?php

namespace basbeheertje\yii2\theme\assets;

use yii\web\AssetBundle;

/**
 * Class BasbeheertjeThemeAsset
 * @package basbeheertje\yii2\theme\assets
 */
class BasbeheertjeThemeAsset extends AssetBundle {
    public $sourcePath = '@basbeheertje/yii2/theme/assets';
    public $publishOptions = ['forceCopy' => true];
    /*public $jsOptions = [
        'conditions' => [
            'plugins/respond.min.js' => 'if lt IE 9',
            'plugins/excanvas.min.js' => 'if lt IE 9',
        ],
    ];
    public $js = [
        'plugins/respond.min.js',
        'plugins/excanvas.min.js',
        'plugins/jquery-migrate-1.2.1.min.js',
        'plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js',
        'plugins/jquery-slimscroll/jquery.slimscroll.min.js',
        'plugins/jquery.blockui.min.js',
        'plugins/jquery.cokie.min.js',
        'plugins/uniform/jquery.uniform.min.js',
        'scripts/core/metronic.js',
        'scripts/core/app.js',
        'scripts/custom/custom.js',
    ];

    public $css = [
        'plugins/uniform/css/uniform.default.css',
        'css/style-metronic.css',
        'css/style.css',
        'css/style-responsive.css',
        'css/custom.css',
    ];*/

    public $js = [
        'scripts/login.js',
        'scripts/menu.js',
        'scripts/splashscreen.js'
    ];

    public $css = [
        'css/style.css',
        'css/style-responsive.css'
    ];

    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
        'yii\web\JqueryAsset',
    ];
}