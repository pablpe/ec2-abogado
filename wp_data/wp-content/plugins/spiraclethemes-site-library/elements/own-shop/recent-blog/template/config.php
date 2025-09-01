<?php


use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
Use Elementor\Controls_Stack;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Own_Shop_RecentBlog extends Widget_Base {

	public function get_name() {
		return 'own-shop-elementor-recent_blog';
	} 

	public function get_title() {
		return __( 'Recent Blog Posts', 'spiraclethemes-site-library' );
	}

	public function get_icon() {
		return 'eicon-post-list';
	}

	public function get_categories() {
		return [ 'sslb-elementor' ];
	}

	/**
	 * A list of scripts that the widgets is depended in
	 * @since 1.3.0
	 **/
	public function get_script_depends() {
		return [ 'bootstrap' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_list_recent_blog',
			[
				'label' => esc_html__( 'Recent Blog', 'spiraclethemes-site-library' ),
			]
		);

		$this->add_control(
			'posts_count',
			[
				'label' => esc_html__( 'Number of posts', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::TEXT,
				'default' => '3',
			]
		);


		$this->add_control(
			'post_cat_slug',
			[
				'label' => __( 'Categories', 'spiraclethemes-site-library' ),
				'description' => esc_html__('This help you to retrieve items from specific category.', 'spiraclethemes-site-library'),
				'type' => Controls_Manager::SELECT2,
				'options' => spiraclethemes_site_library_own_shop_get_categories(),
				'default' => '',
				'multiple' => true
			]
		);

		$this->add_control(
			'post_display_excerpt',
			[
				'label' => __( 'Show excerpt?', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'true' => __( 'Show', 'spiraclethemes-site-library' ),
					'false' => __( 'Hide', 'spiraclethemes-site-library' ),
				],
				'default' => 'false',
			]
		);

		$this->add_control(
			'post_display_readmore',
			[
				'label' => __( 'Show read more?', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'true' => __( 'Show', 'spiraclethemes-site-library' ),
					'false' => __( 'Hide', 'spiraclethemes-site-library' ),
				],
				'default' => 'true',
				'condition' => [
					'post_display_excerpt' => 'true',
				]
			]
		);

		$this->add_control(
			'post_read_more',
			[
				'label' => esc_html__( 'Read more text', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'READ MORE',
				'condition' => [
					'post_display_readmore' => 'true',
					'post_display_excerpt' => 'true',
				]
			]
		);

		
		
		$this->end_controls_section();


		$this->start_controls_section(
			'section_post_title_settings',
			[
				'label' => __( 'Title', 'spiraclethemes-site-library' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'section_post_title_typography',
				'label' => __( 'Title typography', 'spiraclethemes-site-library' ),
				'selector' => 
				'{{WRAPPER}} .recent-blog-widget .content h3 a',
				'fields_options' => [
		            'typography' => ['default' => 'yes'],
		            'font_size' => ['default' => ['size' => 18]],
		            'font_weight' => ['default' => 400],
		        ],
			]
		);
		
		$this->end_controls_section();



		$this->start_controls_section(
			'section_post_content',
			[
				'label' => __( 'Content', 'spiraclethemes-site-library' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'section_post_content_typography',
				'label' => __( 'Content typography', 'spiraclethemes-site-library' ),
				'selector' => 
				'{{WRAPPER}} .recent-blog-widget .content p',
				'fields_options' => [
		            'typography' => ['default' => 'yes'],
		            'font_size' => ['default' => ['size' => 13]],
		            'font_weight' => ['default' => 400],
		        ],
			]
		);
		
		$this->end_controls_section();


		$this->start_controls_section(
			'section_post_readmore',
			[
				'label' => __( 'Read More', 'spiraclethemes-site-library' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'section_post_readmore_typography',
				'label' => __( 'Read More typography', 'spiraclethemes-site-library' ),
				'selector' => 
				'{{WRAPPER}} .recent-blog-widget .content .read-more a',
				'fields_options' => [
		            'typography' => ['default' => 'yes'],
		            'font_size' => ['default' => ['size' => 14]],
		            'font_weight' => ['default' => 400],
		        ],
			]
		);
		
		$this->end_controls_section();
		
	}

	protected function render() {
		require SPIR_SITE_LIBRARY_PATH . '/elements/own-shop/recent-blog/template/view.php';
	}
}
