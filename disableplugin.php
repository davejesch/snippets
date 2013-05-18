<?php
/*
  Plugin Name: Disable Plugin
  Plugin URI: http://davejesch.com
  Description: Disables a specific plugin on client requests
  Author: Dave Jesch
  Version: 1.0.0
 */

/*
	This plugin will disable a specifically named plugin, causing it to not be
	loaded when WordPress is going through it's bootstrap process on client requests.
	Admin requests will always load the plugin.

	Set up whatever conditions you like to get the filter in place. Once the
	filter is called it removes the specific plugin from the list of active plugins.
*/

if (!is_admin() /* && other conditions */)
	add_filter('option_active_plugins', 'dj_disable_plugin', 10, 2);

function dj_disable_plugin($options, $default)
{
	$idx = 0;
	foreach ($options as $opt)
	{
		// this example is excluding Gravity Forms. To disable any other plugin,
		// change the following line to match the plugin file
		if ($opt == 'gravityforms/gravityforms.php')
		{
			unset($options[$idx]);
			break;
		}
		$idx++;
	}
	return ($options);
}
