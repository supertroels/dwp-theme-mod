<?php

/*
Plugin Name: deployWP | Theme modifications
Description: deployWP module for theme modifications
*/

add_action('deployWP', 'dwp_theme_mod_register_modulee');
function dwp_theme_mod_register_modulee(){
	register_deploy_module('theme_mod', dirname(__FILE__).'/theme_mod.dwp.php');
}


?>