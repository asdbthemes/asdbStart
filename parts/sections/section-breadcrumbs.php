<section class="breadcrumbs">
        <div class="wrap">
            <div class="breadcrumb medium-8 columns" role="breadcrumbs">
    		<?php
    		//if(function_exists('bcn_display')){ bcn_display();}
    		if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs();
    		?>
            </div>
            <div class="social-warp medium-4 columns">
                <span class="pull-right">
          			<?php asdb_social_links(); ?>
                </span>
            </div>
        </div><!--/.wrap-->
</section><!--/.breadcrumbs-->
