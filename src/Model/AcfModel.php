<?php

namespace CodingSimplyProjects\Model;

use CodingSimplyProjects\Config\Config;

class AcfModel {

	/**
	 * @var \WP_Post
	 */
	public $post;

	/**
	 * @var array
	 */
	public $acfFields = [];

	/**
	 * @var string
	 */
	public static $acfPrefix = '';

	/**
	 * Name of the model.
	 * @var string
	 */
	public static $name = '';

	public $loops = [];

	public function loop( $field ) {
		if ( !isset( $this->loops[ $field ] ) ) {
			$this->loops[ $field ] = 0;
		}
		$this->loops[ $field ] ++;
		if ( $this->loops[ $field ] === 1 ) {
			$found = property_exists( $this, $field );
		} else {
			$found = property_exists( $this, $field . '_' . $this->loops[ $field ] );
		}
		if ( ! $found ) {
			unset( $this->loops[ $field ] );

			return false;
		}

		return true;
	}

	public function now( $field ) {
		if ( $this->loops[ $field ] === 1 ) {
			return $this->$field;
		}

		return $this->{$field . '_' . $this->loops[ $field ]};
	}

	public function hasValue($field) {
		$value = $this->now($field);
		return !is_null($value) && !empty($value);
	}

	/**
	 * Helper method for getting the acf name from a local field name.
	 *
	 * @param $local string field name that will map to an acf name.
	 *
	 * @return string
	 */
	public static function acfName( $local ) {
		return self::acfPrefix() . $local;
	}


	/**
	 * Creates a prefix for acf.
	 */
	public static function acfPrefix() {
		if ( self::$acfPrefix !== '' ) {
			return self::$acfPrefix;
		}
		$topLevelNs = explode( '\\', __NAMESPACE__ )[0];
		$parts      = preg_split( '/(?=[A-Z])/', $topLevelNs );
		unset( $parts[0] );
		$parts           = array_map( 'strtolower', $parts );
		self::$acfPrefix = implode( '_', $parts ) . '_';

		return self::$acfPrefix;
	}

	/**
	 * Get the name of the class.
	 *
	 * @return string
	 */
	public static function getName() {
		if ( self::$name !== '' ) {
			return self::$name;
		}
		$parts      = explode( '\\', get_called_class() );
		self::$name = $parts[ count( $parts ) - 1 ];

		return self::$name;
	}

	/**
	 * Get's the name plural and lowercase.
	 *
	 * @return string
	 */
	public static function getPluralName() {
		return strtolower( self::getName() ) . 's';
	}

	/**
	 * Get a model instance.
	 *
	 * @param $post \WP_Post
	 *
	 * @return object parent.
	 */
	public static function init( $post ) {
		$class    = get_called_class();
		$acfModel = new $class;
		$p        = get_fields( $post->ID );
		foreach ( $acfModel->acfFields as $key => $field ) {
			$local              = str_replace( self::$acfPrefix, '', $field['name'] );
			$acfModel->{$local} = $p[ $field['name'] ];
		}
		$acfModel->post = $post;

		return $acfModel;
	}

	/**
	 * Creates the custom post type for the acf class.
	 */
	public function custom() {
		$labels = [
			'name'                  => _x( self::getName() . 's', self::getName() . ' General Name', Config::TEXT_DOMAIN ),
			'singular_name'         => _x( self::getName(), self::getName() . ' Singular Name', Config::TEXT_DOMAIN ),
			'menu_name'             => __( self::getName() . 's', Config::TEXT_DOMAIN ),
			'name_admin_bar'        => __( self::getName(), Config::TEXT_DOMAIN ),
			'archives'              => __( self::getName() . ' Archives', Config::TEXT_DOMAIN ),
			'attributes'            => __( self::getName() . ' Attributes', Config::TEXT_DOMAIN ),
			'parent_item_colon'     => __( 'Parent ' . self::getName() . ':', Config::TEXT_DOMAIN ),
			'all_items'             => __( 'All ' . self::getName() . 's', Config::TEXT_DOMAIN ),
			'add_new_item'          => __( 'Add New ' . self::getName(), Config::TEXT_DOMAIN ),
			'add_new'               => __( 'Add New', Config::TEXT_DOMAIN ),
			'new_item'              => __( 'New ' . self::getName(), Config::TEXT_DOMAIN ),
			'edit_item'             => __( 'Edit ' . self::getName(), Config::TEXT_DOMAIN ),
			'update_item'           => __( 'Update ' . self::getName(), Config::TEXT_DOMAIN ),
			'view_item'             => __( 'View ' . self::getName(), Config::TEXT_DOMAIN ),
			'view_items'            => __( 'View ' . self::getName() . 's', Config::TEXT_DOMAIN ),
			'search_items'          => __( 'Search ' . self::getName(), Config::TEXT_DOMAIN ),
			'not_found'             => __( 'Not found', Config::TEXT_DOMAIN ),
			'not_found_in_trash'    => __( 'Not found in Trash', Config::TEXT_DOMAIN ),
			'featured_image'        => __( 'Featured Image', Config::TEXT_DOMAIN ),
			'set_featured_image'    => __( 'Set featured image', Config::TEXT_DOMAIN ),
			'remove_featured_image' => __( 'Remove featured image', Config::TEXT_DOMAIN ),
			'use_featured_image'    => __( 'Use as featured image', Config::TEXT_DOMAIN ),
			'insert_into_item'      => __( 'Insert into ' . strtolower( self::getName() ), Config::TEXT_DOMAIN ),
			'uploaded_to_this_item' => __( 'Uploaded to this ' . strtolower( self::getName() ), Config::TEXT_DOMAIN ),
			'items_list'            => __( self::getName() . 's list', Config::TEXT_DOMAIN ),
			'items_list_navigation' => __( self::getName() . 's list navigation', Config::TEXT_DOMAIN ),
			'filter_items_list'     => __( 'Filter ' . self::getPluralName() . ' list', Config::TEXT_DOMAIN ),
		];
		$args   = [
			'label'               => __( self::getName() . '', Config::TEXT_DOMAIN ),
			'description'         => __( self::getName() . ' Description', Config::TEXT_DOMAIN ),
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
			'rest_base'           => self::getPluralName(),
		];
		register_post_type( self::getPluralName(), $args );
	}

	/**
	 * Creates a meta box for the parameters on the custom post type using acf.
	 */
	public function meta_box() {
		if ( function_exists( "register_field_group" ) ) {
			register_field_group( [
				'id'         => 'acf_' . self::$acfPrefix . 'info',
				'title'      => self::getName() . ' Info',
				'fields'     => $this->acfFields,
				'location'   => [
					[
						[
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => self::getPluralName(),
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