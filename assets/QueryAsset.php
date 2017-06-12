<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class QueryAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl  = '@web';
    public $css      = [
        'css/query.css'
    ];

    public $js       = [
        'js/vendor/ace/ace.js',
        'js/vendor/ace/ext-language_tools.js',
        'js/query.js'
    ];

    public $depends = [
        AppAsset::class
    ];
}
