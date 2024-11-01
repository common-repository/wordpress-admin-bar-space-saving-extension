<?php
/*
Plugin Name: Wordpress Admin Bar Space Saving Ext.
Plugin URI: http://kahi.cz/wordpress/admin-bar-space-saving-plugin
Description: An extension for Wordpress Admin Bar plugin. Removes the header in administration &amp; adds the missing <em>View site</em> link into the bar.
Author: Peter Kahoun aka Kahi
Version: 1.0.1
Author URI: http://kahi.cz
*/



class KABSSE {

	// Descr: full name. used on options-page, ...
	static $full_name = 'Wordpress Admin Bar Space Saving Ext.';

	// Descr: short name. used in menu-item name, ...
	static $short_name = 'Admin Bar Ext.';

	// Descr: abbreviation. used in textdomain, ...
	// Descr: must be same as the name of the class
	static $abbr = 'kabsse';

	// Descr: path to this this file
	// filled automatically
	static $dir_name = '';




	// Descr: initialization. filling main variables, preparing, hooking
	// Descr: constructor replacement (this class is designed to be used as static). calling the initialization: see the end.
	public static function Init () {

		// set self::$dir_name
		$t = str_replace('\\', '/', dirname(__FILE__));
		self::$dir_name = trim(substr($t, strpos($t, '/plugins/')+9), '/');

		// load translation
		// load_plugin_textdomain(self::$abbr, 'wp-content/plugins/' . self::$dir_name . '/languages/');

		// prepare settings
		// self::PrepareSettings();

		// hooking
		add_action('admin_head', array (self::$abbr, 'admin_head'));
		add_filter('wpabar_menuitems', array (self::$abbr, 'wpabar_menuitems'));

	}


	// ---------- WP hooked functions


	// Hook: Action: admin_head
	// Descr: adds CSS <style> block that hides the header
	public static function admin_head ($content) {

?>

	<!-- plugin: <?php echo self::$full_name; ?> -->
	<style type="text/css" media="screen, projection">
		#wphead, #user_info {display:none !important;}
		body {margin-top:1em;}
	</style>

<?php

	}


	// Hook: Filter: wpabar_menuitems
	// Descr: adds into the bar link to the site
	public static function wpabar_menuitems ($array) {
		
		$viewsite_link = array (
			0 => array (				
				'id' => 0,
				'title' => 'Home &nbsp;',
      		'custom' => false,
			)
		);
		
		$array = array_reverse($array, true);
		$array['../'] = $viewsite_link; // http://kahi.cz/blog/
		$array = array_reverse($array, true); 

		return $array;

	}

} // end of class



// Initialize the plugin
KABSSE::Init();
