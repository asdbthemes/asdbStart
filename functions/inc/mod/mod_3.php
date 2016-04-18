<?php

class mod_3 extends modules {

    function __construct($post) {
        //run the parrent constructor
        parent::__construct($post);
    }

    function render() {
        ob_start();
        ?>

        <div class="mod3 mod_wrap" <?php echo $this->get_item_scope();?>>
        <?php echo $this->get_image('thumb-4col'); ?>
        <div class="item-details">
        <?php echo $this->get_title( 9 );?>
        </div>
        <?php echo $this->get_item_scope_meta();?>
        </div>

        <?php return ob_get_clean();
    }
}