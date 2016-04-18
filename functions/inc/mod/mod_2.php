<?php
class mod_2 extends modules {
    function __construct($post) {
        //run the parrent constructor
        parent::__construct($post);
    }

    function render() {
        ob_start();
        ?>

        <div class="mod2 mod_wrap" <?php echo $this->get_item_scope() ?>>

            <div class="item-details">
            <?php echo $this->get_image('thumb-4col'); ?>
            <div class="entry-meta">
                <?php echo $this->get_date(); ?>
				<?php //echo $this->get_cat(); ?>
            </div>
            <?php echo $this->get_title( 8 ); ?>
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