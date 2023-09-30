<?php
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php if ( have_comments() ) : ?>
        <h2 class="comments-area__title">
            <?php
            $vds_comments_number = get_comments_number();

            if ( $vds_comments_number == 1 ) :
                /* translators: %s: post title */
                printf(_x('One Reply to &ldquo;%s&rdquo;', 'comments title', 'vds'), get_the_title());
            else :
                printf(
                /* translators: 1: number of comments, 2: post title */
                    _nx(
                        '%1$s Reply to &ldquo;%2$s&rdquo;',
                        '%1$s Replies to &ldquo;%2$s&rdquo;',
                        $vds_comments_number,
                        'comments title',
                        'vds'
                    ),
                    number_format_i18n($vds_comments_number),
                    get_the_title()
                );
            endif;
            ?>
        </h2>

        <?php vds_comment_nav(); ?>

        <ul class="comments-area__list">
            <?php
            wp_list_comments(array(
                'type' => 'comment',
                'short_ping' => true,
                'avatar_size' => 60,
                'callback' => 'vds_comments'
            ));
            ?>
        </ul>
    <?php
        vds_comment_nav();
    endif;

    if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
    ?>
        <p class="no-comments">
            <?php esc_html_e('Comments are closed.', 'vds'); ?>
        </p>
    <?php
    endif;

    $vds_commenter = wp_get_current_commenter();
    $vds_req = get_option('require_name_email');
    $vds_comments_args = ($vds_req ? " aria-required='true'" : '');

    $vds_comments_args = array(
        'title_reply' => '<span>' . esc_html__('Leave a comment', 'vds') . '</span>',
        'fields' => apply_filters('comment_form_default_fields',
            array(
                'comment_notes_before' => '<div class="comment-fields-row order-1"><div class="row">',
                'author' => '<div class="col-12 col-sm-6 col-md-6"><div class="form-comment-item"><input id="author" placeholder="' . esc_html__('Full Name', 'vds') . '" class="form-control" name="author" type="text" value="' . esc_attr($vds_commenter['comment_author']) . '" size="30" ' . $vds_comments_args . ' /></div></div>',
                'email' => '<div class="col-12 col-sm-6 col-md-6"><div class="form-comment-item"><input id="email" placeholder="' . esc_html__('Your Email', 'vds') . '" class="form-control" name="email" type="text" value="' . esc_attr($vds_commenter['comment_author_email']) . '" size="30" ' . $vds_comments_args . ' /></div></div>',
                'comment_notes_after' => '</div></div>',
            )
        ),
        'comment_field' => '<div class="form-comment-item form-comment-field order-3"><textarea rows="7" id="comment" placeholder="' . esc_html__('Comment', 'vds') . '" name="comment" class="form-control"></textarea></div>',
    );

    comment_form($vds_comments_args);
    ?>
</div>
