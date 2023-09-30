<?php
// A Custom function for get an option
if ( ! function_exists( 'vds_get_option' ) ) {
	function vds_get_option( $option = '', $default = null ) {
		$options = get_option( 'options' );

		return ( isset( $options[ $option ] ) ) ? $options[ $option ] : $default;
	}
}

// Control core classes for avoid errors
if ( class_exists( 'CSF' ) ) {
// Set a unique slug-like ID
	$vds_prefix   = 'options';
	$vds_my_theme = wp_get_theme();

	// Create options
	CSF::createOptions( $vds_prefix, array(
		'menu_title'          => esc_html__( 'Theme Options', 'vds' ),
		'menu_slug'           => 'theme-options',
		'menu_position'       => 2,
		'admin_bar_menu_icon' => 'dashicons-admin-generic',
		'framework_title'     => $vds_my_theme->get( 'Name' ) . ' ' . esc_html__( 'Options', 'vds' ),
		'footer_text'         => esc_html__( 'Thank you for using my theme', 'vds' ),
		'footer_after'        => '<pre>Contact me:<br />Zalo/Phone: 0975458209 - Skype: lathieuhiep - facebook: <a href="https://www.facebook.com/lathieuhiep" target="_blank">lathieuhiep</a></pre>',
	) );

	// Create a section general
	CSF::createSection( $vds_prefix, array(
		'title'  => esc_html__( 'General', 'vds' ),
		'icon'   => 'fas fa-cog',
		'fields' => array(
			// favicon
			array(
				'id'      => 'opt_general_favicon',
				'type'    => 'media',
				'title'   => esc_html__( 'Upload Image Favicon', 'vds' ),
				'library' => 'image',
				'url'     => false
			),

			// logo
			array(
				'id'      => 'opt_general_logo',
				'type'    => 'media',
				'title'   => esc_html__( 'Upload Image Logo', 'vds' ),
				'library' => 'image',
				'url'     => false
			),

			// show loading
			array(
				'id'         => 'opt_general_loading',
				'type'       => 'switcher',
				'title'      => esc_html__( 'website loader', 'vds' ),
				'text_on'    => esc_html__( 'Yes', 'vds' ),
				'text_off'   => esc_html__( 'No', 'vds' ),
				'text_width' => 80,
				'default'    => false
			),

			array(
				'id'         => 'opt_general_image_loading',
				'type'       => 'media',
				'title'      => esc_html__( 'Upload Image Loading', 'vds' ),
				'subtitle'   => esc_html__( 'Use file .git', 'vds' ) . ' <a href="https://loading.io/" target="_blank">loading.io</a>',
				'dependency' => array( 'opt_general_loading', '==', 'true' ),
				'url'        => false
			),

			// show back to top
			array(
				'id'         => 'opt_general_back_to_top',
				'type'       => 'switcher',
				'title'      => esc_html__( 'Use Back To Top', 'vds' ),
				'text_on'    => esc_html__( 'Yes', 'vds' ),
				'text_off'   => esc_html__( 'No', 'vds' ),
				'text_width' => 80,
				'default'    => true
			),
		)
	) );

	//
	// Create a section menu
	CSF::createSection( $vds_prefix, array(
		'title'  => esc_html__( 'Menu', 'vds' ),
		'icon'   => 'fas fa-bars',
		'fields' => array(
			// Sticky menu
			array(
				'id'         => 'opt_menu_sticky',
				'type'       => 'switcher',
				'title'      => esc_html__( 'Sticky menu', 'vds' ),
				'text_on'    => esc_html__( 'Yes', 'vds' ),
				'text_off'   => esc_html__( 'No', 'vds' ),
				'text_width' => 80,
				'default'    => true
			),

			// Show cart
			array(
				'id'         => 'opt_menu_cart',
				'type'       => 'switcher',
				'title'      => esc_html__( 'Cart', 'vds' ),
				'text_on'    => esc_html__( 'Yes', 'vds' ),
				'text_off'   => esc_html__( 'No', 'vds' ),
				'text_width' => 80,
				'default'    => true
			),
		)
	) );

	//
	// -> Create a section blog
	CSF::createSection( $vds_prefix, array(
		'id'    => 'opt_post_section',
		'icon'  => 'fas fa-blog',
		'title' => esc_html__( 'Post', 'vds' ),
	) );

	// Category Post
	CSF::createSection( $vds_prefix, array(
		'parent' => 'opt_post_section',
		'title'  => esc_html__( 'Category', 'vds' ),
		'description' => esc_html__( 'Use for archive, index, page search', 'vds' ),
		'fields' => array(
			// Sidebar
			array(
				'id'      => 'opt_post_cat_sidebar_position',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar position', 'vds' ),
				'options' => array(
					'hide'  => esc_html__( 'Hide', 'vds' ),
					'left'  => esc_html__( 'Left', 'vds' ),
					'right' => esc_html__( 'Right', 'vds' ),
				),
				'default' => 'right'
			),

			// Per Row
			array(
				'id'      => 'opt_post_cat_per_row',
				'type'    => 'select',
				'title'   => esc_html__( 'Blog Per Row', 'vds' ),
				'options' => array(
					'3' => esc_html__( '3 Column', 'vds' ),
					'4' => esc_html__( '4 Column', 'vds' ),
				),
				'default' => '3'
			),
		)
	) );

	// Single Post
	CSF::createSection( $vds_prefix, array(
		'parent' => 'opt_post_section',
		'title'  => esc_html__( 'Single', 'vds' ),
		'fields' => array(
			array(
				'id'      => 'opt_post_single_sidebar_position',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar position', 'vds' ),
				'options' => array(
					'hide'  => esc_html__( 'Hide', 'vds' ),
					'left'  => esc_html__( 'Left', 'vds' ),
					'right' => esc_html__( 'Right', 'vds' ),
				),
				'default' => 'right'
			),

			// Show related post
			array(
				'id'         => 'opt_post_single_related',
				'type'       => 'switcher',
				'title'      => esc_html__( 'Show related post', 'vds' ),
				'text_on'    => esc_html__( 'Yes', 'vds' ),
				'text_off'   => esc_html__( 'No', 'vds' ),
				'default'    => true,
				'text_width' => 80
			),

			// Limit related post
			array(
				'id'      => 'opt_post_single_related_limit',
				'type'    => 'number',
				'title'   => esc_html__( 'Limit related post', 'vds' ),
				'default' => 3,
			),
		)
	) );

	//
	// Create a section social network
	CSF::createSection( $vds_prefix, array(
		'title'  => esc_html__( 'Social Network', 'vds' ),
		'icon'   => 'fab fa-hive',
		'fields' => array(
			array(
				'id'      => 'opt_social_network',
				'type'    => 'repeater',
				'title'   => esc_html__( 'Social Network', 'vds' ),
				'fields'  => array(
					array(
						'id'      => 'icon',
						'type'    => 'icon',
						'title'   => esc_html__( 'Icon', 'vds' ),
						'default' => 'fab fa-facebook-f'
					),

					array(
						'id'    => 'url',
						'type'  => 'text',
						'title' => esc_html__('URL', 'vds'),
						'default' => '#'
					),
				),
				'default' => array(
					array(
						'icon' => 'fab fa-facebook-f',
						'url' => '#',
					),

					array(
						'icon' => 'fab fa-youtube',
						'url' => '#',
					),
				)
			),
		)
	) );

	//
	//  Create a section shop
	CSF::createSection( $vds_prefix, array(
		'id'    => 'opt_shop_section',
		'title'  => esc_html__( 'Shop', 'vds' ),
		'icon'   => 'fas fa-shopping-cart',
	) );

	// Category product
	CSF::createSection( $vds_prefix, array(
		'parent' => 'opt_shop_section',
		'title'  => esc_html__( 'Category', 'vds' ),
		'description' => esc_html__( 'Use for shop category and tag', 'vds' ),
		'fields' => array(
			// Sidebar
			array(
				'id'      => 'opt_shop_cat_sidebar_position',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar position', 'vds' ),
				'options' => array(
					'hide'  => esc_html__( 'Hide', 'vds' ),
					'left'  => esc_html__( 'Left', 'vds' ),
					'right' => esc_html__( 'Right', 'vds' ),
				),
				'default' => 'left'
			),

			// Limit
			array(
				'id'      => 'opt_shop_cat_limit',
				'type'    => 'number',
				'title'   => esc_html__( 'Limit Product', 'vds' ),
				'default' => 12,
			),

			// Per Row
			array(
				'id'      => 'opt_shop_cat_per_row',
				'type'    => 'select',
				'title'   => esc_html__( 'Products Per Row', 'vds' ),
				'options' => array(
					'3' => esc_html__( '3 Column', 'vds' ),
					'4' => esc_html__( '4 Column', 'vds' ),
					'5' => esc_html__( '5 Column', 'vds' ),
				),
				'default' => '4'
			),
		)
	) );

	// Single product
	CSF::createSection( $vds_prefix, array(
		'parent' => 'opt_shop_section',
		'title'  => esc_html__( 'Single', 'vds' ),
		'description' => esc_html__( 'Use for single product', 'vds' ),
		'fields' => array(
			// Sidebar
			array(
				'id'      => 'opt_shop_single_sidebar_position',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar position', 'vds' ),
				'options' => array(
					'hide'  => esc_html__( 'Hide', 'vds' ),
					'left'  => esc_html__( 'Left', 'vds' ),
					'right' => esc_html__( 'Right', 'vds' ),
				),
				'default' => 'left'
			)
		)
	) );

	//
	// -> Create a section footer
	CSF::createSection( $vds_prefix, array(
		'id'    => 'opt_footer_section',
		'icon'  => 'fas fa-stream',
		'title' => esc_html__( 'Footer', 'vds' ),
	) );

	// footer columns
	CSF::createSection( $vds_prefix, array(
		'parent' => 'opt_footer_section',
		'title'  => esc_html__( 'Columns Sidebar', 'vds' ),
		'fields' => array(
			// select columns
			array(
				'id'      => 'opt_footer_columns',
				'type'    => 'select',
				'title'   => esc_html__( 'Number of footer columns', 'vds' ),
				'options' => array(
					'0' => esc_html__( 'Hide', 'vds' ),
					'1' => 1,
					'2' => 2,
					'3' => 3,
					'4' => 4,
				),
				'default' => '4'
			),

			// column width 1
			array(
				'id'         => 'opt_footer_column_width_1',
				'type'       => 'slider',
				'title'      => esc_html__( 'Column width 1', 'vds' ),
				'default'    => 3,
				'min'        => 1,
				'max'        => 12,
				'dependency' => array( 'opt_footer_columns', '!=', '0' )
			),

			// column width 2
			array(
				'id'         => 'opt_footer_column_width_2',
				'type'       => 'slider',
				'title'      => esc_html__( 'Column width 2', 'vds' ),
				'default'    => 3,
				'min'        => 1,
				'max'        => 12,
				'dependency' => array( 'opt_footer_columns', 'not-any', '0,1' )
			),

			// column width 3
			array(
				'id'         => 'opt_footer_column_width_3',
				'type'       => 'slider',
				'title'      => esc_html__( 'Column width 3', 'vds' ),
				'default'    => 3,
				'min'        => 1,
				'max'        => 12,
				'dependency' => array( 'opt_footer_columns', 'not-any', '0,1,2' )
			),

			// column width 4
			array(
				'id'         => 'opt_footer_column_width_4',
				'type'       => 'slider',
				'title'      => esc_html__( 'Column width 4', 'vds' ),
				'default'    => 3,
				'min'        => 1,
				'max'        => 12,
				'dependency' => array( 'opt_footer_columns', 'not-any', '0,1,2,3' )
			),
		)
	) );

	// Copyright
	CSF::createSection( $vds_prefix, array(
		'parent' => 'opt_footer_section',
		'title'  => esc_html__( 'Copyright', 'vds' ),
		'fields' => array(
			// show
			array(
				'id'         => 'opt_footer_copyright_show',
				'type'       => 'switcher',
				'title'      => esc_html__( 'Show copyright', 'vds' ),
				'text_on'    => esc_html__( 'Yes', 'vds' ),
				'text_off'   => esc_html__( 'No', 'vds' ),
				'text_width' => 80,
				'default'    => true
			),

			// content
			array(
				'id'      => 'opt_footer_copyright_content',
				'type'    => 'wp_editor',
				'title'   => esc_html__( 'Content', 'vds' ),
				'media_buttons' => false,
				'default' => esc_html__( 'Copyright &copy; DiepLK', 'vds' )
			),
		)
	) );
}