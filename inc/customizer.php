<?php
/**
 * April Customizer functionality
 *
 * @package april
 * @since april 1.0
 */

/**
 * Page options settings
 */

// A1
add_action( 'wp_enqueue_scripts', 'april_theme_customizer_css', 15 );  
// A2
add_action( 'customize_register', 'april_register_theme_customizer_setup' );
// A3
add_action( 'after_setup_theme', 'april_custom_header_and_background' );

/**
 * Text sanitizer for numeric values
 * @since 1.0
 * @see https://themefoundation.com/wordpress-theme-customizer/
 * @return string $input
 */
function april_sanitize_integer( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
} 

/** A1
 * CUSTOM FONT OUTPUT, CSS
 * 
 * set values into inline styles
 * @since 1.0.0
*/
function april_theme_customizer_css() 
{   
    $fnt = $font = ''; $gen_colr = '#494949'; 
    $hcdf  = get_template_directory_uri() . '/rels/swimmers-wide-default.jpg';
    $hsdf  = get_stylesheet_directory_uri() . '/';
    
    if( get_theme_mods() ) : 
	$fntfamily  = ( empty( get_theme_mod( 'april_fontfamily' ) ) ) 
		        ? 'sans-serif' 
				: wp_strip_all_tags( get_theme_mod( 'april_fontfamily' ) );
    // background image
	$herouri  = ( empty( get_theme_mod( 'april_herocall' ) ) ) 
	            ? esc_url( $hcdf ) : get_theme_mod( 'april_herocall' );
	// hero background size
	$herobksize  = ( empty( get_theme_mod( 'april_herobksize' ) ) ) 
	            ? 'cover' : get_theme_mod( 'april_herobksize' );
	
	// site title color
	$siteta     = ( empty( get_theme_mod( 'april_siteta' ) ) ) 
	            ? '#ffffff' : get_theme_mod( 'april_siteta' );
	// april_ctaposit
	$ctaposit   = ( empty( get_theme_mod( 'april_ctaposit' ) ) ) 
	            ? '100' : get_theme_mod( 'april_ctaposit' );
    $rlp        = ( empty( get_theme_mod( 'april_rlposit' ) ) ) ? '10' 
                         : get_theme_mod( 'april_rlposit' );
    $rtp        = ( empty( get_theme_mod( 'april_rtposit' ) ) ) ? '10' 
                         : get_theme_mod( 'april_rtposit' );
    $maxw       = ( empty( get_theme_mod( 'april_maxwidth' ) ) ) ? '1200' 
                         : get_theme_mod( 'april_maxwidth' );
    endif;
    $cssstyles = 
	'body, button, input, select, textarea, p{ font-family: '. esc_attr( $fntfamily ) .';}
	.site-title, .site-description{ position: relative; left: '. esc_attr( $rlp ) .'px; top: '. esc_attr( $rtp ) .'px;}
	.site-title a, site-description{ color: ' . esc_attr( $siteta ) .';}
	.current_page_item a, .current_page_ancestor a{background: rgba(252,252,252, .8);}
        .herocall{background-image: url('. $herouri . '); background-size: '.esc_attr($herobksize).';}
	.ctasection{margin-left: '.esc_attr( $ctaposit ) .'%}
        .page article.page, .single article.post{max-width: '. esc_attr( $maxw ) .'px;margin: 0 auto;}';
        wp_register_style( 'april-inline-customizer', true );
	wp_enqueue_style( 'april-inline-customizer' );
	wp_add_inline_style( 'april-inline-customizer', $cssstyles );
}
/**
 * Add section to the Options menu.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 * @since 1.0.0
*/

function april_register_theme_customizer_setup($wp_customize)
{
	$transport = ( $wp_customize->selective_refresh ? 'postMessage' : 'refresh' );
    $herodft = get_template_directory_uri() . '/rels/swimmers-wide-default.jpg';
    // Theme font choice section
    $wp_customize->add_section( 'april_general', array(
        'title'       => __( 'April Theme Settings', 'april' ),
        'capability'  => 'edit_theme_options',
		'priority'    => 20
    ) );

	//-----------------Settings and Controls -----------
	$wp_customize->add_setting( 'april_siteta', array(
		'type'           => 'theme_mod',
		'default'          => '#ffffff',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'          => 'refresh'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( 
		$wp_customize, 'april_siteta', array(
		'label'  => esc_attr__( 'Site Title Color', 'april' ),
		'section' => 'title_tagline',
		'settings'  => 'april_siteta'
	    ) ) 
    );
	
	$wp_customize->add_setting( 'april_tposit', array(
		'type'            => 'theme_mod',
		'default'          => 'center',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'          => 'refresh'
	));
	$wp_customize->add_control( 'april_tposit', array(
		'label'    => 'Text Alignment for title',
		'section'   => 'title_tagline',
		'settings'   => 'april_tposit',
		'description' => __( 'Position of title.', 'april'),
		'type'         => 'select',
		'choices'  => array(
			'left'  => 'Left',
			'center' => 'Center',
			'right'   => 'Right',
			'relative' => 'Relative',
			)
	));
	// relative top and relative left
	$wp_customize->add_setting( 'april_rtposit', array(
		'type'              => 'theme_mod',
		'default'           => '0',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh'
	));
	$wp_customize->add_control( 'april_rtposit', array(
		'label'    => 'Top Adjustment',
		'section'   => 'title_tagline',
		'settings'   => 'april_rtposit',
		'description' => __( 'Alignment must be set to Relative.', 'april'),
		'type'         => 'number'
	));
	$wp_customize->add_setting( 'april_rlposit', array(
		'type'              => 'theme_mod',
		'default'           => '0',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh'
	));
	$wp_customize->add_control( 'april_rlposit', array(
		'label'   => 'Left Adjustment',
		'section'  => 'title_tagline',
		'settings'  => 'april_rlposit',
		'description' => esc_html__( 'Alignment must be set to Relative.', 'april'),
		'type'        => 'number'
	));

	// Add setting & control for font type
	$wp_customize->add_setting( 
        'april_fontfamily', array(
		'type'              => 'theme_mod',
		'default'           => 'sans-serif',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh'
	));
	$wp_customize->add_control( 'april_fontfamily', array(
		'label'   => 'Font for Content',
		'section'  => 'april_general',
		'settings'  => 'april_fontfamily',
		'description' => esc_html__( 'Choose the font family type.', 'april'),
		'type'        => 'select',
    	'choices'     => array(
			'inherit'    => esc_attr__( 'Select font', 'apriil' ),
        	'sans-serif' => esc_attr__( 'Sans Serif', 'april'),
			'serif'      => esc_attr__( 'Serif', 'april'),
			'Helvetica'  => esc_attr__( 'Helvetica', 'april'),
			'Arial'      => esc_attr__( 'Arial', 'april'),
			'monospace'  => esc_attr__( 'Monospace', 'april'),
        	)
	));
	// Setting: Upload.
	$wp_customize->add_setting( 'april_herocall', array(
		'type'                 => 'theme_mod',
		'default'              => esc_url( $herodft ),
		'transport'            => 'refresh', 
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'sanitize_text_field'
	) );
	// Control: Image.
	$wp_customize->add_control( new WP_Customize_Image_Control(
		$wp_customize,
		'april_herocall',
		array(
			'label'      => esc_attr__( 'Upload Hero Image', 'april' ),
			'section'    => 'april_general'
		)
	) );
	$wp_customize->add_setting( 
			'april_herobksize', array(
			'type'              => 'theme_mod',
			'default'           => 'cover',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh'
	));
	$wp_customize->add_control( 'april_herobksize', array(
		'label'    => 'Position for Image',
		'section'   => 'april_general',
		'settings'   => 'april_herobksize',
		'description' => esc_html__( 'Position of background image.', 'april'),
		'type'         => 'select',
		'choices'      => array(
			'cover'    => esc_attr__( 'Cover', 'april'),
			'contain'  => esc_attr__( 'Contain', 'april'),
			'29% auto' => esc_attr__( 'Half', 'april'),
			'100%'     => esc_attr__( 'Over Size', 'april'),
			)
	));
	$wp_customize->add_setting( 
		'april_ctaposit', array(
		'type'            => 'theme_mod',
		'default'          => '51',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'          => 'refresh'
	));
	$wp_customize->add_control( 'april_ctaposit', array(
		'label'   => 'Position for Buttons',
		'section'  => 'april_general',
		'settings'  => 'april_ctaposit',
		'description' => esc_html__( 'Position of CallToAction. (51=right; -12=left) Remember to select a Call To Action widget to display your content with.', 'april'),
		'type'         => 'number'
	));
	$wp_customize->add_setting( 
		'april_maybe_banner', array(
		'type'            => 'theme_mod',
		'default'          => true,
		'sanitize_callback' => 'sanitize_text_field',
		'transport'          => 'refresh'
	));
	$wp_customize->add_control( 'april_maybe_banner', array(
		'label'   => 'Hero from Single Posts',
		'section'  => 'april_general',
		'settings'  => 'april_maybe_banner',
		'description' => esc_html__( 'Select how you want to show banner on single post pages.', 'april'),
		'type'        => 'select',
		'choices'     => array(
			true      => esc_attr__( 'Show Banner on Single Posts', 'april'),
			false     => esc_attr__( 'Do Not Show Banner on Posts', 'april')
			)
	));
	$wp_customize->add_setting( 
		'april_maxwidth', array(
		'type'            => 'theme_mod',
		'default'          => '1200',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'          => 'refresh'
	));
	$wp_customize->add_control( 'april_maxwidth', array(
		'label'   => 'Maximum Width of Content',
		'section'  => 'april_general',
		'settings'  => 'april_maxwidth',
		'description' => esc_html__( 'Sets the width of the aricles for pages and posts. (in pixels)', 'april'),
		'type'         => 'number'
	));

}

/**
 * Sets up the WordPress core custom header and custom background features.
 *
 * @since april 1.0
 *
 * @see april_header_style()
 */
function april_custom_header_and_background() {
	$default_background_color = 'fafafa';

	/**
	 * Filter the arguments used when adding 'custom-background' support in April.
	 *
	 * @since april 1.0
	 *
	 */
	add_theme_support(
		'custom-background',
		apply_filters(
			'april_custom_background_args',
			array(
				'default-color' => $default_background_color,
			)
		)
	);

}

/**
 * Adds postMessage support for site title and description for the Customizer.
 *
 * @since April 1.0
 *
 * @param WP_Customize_Manager $wp_customize The Customizer object.
 */
function april_customize_register( $wp_customize ) {
	//$color_scheme = 'default';

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'            => '.site-title a',
				'container_inclusive' => false,
				'render_callback'     => 'april_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'            => '.site-description',
				'container_inclusive' => false,
				'render_callback'     => 'april_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'april_customize_register', 11 );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since April 1.2
 * @see april_customize_register()
 *
 * @return void
 */
function april_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since April 1.2
 * @see april_customize_register()
 *
 * @return void
 */
function april_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since April 1.0
 */
function april_customize_preview_js() {
	wp_enqueue_script( 'april-customize-preview', 
						get_template_directory_uri() . '/rels/customize-preview.js', 
						array( 'customize-preview' ), 
						time(), 
						true 
					);
}
add_action( 'customize_preview_init', 'april_customize_preview_js' ); 
