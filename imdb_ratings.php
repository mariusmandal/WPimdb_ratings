<?php  
/* 
Plugin Name: My IMDB ratings
Plugin URI: http://github.com/mariusmandal/WPimdb_ratings
Description: Fetches movies rated by user and stores them in local db
Author: Marius Mandal
Version: 0.1
Author URI: http://www.mariusmandal.no
*/
	
require_once('functions.php');
register_activation_hook( __FILE__, 'imdb_activate' );
