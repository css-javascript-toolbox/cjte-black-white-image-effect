<?php
/*
Plugin Name: CJTE Black & White Image Effect
Plugin URI: http://css-javascript-toolbox.com/script-extensions/black-white-image-effect/
Description: CJT-Extension plug-in can easily convert any colored image into a greyscale image
Version: 0.5
Author: Wipeout Media 
Author URI: http://css-javascript-toolbox.com

Copyright (c) 2011, Wipeout Media.
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

// Disallow direct access.
defined('ABSPATH') or die("Access denied");

/**
* Everything is defined cjte-imageblackwhiteeffect.class.php file!
* cjte-imageblackwhiteeffect.xml file definition file tells CSS & javascript Toolbox extensions
* loaded what events to bind to this extensions.
* 
* When a binded event is fired cjte-imageblackwhiteeffect.class.php file will loaded automatically!
* 
* This is great for deferring!
* 
* Only registering activation hook is defined here
* as the hook might be fired even before CJT Plugin is 
* laoded by Wordpress.
*/
class CJTEImageBlockWhiteEffectPackage_Plugin {
	
	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected static $instance;
	
	/**
	* put your comment there...
	* 
	*/
	protected function __construct() {
		# Register activation hook
		register_activation_hook(__FILE__, array($this, '_pluginActivated'));
	}

	/**
	* put your comment there...
	* 
	*/
	public function _pluginActivated() {
		# CJT Plugin directory
		$cjtPluginDir = ABSPATH . PLUGINDIR . DIRECTORY_SEPARATOR . 'css-javascript-toolbox';
		# Make sure CJT is loaded
		if (!defined('CJTOOLBOX_PATH')) {
			# run CJT Plugin
			require_once $cjtPluginDir . DIRECTORY_SEPARATOR . 'css-js-toolbox.php';
		}
		# Autload CJT!
		require_once $cjtPluginDir . DIRECTORY_SEPARATOR . 'autoload.inc.php';
		# Cannot run on CJT Frameworks before activator class is exists
		$activatorClassPath = array($cjtPluginDir, 'framework', 'extensions', 'package', 'activator.php');
		if (file_exists(implode(DIRECTORY_SEPARATOR, $activatorClassPath))) {
			# Activate Plugin
			$activator = new CJT_Framework_Extensions_Package_Activator($this);
			$activator->activate();
		}
	}

	/**
	* put your comment there...
	* 
	*/
	public static function main() {
		# Run if not already running
		if (!self::$instance) {
			self::$instance = new CJTEImageBlockWhiteEffectPackage_Plugin();
		}
		return self::$instance;
	}

} # End class

# Activation hook workaround!!
# No other functionality to be found in this file
# Extension will get loaded by the CJT Framework extensions
# loader procedure
CJTEImageBlockWhiteEffectPackage_Plugin::main();

