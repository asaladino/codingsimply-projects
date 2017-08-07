<?php
/*
Plugin Name: Projects by CS;
Plugin URI: http://wordpress.org/plugins/codingsimply-projects/
Description: Display your projects in on your wp site and connect with your public git repo.
Author: Adam Saladino
Version: 0.1.0
Author URI: https://codingsimply.com
Text Domain: codingsimply-projects
*/

namespace CodingSimplyProjects;

use CodingSimplyProjects\Config\Plugin;

require_once __DIR__ . '/vendor/autoload.php';

spl_autoload_register( function ( $className ) {
	$file = __DIR__ . DIRECTORY_SEPARATOR . str_replace( __NAMESPACE__, 'src', $className ) . '.php';
	$file = str_replace( '\\', DIRECTORY_SEPARATOR, $file );
	if ( file_exists( $file ) ) {
		/** @noinspection PhpIncludeInspection */
		require_once $file;
	}
} );

$plugin = new Plugin();
add_action( 'init', [ $plugin, 'init' ], 0 );