<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/** @var BasbeheertjeThemeModule $themeModule */
$themeModule = Yii::$app->getModule(basbeheertje\yii2\theme\BasbeheertjeThemeModule::MODULE_NAME);

$this->title = Yii::t('app', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="main-login-backgroundimage"
     style="background-image: url('<?php echo $themeModule->theme['login']['background']; ?>');">
</div>
<div id="main-login-background">
    <div id="content-container">
        <?php

        $form = ActiveForm::begin([
            'id' => 'login-form',
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-1 control-label'],
            ],
        ]);

        ?>
        <div id="login-logo">
            <?= Html::img($themeModule->theme['login']['logo']); ?>
        </div>
        <div class='row'>
            <?php

            echo $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'form-control-solid form-control form-control-lg']);

            ?>
        </div>
        <div class='row'>
            <?php

            echo $form->field($model, 'password')->passwordInput(['class' => 'form-control-solid form-control form-control-lg']);

            ?>
        </div>
        <div class='row'>
            <?php

            echo $form->field($model, 'rememberMe')->checkbox([
                'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
            ]);

            ?>
        </div>
        <?php

        echo Html::submitButton('Login', ['id' => 'login-button', 'class' => 'btn btn-primary', 'name' => 'login-button']);

        ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>