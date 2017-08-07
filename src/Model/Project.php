<?php

namespace CodingSimplyProjects\Model;


use CodingSimplyProjects\Config\Config;

/**
 * Model that describes a project.
 *
 * @package CodingSimplyProjects\Model
 */
class Project extends AcfModel {

	/**
	 * @var string
	 */
	public $git_url;

	/**
	 * @var bool
	 */
	public $promote;

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
	 * Check if the project has an icon.
	 * @return bool
	 */
	public function hasIcon() {
		return ! empty( $this->icon_url );
	}

	/**
	 * Need to load the acf fields during construction of the project object.
	 */
	public function __construct() {
		$this->acfFields = [
			[
				'key'           => 'field_598122f309509',
				'label'         => 'Git URL',
				'name'          => self::acfName( 'git_url' ),
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
				'key'           => 'field_5986f0db875a5',
				'label'         => 'Promote',
				'name'          => self::acfName( 'promote' ),
				'type'          => 'true_false',
				'instructions'  => 'Should this project get promoted.',
				'message'       => '',
				'default_value' => 0,
			],
			[
				'key'           => 'field_5981253d9d8d5',
				'label'         => 'Icon URL',
				'name'          => self::acfName( 'icon_url' ),
				'type'          => 'text',
				'instructions'  => 'Publicly accessible url for project icon. Probably in your git repo.',
				'required'      => 0,
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
				'name'          => self::acfName( 'screenshot_url' ),
				'type'          => 'text',
				'instructions'  => 'Publicly accessible url for a project screenshot. Probably in your git repo.',
				'default_value' => '',
				'placeholder'   => 'http://',
				'required'      => 0,
				'prepend'       => '',
				'append'        => '',
				'formatting'    => 'none',
				'maxlength'     => '',
			],
			[
				'key'           => 'field_59822f3fb0899',
				'label'         => 'Screenshot URL 2',
				'name'          => self::acfName( 'screenshot_url_2' ),
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
				'name'          => self::acfName( 'screenshot_url_3' ),
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
				'name'          => self::acfName( 'screenshot_url_4' ),
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
				'name'          => self::acfName( 'screenshot_url_5' ),
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
}