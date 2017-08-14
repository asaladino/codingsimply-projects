<?php

namespace CodingSimply\WpPlugin\Core\Repository;

use CodingSimply\WpPlugin\Model\Project;

/**
 * Reads and writes projects to wordpres.
 *
 * @package CodingSimplyProjects\Core\Repository
 */
class ProjectsRepository {

	/**
	 * Find the most recent promoted projects.
	 *
	 * @return Project[] a list of projects.
	 */
	public static function promoted() {
		$posts    = get_posts( [
			'posts_per_page' => 5,
			'post_type'      => Project::getPluralName(),
			'meta_key'       => Project::acfName( 'promote' ),
			'meta_value'     => true
		] );
		$projects = [];
		foreach ( $posts as $post ) {
			$projects[] = Project::init( $post );
		}

		return $projects;
	}

}