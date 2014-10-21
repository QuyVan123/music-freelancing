<?php
//echo "Under development - Quy";

require_once('config.php');

$page_settings = array('title'=>'Home Page','scripts'=>array(JS_LAND_IMG_URL),'stylesheets'=>array(LANDING_STYLE_URL), 'file'=>'landing_page.php');
function print_body(&$page_settings)
{
	//inspiration
	//http://landerapp.com/templates
	echo '
		<!DOCTYPE html>
	<html lang="en">
	<head>
	<title>' . $page_settings['title'] . ' Home Page</title>
	<meta charset=\'UTF-8\'>
	<link href=\'css/landing.css\' type=\'text/css\' rel=\'stylesheet\'>
	</head>
	<body>
	<div id="top">
	<h1>Studio Pulse</h1>
	</div>
	
	<div id="buttom">
	</div>
	<h2>Connecting Music Makers with Engineers Around the World</h2>
	</body>
	</html>
	
	';
	//connecting music artists and engineers around the world
}

print_body($page_settings);
?>
