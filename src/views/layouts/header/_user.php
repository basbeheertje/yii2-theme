<?php


?>
<div id="header-user">
    <div class="users-avatar"><img src="<?php echo Yii::$app->user->identity->getAvatarLink(); ?>"/></div>
    <div class="users-info">
        <div class="users-fullname"><?php echo Yii::$app->user->identity->getFullName(); ?></div>
        <div class="users-email"><?php echo Yii::$app->user->identity->getEmail(); ?></div>
    </div>
</div>
