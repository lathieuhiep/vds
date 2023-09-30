<?php
add_action('cmb2_admin_init', 'vds_post_meta_boxes');
function vds_post_meta_boxes(): void {
    $cmb = new_cmb2_box(array(
        'id' => 'vds_cmb_post',
        'title' => esc_html__('Option metabox', 'vds'),
        'object_types' => array('post'),
        'context' => 'normal',
        'priority' => 'low',
        'show_names' => true,
    ));

    $cmb->add_field( array(
        'id'   => 'vds_cmb_post_title',
        'name' => esc_html__( 'Test Title', 'vds' ),
        'type' => 'title',
        'desc' => esc_html__( 'This is a title description', 'vds' ),
    ) );
}