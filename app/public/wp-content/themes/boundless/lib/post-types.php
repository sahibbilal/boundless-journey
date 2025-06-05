<?php

function create_segments(){
	register_post_type(
		'pagesegment',
		array(
			'labels' => array(
					'name' => __('Page Segments'),
					'singular_name' => __('Page Segment')
				),
			'public' => true,
			//'has_archive' => false,
			//'exclude_from_search' => true,
			//'publicly_queryable'  => false,
			'supports' => array('title'),
		)
	);


	register_post_type(
		'repeatedcontent',
		array(
			'labels' => array(
					'name' => __('Common Content'),
					'singular_name' => __('Common Content')
				),
			'public' => true,
			//'has_archive' => false,
			//'exclude_from_search' => true,
			//'publicly_queryable'  => false,
			'supports' => array('title'),
			'rewrite'  => array(
				'slug'        => 'commoncontent',
				'with_front'  => false,
    		),
		)
	);
}


add_action('init', 'create_segments');

function mediagallery(){
	register_post_type( 'mediagallery',
		array(
			'labels' => array(
				'name'                => __( 'Media Gallery' ),
				'singular_name'       => __( 'Press Release' ),
				'menu_name'           => __( 'Media Gallery' ),
			),
			'public' => true,
			'rewrite' => array(
				'slug'=>'press-release',
				'with_front' => false
				),

		)
	);
}
add_action('init', 'mediagallery');



