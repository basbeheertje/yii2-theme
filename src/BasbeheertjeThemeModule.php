<?php

namespace basbeheertje\yii2\theme;

use basbeheertje\yii2\theme\components\BasbeheertjeThemeComponent;
use yii\base\BootstrapInterface;
use yii\base\InvalidConfigException;
use yii\console\Application as ConsoleApp;
use yii\web\Application as WebApplication;
use yii\web\GroupUrlRule;
use Yii;

/**
 * Class BasbeheertjeThemeModule
 * @package basbeheertje\yii2\theme
 */
class BasbeheertjeThemeModule extends \yii\base\Module implements BootstrapInterface {

    const MODULE_NAME = 'basbeheertjethememodule';

    static public $initialized = false;

    /** @inheritdoc */
    public $controllerNamespace = 'basbeheertje\yii2\theme\controllers';

    /** @inheritdoc */
    public $defaultRoute = 'default/index';

    /** @var string */
    public $defaultController = 'default';

    public $component;

    /**
     * @throws exceptions\CronException
     * @todo describe
     */
    public function init () {
        parent::init();
        \Yii::configure($this, require(__DIR__ . '/config.php'));

        if (!static::$initialized) {
            static::$initialized = true;

            $this->controllerNamespace = "basbeheertje\yii2\theme\cli";
            $this->defaultController = "basbeheertjetheme";
            $this->defaultRoute = "basbeheertjetheme";

            /** @var BasbeheertjeThemeComponent $component */
            if (!isset($this->component)) {
                $component = $this->getComponent();
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function bootstrap ($app) {
        // Make sure to register the base folder as alias as well or things like assets won't work anymore
        \Yii::setAlias('@basbeheertje/yii2/theme', __DIR__);
        if ($app instanceof WebApplication) {
            $app->urlManager->addRules(
                [
                    [
                        'class' => GroupUrlRule::className(),
                        'prefix' => $this->id,
                        'rules' => [
                            'basbeheertje/theme' => 'basbeheertje/theme/index',
                            '<controller:\w+>/<id:\d+>' => '<controller>/view',
                            '<controller:\w+>/<action\w+>/<id:\d+>' => '<controller>/<action>',
                            '<controller:\w+>/<action\w+>' => '<controller>/<action>',
                        ],
                    ]
                ]
                , false);
        } else if ($app instanceof ConsoleApp) {
            $app->controllerMap[$this->getCommandId()] = [
                    'class' => $this->getCommandClass(),
                ] + $this->getCommandOptions();
        } else {
            throw new InvalidConfigException(\Yii::t('basbeheertjetheme', 'The module must be used for web application or console application only.'));
        }
        if ($app->has('i18n')) {
            $app->i18n->translations['basbeheertjetheme'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'en',
                'basePath' => '@basbeheertje/yii2/theme/messages',
            ];
        }
    }

    /**
     * Getter for CommandId
     * @return string
     */
    public function getCommandId () {
        return "basbeheertjetheme";
    }

    /**
     * Getter for CommandClass
     * @return string
     */
    public function getCommandClass () {
        return "basbeheertje\yii2\theme\cli\DefaultController";
    }

    /**
     * Getter for commandoptions
     * @return array
     */
    public function getCommandOptions () {
        return [];
    }

    /**
     * @return BasbeheertjeThemeComponent
     */
    public static function getThemeComponent () {
        /** @var Module $module */
        $module = \Yii::$app->getModule(static::MODULE_NAME);

        return $module->component;
    }

    public function getComponent () {
        if (!isset($this->component)) {
            if (isset(Yii::$app->BasbeheertjeThemeComponent)) {
                $this->component = Yii::$app->BasbeheertjeThemeComponent;
            } else {
                $this->component = new BasbeheertjeThemeComponent();
            }
        }

        return $this->component;
    }

    /**
     * @param $value
     */
    public function setTheme ($value) {
        $component = $this->getComponent();

        $component->theme = array_merge($component->theme, $value);
    }

    /**
     * @return array
     */
    public function getTheme () {
        $component = $this->getComponent();

        return $component->theme;
    }

    /**
     * @param $value
     */
    public function setPositions ($value) {
        $component = $this->getComponent();

        $component->positions = array_merge($component->positions, $value);
    }

    /**
     * @return array
     */
    public function getPositions () {
        $component = $this->getComponent();

        return $component->positions;
    }

    /**
     * @param [] $value
     */
    public function setElements ($value) {
        $component = $this->getComponent();

        $component->elements = array_merge($component->elements, $value);
    }

    /**
     * @return []
     */
    public function getElements () {
        $component = $this->getComponent();

        return $component->elements;
    }
}
