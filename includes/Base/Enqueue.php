<?php 

/**
 * @package Event Calendar
 * Load all styles and scripts
 */

namespace Includes\Base;

class Enqueue {

	public function register()
	{
		add_action( 'wp_enqueue_scripts', array( $this, 'add_styles_and_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'add_styles_and_scripts' ) );
	}
	
	public function add_styles_and_scripts()
	{
		wp_enqueue_style('event-calendar-style', PLUGIN_URL . 'assets/css/event-calendar-style.css');
		wp_enqueue_script('event-calendar-script', PLUGIN_URL . 'assets/js/event-calendar-script.min.js');		
		add_editor_style( PLUGIN_URL . 'assets/css/event-calendar-wp-editor.css' );
	}	
}