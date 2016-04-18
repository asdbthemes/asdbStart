<?php
global $asdbblock;
$thumb ='thumb-4col';
if ( isset($asdbblock['thumb']) ) {$thumb = $asdbblock['thumb'];}
?>

<div class="mod8 mod_wrap">
<?php echo get_blocks_image('thumb-3col');?>

<div class="item-info">
    <?php echo get_blocks_title(8);?>
</div>

</div>
