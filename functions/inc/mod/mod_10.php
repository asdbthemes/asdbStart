<?php
class mod_10 extends modules {
    function __construct($post) {
        //run the parrent constructor
        parent::__construct($post);
    }

    function render() {
        ob_start();
        ?>

        <div class="mod10 mod_wrap" <?php echo $this->get_item_scope() ?>>

            <div class="entry-meta">
				<?php echo $this->get_time_date(); ?>
			</div>

            <?php echo $this->get_title( ); ?>

            <div class="entry-excerpt">
                <?php echo $this->get_excerpt( 15 ); ?>
            </div>

            <?php echo $this->get_item_scope_meta(); ?>


        </div>

        <?php
        return ob_get_clean();
    }
}