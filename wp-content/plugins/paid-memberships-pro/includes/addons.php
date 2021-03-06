<?php
/*
	Some of the code in this library was borrowed from the TGM Updater class by Thomas Griffin. (https://github.com/thomasgriffin/TGM-Updater)
*/

/**
 * Setup plugins api filters
 *
 * @since 1.8.5
*/
function pmpro_setupAddonUpdateInfo()
{
	add_filter('plugins_api', 'pmpro_plugins_api', 10, 3);
	add_filter('pre_set_site_transient_update_plugins', 'pmpro_update_plugins_filter');
	add_filter('http_request_args', 'pmpro_http_request_args_for_addons', 10, 2);
}
add_action('init', 'pmpro_setupAddonUpdateInfo');

/**
 * Get addon information from PMPro server.
 *
 * @since  1.8.5
 */
function pmpro_getAddons()
{
	//check if forcing a pull from the server
	$addons = get_option("pmpro_addons", array());
	$addons_timestamp = get_option("pmpro_addons_timestamp", 0);
	
	//if no addons locally, we need to hit the server
	if(empty($addons) || !empty($_REQUEST['force-check']) || current_time('timestamp') > $addons_timestamp+86400)
	{
		//get em
		$remote_addons = wp_remote_get(PMPRO_LICENSE_SERVER . "/addons/");
		if(get_class($remote_addons) === "WP_Error"){
			return array();
		}
		
		//test response
		if(empty($remote_addons['response']) || $remote_addons['response']['code'] != '200')
		{
			//error
			pmpro_setMessage("Could not connect to the PMPro License Server to update addon information. Try again later.", "error");
			
			//make sure we have at least an array to pass back
			if(empty($addons))
				$addons = array();
		}
		else
		{
			//update addons in cache
			$addons = json_decode(wp_remote_retrieve_body($remote_addons), true);
			delete_option('pmpro_addons');
			add_option("pmpro_addons", $addons, NULL, 'no');
		}
		
		//save timestamp of last update
		delete_option('pmpro_addons_timestamp');
		add_option("pmpro_addons_timestamp", current_time('timestamp'), NULL, 'no');		
	}		
	
	return $addons;
}

/**
 * Find a PMPro addon by slug.
 *
 * @since 1.8.5
 *
 * @param object $slug  The identifying slug for the addon (typically the directory name)
 * @return object $addon containing plugin information or false if not found
*/
function pmpro_getAddonBySlug($slug)
{
	$addons = pmpro_getAddons();
	
	if(empty($addons))
		return false;
		
	foreach($addons as $addon)
		if($addon['Slug'] == $slug)
			return $addon;
			
	return false;
}

/**
* Infuse plugin update details when WordPress runs its update checker.
*
* @since 1.8.5
*
* @param object $value  The WordPress update object.
* @return object $value Amended WordPress update object on success, default if object is empty.
*/
function pmpro_update_plugins_filter( $value ) {
	
	// If no update object exists, return early.
	if ( empty( $value ) ) {
		return $value;
	}

	// get addon information
	$addons = pmpro_getAddons();
	
	// no addons?
	if(empty($addons))
		return $value;
		
	//check addons
	foreach($addons as $addon)
	{
		//skip wordpress.org plugins
		if(empty($addon['License']) || $addon['License'] == 'wordpress')
			continue;
			
		//get data for plugin
		$plugin_file = $addon['Slug'] . '/' . $addon['Slug'] . '.php';
		$plugin_file_abs = ABSPATH . 'wp-content/plugins/' . $plugin_file;				
		
		//couldn't find plugin, skip
		if(!file_exists($plugin_file_abs))
			continue;
		else
			$plugin_data = get_plugin_data( $plugin_file_abs, false, true);
			
		//compare versions
		if(!empty($addon['License']) && version_compare($plugin_data['Version'], $addon['Version'], '<'))
		{
			$value->response[$plugin_file] = pmpro_getPluginAPIObjectFromAddon($addon);
			$value->response[$plugin_file]->new_version = $addon['Version'];			
		}
	}
	
	// Return the update object.
	return $value;
}

/**
 * Disables SSL verification to prevent download package failures.
 *
 * @since 1.8.5
 *
 * @param array $args  Array of request args.
 * @param string $url  The URL to be pinged.
 * @return array $args Amended array of request args.
 */
function pmpro_http_request_args_for_addons($args, $url) 
{
	// If this is an SSL request and we are performing an upgrade routine, disable SSL verification.
	if(strpos($url, 'https://') !== false && strpos($url, PMPRO_LICENSE_SERVER) !== false && strpos($url, "download") !== false)
		$args['sslverify'] = false;
	
	return $args;
}

/**
 * Setup plugin updaters
 *
 * @since  1.8.5
 */
function pmpro_plugins_api($api, $action = '', $args = null)
{	
	//Not even looking for plugin information? Or not given slug?
	if('plugin_information' != $action || empty($args->slug))
		return $api;
	
	//get addon information
	$addon = pmpro_getAddonBySlug($args->slug);
	
	//no addons?
	if(empty($addon))
		return $api;
	
	//handled by wordpress.org?
	if(empty($addon['License']) || $addon['License'] == 'wordpress')
		return $api;
			
	// Create a new stdClass object and populate it with our plugin information.
	$api = pmpro_getPluginAPIObjectFromAddon($addon);
	
	//get license key if one is available
	$key = get_option("pmpro_license_key", "");
	if(!empty($key) && !empty($api->download_link))
		$api->download_link = add_query_arg("key", $key, $api->download_link);
	
	return $api;
}

/**
 * Convert the format from the pmpro_getAddons function to that needed for plugins_api
 *
 * @since  1.8.5
 */
function pmpro_getPluginAPIObjectFromAddon($addon)
{
	$api                        = new stdClass;
		
	if(empty($addon))
		return $api;
	
	$api->name                  = isset( $addon['Name'] )           ? $addon['Name']           : '';
	$api->slug                  = isset( $addon['Slug'] )           ? $addon['Slug']           : '';
	$api->plugin                = isset( $addon['plugin'] )         ? $addon['plugin']           : '';
	$api->version               = isset( $addon['Version'] )        ? $addon['Version']        : '';
	$api->author                = isset( $addon['Author'] )         ? $addon['Author']         : '';
	$api->author_profile        = isset( $addon['AuthorURI'] ) 		? $addon['AuthorURI'] 	   : '';
	$api->requires              = isset( $addon['Requires'] )       ? $addon['Requires']       : '';
	$api->tested                = isset( $addon['Tested'] )         ? $addon['Tested']         : '';
	$api->last_updated          = isset( $addon['LastUpdated'] )   	? $addon['LastUpdated']    : '';
	$api->homepage              = isset( $addon['URI'] )       		? $addon['URI']       	   : '';
	$api->sections['changelog'] = isset( $addon['Changelog'] )      ? $addon['Changelog']      : '';
	$api->download_link         = isset( $addon['Download'] )  		? $addon['Download']  	   : '';
	$api->package        		= isset( $addon['Download'] )  		? $addon['Download']  	   : '';
	
	return $api;
}