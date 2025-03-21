<?php

/** @var BasbeheertjeThemeModule $themeModule */
$themeModule = Yii::$app->getModule(basbeheertje\yii2\theme\BasbeheertjeThemeModule::MODULE_NAME);

?>
<footer class="footer">
    <div class="container">
        <div class="row pull-right">
            <div class="form-group">
                <?php

                echo $themeModule->getComponent()->renderFooterItems();

                ?>
            </div>
        </div>
    </div>
</footer>
