<?php

namespace basbeheertje\yii2\theme\components;

use Yii;
use yii\base\ErrorException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\AssetBundle;
use yii\web\View;

/**
 * Class BasbeheertjeThemeComponent
 * @package basbeheertje\yii2\theme\components
 *
 * @property [] $theme
 * @property [] $positions
 * @property [] $elements
 */
class BasbeheertjeThemeComponent extends \yii\base\Component {
    /**
     * @var AssetBundle
     */
    public static $assetsBundle;

    /**
     * @var string Component name used in the application
     */
    public static $componentName = 'BasbeheertjeTheme';

    public $enabled = true;

    public $theme = [
        'light' => [
            'enabled' => true,
        ],
        'dark' => [
            'enabled' => true,
        ],
        'logo' => [
            'path' => 'images/logo.png',
            'alt' => 'Made by BasBeheertje',
            'height' => 122,
            'width' => 338
        ]
    ];

    public $positions = [
        'header' => [
            'enabled' => true
        ],
        'footer' => [
            'enabled' => true,
        ],
        'left' => [
            'enabled' => false,
        ],
        'right' => [
            'enabled' => false,
        ],
        'center' => [
            'enabled' => true
        ]
    ];

    public $elements = [
        'breadcrumbs' => [
            'enabled' => true,
        ],
        'navigation' => [
            'position' => BasbeheertjeThemeComponent::POSITION_LEFT,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ]
        ],
        'footer' => [
            'enabled' => true
        ]
    ];

    const POSITION_LEFT = 'left';
    const POSITION_TOP = 'top';
    const POSITION_RIGHT = 'right';
    const POSITION_BOTTOM = 'bottom';

    protected $_navbarItems = [];
    protected $_footerItems = [];
    protected $_navbarConfig = [];
    protected $_headertitle = null;
    protected $_assets = [];
    protected $_tabIndex = [];
    protected $_currentTabIndex = 'default';

    public function init () {
        Yii::$classMap['yii\helpers\Html'] = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'Html.php';
    }

    /**
     * @return Metronic Get Metronic component
     */
    public static function getComponent () {
        return Yii::$app->{static::$componentName};
    }

    /**
     * Get base url to metronic assets
     * @param $view View
     * @return string
     */
    public static function getAssetsUrl ($view) {
        if (static::$assetsBundle === null) {
            static::$assetsBundle = static::registerThemeAsset($view);
        }

        return (static::$assetsBundle instanceof AssetBundle) ? static::$assetsBundle->baseUrl : '';
    }

    /**
     * Register Theme Asset
     * @param $view View
     * @return AssetBundle
     */
    public static function registerThemeAsset ($view) {
        /** @var AssetBundle $themeAsset */
        $themeAsset = 'basbeheertje\yii2\theme\assets\BasbeheertjeThemeAsset';
        static::$assetsBundle = $themeAsset::register($view);

        return static::$assetsBundle;
    }

    /**
     * Getter for navbarItems
     * @return array
     */
    public function getNavbarItems () {
        return $this->_navbarItems;
    }

    /**
     * Adds navbar item
     */
    public function addNavbarItem ($navbarItem, $key = null) {
        return $this->_navbarItems[$key] = $navbarItem;
    }

    /**
     * Getter for navbarConfig
     * @return array
     */
    public function getNavbarConfig () {
        return $this->_navbarConfig;
    }

    /**
     * Adds configvalue(s) to navbarConfig
     * @throws ErrorException
     */
    public function addNavbarConfig ($config) {
        if (!is_array($config)) {
            throw new ErrorException('Config should be an array');
        } else {
            $this->_navbarConfig = ArrayHelper::merge($this->_navbarConfig, $config);
        }
    }

    /**
     * Getter for footer items
     * @return array
     */
    public function getFooterItems () {
        return $this->_footerItems;
    }

    /**
     * Check if there are footer items
     * @return boolean
     */
    public function hasFooterItems () {
        return !empty($this->_footerItems);
    }

    /**
     * Adds an footer button
     * @param string $content
     * @param array $options
     */
    public function addFooterButton ($content, $options = []) {
        $this->_footerItems[] = Html::Button($content, $options);
    }

    /**
     * Renders the items for the footer
     * @return string
     */
    public function renderFooterItems () {
        /** @var string $content */
        $content = '';

        if ($this->getFooterItems()) {
            foreach ($this->getFooterItems() as $footerItem) {
                $content .= $footerItem;
            }
        }

        $content .= $this->renderCreatorInfo();

        return $content;
    }

    public function renderCreatorInfo () {
        /** @var string $content */
        $content = '';

        if ($this->elements['footer']['system']) {
            $content .= '<div class="navigation-system"><h2>' . $this->elements['footer']['system'] . '</h2></div>';
        }
        if ($this->elements['footer']['year']) {
            $content .= '<div class="navigation-year"><h2>' . $this->elements['footer']['year'] . '</h2></div>';
        }
        if ($this->elements['footer']['creator']) {
            $content .= '<div class="navigation-creator"><h2>' . $this->elements['footer']['creator'] . '</h2></div>';
        }

        return $content;
    }

    /**
     * @param \yii\web\View $view
     * @return string
     */
    public function getHeaderTitle ($view) {
        if (!isset($this->_headertitle) || is_null($this->_headertitle)) {
            $this->setHeaderTitle($view->title);
        }

        return (string)$this->_headertitle;
    }

    /**
     * @param string $title
     */
    public function setHeaderTitle ($title) {
        $this->_headertitle = (string)$title;
    }

    /**
     * Getter for assets
     * @return string[]
     */
    public function getAssets () {
        return $this->_assets;
    }

    /**
     * @param string $namespace
     * @return boolean
     */
    public function addAsset ($namespace) {
        if (!in_array($namespace, $this->_assets)) {
            $this->_assets[] = $namespace;

            return true;
        }

        return false;
    }

    /**
     * Remove something from the assets list
     * @param $namespace
     * @return bool
     */
    public function removeAsset ($namespace) {
        if (!in_array($namespace, $this->_assets)) {
            return false;
        }

        if (empty($this->_assets)) {
            return false;
        }

        foreach ($this->_assets as $key => $asset) {
            /** @var string $asset */
            if ($asset === $namespace) {
                unset($this->_assets[$key]);
            }
        }

        return true;
    }
}