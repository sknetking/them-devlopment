<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package UpConstruction
 */

get_header();
?>
<main id="primary" class="site-main main">
<!-- Page Title -->
<div class="page-title" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/page-title-bg.jpg');">
  <div class="container position-relative">
	<h1><?php the_title();?></h1>
	<?php if (function_exists('the_breadcrumb')) the_breadcrumb(); ?>

  </div>
</div><!-- End Page Title -->
<?php
		
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
