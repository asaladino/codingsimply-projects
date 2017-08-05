<?php

namespace src\Core\Repository;

use CodingSimplyProjects\Config\Config;

class ProjectsRepository {

	public static function find() {
		$projects = get_posts( [ 'posts_per_page' => 5, 'post_type' =>  Config::PROJECT_POST_TYPE] );
		return $projects;
	}

}