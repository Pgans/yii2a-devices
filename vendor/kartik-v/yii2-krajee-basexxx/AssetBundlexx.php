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
<<<<<<< HEAD
 * Base asset bundle used for all Krajee extensions.
=======
 * Asset bundle used for all Krajee extensions with bootstrap and jquery dependency.
>>>>>>> b387a46f1b7c33470b2f075a6172115dcf06b4d4
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
<<<<<<< HEAD
class AssetBundle extends \yii\web\AssetBundle
{
    /**
     * Unique value to set an empty asset via Yii AssetManager configuration.
     */
    const EMPTY_ASSET = 'N0/@$$3T$';
    /**
     * Unique value to set an empty asset file path via Yii AssetManager configuration.
     */
    const EMPTY_PATH = 'N0/P@T#';
    /**
     * Unique value identifying a Krajee asset
     */
    const KRAJEE_ASSET = 'K3/@$$3T$';
    /**
     * Unique value identifying a Krajee asset file path
     */
    const KRAJEE_PATH = 'K3/P@T#';
    /**
     * @inheritdoc
     */
    public $js = self::KRAJEE_ASSET;
    /**
     * @inheritdoc
     */
    public $css = self::KRAJEE_ASSET;
    /**
     * @inheritdoc
     */
    public $sourcePath = self::KRAJEE_PATH;
    /**
=======
class AssetBundle extends BaseAssetBundle
{
    /**
>>>>>>> b387a46f1b7c33470b2f075a6172115dcf06b4d4
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
<<<<<<< HEAD

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if ($this->js === self::KRAJEE_ASSET) {
            $this->js = [];
        }
        if ($this->css === self::KRAJEE_ASSET) {
            $this->css = [];
        }
        if ($this->sourcePath === self::KRAJEE_PATH) {
            $this->sourcePath = null;
        }
    }

    /**
     * Adds a language JS locale file
     *
     * @param string $lang the ISO language code
     * @param string $prefix the language locale file name prefix
     * @param string $dir the language file directory relative to source path
     * @param bool $min whether to auto use minified version
     *
     * @return AssetBundle instance
     */
    public function addLanguage($lang = '', $prefix = '', $dir = null, $min = false)
    {
        if (empty($lang) || substr($lang, 0, 2) == 'en') {
            return $this;
        }
        $ext = $min ? (YII_DEBUG ? ".min.js" : ".js") : ".js";
        $file = "{$prefix}{$lang}{$ext}";
        if ($dir === null) {
            $dir = 'js';
        } elseif ($dir === "/") {
            $dir = '';
        }
        $path = $this->sourcePath . '/' . $dir;
        if (!Config::fileExists("{$path}/{$file}")) {
            $lang = Config::getLang($lang);
            $file = "{$prefix}{$lang}{$ext}";
        }
        if (Config::fileExists("{$path}/{$file}")) {
            $this->js[] = empty($dir) ? $file : "{$dir}/{$file}";
        }
        return $this;
    }

    /**
     * Set up CSS and JS asset arrays based on the base-file names
     *
     * @param string $type whether 'css' or 'js'
     * @param array $files the list of 'css' or 'js' basefile names
     */
    protected function setupAssets($type, $files = [])
    {
        if ($this->$type === self::KRAJEE_ASSET) {
            $srcFiles = [];
            $minFiles = [];
            foreach ($files as $file) {
                $srcFiles[] = "{$file}.{$type}";
                $minFiles[] = "{$file}.min.{$type}";
            }
            $this->$type = YII_DEBUG ? $srcFiles : $minFiles;
        } elseif ($this->$type === self::EMPTY_ASSET) {
            $this->$type = [];
        }
    }

    /**
     * Sets the source path if empty
     *
     * @param string $path the path to be set
     */
    protected function setSourcePath($path)
    {
        if ($this->sourcePath === self::KRAJEE_PATH) {
            $this->sourcePath = $path;
        } elseif ($this->sourcePath === self::EMPTY_PATH) {
            $this->sourcePath = null;
        }
    }
=======
>>>>>>> b387a46f1b7c33470b2f075a6172115dcf06b4d4
}
