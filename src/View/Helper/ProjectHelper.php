<?php

namespace CodingSimplyProjects\View\Helper;

use CodingSimplyProjects\Model\Project;

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

}