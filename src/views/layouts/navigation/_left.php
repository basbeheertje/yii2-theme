<?php

use basbeheertje\yii2\theme\components\BasbeheertjeThemeComponent;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;

/** @var BasbeheertjeThemeModule $themeModule */
$themeModule = Yii::$app->getModule(basbeheertje\yii2\theme\BasbeheertjeThemeModule::MODULE_NAME);

?>
<div class="left-navigation" style="background-color:white;display: inline-block;float: left;">
    <?php

    if ($themeModule->theme['logo']) {
        echo $this->render(
            '_logo',
            $themeModule->theme['logo']
        );
    }

    NavBar::begin([
        //'brandLabel' => Yii::$app->name,
        //'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar',
        ],
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => array_merge(
            Yii::$app->BasbeheertjeThemeComponent->getNavbarItems()
        ),
    ]);
    NavBar::end();

    if ($themeModule->positions['footer']['enabled'] === false) {
        echo $themeModule->component->renderCreatorInfo();
    }

    ?>
</div>
