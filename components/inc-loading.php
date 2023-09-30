<?php
$show_loading = vds_get_option( 'opt_general_loading', '0' );

if(  $show_loading == '1' ) :
    $opt_image_loading  = vds_get_option( 'opt_general_image_loading' );
?>
    <div id="site-loadding" class="d-flex align-items-center justify-content-center">
        <?php if ( !empty( $opt_image_loading['url'] ) ): ?>
            <img class="loading_img" src="<?php echo esc_url( $opt_image_loading['url'] ); ?>" alt="<?php esc_attr_e('loading...','vds') ?>"  >
        <?php else: ?>
            <img class="loading_img" src="<?php echo esc_url(get_theme_file_uri( '/assets/images/loading.gif' )); ?>" alt="<?php esc_attr_e('loading...','vds') ?>">
        <?php endif; ?>
    </div>
<?php endif; ?>