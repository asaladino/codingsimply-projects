<?php

namespace CodingSimply\WpPlugin\View\Helper;

use CodingSimply\WpPlugin\Model\Project;

/**
 * Will helps outputting the project.
 *
 * @package CodingSimplyProjects\View\Helper
 */
class ProjectHelper {

	/**
	 * @var Project
	 */
	protected $project;

	public function __construct( $project ) {
		$this->project = $project;
	}

	/**
	 * Get project initials from the title.
	 * @return string
	 */
	public function getTitleInitials() {
		$parts = explode( ' ', $this->project->post->post_title );
		if ( count( $parts ) > 1 ) {
			return substr( $parts[0], 0, 1 ) .
			       strtolower( substr( $parts[1], 0, 1 ) );
		}
		$parts = preg_split( '/(?=[A-Z])/', $this->project->post->post_title );
		if ( count( $parts ) > 2 ) {
			return substr( $parts[1], 0, 1 ) .
			       strtolower( substr( $parts[2], 0, 1 ) );
		}

		return substr( $parts[0], 0, 1 ) .
		       strtolower( substr( $parts[0], 1, 1 ) );
	}

	/**
	 * The icon for the project.
	 *
	 * @param $owner string of the project.
	 *
	 * TODO: Owner should be part of the project.
	 *
	 * @return string
	 */
	public function getIcon( $owner ) {
		if ( $this->project->hasIcon() ) {
			return "<img class='shadow' src='{$this->project->icon_url}'/>";
		}

		return "<div class='project-icon shadow'>
				<div class='project-initials'>{$this->getTitleInitials()}</div>
				<div class='project-owner'>{$owner}</div></div>";
	}

	/**
	 * Creates an img for the first screenshot.
	 *
	 * @param string $class css for the image. Default is thumbnail.
	 *
	 * @return string|null img tag for the screenshot.
	 */
	public function getScreenShot( $class = 'thumbnail' ) {
		if ( $this->project->hasValue( 'screenshot_url' ) ) {
			return "<img src='{$this->project->now( 'screenshot_url' )}' class='$class' />";
		}
	}

}