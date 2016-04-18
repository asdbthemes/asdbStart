<?php
global $asdbblock;
if ($asdbblock['thumb']) {$thumb = $asdbblock['thumb'];} else {$thumb ='thumb-4col'; }
?>

<div class="mod10 mod_wrap">

    <div class="entry-meta">
        <?php echo get_blocks_time_date();?>
    </div>

    <?php echo get_blocks_title();?>

    <div class="entry-excerpt">
        <?php kama_excerpt('maxchar=105');?>
    </div>

</div>
