<?php

namespace CodingSimply\WpPlugin\Config;

use CodingSimply\WpPlugin\Model\Project;

class Plugin {

	public function init() {
		$project = new Project();
		$project->custom();
		$project->meta_box();
	}
}