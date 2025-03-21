<?php

/** @var BasbeheertjeThemeModule $themeModule */
$themeModule = Yii::$app->getModule(basbeheertje\yii2\theme\BasbeheertjeThemeModule::MODULE_NAME);

echo "<h1 id='header-title'>" . $themeModule->getComponent()->getHeaderTitle($this) . '</h1>';

echo $this->render('header/_search');

echo $this->render('header/_notifications');

echo $this->render('header/_user');

?>