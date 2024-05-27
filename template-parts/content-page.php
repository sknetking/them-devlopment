<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package UpConstruction
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'upconstruction' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
<div class="container">
      <div class="row">

        <div class="col-lg-8">

          <!-- Blog Details Section -->
          <div id="blog-details" class="blog-details section">
            <div class="container">

              <article class="article">

                <div class="post-img">
				<?php upconstruction_post_thumbnail("img-fluid"); ?>
                 
                </div>

                <h2 class="title"><?php the_title();?></h2>
                
                <div class="meta-top">
    <ul>
        <li class="d-flex align-items-center">
            <i class="bi bi-person"></i>
            <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                <?php the_author(); ?>
            </a>
        </li>
        <li class="d-flex align-items-center">
            <i class="bi bi-clock"></i>
            <a href="<?php the_permalink(); ?>">
                <time datetime="<?php echo get_the_date('c'); ?>">
                    <?php echo get_the_date(); ?>
                </time>
            </a>
        </li>
        <li class="d-flex align-items-center">
            <i class="bi bi-chat-dots"></i>
            <a href="<?php comments_link(); ?>">
                <?php
                $comment_count = get_comments_number();
                printf(_n('%s Comment', '%s Comments', $comment_count, 'text-domain'), number_format_i18n($comment_count));
                ?>
            </a>
        </li>
    </ul>
</div><!-- End meta top -->


                <div class="content">
                  <?php the_content();
				 wp_link_pages(
						 array(
							 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'upconstruction' ),
							 'after'  => '</div>',
						 )
					 );
					 
				  ?>
                </div><!-- End post content -->

                <div class="meta-bottom">
    <i class="bi bi-folder"></i>
    <ul class="cats">
        <?php
        // Fetch and display categories
        $categories = get_the_category();
        if ( ! empty( $categories ) ) {
            foreach ( $categories as $category ) {
                echo '<li><a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a></li>';
            }
        }
        ?>
    </ul>

    <i class="bi bi-tags"></i>
    <ul class="tags">
        <?php
        // Fetch and display tags
        $post_tags = get_the_tags();
        if ( ! empty( $post_tags ) ) {
            foreach ( $post_tags as $tag ) {
                echo '<li><a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '">' . esc_html( $tag->name ) . '</a></li>';
            }
        }
        ?>
    </ul>
</div>
<!-- End meta bottom -->


              </article>

            </div>
          </div><!-- /Blog Details Section -->

          <!-- Blog Author Section -->
		  <section id="blog-author" class="blog-author section">
    <div class="container">
        <div class="author-container d-flex align-items-center">
            <?php
            $author_id = get_the_author_meta('ID');
            $author_name = get_the_author_meta('display_name', $author_id);
            $author_bio = get_the_author_meta('description', $author_id);
            $author_avatar = get_avatar_url($author_id, ['size' => '150']);
            $author_twitter = get_the_author_meta('twitter', $author_id);
            $author_facebook = get_the_author_meta('facebook', $author_id);
            $author_instagram = get_the_author_meta('instagram', $author_id);
            ?>

            <img src="<?php echo esc_url($author_avatar); ?>" class="rounded-circle flex-shrink-0" alt="<?php echo esc_attr($author_name); ?>">
            <div>
                <h4><?php echo esc_html($author_name); ?></h4>
                <div class="social-links">
                    <?php if ($author_twitter) : ?>
                        <a href="<?php echo esc_url($author_twitter); ?>"><i class="bi bi-twitter"></i></a>
                    <?php endif; ?>
                    <?php if ($author_facebook) : ?>
                        <a href="<?php echo esc_url($author_facebook); ?>"><i class="bi bi-facebook"></i></a>
                    <?php endif; ?>
                    <?php if ($author_instagram) : ?>
                        <a href="<?php echo esc_url($author_instagram); ?>"><i class="bi bi-instagram"></i></a>
                    <?php endif; ?>
                </div>
                <p><?php echo esc_html($author_bio); ?></p>
            </div>
        </div>
    </div>
</section>

		<!-- /Blog Author Section -->

          <!-- Blog Comments Section -->

         <!-- /Blog Comments Section -->

</div>

        <div class="col-lg-4 sidebar">

          <div class="widgets-container">

            <!-- Search Widget -->
			<aside id="secondary" class="widget-area container">
				<?php dynamic_sidebar( 'sidebar-1' ); ?>
			</aside><!-- #secondary -->

          </div>

        </div>

      </div>
    </div>