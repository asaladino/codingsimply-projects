<?php

namespace CodingSimplyProjects\Model;


use CodingSimplyProjects\Config\Config;

/**
 * Model that describes a project.
 *
 * @package CodingSimplyProjects\Model
 */
class Project {

	/**
	 * @var string
	 */
	public $git_url;

	/**
	 * @var string
	 */
	public $icon_url;

	/**
	 * @var string
	 */
	public $screenshot_url;

	/**
	 * @var string
	 */
	public $screenshot_url_2;

	/**
	 * @var string
	 */
	public $screenshot_url_3;

	/**
	 * @var string
	 */
	public $screenshot_url_4;

	/**
	 * @var string
	 */
	public $screenshot_url_5;

	/**
	 * @var \WP_Post
	 */
	public $post;

	/**
	 * @var string
	 */
	protected $acfPrefix = 'coding_simply_project_';

	/**
	 * @var array
	 */
	protected $acfFields = [];

	/**
	 * Need to load the acf fields during construction of the project object.
	 */
	public function __construct() {
		$this->acfFields = [
			[
				'key'           => 'field_598122f309509',
				'label'         => 'Git URL',
				'name'          => $this->acfPrefix . 'git_url',
				'type'          => 'text',
				'instructions'  => 'Publicly access url for you git repo. A README.md file should be accessible.',
				'required'      => 1,
				'default_value' => '',
				'placeholder'   => 'http://',
				'prepend'       => '',
				'append'        => '',
				'formatting'    => 'none',
				'maxlength'     => '',
			],
			[
				'key'           => 'field_5981253d9d8d5',
				'label'         => 'Icon URL',
				'name'          => $this->acfPrefix . 'icon_url',
				'type'          => 'text',
				'instructions'  => 'Publicly accessible url for project icon. Probably in your git repo.',
				'required'      => 1,
				'default_value' => '',
				'placeholder'   => 'http://',
				'prepend'       => '',
				'append'        => '',
				'formatting'    => 'none',
				'maxlength'     => '',
			],
			[
				'key'           => 'field_59822f1db0898',
				'label'         => 'Screenshot URL',
				'name'          => $this->acfPrefix . 'screenshot_url',
				'type'          => 'text',
				'instructions'  => 'Publicly accessible url for a project screenshot. Probably in your git repo.',
				'default_value' => '',
				'placeholder'   => 'http://',
				'required'      => 1,
				'prepend'       => '',
				'append'        => '',
				'formatting'    => 'none',
				'maxlength'     => '',
			],
			[
				'key'           => 'field_59822f3fb0899',
				'label'         => 'Screenshot URL 2',
				'name'          => $this->acfPrefix . 'screenshot_url_2',
				'type'          => 'text',
				'instructions'  => 'Publicly accessible url for a project screenshot. Probably in your git repo.',
				'default_value' => '',
				'placeholder'   => 'http://',
				'prepend'       => '',
				'append'        => '',
				'formatting'    => 'none',
				'maxlength'     => '',
			],
			[
				'key'           => 'field_59822f58b089a',
				'label'         => 'Screenshot URL 3',
				'name'          => $this->acfPrefix . 'screenshot_url_3',
				'type'          => 'text',
				'instructions'  => 'Publicly accessible url for a project screenshot. Probably in your git repo.',
				'default_value' => '',
				'placeholder'   => 'http://',
				'prepend'       => '',
				'append'        => '',
				'formatting'    => 'none',
				'maxlength'     => '',
			],
			[
				'key'           => 'field_59822f6ab089b',
				'label'         => 'Screenshot URL 4',
				'name'          => $this->acfPrefix . 'screenshot_url_4',
				'type'          => 'text',
				'instructions'  => 'Publicly accessible url for a project screenshot. Probably in your git repo.',
				'default_value' => '',
				'placeholder'   => 'http://',
				'prepend'       => '',
				'append'        => '',
				'formatting'    => 'none',
				'maxlength'     => '',
			],
			[
				'key'           => 'field_59822f78b089c',
				'label'         => 'Screenshot URL 5',
				'name'          => $this->acfPrefix . 'screenshot_url_5',
				'type'          => 'text',
				'instructions'  => 'Publicly accessible url for a project screenshot. Probably in your git repo.',
				'default_value' => '',
				'placeholder'   => 'http://',
				'prepend'       => '',
				'append'        => '',
				'formatting'    => 'none',
				'maxlength'     => '',
			]
		];
	}

	/**
	 * Get a Project from a Post.
	 *
	 * @param $post \WP_Post
	 *
	 * @return Project
	 */
	public static function init( $post ) {
		$project = new Project();
		$p       = get_fields( $post->ID );
		foreach ( $project->acfFields as $key => $field ) {
			$local             = str_replace( $project->acfPrefix, '', $field['name'] );
			$project->{$local} = $p[ $field['name'] ];
		}
		$project->post = $post;

		return $project;
	}

	/**
	 * Creates the custom post type for the project.
	 */
	public function custom() {
		$labels = [
			'name'                  => _x( 'Projects', 'Project General Name', Config::TEXT_DOMAIN ),
			'singular_name'         => _x( 'Project', 'Project Singular Name', Config::TEXT_DOMAIN ),
			'menu_name'             => __( 'Projects', Config::TEXT_DOMAIN ),
			'name_admin_bar'        => __( 'Project', Config::TEXT_DOMAIN ),
			'archives'              => __( 'Project Archives', Config::TEXT_DOMAIN ),
			'attributes'            => __( 'Project Attributes', Config::TEXT_DOMAIN ),
			'parent_item_colon'     => __( 'Parent Project:', Config::TEXT_DOMAIN ),
			'all_items'             => __( 'All Projects', Config::TEXT_DOMAIN ),
			'add_new_item'          => __( 'Add New Project', Config::TEXT_DOMAIN ),
			'add_new'               => __( 'Add New', Config::TEXT_DOMAIN ),
			'new_item'              => __( 'New Project', Config::TEXT_DOMAIN ),
			'edit_item'             => __( 'Edit Project', Config::TEXT_DOMAIN ),
			'update_item'           => __( 'Update Project', Config::TEXT_DOMAIN ),
			'view_item'             => __( 'View Project', Config::TEXT_DOMAIN ),
			'view_items'            => __( 'View Projects', Config::TEXT_DOMAIN ),
			'search_items'          => __( 'Search Project', Config::TEXT_DOMAIN ),
			'not_found'             => __( 'Not found', Config::TEXT_DOMAIN ),
			'not_found_in_trash'    => __( 'Not found in Trash', Config::TEXT_DOMAIN ),
			'featured_image'        => __( 'Featured Image', Config::TEXT_DOMAIN ),
			'set_featured_image'    => __( 'Set featured image', Config::TEXT_DOMAIN ),
			'remove_featured_image' => __( 'Remove featured image', Config::TEXT_DOMAIN ),
			'use_featured_image'    => __( 'Use as featured image', Config::TEXT_DOMAIN ),
			'insert_into_item'      => __( 'Insert into project', Config::TEXT_DOMAIN ),
			'uploaded_to_this_item' => __( 'Uploaded to this project', Config::TEXT_DOMAIN ),
			'items_list'            => __( 'Projects list', Config::TEXT_DOMAIN ),
			'items_list_navigation' => __( 'Projects list navigation', Config::TEXT_DOMAIN ),
			'filter_items_list'     => __( 'Filter projects list', Config::TEXT_DOMAIN ),
		];
		$args   = [
			'label'               => __( 'Project', Config::TEXT_DOMAIN ),
			'description'         => __( 'Project Description', Config::TEXT_DOMAIN ),
			'labels'              => $labels,
			'supports'            => [],
			'taxonomies'          => [ 'category', 'post_tag' ],
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
			'show_in_rest'        => true,
			'rest_base'           => '/projects/',
		];
		register_post_type( Config::PROJECT_POST_TYPE, $args );
	}

	/**
	 * Creates a meta box for the project parameters on the custom post type using acf.
	 */
	public function meta_box() {
		if ( function_exists( "register_field_group" ) ) {
			register_field_group( [
				'id'         => 'acf_' . $this->acfPrefix . 'info',
				'title'      => 'Project Info',
				'fields'     => $this->acfFields,
				'location'   => [
					[
						[
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => Config::PROJECT_POST_TYPE,
							'order_no' => 0,
							'group_no' => 0,
						],
					],
				],
				'options'    => [
					'position'       => 'normal',
					'layout'         => 'default',
					'hide_on_screen' => [],
				],
				'menu_order' => 0
			] );
		}
	}
}