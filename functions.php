<?php
	
function imdb_activate() {
	global $wpdb;
	$table_name = $wpdb->prefix . "my_rated_movies"; 
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
			  id int(11) unsigned NOT NULL AUTO_INCREMENT,
			  imdb_id varchar(20) NOT NULL DEFAULT '',
			  year int(4) NOT NULL,
			  title varchar(150) NOT NULL DEFAULT '',
			  poster varchar(255) NOT NULL,
			  genre varchar(150) NOT NULL,
			  plot text,
			  runtime int(3) NOT NULL,
			  released datetime NOT NULL,
			  director varchar(150) DEFAULT '',
			  actors varchar(255) NOT NULL DEFAULT '',
			  awards varchar(255) DEFAULT NULL,
			  metascore float DEFAULT NULL,
			  imdb_rating int(2) NOT NULL,
			  imdb_votes int(11) DEFAULT NULL,
			  PRIMARY KEY  (id),
			  UNIQUE KEY imdb_id (imdb_id)
			) $charset_collate";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}
