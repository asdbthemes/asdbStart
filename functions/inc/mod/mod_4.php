<?php

class mod_4 extends modules {

    function __construct($post) {
        //run the parrent constructor
        parent::__construct($post);
    }

    function render() {
        ob_start();
        ?>

        <div class="mod4 mod_wrap" <?php echo $this->get_item_scope();?>>
        <?php echo $this->get_image('thumb-1col');?>

        <div class="item-details">
            <?php echo $this->get_title(10);?>

            <div class="meta-info">
                <?php //echo $this->get_author();?>
                <?php echo $this->get_date();?>
                <?php //echo $this->get_commentsAndViews();?>
            </div>

        </div>

        <?php echo $this->get_item_scope_meta();?>
        </div>

        <?php return ob_get_clean();
    }
}