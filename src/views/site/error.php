<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */

/* @var $exception Exception */

use yii\helpers\Html;

$this->title = Yii::t('app', $name);
?>
<div class="site-error">
    <div class="alert alert-danger">
        <?php echo nl2br(Html::encode($message)); ?>
    </div>

    <div class="text-block">
            <?php echo Yii::t('app', 'The above error occurred while the Web server was processing your request.'); ?>
            <?php echo Yii::t('app', 'Please contact us if you think this is a server error. Thank you.'); ?>
    </div>
</div>
