<?php
/**
 * Template Name: Fullwidth Template
 *
 * The template for the full-width page.
 *
 * @package Hestia
 * @since Hestia 1.0
 */

get_header();
	hestia_output_wrapper_header_start( false ); ?>
		<div class="container">
			<div class="row">
				<div class="col-md-10 col-md-offset-1 text-center">
					<?php single_post_title( '<h1 class="hestia-title">', '</h1>' ); ?>
				</div>
			</div>
		</div>
	</div>
</header>
<div class="<?php echo hestia_layout(); ?>">
	<div class="blog-post">
		<div class="container">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/content-fullwidth', 'page' );
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				endwhile;
			else :
				get_template_part( 'template-parts/content', 'none' );
			endif;
			?>
		</div>
	</div>

	<?php get_footer(); ?>
