<?php 


/**
 *  Defining Constants
 */

// Core Constants
define('LAWFIZ_ONE_REQUIRED_PHP_VERSION', '5.6' );
define('LAWFIZ_ONE_THEME_AUTH','https://spiraclethemes.com/');


/**
* Check for minimum PHP version requirement 
*
*/
function lawfiz_one_check_theme_setup( $oldtheme_name, $oldtheme ){
  	// Compare versions.
  	if ( version_compare(phpversion(), LAWFIZ_ONE_REQUIRED_PHP_VERSION, '<') ) :
	  	// Theme not activated info message.
	  	add_action( 'admin_notices', 'lawfiz_one_php_admin_notice' );
	  	function lawfiz_one_php_admin_notice() {
	    	?>
	      		<div class="update-nag">
	          		<?php 
	          			esc_html_e( 'You need to update your PHP version to a minimum of 5.6 to run Lawfiz One WordPress Theme.', 'lawfiz-one' ); 
	          		?> 
	          		<br />
	          		<?php esc_html_e( 'Actual version is:', 'lawfiz-one' ) ?> 
	          		<strong><?php echo phpversion(); ?></strong>, 
	          		<?php esc_html_e( 'required is', 'lawfiz-one' ) ?> 
	          		<strong><?php echo LAWFIZ_ONE_REQUIRED_PHP_VERSION; ?></strong>
	      		</div>
	    	<?php
	  	}
		// Switch back to previous theme.
		switch_theme( $oldtheme->stylesheet );
		return false;
	endif;
}
add_action( 'after_switch_theme', 'lawfiz_one_check_theme_setup', 10, 2  );



/**
 * Lawfiz One theme functions
 */	
function lawfiz_one_theme_setup(){

	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	remove_action( 'admin_menu', 'lawfiz_add_menu' );

	//remove theme support for new widgets block editor
	remove_theme_support( 'widgets-block-editor' );
   
	add_action('wp_enqueue_scripts', 'lawyer_one_load_scripts');

	/**
	* Adding translation file
	*/
	$path = get_stylesheet_directory().'/languages';
    load_child_theme_textdomain( 'lawyer-one', $path );
}
add_action( 'after_setup_theme', 'lawfiz_one_theme_setup', 99 );


/**
 * Load Scripts
 */
function lawyer_one_load_scripts() {

	wp_register_style( 'lawfiz-one-style' , trailingslashit(get_stylesheet_directory_uri()).'style.css', false, wp_get_theme()->get('Version'), 'all');
	wp_enqueue_style( 'lawfiz-one-style' );
	
	// Main js
	wp_enqueue_script( 'lawfiz-one-script', trailingslashit(get_stylesheet_directory_uri()).'js/main.js',array(), wp_get_theme()->get('Version'), true );
}


/**
 * Adding class to body
 */
if ( ! function_exists( 'lawfiz_one_add_classes_to_body' ) ) :
function lawfiz_one_add_classes_to_body($classes = '') {
    return array_merge( $classes, array( 'lawfiz-one-theme' ) );
}
endif;
add_filter('body_class', 'lawfiz_one_add_classes_to_body');


/**
 * Function for Minimizing dynamic CSS
 */
function lawfiz_one_minimize_css($css){
    $css = preg_replace('/\/\*((?!\*\/).)*\*\//', '', $css);
    $css = preg_replace('/\s{2,}/', ' ', $css);
    $css = preg_replace('/\s*([:;{}])\s*/', '$1', $css);
    $css = preg_replace('/;}/', '}', $css);
    return $css;
}


/**
 * Check WooCommerce is active
*/
if ( ! function_exists( 'lawfiz_one_is_woocommerce_activated' ) ) :
	function lawfiz_one_is_woocommerce_activated() {
		if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
	}
endif;


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function lawfiz_one_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Topbar Sidebar', 'lawfiz-one' ),
		'id'            => 'topsidebar',
		'description'   => esc_html__( 'Add widgets here.', 'lawfiz-one' ),
		'before_widget' => '<ul id="%1$s" class="widget %2$s">',
		'after_widget'  => '</ul>',
	) );
}
add_action( 'widgets_init', 'lawfiz_one_widgets_init', 20 );



/**
* Includes
*/

//include template functions
require_once( get_stylesheet_directory(). '/inc/template-functions.php' );

/**
 * Upgrade to Pro
 */
require_once( get_stylesheet_directory(). '/lawfiz-one-pro/class-customize.php' );

//include customizer
require_once( get_stylesheet_directory(). '/inc/customizer/customizer.php' );