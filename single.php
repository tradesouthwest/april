<?php
/**
 * The single post template file
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package april
 * @since april 1.0
 */

get_header(); ?>

<div class="container">
   
    <section class="left-side">
	    <?php 
	    if ( april_theme_maybe_banner() ) 
		{ ?>
	   
	    <div class="herocall">

		    <div class="site-branding">

				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<p class="site-description"><?php echo esc_html__( get_bloginfo( 'description', 'display' ) ); ?></p>

			</div><!-- .site-branding -->
			<div class="ctasection">
			<?php 
			if ( is_active_sidebar( 'sidebar-cta' ) ) : ?>

					<?php dynamic_sidebar( 'sidebar-cta' ); ?>
    
			<?php else: 
			echo '<div class="nocta-blank">&nbsp;</div>';
			endif; ?>
			</div>

        </div><!-- ends herocall and ctasection -->
		
		<?php 
		} ?>

        <main id="main" class="main main-content">

				<?php
				// Start the loop.
				while ( have_posts() ) :
					the_post();
					
					get_template_part( 'content' );

				// End the loop.
				endwhile;
				?>
			    <?php 
				/* Add post type to next line if needed	*/
				if ( is_singular( array( 'post' ) ) ) : ?>
					<?php 
					// If comments are open or at least one comment exists, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					} 
					?>
					<div class="prev-next-links">
						<p><?php previous_post_link(); ?><span>&nbsp;</span><?php next_post_link(); ?></p>
					</div>
				
				<div class="april-recent-posts">
					
					<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
			    
				</div>
				<?php 
				endif; ?>
		</main>

	</section>

	<section class="right-side">
  
		<?php get_sidebar(); ?>
	
	</section>

</div>
<?php get_footer(); ?>