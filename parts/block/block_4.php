<?php
global $asdbblock;
$thumb ='thumb-4col';
if ( isset($asdbblock['thumb']) ) {$thumb = $asdbblock['thumb'];}
?>

<div class="mod4 mod_wrap">

    <div class="entry-meta">
        <?php echo get_blocks_date();?>
    </div>

    <?php echo get_blocks_title(6);?>

    <div class="entry-excerpt">
        <?php kama_excerpt(55);?>
    </div>

</div>
