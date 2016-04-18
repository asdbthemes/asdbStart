<?php
global $asdbblock;
$thumb ='thumb-4col';
if ( isset($asdbblock['thumb']) ) {$thumb = $asdbblock['thumb'];}
?>

<div class="mod6 mod_wrap">

    <?php echo get_blocks_image('thumb-small');?>

<div class="item-info">
    <?php echo get_blocks_title(6);?>
    <div class="entry-excerpt">
        <?php kama_excerpt(55);?>
    </div>
</div>

</div>
