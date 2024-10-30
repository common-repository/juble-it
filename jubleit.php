<?php
/**
 * @package Juble it!
 * @version 1.0
 */
/*
Plugin Name: Juble it! for WordPress
Plugin URI: http://wordpress.org/plugins/jubleit/
Description: Juble it is an easier way for creators of all kinds to get paid for their work.  The Juble it! button is your digital tip jar.
Author: Juble it!
Version: 1.0
Author URI: http://jubleit.com/
*/
$class_name = "widget_jubleit";

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

// new jubleit widget
$Juble = new JubleIt_Widget;

$Juble -> widget;

?>
