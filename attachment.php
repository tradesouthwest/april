<?php
/**
 * The single attachment template file
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
			if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
				<div class="ctasection">        
				
					<?php dynamic_sidebar( 'sidebar-4' ); ?>
	                
    	        </div>
            <?php endif; ?>
        </div><!-- ends herocall and ctasection -->

            <main id="main" class="main main-content">
            
			<?php if ( have_posts() ) : ?>

				<?php
				// Start the loop.
				while ( have_posts() ) :
					the_post();
					
					get_template_part( 'content', 'attachment' );

					// End the loop.
				endwhile; ?>

                <aside class="aside-attachment-comments">

                    <?php comments_template(); ?>
                
                </aside>
            <?php 
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
