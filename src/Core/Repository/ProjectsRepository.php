<?php

namespace CodingSimplyProjects\Core\Repository;

use CodingSimplyProjects\Model\Project;

class ProjectsRepository {

	/**
	 * @return Project[]
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