<?php
/**
 * The pages template file
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package april
 * @since april 1.0
 */

get_header(); ?>

<div class="container">
   
    <section class="left-side">
	   
	    <div class="herocall">

		    <div class="site-branding">

				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<p class="site-description"><?php echo esc_html__( get_bloginfo( 'description', 'display' ) ); ?></p>

			</div><!-- .site-branding -->
			<?php 
			if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
				<div class="ctasection">        
				
					<?php dynamic_sidebar( 'sidebar-2' ); ?>
	                
    	        </div>
			<?php 
			endif; ?>

        </div><!-- ends herocall and ctasection -->

            <main id="main" class="main main-content">
            
			<?php if ( have_posts() ) : ?>

				<?php
				// Start the loop.
				while ( have_posts() ) :
					the_post();
					
					get_template_part( 'content' );

				// End the loop.
				endwhile; 
				else: 
			?>
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
