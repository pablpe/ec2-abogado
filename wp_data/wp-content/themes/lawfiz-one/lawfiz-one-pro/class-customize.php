<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Lawfiz_One_Pro_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		require_once( get_stylesheet_directory() . '/lawfiz-one-pro/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Lawfiz_One_Pro_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Lawfiz_One_Pro_Customize_Section_Pro(
				$manager,
				'lawfiz_one_buy',
				array(
					'priority'      => 10,
					'title'    => esc_html__( 'LawFiz One Pro', 'lawfiz-one' ),
					'pro_text' => esc_html__( 'Upgrade to Pro', 'lawfiz-one' ),
					'pro_url'  => 'https://spiraclethemes.com/lawfiz-one-theme/'
				)
			)
		);
	}
}

// Doing this customizer thang!
Lawfiz_One_Pro_Customize::get_instance();
