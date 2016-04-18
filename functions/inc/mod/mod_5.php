<?php

class mod_5 extends modules {

    function __construct($post) {
        //run the parrent constructor
        parent::__construct($post);
    }

    function render() {
        ob_start();
        ?>

        <div class="mod5 mod_wrap" <?php echo $this->get_item_scope();?>>

            <?php echo $this->get_image('thumb-1col');?>
            <?php echo $this->get_title(22);?>


            <div class="entry-meta">
                <?php echo $this->get_author();?>
                <?php echo $this->get_date();?>
                <?php echo $this->get_comments(); ?>
                <?php echo $this->get_views(); ?>
            </div>

            <div class="entry-excerpt">
                <?php echo $this->get_excerpt(55);?>
            </div>

            <?php echo $this->get_item_scope_meta();?>
        </div>

        <?php return ob_get_clean();
    }
}