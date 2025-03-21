<?php

use basbeheertje\yii2\theme\components\BasbeheertjeThemeComponent;

/* @var $this \yii\web\View */

/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use basbeheertje\yii2\theme\assets\BasbeheertjeThemeAsset;

BasbeheertjeThemeAsset::register($this);

/** @var BasbeheertjeThemeModule $themeModule */
$themeModule = Yii::$app->getModule(basbeheertje\yii2\theme\BasbeheertjeThemeModule::MODULE_NAME);

if (!empty(Yii::$app->BasbeheertjeThemeComponent)) {
    foreach (Yii::$app->BasbeheertjeThemeComponent->getAssets() as $asset) {
        /** @var string $asset */
        $asset::register($this);
    }
}

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
<body class="page-<?php echo strtolower(Yii::$app->controller->id) . "-" . strtolower(Yii::$app->controller->action->id); ?> main-layout">
<?php $this->beginBody() ?>
<div class="row-fluid">
    <?php

    if ($themeModule->elements['navigation']['position'] === BasbeheertjeThemeComponent::POSITION_LEFT) {
        echo $this->render('_navigation');
        echo '<div id="position-main-page" class="col-md-10">';
    }

    if ($themeModule->positions['header']['enabled'] === true) {
        echo '<div class="row-fluid"><div class="col-md-12">' . $this->render('_header') . '</div></div>';
    }

    if ($themeModule->elements['breadcrumbs']['enabled'] === true) {
        echo '<div class="row-fluid"><div class="col-md-12">' . $this->render('_breadcrumbs') . '</div></div>';
    }

    echo '<div class="row-fluid" id="position-main-page-contents">';

    $center_width = 12;

    if ($themeModule->positions['left']['enabled'] === true) {
        echo '<div class="col-md-3">';
        echo $this->render('_left');
        echo '</div>';
        $center_width = -3;
    }

    if ($themeModule->positions['right']['enabled'] === true) {
        $center_width = -3;
    }

    if ($themeModule->positions['center']['enabled'] === true) {
        echo '<div class="col-md-' . $center_width . '">';
        echo $this->render('_center', ['content' => $content]);
        echo '</div>';
    }
    if ($themeModule->positions['right']['enabled'] === true) {
        echo '<div class="col-md-3">';
        echo $this->render('_right');
        echo '</div>';
    }

    if ($themeModule->elements['navigation']['position'] === BasbeheertjeThemeComponent::POSITION_RIGHT) {
        echo $this->render('_navigation');
    }
    echo '</div>';

    if ($themeModule->elements['navigation']['position'] === BasbeheertjeThemeComponent::POSITION_LEFT) {
        echo '</div>';
    }

    if ($themeModule->positions['footer']['enabled'] === true) {
        echo $this->render('_footer');
    }

    ?>
    <?php

    /*
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
            ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->fullname . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();

    */

    ?>

    <div class="container">

        <?php echo Alert::widget(); ?>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
