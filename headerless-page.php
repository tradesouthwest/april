<?php
/**
 * Template Name: Headerless Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package april
 * @since april 1.0
 */

get_header(); ?>

<div class="container">
   
    <section class="left-side">

        <main id="main" class="main main-content">
            
			<?php if ( have_posts() ) : ?>

				<?php
				// Start the loop.
				while ( have_posts() ) :
					the_post();
					
					get_template_part( 'content' );

					// End the loop.
				endwhile;

				// Previous/next page navigation.
				the_posts_pagination(
					array(
						'prev_text'          => esc_html__( 'Previous page', 'april' ),
						'next_text'          => esc_html__( 'Next page', 'april' ),
						'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'april' ) . ' </span>',
					)
				); ?>
			<?php 
			else: ?>
                <hr>
			<?php
			endif; ?>

		</main>

	</section>

	<section class="right-side">
  
		<?php get_sidebar(); ?>
	
	</section>

</div>
<?php get_footer(); ?>
