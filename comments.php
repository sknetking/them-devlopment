<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package UpConstruction
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */

if ( post_password_required() ) {
    return;
}
?>

<section id="blog-comments" class="blog-comments section">
    <div class="container">
        <?php
        if ( have_comments() ) :
            $upconstruction_comment_count = get_comments_number();
            ?>
            <h4 class="comments-count">
                <?php echo esc_html( sprintf( _n( '%s Comment', '%s Comments', $upconstruction_comment_count, 'upconstruction' ), number_format_i18n( $upconstruction_comment_count ) ) ); ?>
            </h4>
            
            <ol class="comment-list">
                <?php
                wp_list_comments( array(
                    'style'      => 'div',
                    'short_ping' => true,
                    'callback'   => 'custom_comments_callback'
                ) );
                ?>
            </ol>
            
            <?php the_comments_navigation(); ?>

            <?php if ( ! comments_open() ) : ?>
                <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'upconstruction' ); ?></p>
            <?php endif; ?>
            
        <?php endif; ?>

        <div class="reply-form">
            <h4><?php esc_html_e( 'Leave a Reply', 'upconstruction' ); ?></h4>
            <p><?php esc_html_e( 'Your email address will not be published. Required fields are marked *', 'upconstruction' ); ?></p>
            <?php
            $comment_form_args = array(
                'class_form'           => 'comment-form',
                'title_reply'          => '',
                'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'upconstruction' ),
                'cancel_reply_link'    => esc_html__( 'Cancel Reply', 'upconstruction' ),
                'label_submit'         => esc_html__( 'Post Comment', 'upconstruction' ),
                'comment_field'        => '<div class="row"><div class="col form-group"><textarea id="comment" name="comment" class="form-control" placeholder="' . esc_attr__( 'Your Comment*', 'upconstruction' ) . '" required></textarea></div></div>',
                'fields'               => apply_filters( 'comment_form_default_fields', array(
                    'author' => '<div class="row"><div class="col-md-6 form-group"><input id="author" name="author" type="text" class="form-control" placeholder="' . esc_attr__( 'Your Name*', 'upconstruction' ) . '" required></div>',
                    'email'  => '<div class="col-md-6 form-group"><input id="email" name="email" type="email" class="form-control" placeholder="' . esc_attr__( 'Your Email*', 'upconstruction' ) . '" required></div></div>',
                    'url'    => '<div class="row"><div class="col form-group"><input id="url" name="url" type="url" class="form-control" placeholder="' . esc_attr__( 'Your Website', 'upconstruction' ) . '"></div></div>',
                ) ),
            );
            comment_form( $comment_form_args );
            ?>
        </div>
    </div>
</section>

<?php

function custom_comments_callback( $comment, $args, $depth ) {
    $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
    ?>
    <<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? 'comment' : 'comment parent' ); ?> id="comment-<?php comment_ID(); ?>">
        <div class="d-flex">
            <div class="comment-img">
                <?php echo get_avatar( $comment, 64 ); ?>
            </div>
            <div>
                <h5><?php printf( '<a href="%s">%s</a>', esc_url( get_comment_link( $comment->comment_ID ) ), get_comment_author() ); ?> 
                <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" class="reply"><i class="bi bi-reply-fill"></i> <?php comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply', 'upconstruction' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></a></h5>
                <time datetime="<?php comment_time( 'c' ); ?>"><?php printf( esc_html__( '%1$s at %2$s', 'upconstruction' ), get_comment_date(), get_comment_time() ); ?></time>
                <?php if ( '0' === $comment->comment_approved ) : ?>
                    <p><em><?php esc_html_e( 'Your comment is awaiting moderation.', 'upconstruction' ); ?></em></p>
                <?php endif; ?>
                <p><?php comment_text(); ?></p>
            </div>
        </div>
    </<?php echo $tag; ?>>
    <?php
}
?>
