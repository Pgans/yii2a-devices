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

/**
 * Base module class for Krajee extensions
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
<<<<<<< HEAD
 * @since 1.8.7
=======
 * @since 1.8.9
>>>>>>> b387a46f1b7c33470b2f075a6172115dcf06b4d4
 */
class Module extends \yii\base\Module
{
    use TranslationTrait;

    /**
     * @var array the the internalization configuration for this widget
     */
    public $i18n = [];

    /**
     * @var string translation message file category name for i18n
     */
    protected $_msgCat = '';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->initI18N();
    }
}
