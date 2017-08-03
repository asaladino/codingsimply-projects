<?php
/**
 * Created by PhpStorm.
 * User: adamsaladino
 * Date: 8/1/17
 * Time: 8:08 PM
 */

namespace CodingSimplyProjects\Controller;


class ProjectsController {

	public function index($atts) {

		// Attributes
		$atts = shortcode_atts(
			array(
				'id' => '',
			),
			$atts,
			'cs-project'
		);

	}

	public function view() {
		echo 'test';
		exit;
	}
}