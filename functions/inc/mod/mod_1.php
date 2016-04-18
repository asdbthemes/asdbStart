<?php
class mod_1 extends modules {
    function __construct($post) {
        //run the parrent constructor
        parent::__construct($post);
    }

    function render() {
        ob_start();
        ?>

        <div class="mod1 mod_wrap" <?php echo $this->get_item_scope() ?>>

            <?php echo $this->get_image('thumb-4col'); ?>

            <?php echo $this->get_title( 8 ); ?>

            <div class="entry-meta">
                <?php echo $this->get_author(); ?>
                <?php echo $this->get_date(); ?>
                <?php echo $this->get_comments(); ?>
                <?php echo $this->get_views(); ?>
            </div>

            <div class="entry-excerpt">
                <?php echo $this->get_excerpt( 20 ); ?>
            </div>

            <?php echo $this->get_item_scope_meta(); ?>

        </div>

        <?php
        return ob_get_clean();
    }
}