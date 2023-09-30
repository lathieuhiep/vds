<?php
// Remove gutenberg widgets
add_filter('use_widgets_block_editor', '__return_false');

/* Better way to add multiple widgets areas */
function vds_widget_registration($name, $id, $description = ''): void {
	register_sidebar( array(
		'name' => $name,
		'id' => $id,
		'description' => $description,
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
}

function vds_multiple_widget_init(): void {
	vds_widget_registration( esc_html__('Sidebar Main', 'vds'), 'sidebar-main' );
	vds_widget_registration( esc_html__('Sidebar Shop', 'vds'), 'sidebar-wc', esc_html__('Display sidebar on page shop.', 'vds') );
	vds_widget_registration( esc_html__('Sidebar Product', 'vds'), 'sidebar-wc-product', esc_html__('Display sidebar on page single product.', 'vds') );

	vds_widget_registration( esc_html__('Sidebar Footer Column 1', 'vds'), 'sidebar-footer-column-1' );
	vds_widget_registration( esc_html__('Sidebar Footer Column 2', 'vds'), 'sidebar-footer-column-2' );
	vds_widget_registration( esc_html__('Sidebar Footer Column 3', 'vds'), 'sidebar-footer-column-3' );
	vds_widget_registration( esc_html__('Sidebar Footer Column 4', 'vds'), 'sidebar-footer-column-4' );
}

add_action('widgets_init', 'vds_multiple_widget_init');