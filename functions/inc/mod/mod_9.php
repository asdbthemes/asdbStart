<?php


class mod_9 extends modules {

    function __construct($post) {
        //run the parrent constructor
        parent::__construct($post);
    }

    function render() {
        ob_start();
        ?>

        <div class="mod_wrap mod9" <?php echo $this->get_item_scope();?>>
            <?php echo $this->get_image('thumb-1col');?>

            <div class="item-details">
                <?php echo $this->get_title(8);?>


                <p><div class="td-post-text-excerpt">
                <?php echo $this->get_excerpt( 155 );?></div></p>

                <div class="more-link-wrap wpb_button read_more clearfix">
                    <a href="<?php echo $this->href;?>"><?php echo __('Continue', 'asdbbase');?></a>
                </div>

            </div>

            <?php echo $this->get_item_scope_meta();?>
        </div>

        <?php return ob_get_clean();
    }
}