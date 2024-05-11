<?php
/**
 * The template part for displaying content
 *
 * @package april
 * @since april 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="content-title">
    <?php 
    the_title(
        sprintf( '<h2 class="card-title h4"><a href="%s" rel="bookmark">', 
        esc_attr( esc_url( get_permalink() ) ) 
        ),
        '</a></h2>'
    ); ?>
	</header>
	<div class="entry-content">
		<?php 
		the_excerpt(); 
		?>
	</div><!-- .entry-content -->
    <div class="after-entry">

        <?php do_action( 'april_theme_after_entry' ); ?>
        
    </div>
</article><!-- #post-## -->
