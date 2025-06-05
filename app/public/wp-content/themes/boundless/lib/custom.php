<?php
/**
 * Custom scripts for pulling data and formatting for site.
 *
 * @package WordPress
 * @subpackage Boundless Journeys
 * @since Boundless Journeys 1.0
 */




/**
 * This data is pulled from the Page Segments section.
 * It uses a repeater field from advanced custom fields.
 *
 * @param   bool      $display - if set to true will echo right away.
 * return   string | void
 */
function outputAccolades($display = FALSE) {
  $output = '';
  $accolades = get_field('footer_accolades', SEGID);
  if ($accolades) {
    foreach ($accolades as $item) {
      $imagetitle = isset($item['image']['title']) ? $item['image']['title'] : '';
      $imageurl   = isset($item['image']['url']) ? $item['image']['url'] : '';
      $imagealt   = isset($item['image']['alt']) ? $item['image']['alt'] : '';
      $title      = isset($item['title']) ? $item['title'] : '';
      $subtitle   = $item['sub_title'];
      // Append HTML output
      $output .= '<div class="accolade" id="' . esc_attr($imagetitle) . '">'
               .   '<img alt="' . $imagealt . '" src="' . esc_url($imageurl) . '">'
               .   '<div class="title">'
               .     '<h4>' . $title . '</h4>'
               .     '<p>' . $subtitle . '</p>'
               .   '</div>'
               . '</div>';
    }
  }
  if ($display) {
    echo $output;
  }
  else {
    return $output;
  }
}

/**
 *
 *
 * @param   bool      $display - if set to true will echo right away.
 * return   string | void
 */
function outputContactButtons($display = FALSE) {
  $output = '';
  $buttons = get_field('contact_buttons', SEGID);
  foreach ($buttons as $item) {
    $title = isset($item['button_title']) ? $item['button_title'] : '';
    $link = isset($item['button_link']) ? $item['button_link'] : '';
    // Append HTML output
    $class = "";
  //  if (strtolower($title) == "email an expert" ) $class = " inline-item";
    $output .= '<li>'
             .   '<a class="button white'.$class.'" title="' . esc_attr($title) . '" href="' . esc_url($link) . '">' . $title . '</a>'
             . '</li>';
  }
  if ($display) {
    echo $output;
  }
  else{
    return $output;
  }
}

/**
 *
 *
 * @return  void
 */
function addImageSizes() {
  add_image_size('desktop_full', 1920, 700, true);
  add_image_size('desktop_full_large', 1920, 975, true);
  add_image_size('mobile_full_large', 640, 400, true);
  add_image_size('mobile_full', 640, 300, true);
  add_image_size('htca', 962, 400, TRUE);
  add_image_size('desktop_cta', 932, 900, TRUE);
  add_image_size('mobile_cta',475, 450, TRUE);
  add_image_size('itinerary_destination', 390, 309, TRUE);
  add_image_size('desktop_feature', 1100, 600, TRUE);
  add_image_size('mobile_feature',550, 300, TRUE);
  add_image_size('accom_thumb', 300,300,TRUE);
}
add_action('after_setup_theme', 'addImageSizes');

/**
 *
 *
 * @param   array     $n
 * @return  string    $grid
 */
function grid_getType($n) {
  $grid = '';
  $type = isset($n['acf_fc_layout']) ? $n['acf_fc_layout'] : '';
  switch ($type) {
    case 'image':
      $grid = grid_printImage($n);
      break;
    case 'text_box':
      $grid = grid_printText($n);
      break;
    case 'image_with_overlay':
      $grid = grid_printOverlay($n);
      break;
    case 'textandbutton':
      $grid = grid_printTextButton($n);
      break;
  }
  return $grid;
}

/**
 *
 *
 * @param   array     $n
 * @return  string    $output
 */
function grid_printImage($n) {
  $size = isset($n['size']) ? $n['size'] : '';
  if ( ($size == "three_quarters") || ($size == "two_thirds") ) {
    $image = isset($n['image']['sizes'][FULLIMG . 'full']) ? $n['image']['sizes'][FULLIMG . 'full'] : '';
  } else {
    $image = isset($n['image']['sizes'][FULLIMG . 'cta']) ? $n['image']['sizes'][FULLIMG . 'cta'] : '';
  }

  // Build HTML output
//  $output = '<div class="cta cta-' . esc_attr($size) . ' img" style="background-image:url(\'' . esc_url($image) . '\');"></div>';
  $output = '<div class="cta cta-' . esc_attr($size) . ' img" data-src="' . esc_url($image) . '"></div>';

  return $output;
}

/**
 *
 *
 * @param   array     $n
 * @return  string    $output
 */

function grid_printText($n) {
  $button = '';
  $color = isset($n['background_color']) ? $n['background_color'] : '';
  $label = isset($n['button_label']) ? $n['button_label'] : '';
  $size = isset($n['size']) ? $n['size'] : '';
  $text_color = isset($n['text_color']) ? $n['text_color'] : '';
  $url = isset($n['url']) ? SITEURL . $n['url'] : '';
  if ($label) {
    $button = '<a class="button" href="' . esc_url($url) . '" title="' . esc_attr($label) . '">' . $label . '</a>';
  }
  // Build HTML output
  $output = '<div class="cta cta-' . esc_attr($size) . ' txt ' . esc_attr($text_color) . '" style="background-color:' . esc_attr($color) . '">'
          .   '<div class="tbl">'
          .     '<div class="tc">' . $n['text_box'] . $button . '</div>'
          .   '</div>'
          . '</div>';
  return $output;
}

/**
 *
 *
 * @param   array     $n
 * @return  string    $output
 */
function grid_printOverlay($n) {
  $color      = isset($n['highlight_color']) ? $n['highlight_color'] : '';
  $image      = isset($n['image']['sizes'][FULLIMG . 'cta']) ? $n['image']['sizes'][FULLIMG . 'cta'] : '';
  $size       = isset($n['size']) ? $n['size'] : '';
  $text_color = isset($n['text_color']) ? $n['text_color'] : '';
  $title      = isset($n['title']) ? $n['title'] : '';
  $url        = isset($n['page_link']) ? SITEURL . $n['page_link'] : '';
  $link_type  = isset($n['link_type']) ? $n['link_type'] : '';
  switch ($link_type){
    case 'external':
      $actual_link = isset($n['external_link']) ? $n['external_link'] : '';
      break;
    case 'video':
      $actual_link = 'http://www.youtube.com/watch?v=' . isset($n['video_link']) ? $n['video_link'] : '';
      break;
    case 'email':
      $actual_link = 'mailto:' . isset($n['email_link']) ? $n['email_link'] : '';
      break;
    default:
      $actual_link = isset($n['internal_link']) ? $n['internal_link'] : '';
      if(!$actual_link) {
        $actual_link = $url;
      }
      break;
  }
  // Build HTML output
  $output  = '<a class="cta cta-' . esc_attr($size) . '" href="' . esc_url($actual_link) .'" title="' . esc_attr($title) . '">'
  //         .   '<div class="txt ' . $text_color . '" style="background-image:url(\'' . esc_url($image) .'\');">'
           .   '<div class="txt img ' . $text_color . '" data-src="' . esc_url($image) .'">'
           .     '<span class="highlight opfade" style="background-color:' . esc_attr($color) . ';"></span>'
           .     '<div class="tbl">'
           .       '<div class="tc">'
           .         '<span class="line">' . $title . '</span>'
           .       '</div>'
           .     '</div>'
           .   '</div>'
           . '</a>';
  return $output;
}

/**
 *
 *
 * @param   array     $n
 * @return  string    $output
 */
function grid_printTextButton($n) {
  $content  = isset($n['content']) ? $n['content'] : '';
  $image    = isset($n['image']['sizes'][FULLIMG . 'cta']) ? $n['image']['sizes'][FULLIMG . 'cta'] : '';
  $label    = isset($n['button_label']) ? $n['button_label'] : '';
  $title    = isset($n['title']) ? $n['title'] : '';
  $url      = isset($n['button_link']) ? $n['button_link'] : '';
  $aslink   = isset($n['headline_as_link']) ? $n['headline_as_link'] : '';
  if (isset($n['external_link']) && $n['external_link'] != "") {
    $url = $n['external_link'];
  }

  if ($n['headline_as_link'][0] == "yes") {
    $title = "<h3><a href='".$url."' title='".esc_attr($title)."'>" . $title . "</a></h3>";
  } else {
    $title = '<h3>' . $title . '</h3>';
  }

  // Start HTML output
  $output  = '<div class="cta this">'
//           .   '<div style="background-image:url(\'' . esc_url($image) .'\');" class="img img-400"></div>'
           .   '<div data-src="' .esc_url($image) .'" class="img img-400"></div>'
           .   $title
           .   '<p class="large">' . $content . '</p>';
  if ($label !== '' && $url !== '') {
    $output .= '<a href="' . esc_url($url) . '" class="button gray" title="' . esc_attr($label) . '">' . $label . '</a>';
  }
  $output .= '</div>';
  return $output;
}


/**
 * @param   mixed     $cats
 * @param   int       $limit
 * @param   string    $post
 * @return  void
 */
function getArticles($cats, $limit = 3, $post = 'post') {
  // Most cat groups come in as comma seperated but split it if it does not.
  if (!empty($cats)) {
    if (is_array($cats)) {
      $catssep = $cats;
    }
    else {
      $catssep = implode(',', $cats);
    }
    $args = array(
      'category__in'    => $catssep,
      'posts_per_page'  => 3,
      'post_type'        => 'post',
    );

  }
  else{
    $args = array(
      'posts_per_page'  => 3,
      'post_type'        => 'post'
    );
  }
  $query = new WP_Query($args);
  foreach ($query->posts as $post) {
    // get cats
    $image = "";
    if (has_post_thumbnail($post->ID)) {
      $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "htca" );
      $image = $image[0];
    } else {
      $postcat = wp_get_post_categories($post->ID);
      $image = category_image_src(array('term_id'=>$postcat[0], 'size'=> "htca"), false );
    }
    // Use image if available, else use default
    $image = isset($image) ? $image : '/wp-content/uploads/2015/08/cta-leopard.jpg';

    $pageurl =  esc_url(get_permalink($post->ID));
?>
<div class="cta">
  <div class="img" data-src="<?php echo $image; ?>"><a class="fillable" href="<?php echo $pageurl; ?>"></a></div>
  <h3><a href="<?php echo $pageurl; ?>"><?php echo $post->post_title; ?></a></h3>
  <p>By: <?php echo get_the_author_meta('display_name', $post->post_author); ?></p>
  <p><?php echo limit_words($post->post_content, 30); ?>&hellip;</p>
  <p class="read-more">
    <a class="more" title="<?php echo esc_attr($post->post_title); ?>" href="<?php echo $pageurl; ?>">Read This Article</a>

    <?php if ( ! empty( $postcat[0] ) ) : ?>
      <span>- or -</span>
      <a href="<?php echo esc_url(get_category_link($postcat[0])); ?>">See Related Articles</a>
    <?php endif; ?>
  </p>
</div>
<?php
  }
}

/**
 *
 *
 * @param   int       $top
 * @param   int       $bottom
 * @return  string    $margin
 */
function getMargins($top = 0, $bottom = 0) {
  // check if number first
  if (is_numeric($top)) {
    $top = $top . 'px';
  }
  if (is_numeric($bottom)) {
    $bottom = $bottom . 'px';
  }
  $margin = ' margin-top:' . $top . '; margin-bottom:' . $bottom . ';';
  return $margin;
}

/**
 *
 *
 * @param   string    $string
 * @param   int       $limit
 * @return  string    $limited_string
 */
function limit_words($string = '', $limit = 0) {
  $newstring = strip_tags(strip_shortcodes($string));
  $words = explode(' ', $newstring);
  foreach ($words as $i => $word) {
    if (stristr($word, 'http')) {
      unset($words[$i]);
    }
  }
  $limited_string = implode(' ',array_splice($words, 0, $limit));
  return $limited_string;
}


  /* Specify the Editor Stylesheet */
  function my_theme_add_editor_styles() {
    add_editor_style( 'css/editor-style.css' );
  }
  add_action( 'init', 'my_theme_add_editor_styles' );


  /**
   * Fix some of the annoying things about MCE. Also includes editor-style.css
   *
   */
  function formatTinyMCE($in)
  {
      $in['wpautop'] = false;
      return $in;
  }

  add_filter('tiny_mce_before_init', 'formatTinyMCE' );

add_filter( 'mce_buttons_2', 'fb_mce_editor_buttons' );
function fb_mce_editor_buttons( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
/**
 * Add styles/classes to the "Styles" drop-down
 */
function fb_mce_before_init( $settings ) {

    $style_formats = array(
        array(
            'title' => 'Arrow List',
            'selector' => 'ul',
            'classes' => 'arrow-list'
        ),
        array(
            'title' => 'Image Right',
            'selector' => 'img',
            'classes' => 'img-right'
        ),
        array(
            'title' => 'Image Left',
            'selector' => 'img',
            'classes' => 'img-left'
        )
    );

    $settings['style_formats'] = json_encode( $style_formats );
    unset($settings['preview_styles']);
    return $settings;
}
add_filter( 'tiny_mce_before_init', 'fb_mce_before_init' );

/* Add Typekit Fonts to the Editor */
add_filter("mce_external_plugins", "tomjn_mce_external_plugins");
function tomjn_mce_external_plugins($plugin_array){
 $plugin_array['typekit']  =  get_template_directory_uri().'/typekit.tinymce.js';
   return $plugin_array;
}

/**
 *
 *
 * @param   string    $needle
 * @param   array     $haystack
 * @param   bool      $strict
 * @return  bool
 */
function in_array_r($needle, $haystack, $strict = FALSE) {
  foreach ($haystack as $item) {
    if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
      return true;
    }
  }
  return false;
}



/*******************************************************************************
 * BLOG CUSTOMIZATION - ST
 ******************************************************************************/
/**
 * Customize the_excerpt();
 *
 * @param   string    $more
 * @return  string    $more_link
 */
function new_excerpt_more($more) {
  global $post;
  $more_link = '&hellip; <a class="moretag" href="'. esc_url(get_permalink($post->ID)) . '" title="Read more of this post">Read More &raquo;</a>';
  return $more_link;
}
add_filter('excerpt_more', 'new_excerpt_more');

/**
 * Add button classes to post nav
 *
 * @return  string    $attributes
 */
function posts_link_attributes() {
  $attributes = 'class="button white"';
  return $attributes;
}
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

/**
 *
 * @return  void
 */
function printBJRecentPosts() {
  $args = array(
    'numberposts'       => 10,
    'orderby'           => 'post_date',
    'order'             => 'DESC',
    'post_type'         => 'post',
    'post_status'       => 'publish',
    'suppress_filters'  => TRUE,
  );
  $recent_posts = wp_get_recent_posts($args, ARRAY_A);
  if ($recent_posts) {
    echo '<ul>';
    foreach ($recent_posts as $recent) {
      echo '<li>'
         .   '<a href="' . esc_url(get_permalink($recent['ID'])) . '">' .  $recent['post_title'] . '</a>'
         . '</li>';
    }
    echo '</ul>';
  }
}

/**
 * Display dropdown of categories
 *
 * @return  void
 */
function printBJCatDropDown() {
  $args = array(
    'title_li'          => '',
    'show_option_none'  => 'Select category',
    'class'             => 'postform selectized',
    'show_count'        => 1,
    'orderby'           => 'name',
    'order'             => 'ASC',
    'value_field'       => 'slug',
    'selected'          => 1,
  );
  wp_dropdown_categories($args);
?>
<script type="text/javascript">
  // Cache jQuery object
  _select = $('select#cat');
  if ($('option', _select).length > 0) {
    _select.change(function() {
      window.location = '/category/' + _select.val();
    });
  }
</script>
<?php
}

add_filter('next_post_link', 'post_link_attributes');
add_filter('previous_post_link', 'post_link_attributes');

function post_link_attributes($output) {
    $code = 'class="button white"';
    return str_replace('<a href=', '<a '.$code.' href=', $output);
}

function custom_pagination($array) {
  if( is_array( $array ) ) {
      $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
      print_r($paged);
      echo '<ul class="pagination">';
      foreach ( $paged as $page ) {
              echo "<li>$page</li>";
      }
     echo '</ul>';
  }
}

add_filter('body_class', 'add_body');


function add_body($classes) {

  if (wpmd_is_notdevice()) {

    $classes[] = "desktop";

  }

  $iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
  $iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
  $iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");

  if( $iPod || $iPhone || $iPad ) $classes[] = "ios";

  return $classes;

}

function pressreleases(){

	$args = array(
          'posts_per_page' 	=> -1,
          'post_type'				=> 'mediagallery',
          'orderby'					=> 'date',
          'order' 					=> 'DESC',
      );

	  $output = '';

      if ( query_posts( $args ) ) :
	  	$output .= '<div class="press-releases"><ul class="arrow">';
        while (have_posts()) : the_post();
          $output .= '<li><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a> - '.get_the_date().'</li>';
        endwhile;
		$output .= '</ul></div>';
      endif;
      wp_reset_query();



	return $output;
}
add_shortcode( 'pressreleases', 'pressreleases' );


/*
function custom_rating_image_extension() {
    return 'png';
}
add_filter( 'wp_postratings_image_extension', 'custom_rating_image_extension' );
*/
//OVERRIDE Rich URL to change on every page.
add_filter("option_rich_url_value", function(){
	return get_permalink();
});

if (!function_exists('console_log')) {
	/**
	 * Output a formatted array for debugging
	 *
	 * @param $data
	 */
	function console_log($data)
	{
		echo '<script>console.log(' .json_encode($data) .')</script>';
	}
}

// custom ip for local requests to speed response times when building the cache
add_filter('http_api_curl', 'custom_http_api_curl_options', 0, 3);

function custom_http_api_curl_options($handle, $r, $url) {
    $hostname = 'www.boundlessjourneys.com'; 
    $custom_ip = '127.0.0.1'; 

    // Check if the request URL matches the specific hostname
    if (strpos($url, $hostname) !== false) {
        // Set CURLOPT_RESOLVE option to resolve the hostname to a custom IP
		curl_setopt($handle, CURLOPT_RESOLVE, [
			"$hostname:443:$custom_ip",
			"$hostname:80:$custom_ip"
		]);
		curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);		
    }

    return $handle;
}

add_filter('gform_pre_render_26', 'populate_trips_dropdown');
add_filter('gform_pre_submission_filter_26', 'populate_trips_dropdown');
add_filter('gform_pre_validation_26', 'populate_trips_dropdown');
function populate_trips_dropdown($form) {
  $field_id     = 38;
  $date_id      = 47;
  $trip_id      = isset($_GET['trip_id']) ? intval($_GET['trip_id']) : '';
  $idsArray     = [];
  foreach ($form['fields'] as &$field) {
    if ($field->id == $field_id) {

      $trips = get_posts([
          'post_type'         => 'vtc_trip',
          'post_status'       => 'publish',
          'posts_per_page'    => -1,
          'suppress_filters'  => true,
          'orderby'           => 'title',
          'order'             => 'ASC',
      ]);      
      
      $choices[] = [
        'text'        => "Please Select",
        'value'       => '',
        'isSelected'  => ''
      ];
      foreach ($trips as $trip) {
          if (stripos($trip->post_title, 'custom') !== false) {
              continue;
          }

          $choices[] = [
              'text' => $trip->post_title,
              'value' => $trip->post_title,
              'isSelected' => ($trip_id == $trip->ID),
              'customData' => $trip->ID
          ];
          
          if (html_entity_decode(strtolower(trim($_REQUEST['input_38']))) === html_entity_decode(strtolower(trim($trip->post_title)))) {
            $idsArray[] = $trip->ID;
          } else  {
            $idsArray[] = $trip->ID;
          }
      }

      $choices[] = [
          'text' => 'Custom',
          'value' => 'Custom'
      ];

      $field->choices = $choices;
    } else if ($field->id == $date_id) {
      $dates[] = [
        'text'        => "Please Select",
        'value'       => '',
        'isSelected'  => ''
      ];

      foreach ($idsArray as $tripId ) {
        $trip_dates = get_field('trip_dates', $tripId);

        foreach ($trip_dates as $date) {
          if (isset($date['start_date'])) {
            $dates[] = [
              'text'        => $date['start_date'],
              'value'       => $date['start_date'],
              'isSelected'  => $date['start_date'] == $_REQUEST['input_47'],
              'customData'  => $tripId
            ];
          }
        }
      }
      $dates[] = [
        'text'        => "Please Call For Dates",
        'value'       => 'Please Call For Dates',
        'isSelected'  => ''
      ];
      
      $field->choices = $dates;
    }
  }

  return $form;
}

add_action('wp_ajax_send_email_on_field_fill', 'send_email_on_field_fill');
add_action('wp_ajax_nopriv_send_email_on_field_fill', 'send_email_on_field_fill');
function send_email_on_field_fill() {
  
    if (isset($_POST['email']) && isset($_POST['fields'])) {
        $email = sanitize_email($_POST['email']);
        $fields = $_POST['fields'];
        
        $email_body = "The email field was filled with: {$email}\n\n";
        $email_body .= "Additional fields:\n";
        foreach ($fields as $fieldLabel => $fieldValue) {
            $email_body .= "{$fieldLabel}: {$fieldValue}\n";
        }
        
        $to = ['info@boundlessjourneys.com', 'jane@boundlessjourneys.com'];  
        $subject = 'Request a Reservation Email Trigger';
        $headers = ['Content-Type: text/plain; charset=UTF-8'];

        $success = wp_mail($to, $subject, $email_body, $headers);

        if ($success) {
            wp_send_json_success('Email sent successfully.');
        } else {
            wp_send_json_error('Failed to send email.');
        }
    } else {
        wp_send_json_error('Missing required data.');
    }

    wp_die();
}

add_filter('gform_field_choice_markup_pre_render', 'add_data_id_to_choices', 10, 4);
function add_data_id_to_choices($choice_markup, $choice, $field, $value) {
    if (isset($choice['customData'])) {
        $data_id = esc_attr($choice['customData']);
        $choice_markup = preg_replace(
            '/<option (.*?)>/',
            '<option $1 data-id="' . $data_id . '">',
            $choice_markup
        );
    }

    return $choice_markup;
}



function get_trip_start_dates() {
  if (!isset($_POST['trip_id'])) {
      wp_send_json_error(['message' => 'Invalid Request']);
  }

  $trip_id = intval($_POST['trip_id']);
  $trip_dates = get_field('trip_dates', $trip_id);

  $dates = [];

  if ($trip_dates) {
      foreach ($trip_dates as $trip) {
          if (!empty($trip['start_date'])) {
              $dates[] = esc_html($trip['start_date']);
          }
      }
  }

  if (!empty($dates)) {
      wp_send_json_success(['dates' => $dates]);
  } else {
      wp_send_json_error(['message' => 'No dates available']);
  }
}
add_action('wp_ajax_get_trip_start_dates', 'get_trip_start_dates');
add_action('wp_ajax_nopriv_get_trip_start_dates', 'get_trip_start_dates');


function enqueue_custom_scripts() {
  wp_localize_script('trip-script', 'ajaxurl', admin_url('admin-ajax.php'));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

// EOF
