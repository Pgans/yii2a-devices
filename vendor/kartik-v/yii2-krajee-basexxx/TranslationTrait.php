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
use yii\helpers\ArrayHelper;

/**
 * TranslationTrait manages methods for all translations used in Krajee extensions
 *
 * @property array $i18n
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
<<<<<<< HEAD
 * @since 1.8.7
=======
 * @since 1.8.9
>>>>>>> b387a46f1b7c33470b2f075a6172115dcf06b4d4
 */
trait TranslationTrait
{
    /**
     * Yii i18n messages configuration for generating translations
     *
     * @param string $dir the directory path where translation files will exist
     * @param string $cat the message category
     *
     * @return void
     */
    public function initI18N($dir = '', $cat = '')
    {
        if (empty($cat) && empty($this->_msgCat)) {
            return;
        }
        if (empty($cat)) {
            $cat = $this->_msgCat;
        }
        if (empty($dir)) {
            $reflector = new \ReflectionClass(get_class($this));
            $dir = dirname($reflector->getFileName());
        }
        Yii::setAlias("@{$cat}", $dir);
        $config = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => "@{$cat}/messages",
            'forceTranslation' => true
        ];
        $globalConfig = ArrayHelper::getValue(Yii::$app->i18n->translations, "{$cat}*", []);
        if (!empty($globalConfig)) {
            $config = array_merge($config, is_array($globalConfig) ? $globalConfig : (array) $globalConfig);
        }
        if (!empty($this->i18n) && is_array($this->i18n)) {
            $config = array_merge($config, $this->i18n);
        }
        Yii::$app->i18n->translations["{$cat}*"] = $config;
    }
}
