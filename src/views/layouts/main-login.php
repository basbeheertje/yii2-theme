<?php

use basbeheertje\yii2\theme\components\BasbeheertjeThemeComponent;

/* @var $this \yii\web\View */

/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;
use basbeheertje\yii2\theme\assets\BasbeheertjeThemeAsset;

BasbeheertjeThemeAsset::register($this);

/** @var BasbeheertjeThemeModule $themeModule */
$themeModule = Yii::$app->getModule(basbeheertje\yii2\theme\BasbeheertjeThemeModule::MODULE_NAME);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="page-<?php echo strtolower(Yii::$app->controller->id) . "-" . strtolower(Yii::$app->controller->action->id); ?> main-login">
<?php $this->beginBody() ?>
<div class="d-flex flex-column flex-root">
    <?php

    echo $content;

    ?>
</div>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
