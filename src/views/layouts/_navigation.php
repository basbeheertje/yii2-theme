<?php

use basbeheertje\yii2\theme\components\BasbeheertjeThemeComponent;

/** @var BasbeheertjeThemeModule $themeModule */
$themeModule = Yii::$app->getModule(basbeheertje\yii2\theme\BasbeheertjeThemeModule::MODULE_NAME);

if ($themeModule->elements['navigation']['position'] === BasbeheertjeThemeComponent::POSITION_LEFT) {
    echo '<div class="col-md-2" id="navigation-element">';
    echo $this->render('navigation/_left');
    echo '</div>';
} else if ($themeModule->elements['navigation']['position'] === BasbeheertjeThemeComponent::POSITION_RIGHT) {
    echo $this->render('navigation/_right');
} else if ($themeModule->elements['navigation']['position'] === BasbeheertjeThemeComponent::POSITION_HEADER) {
    echo $this->render('navigation/_header');
}