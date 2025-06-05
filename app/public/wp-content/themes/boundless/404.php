<?php
/**
 * 404 Error Page Template
 *
 * @package WordPress
 * @subpackage Boundless Journeys
 * @since Boundless 1.0
 */

get_header();




while( has_sub_field('special_page_content', 5094) ){
//	ACF_Layout::render(get_row_layout());
}

?>

<section id="splash" class="header-390 " data-speed="-2">
    <ul class="slideshowheader">
        <li class='slide big-slide' style="background-image: url('/wp-content/themes/boundless/images/default.jpg')">
            <div>
                <div class="caption">
                    <div class="tbl">
                        <div class="tc">
                            <span class="headline">404: Page Not Found</span>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
    <div class="bottom-mask"></div>
</section>



<section>
  	<div>

    	<h2>Error 404 - Page Not Found</h2>

        <p>We don't have a page for that web address.</p>
        <p>Could be a broken link or a typo — try one of these pages.</p>

        <div class="sitemap clearfix">
        	<div class="col col-1">

                <ul>
                	<li><a href="<?php echo get_permalink(9090);?>"><?php echo get_the_title(9090);?></a>
                    	<ul>
                        	<li><a href="/tours/hiking">Hiking and Walking</a></li>
                        	<li><a href="/tours/trekking">Trekking</a></li>
                        	<li><a href="/tours/safari">Safaris</a></li>
                        	<li><a href="/tours/culture">Cultural Encounters</a></li>
                        	<li><a href="/tours/cruising/">Expedition Cruising</a></li>
                        </ul>
                    </li>


                    <li><a href="<?php echo get_permalink(367);?>"><?php echo get_the_title(367);?></a>
                    	<ul>
                        	<li><a href="<?php echo get_permalink(5359);?>"><?php echo get_the_title(5359);?></a></li>
                            <li><a href="<?php echo get_permalink(5361);?>"><?php echo get_the_title(5361);?></a></li>
                            <li><a href="<?php echo get_permalink(5351);?>"><?php echo get_the_title(5351);?></a></li>
                            <li><a href="<?php echo get_permalink(5363);?>"><?php echo get_the_title(5363);?></a></li>
                            <li><a href="<?php echo get_permalink(5353);?>"><?php echo get_the_title(5353);?></a></li>
                            <li><a href="<?php echo get_permalink(5525);?>"><?php echo get_the_title(5525);?></a></li>
                            <li><a href="<?php echo get_permalink(5868);?>"><?php echo get_the_title(5868);?></a></li>
                        </ul>
                    </li>





                    <li><a href="<?php echo get_permalink(8);?>"><?php echo get_the_title(8);?></a>
                    	<ul>
                        	<li><a href="<?php echo get_permalink(6040);?>"><?php echo get_the_title(6040);?></a></li>
                            <li><a href="<?php echo get_permalink(12);?>"><?php echo get_the_title(12);?></a></li>
                            <li><a href="<?php echo get_permalink(6036);?>"><?php echo get_the_title(6036);?></a></li>
                            <li><a href="<?php echo get_permalink(10);?>"><?php echo get_the_title(10);?></a></li>
                            <li><a href="<?php echo get_permalink(6133);?>"><?php echo get_the_title(6133);?></a></li>
                            <li><a href="<?php echo get_permalink(14);?>"><?php echo get_the_title(14);?></a></li>
                            <li><a href="<?php echo get_permalink(6053);?>"><?php echo get_the_title(6053);?></a></li>
                            <li><a href="<?php echo get_permalink(6);?>"><?php echo get_the_title(6);?></a></li>
                        </ul>
                    </li>
                </ul>

            </div>
            <div class="col col-2">

            	<ul>
                    <li><a href="/destinations">Destinations</a>
                    	<div class="cols clearfix">
                            <div class="col col-1">
                                <ul>
                                    <?php
				echo '<li><a href="'.get_permalink(5098).'">'.get_the_title(5098).'</a><ul>';
				wp_list_pages('title_li=&depth=1&child_of=5098'); //&exclude=47,21
				echo '</ul></li>'; ?>

                                    <?php
				echo '<li><a href="'.get_permalink(5141).'">'.get_the_title(5141).'</a><ul>';
				wp_list_pages('title_li=&depth=1&child_of=5141'); //&exclude=47,21
				echo '</ul></li>'; ?>
                                </ul>
                            </div>

                            <div class="col col-2">
                                <ul>
                                    <?php
				echo '<li><a href="'.get_permalink(5172).'">'.get_the_title(5172).'</a><ul>';
				wp_list_pages('title_li=&depth=1&child_of=5172'); //&exclude=47,21
				echo '</ul></li>'; ?>

                                    <?php
				echo '<li><a href="'.get_permalink(5206).'">'.get_the_title(5206).'</a><ul>';
				wp_list_pages('title_li=&depth=1&child_of=5206'); //&exclude=47,21
				echo '</ul></li>'; ?>

                                    <?php
				echo '<li><a href="'.get_permalink(5220).'">'.get_the_title(5220).'</a><ul>';
				wp_list_pages('title_li=&depth=1&child_of=5220'); //&exclude=47,21
				echo '</ul></li>'; ?>

                                </ul>
                            </div>
                        </div>
                    </li>

                </ul>



            </div>
            <div class="col col-3">

            </div>
        </div>

    </div>
  </section>








<?php


get_footer();


?>