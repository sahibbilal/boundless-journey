<?php
/**
 * Template: Site Map
 */

get_header();

while( has_sub_field('special_page_content') ){
	ACF_Layout::render(get_row_layout());
}

?>
  <section>
  	<div>
        <h2>Sitemap</h2>
        <div class="clearfix">
            <div class="col col-12">
                <?= do_shortcode('[aioseo_html_sitemap]'); ?>
            </div>
        </div>
    </div>
  </section>
<?php

get_footer();

// EOF