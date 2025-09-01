<?php


use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
Use Elementor\Controls_Stack;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Blogson_Postgrid extends Widget_Base {

	public function get_name() {
		return 'blogson-elementor-postgrid';
	} 

	public function get_title() {
		return __( 'Post Grid', 'spiraclethemes-site-library' );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
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
			'section_recent_posts',
			[
				'label' => esc_html__( 'Post Grid', 'spiraclethemes-site-library' ),
			]
		);

		$this->add_control(
			'show_section_title',
			[
				'label' => __( 'Show section title', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'true' => __( 'Show', 'spiraclethemes-site-library' ),
					'false' => __( 'Hide', 'spiraclethemes-site-library' ),
				],
				'default' => 'true',
			]
		);

		$this->add_control(
			'section_title',
			[
				'label' => esc_html__( 'Title', 'spiraclethemes-site-library' ),
				'description' => esc_html__('Enter title. Leave blank to hide.', 'spiraclethemes-site-library'),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'condition' => [
					'show_section_title' => 'true',
				]
			]
		);

		$this->add_control(
			'section_title_size',
			[
				'label' => esc_html__( 'Title size', 'spiraclethemes-site-library' ),
				'options' => [
					'h1' => esc_html__('H1', 'spiraclethemes-site-library'),
					'h2' => esc_html__('H2', 'spiraclethemes-site-library'),
					'h3' => esc_html__('H3', 'spiraclethemes-site-library'),
					'h4' => esc_html__('H4', 'spiraclethemes-site-library'),
					'h5' => esc_html__('H5', 'spiraclethemes-site-library'),
					'h6' => esc_html__('H6', 'spiraclethemes-site-library'),
				],
				'type' => Controls_Manager::SELECT,
				'default' => 'h2',
				'condition' => [
					'show_section_title' => 'true',
				]
			]
		);

		$this->add_control(
			'post_style',
			[
				'label' => esc_html__( 'Posts style', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::SELECT,
				'description' => esc_html__('Select posts style on preview.', 'spiraclethemes-site-library'),
				'options' => [
					'style_1' => esc_html__('Featured', 'spiraclethemes-site-library'),
					'style_2' => esc_html__('Image Blocks', 'spiraclethemes-site-library'),
					'style_3' => esc_html__('Grid List', 'spiraclethemes-site-library')
				],
				'default' => 'style_1',
			]
		);

		$this->add_control(
			'post_count',
			[
				'label' => esc_html__( 'Posts count', 'spiraclethemes-site-library' ),
				'description' => esc_html__('Enter number of post to display (Note: Enter -1 to display all posts). Note: You might see the sticky posts on the front page so adjust the count according to the number of sticky posts. Sticky posts will show only when no category selected.', 'spiraclethemes-site-library'),
				'type' => Controls_Manager::TEXT,
				'default' => '4',
				'condition' => [
					'post_style' => ['style_2','style_3'],
				],
			]
		);

		$this->add_control(
			'post_columns',
			[
				'label' => esc_html__( 'Posts per row', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::SELECT,
				'description' => esc_html__('Select posts count per row. It works for simple and masonry style.', 'spiraclethemes-site-library'),
				'options' => [
					'span12' => esc_html__('One', 'spiraclethemes-site-library'),
					'span6' => esc_html__('Two', 'spiraclethemes-site-library'),
					'span4' => esc_html__('Three', 'spiraclethemes-site-library'),
					'span3' => esc_html__('Four', 'spiraclethemes-site-library'),
				],
				'default' => 'span6',
				'condition' => [
					'post_style' => ['style_2','style_3'],
				],
			]
		);

		$this->add_control(
			'post_cat_slug',
			[
				'label' => __( 'Categories', 'spiraclethemes-site-library' ),
				'description' => esc_html__('This help you to retrieve items from specific category.', 'spiraclethemes-site-library'),
				'type' => Controls_Manager::SELECT2,
				'options' => spiraclethemes_site_library_blogson_get_categories(),
				'default' => '',
				'multiple' => true
			]
		);
		
		$this->add_control(
			'post_ids',
			[
				'label' => __( 'Select posts to show', 'spiraclethemes-site-library' ),
				'description' => __('Leave empty to show recent posts.', 'spiraclethemes-site-library'),
				'type' => Controls_Manager::SELECT2,
				'options' => spiraclethemes_site_library_blogson_get_all_posts(),
				'default' => '',
				'multiple' => true
			]
		);

		$this->add_control(
			'post__not_in',
			[
				'label' => __( 'Select posts to exclude', 'spiraclethemes-site-library' ),
				'description' => __('Select posts to exclude those records', 'spiraclethemes-site-library'),
				'type' => Controls_Manager::SELECT2,
				'options' => spiraclethemes_site_library_blogson_get_all_posts(),
				'default' => '',
				'multiple' => true
			]
		);

		$this->add_control(
			'post_orderby',
			[
				'label' => esc_html__( 'Order by', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::SELECT,
				'description' => esc_html__('Select how to sort retrieved posts.', 'spiraclethemes-site-library'),
				'options' => [
					'date' => esc_html__('Date', 'spiraclethemes-site-library'),
					'modified' => esc_html__('Last modified date', 'spiraclethemes-site-library'),
					'comment_count' => esc_html__('Popularity', 'spiraclethemes-site-library'),
					'title' => esc_html__('Title', 'spiraclethemes-site-library'),
					'rand' => esc_html__('Random', 'spiraclethemes-site-library'),
				],
				'default' => 'date',
			]
		);

		$this->add_control(
			'post_order',
			[
				'label' => esc_html__( 'Posts order', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'DESC' => [
						'title' => esc_html__( 'descending', 'spiraclethemes-site-library' ),
						'icon' => 'fa fa-sort-amount-desc',
					],
					'ASC' => [
						'title' => esc_html__( 'ascending', 'spiraclethemes-site-library' ),
						'icon' => 'fa fa-sort-amount-asc',
					],
				],
				'default' => 'DESC',
			]
		);


		$imageSizes = get_intermediate_image_sizes();
		$imageSizes[]= 'full';
		$imageSizes = array_combine($imageSizes, $imageSizes);
		$this->add_control(
			'post_thumbsize',
			[
				'label' => __( 'Image size', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::SELECT,
				'description' => esc_html__('Select your image size to use in post.', 'spiraclethemes-site-library'),
				'options' => $imageSizes,
				'default' => 'large',
			]
		);
		
		$this->add_control(
			'post_content_show',
			[
				'label' => __( 'Display content?', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'true' => __( 'Show', 'spiraclethemes-site-library' ),
					'false' => __( 'Hide', 'spiraclethemes-site-library' ),
				],
				'default' => 'false',
				'condition' => [
					'post_style' => ['style_3'],
				],
			]
		);

		$this->add_control(
			'post_excerpt_count',
			[
				'label' => esc_html__( 'Content count', 'spiraclethemes-site-library' ),
				'description' => esc_html__('Enter number of words in post excerpt. 0 to hide it.', 'spiraclethemes-site-library'),
				'type' => Controls_Manager::TEXT,
				'default' => '17',
				'condition' => [
					'post_content_show' => 'true',
					'post_style' => ['style_3'],
				],
			]
		);

		$this->add_control(
			'post_display_categories',
			[
				'label' => __( 'Display categories?', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'true' => __( 'Show', 'spiraclethemes-site-library' ),
					'false' => __( 'Hide', 'spiraclethemes-site-library' ),
				],
				'default' => 'true',
			]
		);

		$this->add_control(
			'post_display_comments',
			[
				'label' => __( 'Display comments?', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'true' => __( 'Show', 'spiraclethemes-site-library' ),
					'false' => __( 'Hide', 'spiraclethemes-site-library' ),
				],
				'default' => 'false',
			]
		);

		$this->add_control(
			'post_display_date',
			[
				'label' => __( 'Display date?', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'true' => __( 'Show', 'spiraclethemes-site-library' ),
					'false' => __( 'Hide', 'spiraclethemes-site-library' ),
				],
				'default' => 'true',
			]
		);

		$this->add_control(
			'post_display_author',
			[
				'label' => __( 'Display author?', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'true' => __( 'Show', 'spiraclethemes-site-library' ),
					'false' => __( 'Hide', 'spiraclethemes-site-library' ),
				],
				'default' => 'true',
			]
		);

		$this->add_control(
			'post_display_author_pre_text',
			[
				'label' => esc_html__( 'Author pre text', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'By',
				'condition' => [
					'post_display_author' => 'true',
				]
			]
		);

		$this->add_control(
			'post_trim_title',
			[
				'label' => __( 'Trim title?', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'true' => __( 'Yes', 'spiraclethemes-site-library' ),
					'false' => __( 'No', 'spiraclethemes-site-library' ),
				],
				'default' => 'true',
			]
		);

		$this->add_control(
			'post_trim_title_count',
			[
				'label' => esc_html__( 'Trim title count', 'spiraclethemes-site-library' ),
				'description' => esc_html__('Enter number of words to show in title, 0 to hide it.', 'spiraclethemes-site-library'),
				'type' => Controls_Manager::TEXT,
				'default' => '7',
				'condition' => [
					'post_trim_title' => 'true',
				]
			]
		);

		$this->add_control(
			'post_show_readmore',
			[
				'label' => __( 'Show readmore', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'true' => __( 'Show', 'spiraclethemes-site-library' ),
					'false' => __( 'Hide', 'spiraclethemes-site-library' ),
				],
				'default' => 'false',
				'condition' => [
					'post_style' => ['style_3'],
				],
			]
		);

		$this->add_control(
			'post_readmore_text',
			[
				'label' => __( 'Readmore text', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'post_show_readmore' => 'true'
				],
				'default' => 'Read More',
				'condition' => [
					'post_show_readmore' => 'true',
				],
			]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'section_posts_layout',
			[
				'label' => __( 'Layout', 'spiraclethemes-site-library' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'row_gap',
			[
				'label' => __( 'Rows gap', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .latest-posts .blog-posts article' => 'margin-left: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .latest-posts .blog-posts article' => 'margin-right: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'image_height',
			[
				'label' => __( 'Image height', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 900,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 500,
				],
				'selectors' => [
					'{{WRAPPER}} .latest-posts .blog-posts article .post-grid-area-content .content-wrapper' => 'height: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .latest-posts article.style_3 .post-grid .post-image .post-image-wrapper' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'post_text_position',
			[
				'label' => esc_html__( 'Text position', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::SELECT,
				'description' => esc_html__('Choose text position over image', 'spiraclethemes-site-library'),
				'options' => [
					'center' => esc_html__('Center', 'spiraclethemes-site-library'),
					'bottomcenter' => esc_html__('Bottom Center', 'spiraclethemes-site-library'),
					
				],
				'default' => 'bottomcenter',
				'condition' => [
					'post_style' => ['style_1','style_2'],
				],
			]

		);

		$this->add_responsive_control(
			'post_text_adjust',
			[
				'label' => __( 'Text Adjustment', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 80,
				],
				'selectors' => [
					'{{WRAPPER}} .latest-posts article.bottomcenter .post-grid-area-content .content-wrapper .content-inner' => 'top: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .latest-posts article.center .post-grid-area-content .content-wrapper .content-inner' => 'top: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'post_text_position' => 'bottomcenter',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_posts_box',
			[
				'label' => __( 'Image', 'spiraclethemes-site-library' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'image_paddings',
			[
				'label' => __( 'Image padding', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'default' => ['top'=>'7', 'right'=>'7', 'bottom'=>'7', 'left'=>'7', 'unit'=>'px'],
				'selectors' => [
					'{{WRAPPER}} .latest-posts .blog-posts .post.post-size:not(.style_2) .post-content-container' => 'padding: {{top}}{{unit}} {{right}}{{unit}} {{bottom}}{{unit}} {{left}}{{unit}}',
					'{{WRAPPER}} .latest-posts .post .post-img-side .post-img' => 'border-width: {{top}}{{unit}} {{right}}{{unit}} {{bottom}}{{unit}} {{left}}{{unit}}',
				],
				'condition' => [
					'post_style' => ['style_1','style_2'],
				],
			]
		);

		$this->add_responsive_control(
			'image_radius',
			[
				'label' => __( 'Image border radius', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'default' => ['top'=>'10', 'right'=>'10', 'bottom'=>'10', 'left'=>'10', 'unit'=>'px'],
				'selectors' => [
					'{{WRAPPER}} .latest-posts .blog-posts article .post-grid-area-content' => 'border-radius: {{top}}{{unit}} {{right}}{{unit}} {{bottom}}{{unit}} {{left}}{{unit}}',
					'{{WRAPPER}} .post-grid-area-content .content-wrapper:before' => 'border-radius: {{top}}{{unit}} {{right}}{{unit}} {{bottom}}{{unit}} {{left}}{{unit}}',
					'{{WRAPPER}} .latest-posts article.style_3 .post-grid .post-image-wrapper' => 'border-radius: {{top}}{{unit}} {{right}}{{unit}} {{bottom}}{{unit}} {{left}}{{unit}}',
					

				]
			]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_box',
			[
				'label' => __( 'Content', 'spiraclethemes-site-library' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'post_style' => ['style_1','style_2'],
				],
			]

		);

		$this->add_responsive_control(
			'content_paddings',
			[
				'label' => __( 'Content padding', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'default' => ['top'=>'5', 'right'=>'5', 'bottom'=>'5', 'left'=>'5', 'unit'=>'px'],
				'selectors' => [
					'{{WRAPPER}} .latest-posts article.center .post-grid-area-content .content-wrapper .content-inner' => 'padding: {{top}}{{unit}} {{right}}{{unit}} {{bottom}}{{unit}} {{left}}{{unit}}',
				],
				'condition' => [
					'post_style' => ['style_1','style_2'],
				],
			]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_typography',
			[
				'label' => __( 'Title', 'spiraclethemes-site-library' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'section_title_typography',
				'label' => __( 'Section title typography', 'spiraclethemes-site-library' ),
				'selector' => '{{WRAPPER}} .latest-posts .post_title',
				'fields_options' => [
		            'typography' => ['default' => 'yes'],
		            'font_size' => ['default' => ['size' => 20]],
		            'font_weight' => ['default' => 500],
		        ],
		        'condition' => [
					'show_section_title' => 'true',
				]
			]
		);

		$this->add_control(
			'section_title_color',
			[
				'label' => __( 'Section title color', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .latest-posts .post_title' => 'color: {{VALUE}}',
				],
				'condition' => [
					'show_section_title' => 'true',
				]
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Post title typography', 'spiraclethemes-site-library' ),
				'selector' => '{{WRAPPER}} .latest-posts article .title h2 a',
				'fields_options' => [
		            'typography' => ['default' => 'yes'],
		            'font_size' => ['default' => ['size' => 20]],
		            'font_weight' => ['default' => 500],
		        ],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Post title color', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#c8c8c8',
				'selectors' => [
					'{{WRAPPER}} .latest-posts article .title h2 a' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .latest-posts article .title h2' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label' => __( 'Post title hover color', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#c8c8c8',
				'selectors' => [
					'{{WRAPPER}} .latest-posts article .title h2 a:hover' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .latest-posts article .title h2:hover' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_responsive_control(
			'section_title_space',
			[
				'label' => __( 'Section title space', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -50,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .latest-posts .post_title' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'show_section_title' => 'true',
				]
			]
		);

		$this->add_responsive_control(
			'title_space',
			[
				'label' => __( 'Post title space', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -50,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .latest-posts article .title h2 a' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .latest-posts article .title h2' => 'margin-bottom: {{SIZE}}{{UNIT}}'
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_typography',
			[
				'label' => __( 'Content', 'spiraclethemes-site-library' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'post_style' => ['style_3'],
					'post_content_show' => 'true',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => __( 'Typography', 'spiraclethemes-site-library' ),
				'selector' => '{{WRAPPER}} .latest-posts .blog-posts .post .post-content',
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' => __( 'Content color', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .latest-posts .blog-posts .post .post-content' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'content_space',
			[
				'label' => __( 'Content space', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .latest-posts .blog-posts .post .post-content' => 'margin-top: {{SIZE}}{{UNIT}}'
				],
			]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'section_meta_typography',
			[
				'label' => __( 'Category & meta style', 'spiraclethemes-site-library' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'category_typography',
				'label' => __( 'Category', 'spiraclethemes-site-library' ),
				'selector' => '{{WRAPPER}} .latest-posts article .category a',
				'fields_options' => [
		            'typography' => ['default' => 'yes'],
		            'font_size' => ['default' => ['size' => 12]],
		            'font_weight' => ['default' => 400],
		        ],
			]
		);

		$this->add_control(
			'category_color',
			[
				'label' => __( 'Category color', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .latest-posts article .category a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'category_background_settings',
			[
				'label' => esc_html__( 'Category background settings', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'true' => esc_html__( 'Show', 'spiraclethemes-site-library' ),
					'false' => esc_html__( 'Hide', 'spiraclethemes-site-library' ),
				],
				'default' => 'true',
			]
		);

		$this->add_control(
			'category_bg_color',
			[
				'label' => __( 'Category background color', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .latest-posts article .category a' => 'background: {{VALUE}}',
				],
				'condition' => [
					'category_background_settings' => 'true'
				],
			]
		);

		$this->add_responsive_control(
			'category_bg_color_padding',
			[
				'label' => __( 'Category padding', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'default' => ['top'=>'2', 'right'=>'15', 'bottom'=>'2', 'left'=>'15', 'unit'=>'px'],
				'selectors' => [
					'{{WRAPPER}} .latest-posts article .category a' => 'padding: {{top}}{{unit}} {{right}}{{unit}} {{bottom}}{{unit}} {{left}}{{unit}}'
				],
				'condition' => [
					'category_background_settings' => 'true'
				],
			]
		);

		$this->add_responsive_control(
			'category_bg_radius',
			[
				'label' => __( 'Category radius', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'default' => ['top'=>'5', 'right'=>'5', 'bottom'=>'5', 'left'=>'5', 'unit'=>'px'],
				'selectors' => [
					'{{WRAPPER}} .latest-posts article .category a' => 'border-radius: {{top}}{{unit}} {{right}}{{unit}} {{bottom}}{{unit}} {{left}}{{unit}}'
				],
				'condition' => [
					'category_background_settings' => 'true'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
				'label' => __( 'Meta (author,date,comments)', 'spiraclethemes-site-library' ),
				'selector' => '{{WRAPPER}} .latest-posts article .meta span > span',
				'{{WRAPPER}}  .latest-posts article .meta span',
				'fields_options' => [
		            'typography' => ['default' => 'yes'],
		            'font_size' => ['default' => ['size' => 12]],
		            'font_weight' => ['default' => 400],
		        ],
				
			]
		);

		$this->add_control(
			'meta_color',
			[
				'label' => __( 'Meta color', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#c8c8c8',
				'selectors' => [
					'{{WRAPPER}} .latest-posts article .meta span' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .latest-posts article .meta span > a' => 'color: {{VALUE}} !important',

				],
			]
		);

		$this->add_control(
			'meta_hover_color',
			[
				'label' => __( 'Meta hover color', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#c8c8c8',
				'selectors' => [
					'{{WRAPPER}} .latest-posts article .meta span:hover' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .latest-posts article .meta span > a:hover' => 'color: {{VALUE}} !important',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'readmore_typography',
				'label' => __( 'Read more', 'spiraclethemes-site-library' ),
				'selector' => '{{WRAPPER}} .latest-posts article.style_3 .post-read-more a',
				'condition' => [
					'post_style' => ['style_3'],
					'post_show_readmore' => 'true'
				],
			]
		);

		$this->add_responsive_control(
			'readmore_space',
			[
				'label' => __( 'Readmore space', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .latest-posts article.style_3 .post-read-more' => 'margin-top: {{SIZE}}{{UNIT}}'
				],
			]
		);
		
		$this->start_controls_tabs(
			'readmore_colors',
			[
				'condition' => [
					'post_style' => ['style_3'],
					'post_show_readmore' => 'true'
				],
			]
		);

		$this->start_controls_tab(
			'readmore_color_normal',
			[
				'label' => __( 'Normal', 'spiraclethemes-site-library' ),
			]
		);

		$this->add_control(
			'readmore_color',
			[
				'label' => __( 'Color', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .latest-posts article.style_3 .post-read-more a' => 'color: {{VALUE}};'
				],
			]
		);
		

		$this->end_controls_tab();
		

		$this->start_controls_tab(
			'readmore_color_hover',
			[
				'label' => __( 'Hover', 'spiraclethemes-site-library' ),
			]
		);

		$this->add_control(
			'readmore_hover_color',
			[
				'label' => __( 'Color', 'spiraclethemes-site-library' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .latest-posts article.style_3 .post-read-more a:hover' => 'color: {{VALUE}};'
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

	}

	protected function render() {
		require SPIR_SITE_LIBRARY_PATH . '/elements/blogson/post-grid/template/view.php';
	}
}
