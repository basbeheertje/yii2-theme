<?php

/** @var string $path */
/** @var string $alt */
/** @var float $width */
/** @var float $height */

?>
<div class="navigation-logo">
    <img src="<?php echo $path; ?>"<?php if ($alt) {
        echo ' alt="' . $alt . '"';
    }; ?><?php if (isset($height) && $height) {
        echo ' height="' . $height . '"';
    }; ?><?php if (isset($width) && $width) {
        echo ' width="' . $width . '"';
    }; ?>/>
</div>