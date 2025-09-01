<?php
/**
 * Theme information lawfiz
 *
 * @package lawfiz
 */


 define('LAWFIZ_THEME_URL','https://spiraclethemes.com/lawfiz-theme/');
 define('LAWFIZ_THEME_PRO_URL','https://spiraclethemes.com/lawfiz-theme/');
 define('LAWFIZ_THEME_DOC_URL','https://spiraclethemes.com/lawfiz-theme/');
 define('LAWFIZ_THEME_VIDEOS_URL','https://spiraclethemes.com/lawfiz-theme/');
 define('LAWFIZ_THEME_SUPPORT_URL','https://wordpress.org/support/theme/lawfiz/');
 define('LAWFIZ_THEME_RATINGS_URL','https://wordpress.org/support/theme/lawfiz/reviews/');
 define('LAWFIZ_THEME_CHANGELOGS_URL','https://themes.trac.wordpress.org/log/lawfiz/');
 define('LAWFIZ_THEME_CONTACT_URL','https://spiraclethemes.com/contact/');
 


if ( ! class_exists( 'Lawfiz_About_Page' ) ) {
	/**
	 * Singleton class used for generating the about page of the theme.
	 */
	class Lawfiz_About_Page {
		/**
		 * Define the version of the class.
		 *
		 * @var string $version The Lawfiz_About_Page class version.
		 */
		private $version = '1.0.0';
		/**
		 * Used for loading the texts and setup the actions inside the page.
		 *
		 * @var array $config The configuration array for the theme used.
		 */
		private $config;
		/**
		 * Get the theme name using wp_get_theme.
		 *
		 * @var string $theme_name The theme name.
		 */
		private $theme_name;
		/**
		 * Get the theme slug ( theme folder name ).
		 *
		 * @var string $theme_slug The theme slug.
		 */
		private $theme_slug;
		/**
		 * The current theme object.
		 *
		 * @var WP_Theme $theme The current theme.
		 */
		private $theme;
		/**
		 * Holds the theme version.
		 *
		 * @var string $theme_version The theme version.
		 */
		private $theme_version;		
		/**
		 * Define the html notification content displayed upon activation.
		 *
		 * @var string $notification The html notification content.
		 */
		private $notification;
		/**
		 * The single instance of Lawfiz_About_Page
		 *
		 * @var Lawfiz_About_Page $instance The Lawfiz_About_Page instance.
		 */
		private static $instance;
		/**
		 * The Main Lawfiz_About_Page instance.
		 *
		 * We make sure that only one instance of Lawfiz_About_Page exists in the memory at one time.
		 *
		 * @param array $config The configuration array.
		 */
		public static function lawfiz_init( $config ) {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Lawfiz_About_Page ) ) {
				self::$instance = new Lawfiz_About_Page;				
				self::$instance->config = $config;
				self::$instance->lawfiz_setup_config();	
			}
		}

		/**
		 * Setup the class props based on the config array.
		 */
		public function lawfiz_setup_config() {
			$theme = wp_get_theme();
			if ( is_child_theme() ) {
				$this->theme_name = $theme->parent()->get( 'Name' );
				$this->theme      = $theme->parent();
			} else {
				$this->theme_name = $theme->get( 'Name' );
				$this->theme      = $theme->parent();
			}
			$this->theme_version = $theme->get( 'Version' );
			$this->theme_slug    = $theme->get_template();			
				
		}	
	}
}


/**
 *  Adding a About page 
 */
add_action('admin_menu', 'lawfiz_add_menu');
function lawfiz_add_menu() {
     add_theme_page(esc_html__('About LawFiz Theme','lawfiz'), esc_html__('Lawfiz Info','lawfiz'),'manage_options', esc_html__('lawfiz-theme-info','lawfiz'), esc_html__('lawfiz_theme_info','lawfiz'));
}

/**
 *  Callback
 */
function lawfiz_theme_info() {
	$theme = wp_get_theme();
?>
	<div class="theme-info">
		<div class="top-section">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="title">
							<h1><?php esc_html_e( 'Lawfiz WordPress Theme', 'lawfiz' ); ?> <span><?php echo $theme->get( 'Version' ); ?></span> </h1>
							<p><?php esc_html_e( 'Introducing LawFiz: a sleek, professional WordPress theme crafted for lawyers by Spiracle Themes. With its clean design and mobile-friendly layout, LawFiz ensures your legal services shine on any device. Showcase your expertise with customizable homepage sections and easy-to-manage pages. Share insights and connect with clients through integrated social media features. Elevate your online presence effortlessly with LawFiz – download for free today.', 'lawfiz' ); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="middle-section">
			<div class="container">
				<div class="row">
					<div class="col-md-9">
						<div class="quick-links">
							<h2><?php esc_html_e( 'Quick Customizer Settings', 'lawfiz' ); ?> </h2>
							<div class="row">
								<div class="col-md-4">
									<div class="customizer-title">
										<h3>
											<span class="dashicons dashicons-format-image"></span>
											<a href="<?php echo esc_url(admin_url( 'customize.php?autofocus[control]=custom_logo')) ?>"> <?php esc_html_e( 'Upload Logo', 'lawfiz' ); ?> </a>
										</h3>
									</div>
								</div>
								<div class="col-md-4">
									<div class="customizer-title">
										<h3>
											<span class="dashicons dashicons-admin-tools"></span> 
											<a href="<?php echo esc_url(admin_url( 'customize.php?autofocus[panel]=lawfiz_header_settings_panel')) ?>"> <?php esc_html_e( 'Header Settings', 'lawfiz' ); ?> </a>
										</h3>
									</div>
								</div>
								<div class="col-md-4">
									<div class="customizer-title">
										<h3>
											<span class="dashicons dashicons-admin-customizer"></span> 
											<a href="<?php echo esc_url(admin_url( 'customize.php?autofocus[control]=lawfiz_link_color')) ?>"> <?php esc_html_e( 'Color Settings', 'lawfiz' ); ?> </a>
										</h3>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="customizer-title">
										<h3>
											<span class="dashicons dashicons-media-default"></span> 
											<a href="<?php echo esc_url(admin_url( 'customize.php?autofocus[control]=lawfiz_enable_page_title')) ?>"> <?php esc_html_e( 'Page Settings', 'lawfiz' ); ?> </a>
										</h3>
									</div>
								</div>
								<div class="col-md-4">
									<div class="customizer-title">
										<h3>
											<span class="dashicons dashicons-columns"></span> 
											<a href="<?php echo esc_url(admin_url( 'customize.php?autofocus[control]=lawfiz_footer_copyright_text')) ?>"> <?php esc_html_e( 'Footer Settings', 'lawfiz' ); ?> </a>
										</h3>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="customizer-title">
										<h3>
											<span class="dashicons dashicons-image-filter"></span> 
											<a href="<?php echo esc_url(admin_url( 'customize.php?autofocus[control]=lawfiz_enable_preloader')) ?>"> <?php esc_html_e( 'Preloader Settings', 'lawfiz' ); ?> </a>
										</h3>
									</div>
								</div>
								<div class="col-md-4">
									<div class="customizer-title">
										<h3>
											<span class="dashicons dashicons-edit-large"></span> 
											<a href="<?php echo esc_url(admin_url( 'customize.php?autofocus[panel]=lawfiz_blog_settings_panel')) ?>"> <?php esc_html_e( 'Blog Settings', 'lawfiz' ); ?> </a>
										</h3>
									</div>
								</div>
								
							</div>
						</div>

						<div class="comp-box">
							<center><h2 class="table-heading"><?php esc_html_e( 'Why should you Upgrade to our PRO Addon ?', 'lawfiz' ); ?></h2></center>
							<div class="comp-table">
								<table>
									<thead> 
										<tr> 
										 	<td class="thead-column1"><strong><h4><?php esc_html_e( 'Feature', 'lawfiz' ); ?></h4></strong></td>
											<td class="thead-column2"><strong><h4><?php esc_html_e( 'Lawfiz Free', 'lawfiz' ); ?></h4></strong></td>
											<td class="thead-column3"><strong><h4><?php esc_html_e( 'Pro Addon Plugin', 'lawfiz' ); ?></h4></strong></td>
										</tr> 
									</thead>
									<tbody>
										<tr> 
						 					<td class="tbody-column1"><?php esc_html_e( 'Favicon, Logo, Title and Tagline Customization', 'lawfiz' ); ?></td>
						 					<td class="tbody-column2"><span class="dashicons dashicons-yes"></span></td>
						 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
										</tr>
										<tr> 
						 					<td class="tbody-column1"><?php esc_html_e( 'Customizer Theme Options', 'lawfiz' ); ?></td>
						 					<td class="tbody-column2"><span class="dashicons dashicons-yes"></span></td>
						 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
										</tr>
										<tr> 
						 					<td class="tbody-column1"><?php esc_html_e( 'Contact Form', 'lawfiz' ); ?></td>
						 					<td class="tbody-column2"><span class="dashicons dashicons-yes"></span></td>
						 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
										</tr>
										<tr> 
						 					<td class="tbody-column1"><?php esc_html_e( 'Color Settings', 'lawfiz' ); ?></td>
						 					<td class="tbody-column2"><span class="dashicons dashicons-yes"></span></td>
						 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
										</tr>
										<tr> 
						 					<td class="tbody-column1"><?php esc_html_e( 'Footer Widget', 'lawfiz' ); ?></td>
						 					<td class="tbody-column2"><span class="dashicons dashicons-yes"></span></td>
						 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
										</tr>
										<tr> 
						 					<td class="tbody-column1"><?php esc_html_e( '1 Click Demo Import', 'lawfiz' ); ?></td>
						 					<td class="tbody-column2"><span class="dashicons dashicons-yes"></span></td>
						 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
										</tr>
										<tr> 
						 					<td class="tbody-column1"><?php esc_html_e( 'Breadcrumb Display', 'lawfiz' ); ?></td>
						 					<td class="tbody-column2"><span class="dashicons dashicons-yes"></span></td>
						 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
										</tr>
										<tr> 
						 					<td class="tbody-column1"><?php esc_html_e( 'Elementor Page Builder', 'lawfiz' ); ?></td>
						 					<td class="tbody-column2"><span class="dashicons dashicons-yes"></span></td>
						 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
										</tr>
										<tr> 
						 					<td class="tbody-column1"><?php esc_html_e( '2 Header Styles', 'lawfiz' ); ?></td>
						 					<td class="tbody-column2"><span class="dashicons dashicons-yes"></span></td>
						 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
										</tr>
										<tr> 
						 					<td class="tbody-column1"><?php esc_html_e( 'Inner Pages Settings', 'lawfiz' ); ?></td>
						 					<td class="tbody-column2"><span class="dashicons dashicons-yes"></span></td>
						 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
										</tr>
										<tr> 
						 					<td class="tbody-column1"><?php esc_html_e( 'Blog Sidebar', 'lawfiz' ); ?></td>
						 					<td class="tbody-column2"><span class="dashicons dashicons-yes"></span></td>
						 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
										</tr>
										<tr> 
						 					<td class="tbody-column1"><?php esc_html_e( 'Preloader', 'lawfiz' ); ?></td>
						 					<td class="tbody-column2"><span class="dashicons dashicons-yes"></span></td>
						 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
										</tr>
										<tr> 
						 					<td class="tbody-column1"><?php esc_html_e( 'Responsive Design (Mobile, Tablets)', 'lawfiz' ); ?></td>
						 					<td class="tbody-column2"><span class="dashicons dashicons-yes"></span></td>
						 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
										</tr>
										<tr> 
						 					<td class="tbody-column1"><?php esc_html_e( 'Sidebar Options (Full, Left and Right)', 'lawfiz' ); ?></td>
						 					<td class="tbody-column2"><span class="dashicons dashicons-yes"></span></td>
						 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
										</tr>

										<tr> 
						 					<td class="tbody-column1"><?php esc_html_e( 'Top Social Icons', 'lawfiz' ); ?></td>
						 					<td class="tbody-column2"><span class="dashicons dashicons-no-alt"></span></td>
						 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
										</tr>
										<tr> 
						 					<td class="tbody-column1"><?php esc_html_e( '800+ Google Fonts', 'lawfiz' ); ?></td>
						 					<td class="tbody-column2"><span class="dashicons dashicons-no-alt"></span></td>
						 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
										</tr>
										
										<tr> 
						 					<td class="tbody-column1"><?php esc_html_e( 'Slider for Homepage', 'lawfiz' ); ?></td>
						 					<td class="tbody-column2"><span class="dashicons dashicons-no-alt"></span></td>
						 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
										</tr>
										<tr> 
						 					<td class="tbody-column1"><?php esc_html_e( 'Typography', 'lawfiz' ); ?></td>
						 					<td class="tbody-column2"><span class="dashicons dashicons-no-alt"></span></td>
						 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
										</tr>
										<tr> 
						 					<td class="tbody-column1"><?php esc_html_e( 'Footer Credits Editor', 'lawfiz' ); ?></td>
						 					<td class="tbody-column2"><span class="dashicons dashicons-no-alt"></span></td>
						 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
										</tr>
										<tr> 
						 					<td class="tbody-column1"><?php esc_html_e( 'Extra Blog Settings', 'lawfiz' ); ?></td>
						 					<td class="tbody-column2"><span class="dashicons dashicons-no-alt"></span></td>
						 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
										</tr>
										<tr> 
						 					<td class="tbody-column1"><?php esc_html_e( 'WooCommerce Ready', 'lawfiz' ); ?></td>
						 					<td class="tbody-column2"><span class="dashicons dashicons-no-alt"></span></td>
						 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
										</tr>
										<tr> 
						 					<td class="tbody-column1"><?php esc_html_e( 'WooCommerce Settings', 'lawfiz' ); ?></td>
						 					<td class="tbody-column2"><span class="dashicons dashicons-no-alt"></span></td>
						 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
										</tr>
										<tr> 
						 					<td class="tbody-column1"><?php esc_html_e( 'Extra Customizer Settings', 'lawfiz' ); ?></td>
						 					<td class="tbody-column2"><span class="dashicons dashicons-no-alt"></span></td>
						 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
										</tr>
										<tr> 
						 					<td class="tbody-column1"><?php esc_html_e( 'Menu Cart', 'lawfiz' ); ?></td>
						 					<td class="tbody-column2"><span class="dashicons dashicons-no-alt"></span></td>
						 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
										</tr>
										<tr> 
						 					<td class="tbody-column1"><?php esc_html_e( 'Sticky Header', 'lawfiz' ); ?></td>
						 					<td class="tbody-column2"><span class="dashicons dashicons-no-alt"></span></td>
						 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
										</tr>
										<tr> 
						 					<td class="tbody-column1"><?php esc_html_e( 'More Color Options', 'lawfiz' ); ?></td>
						 					<td class="tbody-column2"><span class="dashicons dashicons-no-alt"></span></td>
						 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
										</tr>
										<tr> 
						 					<td class="tbody-column1"><?php esc_html_e( 'Author Section for Single Post', 'lawfiz' ); ?></td>
						 					<td class="tbody-column2"><span class="dashicons dashicons-no-alt"></span></td>
						 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
										</tr>
										<tr> 
						 					<td class="tbody-column1"><?php esc_html_e( 'Related Posts Section', 'lawfiz' ); ?></td>
						 					<td class="tbody-column2"><span class="dashicons dashicons-no-alt"></span></td>
						 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
										</tr>
										<tr> 
						 					<td class="tbody-column1"><?php esc_html_e( 'Footer Columns Settings', 'lawfiz' ); ?></td>
						 					<td class="tbody-column2"><span class="dashicons dashicons-no-alt"></span></td>
						 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
										</tr>
										<tr> 
						 					<td class="tbody-column1"><?php esc_html_e( 'Extra Premium Demos', 'lawfiz' ); ?></td>
						 					<td class="tbody-column2"><span class="dashicons dashicons-no-alt"></span></td>
						 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
										</tr>
										<tr> 
						 					<td class="tbody-column1"><?php esc_html_e( 'Priority Support', 'lawfiz' ); ?></td>
						 					<td class="tbody-column2"><span class="dashicons dashicons-no-alt"></span></td>
						 					<td class="tbody-column3"><span class="dashicons dashicons-yes"></span></td>
										</tr> 
										<tr class="last-row"> 
						 					<td class="tbody-column1"></td>
						 					<td class="tbody-column2"></td>
						 					<td class="tbody-column3"><a class="button button-primary button-large" href="<?php echo esc_url(LAWFIZ_THEME_PRO_URL); ?>" target="_blank"><?php esc_html_e( 'Upgrade to PRO', 'lawfiz' ); ?></a></td>
										</tr> 
					   				</tbody>
								</table>
							</div>
						</div>
					</div>

					<div class="col-md-3 sidebar-right">
						<div class="sidebar">
							<div class="section-box first">
								<div class="icon">
									<span class="dashicons dashicons-visibility"></span>
								</div>
								<div class="heading">
									<h3><a href="<?php echo esc_url(LAWFIZ_THEME_URL); ?>" target="_blank"><?php esc_html_e( 'VIEW DEMOS', 'lawfiz' ); ?></a></h3>
								</div>	
							</div>	

							<div class="section-box">
								<div class="icon">
									<span class="dashicons dashicons-star-filled"></span>
								</div>
								<div class="heading">
									<h3><a href="<?php echo esc_url(LAWFIZ_THEME_RATINGS_URL); ?>" target="_blank"><?php esc_html_e( 'RATE OUR THEME', 'lawfiz' ); ?></a></h3>
								</div>						
							</div>

							<div class="section-box">
								<div class="icon">
									<span class="dashicons dashicons-format-aside"></span>
								</div>
								<div class="heading">
									<h3><a href="<?php echo esc_url(LAWFIZ_THEME_DOC_URL); ?>" target="_blank"><?php esc_html_e( 'VIEW DOCUMENTATION', 'lawfiz' ); ?></a></h3>
								</div>						
							</div>

							<div class="section-box">
								<div class="icon">
									<span class="dashicons dashicons-video-alt2"></span>
								</div>
								<div class="heading">
									<h3><a href="<?php echo esc_url(LAWFIZ_THEME_VIDEOS_URL); ?>" target="_blank"><?php esc_html_e( 'VIDEO TUTORIALS', 'lawfiz' ); ?></a></h3>
								</div>						
							</div>

							<div class="section-box">
								<div class="icon">
									<span class="dashicons dashicons-sos"></span>
								</div>
								<div class="heading">
									<h3><a href="<?php echo esc_url(LAWFIZ_THEME_SUPPORT_URL); ?>" target="_blank"><?php esc_html_e( 'ASK FOR SUPPORT', 'lawfiz' ); ?></a></h3>
								</div>						
							</div>

							<div class="section-box">
								<div class="icon">
									<span class="dashicons dashicons-admin-tools"></span>
								</div>
								<div class="heading">
									<h3><a href="<?php echo esc_url(LAWFIZ_THEME_CHANGELOGS_URL); ?>" target="_blank"><?php esc_html_e( 'VIEW CHANGELOGS', 'lawfiz' ); ?></a></h3>
								</div>						
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<div class="title">
							<div class="review-content">
								<p><?php esc_html_e( ' Please ', 'lawfiz' )  ?>
									<a href="<?php echo esc_url(LAWFIZ_THEME_RATINGS_URL); ?>" target="_blank"><?php esc_html_e( 'rate our theme', 'lawfiz' ); ?></a>
									<span>★★★★★</span>
									<?php esc_html_e( ' to help us spread the word. Thank you from the Spiracle Themes team!', 'lawfiz' ); ?>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>		
	</div>
<?php
}
