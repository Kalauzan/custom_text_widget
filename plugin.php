<?php
/*
	Plugin Name: Custom Text Widget
	Plugin URI: http://www.theinfotechs.com/wordpress
	Description: Arbitrary text... but you can count the remaining text and have options to take text up or down the title...
	Version: 1:1:0
	Author: Md. Abu Kalam Azad
	Author URI: http://www.theinfotechs.com/wordpress
	License: GPLv2 or later
	License URI: http://www.theinfotechs.com/wordpress
	Copyright 2016 Md. Abul Kalam Azad (akazad7600@yahoo.com)
	
	This program is free software; you can redistribute it and/or modify it under the terms of the GNU
	General Public License, version 2, as published by the free software foundation.
	
	This program is distributed in the hope that it will be usefull, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PERTICULAR PURPOSE. see the GNU General public license for more details.
	
	You should have recieved a copy of the GNU General Public License along with this program; if not, write to the free software Foundation, Inc., 51 Lohagara, Chittagong, Bangladesh.
*/
/**
*---------------------------------------------------
* = THE WAY TO CREATE PLUGIN SETTINGS LINKS...
*---------------------------------------------------
*/
function plugin_settings_links($links,$file){
	$this_plugin = dirname(plugin_basename(__FILE__));
	if(dirname($file) == $this_plugin){
		$settings_link = "<a href='options-general.php'>Settings</a>";
		$links[] = $settings_link;
	}
	return ($links);
}
add_filter('plugin_action_links','plugin_settings_links',10,2);
/**
*---------------------------------------------------
* = THE WAY TO CREATE PLUGIN LICENSE LINKS...
*---------------------------------------------------
*/
function plugin_license_links($links,$file){
	$this_plugin = dirname(plugin_basename(__FILE__));
	if(dirname($file) == $this_plugin){
		return array_merge(
			$links,
			array(
				'License' => '<a href="http://www.theinfotechs.com">License</a>'
				)
			);
	}
	return $links;
}
add_filter('plugin_row_meta','plugin_license_links', 10,2);
/**
*----------------------------------------------------------------------------------------
* = GOOGLE ANALYTICS...
*-----------------------------------------------------------------------------------------
*/
define( MY_GOOGLE_ANALYTICS, plugin_dir_path(__FILE__).'/inc/my_google_analytics.php' );
if (file_exists(MY_GOOGLE_ANALYTICS) && is_admin()){
		require_once(MY_GOOGLE_ANALYTICS);
}
/**
*----------------------------------------------------------------------------------------
* = MY PLUGIN ACTIVATION HOOK...
*-----------------------------------------------------------------------------------------
*/
define( MY_PLUGIN_ACTIVATION, plugin_dir_path(__FILE__).'/inc/my_activation.php' );
if (file_exists(MY_PLUGIN_ACTIVATION) && is_admin()){
		require_once(MY_PLUGIN_ACTIVATION);
}
class Custom_Widget extends WP_Widget {
	/**
	* Actual initialization to process of widget
	*/
	public function __construct(){
		// Register plugin extdomain
		add_action('init',array($this,'widget_textdomain'));
		
		// Register stylesheets
		add_action('admin_print_styles',array($this,'register_admin_styles'));
		add_action('wp_enqueue_scripts',array($this,'register_widget_styles'));
		
		// Register javascripts
		add_action('admin_enqueue_scripts',array($this,'register_admin_scripts'));
		add_action('wp_enqueue_scripts',array($this,'register_widget_scripts'));
		
		parent::__construct(
			'custom-text',
			__('Custom Text','custom-text'),
			array(
				'classname' => 'custom-text',
				'description' => __('Arbitrary text... but you can count the remaining text and have options to take text up down...','custom-text'),
			)
		);
	}
	/**
	* Output the options form on widget administrative dashbpard
	*/
	public function form($instance){
		$instance = wp_parse_args(
			(array)$instance,
			array(
				'name' => '',
				'bio' => '',
				'position' => 'above',
				'homepage-only' => '',
			)
		);
		include(plugin_dir_path(__FILE__).'/inc/admin.php');
	}
	/**
	* Process widget options to be saved
	*/
	public function update($new_instance, $old_instanse){
		
		$old_instance['name'] = strip_tags(stripslashes($new_instance['name']));
		$old_instance['bio'] = strip_tags(stripslashes($new_instance['bio']));
		$old_instance['position'] = $new_instance['position'];
		$old_instance['homepage-only'] = $new_instance['homepage-only'];
		
		return $old_instance;
	}
	/**
	* Output the content of the widget
	*/
	public function widget($args,$instance){
		extract($args,EXTR_SKIP);
		
		$before_widget;
		include(plugin_dir_path(__FILE__) . '/inc/widget.php');
		$after_widget;
	}
	
	public function widget_textdomain(){
		load_plugin_textdomain('custom-text', plugin_dir_path(__FILE__) . '/languages');
	}
	
	public function register_admin_styles(){
		wp_enqueue_style('custom-text-admin',plugins_url('/my_widget/css/admin.css'));
	}
	
	public function register_widget_styles(){
		wp_enqueue_style('custom-text-widget',plugins_url('/my_widget/css/widget.css'));
	}
	
	public function register_admin_scripts(){
		wp_enqueue_script('custom-text-admin',plugins_url('my_widget/js/admin.js'));
	}
	
	public function register_widget_scripts(){
		wp_enqueue_style('custom-text-widget',plugins_url('/my_widget/js/widget.js'));
	}
}
add_action('widgets_init',create_function('','register_widget("Custom_Widget");'));
?>
