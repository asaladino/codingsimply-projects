<?php

namespace CodingSimplyProjects\Config;

use CodingSimplyProjects\Model\Project;

class Plugin {

	public function init() {
		$project = new Project();
		$project->custom();
		$project->meta_box();

	}
}