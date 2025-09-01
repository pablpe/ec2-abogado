<?php
/**
 * lawfiz functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package lawfiz
 */

/**
 *  Defining Constants
 */

// Core Constants
define('LAWFIZ_REQUIRED_PHP_VERSION', '5.6' );
define('LAWFIZ_DIR_PATH', get_template_directory());
define('LAWFIZ_THEME_AUTH','https://spiraclethemes.com/');
define('LAWFIZ_DIR_URI', get_template_directory_uri());

//Register Required plugin
require_once(get_template_directory() .'/inc/class-tgm-plugin-activation.php');


/**
* Check for minimum PHP version requirement 
*
*/
function lawfiz_check_theme_setup( $oldtheme_name, $oldtheme ){
    // Compare versions.
    if ( version_compare(phpversion(), LAWFIZ_REQUIRED_PHP_VERSION, '<') ) :
    // Theme not activated info message.
    add_action( 'admin_notices', 'lawfiz_php_admin_notice' );
    function lawfiz_php_admin_notice() {
        ?>
            <div class="update-nag">
                <?php esc_html_e( 'You need to update your PHP version to a minimum of 5.6 to run LawFiz WordPress Theme.', 'lawfiz' ); ?> <br />
                <?php esc_html_e( 'Actual version is:', 'lawfiz' ) ?> <strong><?php echo phpversion(); ?></strong>, <?php esc_html_e( 'required is', 'lawfiz' ) ?> <strong><?php echo LAWFIZ_REQUIRED_PHP_VERSION; ?></strong>
            </div>
        <?php
    }
    // Switch back to previous theme.
    switch_theme( $oldtheme->stylesheet );
        return false;
    endif;
}
add_action( 'after_switch_theme', 'lawfiz_check_theme_setup', 10, 2  );


if ( ! function_exists( 'lawfiz_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function lawfiz_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on lawfiz, use a find and replace
     * to change 'lawfiz' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'lawfiz', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary', 'lawfiz' ),
        'footer' => esc_html__( 'Footer', 'lawfiz' ),
		'social' => esc_html__( 'Sidebar Social', 'lawfiz' ),
		'footer-social' => esc_html__( 'Footer Social', 'lawfiz' )
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(      
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );

    // Gallery post format
    add_theme_support( 'post-formats', array( 'gallery' ));

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );

    // Remove theme support for new widgets block editor
    remove_theme_support( 'widgets-block-editor' );

    /**
     * lawfiz theme info
     */
    require get_template_directory() . '/inc/theme-info.php';

    /*
    * About page instance
    */
    $config = array();
    Lawfiz_About_Page::lawfiz_init( $config );

}
endif;
add_action( 'after_setup_theme', 'lawfiz_setup' );


/**
* Custom logo
*/
function lawfiz_logo_setup(){
    add_theme_support('custom-logo', array(
        'height' => 65,
        'width' => 350,
        'flex-height' => true,
        'flex-width' => true,
    ));
}
add_action('after_setup_theme', 'lawfiz_logo_setup');


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function lawfiz_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'lawfiz_content_width', 640 );
}
add_action( 'after_setup_theme', 'lawfiz_content_width', 0 );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function lawfiz_widgets_init() {
	//Footer widget columns
    $widget_num = absint(get_theme_mod( 'lawfiz_footer_widgets', '4' ));
    for ( $i=1; $i <= $widget_num; $i++ ) :
        register_sidebar( array(
            'name'          => esc_html__( 'Footer Column', 'lawfiz' ) . $i,
            'id'            => 'footer-' . $i,
            'description'   => '',
            'before_widget' => '<div id="%1$s" class="section %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title" itemprop="name">',
            'after_title'   => '</h4>',
        ) );
    endfor;

    register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'lawfiz' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'lawfiz' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );


    if(get_theme_mod( 'lawfiz_enable_header_topbar',true)):
        register_sidebar( array(
            'name'          => esc_html__( 'Top Bar Left Column', 'lawfiz' ),
            'id'            => 'topbar-left',
            'description'   => esc_html__( 'Add widgets here.', 'lawfiz' ),
            'before_widget' => '<div id="%1$s" class="section %2$s">',
            'after_widget'  => '</div>',
        ) );
        register_sidebar( array(
            'name'          => esc_html__( 'Top Bar Right Column', 'lawfiz' ),
            'id'            => 'topbar-right',
            'description'   => esc_html__( 'Add widgets here.', 'lawfiz' ),
            'before_widget' => '<div id="%1$s" class="section %2$s">',
            'after_widget'  => '</div>',
        ) );
    endif;
    

}
add_action( 'widgets_init', 'lawfiz_widgets_init' );


/**
* Admin Scripts
*/
if ( ! function_exists( 'lawfiz_admin_scripts' ) ) :
    function lawfiz_admin_scripts($hook) {
        wp_enqueue_style( 'lawfiz-info-css', get_template_directory_uri() . '/css/lawfiz-theme-info.css', false ); 
    }
endif;
add_action( 'admin_enqueue_scripts', 'lawfiz_admin_scripts' );


/** 
* Excerpt More
*/
function lawfiz_excerpt_more( $more ) {
	if ( is_admin() ) {
		return $more;
	}
    return '&hellip;';
}
add_filter('excerpt_more', 'lawfiz_excerpt_more');


/** 
* Custom excerpt length.
*/
function lawfiz_excerpt_length() {
	$length= intval(get_theme_mod('lawfiz_posts_excerpt_length',30));
    return $length;
}
add_filter('excerpt_length', 'lawfiz_excerpt_length');


/**
 * Display Dynamic CSS.
 */
function lawfiz_dynamic_css_wrap() {
	require_once( get_parent_theme_file_path( '/css/dynamic.css.php' ) );  
	?>
  		<style type="text/css" id="lawfiz-dynamic-style">
    		<?php echo lawfiz_dynamic_css_stylesheet(); ?>
  		</style>
	<?php 
}
add_action( 'wp_head', 'lawfiz_dynamic_css_wrap' );


/*
script goes here
*/
function lawfiz_scripts() {

    wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', array(), '5.3.3');
    wp_enqueue_style( 'bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css', array(), '5.3.3');
    wp_enqueue_style( 'lawfiz-style', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get('Version'));
	wp_enqueue_style( 'm-customscrollbar', get_template_directory_uri() . '/css/jquery.mCustomScrollbar.css', array(), '3.1.5');
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.css', array(), '3.7.2');

    wp_enqueue_style( 'dmsans-google-fonts', 'https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,700;1,9..40,400;1,9..40,700&display=swap', array(), '1.0');


    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	
	wp_enqueue_script( 'jquery-easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array('jquery'), '1.3', true );
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.js', array(), '2.6.2', true );
	wp_enqueue_script( 'resize-sensor', get_template_directory_uri() . '/js/ResizeSensor.js',array(),'1.0.0', true );
	wp_enqueue_script( 'm-customscrollbar-js', get_template_directory_uri() . '/js/jquery.mCustomScrollbar.js',array(),'3.1.5', true );	
	wp_enqueue_script( 'html5shiv',get_template_directory_uri().'/js/html5shiv.js',array(), '3.7.3');
	wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'respond', get_template_directory_uri().'/js/respond.js' );
    wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );
    wp_enqueue_script( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js', array(), '5.3.3', true );

    wp_enqueue_script( 'lawfiz-main', get_template_directory_uri() . '/js/main.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'lawfiz_scripts' );


/**
* Custom search form
*/
function lawfiz_search_form( $form ) {
    $form = '<form method="get" id="searchform" class="searchform" action="' . esc_url(home_url( '/' )) . '" >
    <div class="search">
      <input type="text" value="' . get_search_query() . '" class="blog-search" name="s" id="s" placeholder="'. esc_attr__( 'Search here','lawfiz' ) .'">
      <label for="searchsubmit" class="search-icon"><i class="bi bi-search"></i></label>
      <input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search','lawfiz' ) .'" />
    </div>
    </form>';
    return $form;
}
add_filter( 'get_search_form', 'lawfiz_search_form', 100 );


/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function lawfiz_pingback_header() {
    if ( is_singular() && pings_open() ) {
       printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
    }
}
add_action( 'wp_head', 'lawfiz_pingback_header' );


/** 
*plugins Required
*/

function lawfiz_register_required_plugins() {

    $plugins = array(
      array(
          'name'               => 'Spiraclethemes Site Library',
          'slug'               => 'spiraclethemes-site-library',
          'source'             => '',
          'required'           => false,          
          'force_activation'   => false,
      ),    
    );

    $config = array(
            'id'           => 'lawfiz',
            'default_path' => '',
            'menu'         => 'tgmpa-install-plugins',
            'has_notices'  => true,
            'dismissable'  => true,
            'dismiss_msg'  => '',
            'is_automatic' => false,
            'message'      => '',
            'strings'      => array()
    );

    tgmpa( $plugins, $config );

}
add_action( 'tgmpa_register', 'lawfiz_register_required_plugins' );


/**
 * Customizer additions.
 */
require get_parent_theme_file_path() . '/inc/customizer/customizer.php';

/**
 * Template functions
 */
require get_parent_theme_file_path() . '/inc/template-functions.php';

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path() . '/inc/template-tags.php';

/**
 * Custom template hooks for this theme.
 */
require get_parent_theme_file_path() . '/inc/template-hooks.php';

/**
 * Extra classes for this theme.
 */
require get_parent_theme_file_path() . '/inc/extras.php';

/**
 * Notices
 */
require_once get_parent_theme_file_path( '/inc/activation/class-welcome-notice.php' );
require_once get_parent_theme_file_path( '/inc/activation/class-rating-notice.php' );

/**
 * Upgrade Pro
 */
require_once( trailingslashit( get_template_directory() ) . 'lawfiz-pro/class-customize.php' );