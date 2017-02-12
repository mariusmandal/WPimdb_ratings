<?php
	
$url = 'http://rss.imdb.com/user/ur35073313/ratings';
$timeout = 15;

$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
curl_setopt($curl, CURLOPT_URL, $url);
$curl_result = curl_exec( $curl );
$data = simplexml_load_string( $curl_result );

$username = str_replace("'s Ratings", '', $data->channel->title);

foreach( $data->channel->item as $movie ) {
	// Find and store year
	preg_match("/\(([0-9]{4})(.*)\)/", $movie->title->__toString(), $year);
	$movie->year = $year[1];
	// Find and store rating
	$movie->rating = preg_replace("/[^0-9]/","", str_replace($username, '', $movie->description));
	// Remove year from title
	$movie->title = substr( $movie->title->__toString(), 0, strrpos( $movie->title->__toString(), '('));
	// Find and store time of rating
	$rated = DateTime::createFromFormat('D, d M Y H:i:s e', $movie->pubDate->__toString() );
	$movie->rated = $rated->format('d.m.Y');
	
	// Find and store IMDB ID
	preg_match("/tt([0-9]+)/", $movie->link->__toString(), $id);
	$movie->id = $id[0];
	
	echo '<h3 style="margin-bottom: 2px">'. $movie->title .' (R'. $movie->rating .'@'. $movie->rated .' P'. $movie->year .' - ID: '. $movie->id .')</h3>'
		. $movie->link
		;
}
