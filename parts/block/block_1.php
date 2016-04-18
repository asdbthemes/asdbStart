<?php
global $asdbblock;
$thumb ='thumb-4col';
if ( isset($asdbblock['thumb']) ) {$thumb = $asdbblock['thumb'];}
?>

<div class="mod1 mod_wrap">

    <?php //get_blocks_thumb($thumb);?>
    <?php echo get_blocks_image($thumb);?>

    <?php echo get_blocks_title(6);?>


    <div class="entry-meta">
        <?php //echo get_blocks_author();?>
        <?php echo get_blocks_date();?>
        <?php echo get_blocks_cat(); ?>
        <?php echo get_blocks_comments(); ?>
        <?php echo get_blocks_views(); ?>
    </div>

    <div class="entry-excerpt">
        <?php kama_excerpt(55);?>
    </div>

</div>
