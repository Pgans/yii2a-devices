<?php

/**
 * @package   yii2-krajee-base
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
<<<<<<< HEAD
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2016
 * @version   1.8.7
=======
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2017
 * @version   1.8.9
>>>>>>> b387a46f1b7c33470b2f075a6172115dcf06b4d4
 */

namespace kartik\base;

use Yii;

/**
 * Common base widget asset bundle for all Krajee widgets
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class WidgetAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->setSourcePath(__DIR__ . '/assets');
        $this->setupAssets('css', ['css/kv-widgets']);
        $this->setupAssets('js', ['js/kv-widgets']);
        parent::init();
    }
}
