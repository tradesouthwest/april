<?php
/**
 * Options page functionality 
 * 
 * @package    ClassicPress
 * @subpackage April
 * @since      April 1.0.0
 */
add_action('admin_menu', 'april_create_theme_options_page');
add_action('admin_init', 'april_register_and_build_fields');

/**
 * Add theme menu
 *
 * @since 1.0.0
 * @uses add_theme_page()
 * $page_title, $menu_title, $capability, $menu_slug, $function
 */
function april_create_theme_options_page() {
   add_theme_page( esc_html__( 'Theme Help', 'april' ), 
                  esc_html__( 'Theme Help', 'april' ), 
                  'administrator', 
                  __FILE__, 
                  'april_options_page_fn'
                );
}

// Builds fields
function april_register_and_build_fields() {
   register_setting('april_theme_info', 'april_theme_info', 'validate_setting');

   add_settings_section('main_section', 
                        'Main Settings', 'april_section_cb', __FILE__);
   add_settings_field('april_ad_one', esc_html__( 'Basic Info', 'april' ),
                      'april_ad_setting_one', __FILE__, 
                      'main_section');
   add_settings_field('april_ad_two', esc_html__( 'Customizer Link', 'april' ), 
                      'april_ad_setting_two', __FILE__, 
                      'main_section'); 
}

// Render Options page
function april_options_page_fn() {
?>
    <div id="theme-options-wrap" class="widefat">
        <div class="icon32" id="icon-tools"></div>

        <h2><?php esc_html_e( 'April Theme Guide', 'april' ); ?></h2>
        <p><?php esc_html_e( 'General Help', 'april' ); ?></p>

        <form method="post" action="options.php" enctype="multipart/form-data">
            <?php settings_fields('april_theme_info'); ?>
            <?php do_settings_sections(__FILE__); ?>
        </form>
        <style id="april-options-css">
        #theme-options-wrap {
            width: 93%;
            padding: 3em;
            background: #fafeff;   
            border-top: 1px solid white;}
        #theme-options-wrap #icon-tools {
            position: relative;
            top: -10px;}	
        #theme-options-wrap input, #theme-options-wrap textarea {
            padding: .7em;}
        #theme-options-wrap em{color:#646464}</style>
    </div>
<?php
}

// Ad one
function april_ad_setting_two() {
   echo '<a class="button secondary" href="' . esc_url( admin_url( '/' ) 
        . 'customize.php?return=%2Fapril-theme%2Fwp-admin%2Fthemes.php%3Fpage%3Dhome%252Fleadspil%252Fpublic_html%252Fapril-theme%252Fwp-content%252Fthemes%252Fapril%252Finc%252Ftheme-admin-menu.php' ) .'" 
        title="' . esc_attr__( 'Customize Theme Here', 'april' ) . '">'
        . esc_html__( 'Customize Theme Here', 'april' ) . '</a>';
}

// Ad two
function april_ad_setting_one() {
    echo '<h5>'. esc_html__( 'Theme Options Include:', 'april' ) . '</h4>
    <hr><pre>'. esc_attr__('
    - Upload Hero Image.
    - Position for Image.
    - Placement of Call to Action buttons.
    - Font for Content
      Choose the font family type.
    - Set maximum width of articles.
    - Add page background image
      ', 'april' ) .'</pre>';
    echo '<h5>' . esc_html__( 'For Call To Action Widget try: (copy/paste into widget)', 'april' ) . '</h5>';
    echo '<hr><p>';
    echo '&lt;p>&lt;a class="button primary" href="#main" title="go to content">View Our Program&lt;/a>&lt;/p>
      &lt;p>&lt;a class="button primary" href="#main" title="go to content">View Other Programs&lt;/a>&lt;/p>';
    echo '</p>';
    echo '<p><em>' . esc_html__( 'Use the Custom HTML type of widget to display your buttons with.', 'april') . '</em></p>';
    echo '<h5>' . esc_html__( 'To remove Recent Posts Widget from single posts pages, add this to the Customizer > Additional CSS section:', 'april' )
          . '</h5><hr><pre>'. esc_attr('
          .april-recent-posts{ display: none; }') . '</pre>';
}

// @since 1.0.0 
function april_section_cb() {
    echo esc_html__( 'Produced by ', 'april' ) 
    . '<a href="'. esc_url("https://tradesouthwest.com/").'" title="TradeSouthWest" target="_blank">TradeSouthWest</a>.';
    echo '<figure><img src="'. esc_url( get_template_directory_uri( ) . '/inc/TSWlogo.png' ) .'" alt="TSW" height="90"/></figure>';
}
