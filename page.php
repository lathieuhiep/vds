<?php
get_header();

$vds_check_elementor =   get_post_meta( get_the_ID(), '_elementor_edit_mode', true );

$vds_class_elementor =   '';

if ( $vds_check_elementor ) :
    $vds_class_elementor =   ' site-container-elementor';
endif;
?>

    <main class="site-container<?php echo esc_attr( $vds_class_elementor ); ?>">
        <?php
        if ( $vds_check_elementor ) :
            get_template_part('template-parts/page/content','page-elementor');
        else:
            get_template_part('template-parts/page/content','page');
        endif;
        ?>
    </main>

<?php 

get_footer();