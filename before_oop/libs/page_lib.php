<?php
//functions used to handle the front end of the website go here

//should this be here?
session_start();


//function print_page($page_settings=array())
function print_page(&$page_settings)
{
	print_file_header($page_settings);
	print_page_header($page_settings);
	print_body($page_settings); // defined on the actual page
	print_footer($page_settings);
}


function print_file_header(&$page_settings)
{
	$escapedTitle = htmlspecialchars($page_settings['title']);
	
	echo'
	<!DOCTYPE html>
	<html lang="en">
	<head>
	<title>' . $escapedTitle . ' Home Page</title>
	<meta charset=\'UTF-8\'>';
	
	handle_and_print_external_files($page_settings);
}

function handle_and_print_external_files(&$page_settings)
{
	style_sheet_handler($page_settings);
	script_handler($page_settings);
	
}


//the css urls array is kind of messy
//should modify the config file making $CSS_URLS_ARRAY into CSS_URLS_LIST as a string
// then explode the list into the array below
function style_sheet_handler(&$page_settings)
{
	global $CSS_URLS_ARRAY;
	if (!isset($page_settings['stylesheets']))
	{
		$page_settings['stylesheets']=array();
	}
	$page_settings['stylesheets'] = array_merge($CSS_URLS_ARRAY,$page_settings['stylesheets']);
	echo_style_sheets($page_settings);
}

function script_handler(&$page_settings)
{
	if (!isset($page_settings['scripts']))
	{
		$page_settings['scripts'] = array();
	}
	echo_scripts($page_settings);
}

function echo_style_sheets(&$page_settings)
{
	foreach ($page_settings['stylesheets'] as $css_href)
	{
		echo '
		<link href=\'' . htmlspecialchars($css_href) .'\' type=\'text/css\' rel=\'stylesheet\'>';
	}
}

function echo_scripts(&$page_settings)
{
	
	foreach ($page_settings['scripts'] as $script_src) 
	{
		echo '
		<script src=' . htmlspecialchars($script_src) . ' type="text/javascript"></script>';
	}
}



function print_page_header(&$page_settings)
{
	//navigator
	echo '
	</head>
	<body>
		<div id=\'page\'> 
			<div id=\'header\'>
				<a id=\'title_header\' href=\'' . INDEX_URL . '\'>' . WEBSITE_NAME . '</a>';
	if (is_signed_in())
	{
		echo_user_session_navigation_and_logout();
	}
	else
	{
		echo_non_user_session_navigation_and_register_login();
	}
	display_messages($page_settings);
}

function echo_public_navigation_links()
{
	create_menu_link(INDEX_URL,"Home Page");
	create_menu_link(USER_LIST_URL,"User List");
	create_menu_link(CONTACT_US_URL,"Contact Us");
	create_menu_link(PAYMENT_TEST_URL,"Payment Test");
	create_menu_link(JOB_POST_LISTING_URL,"Job Listings");
	
}

function echo_user_session_navigation_and_logout()
{
	echo '
		<ul id="login_register">
		
		<li> <a href=\'' . LOGOUT_URL . '\'>Logout</a> </li>';
		
	create_menu_accent_link(DISPLAY_PROFILE_URL . '?username=' . $_SESSION['user'], $_SESSION['user'] . "'s Profile"); 
	
	echo '
		</ul>
		</div>
		<ul id=\'menu\'>';
	echo_public_navigation_links();
	
	create_menu_link(EDIT_PROFILE_URL . '?username=' . $_SESSION['user'],"Edit Profile");
	create_menu_link(UPLOAD_FILE_URL,"Upload File");
	create_menu_link(VIEW_FILES_URL,"View Files");
	create_menu_link(INBOX_URL,"Inbox");
	create_menu_link(JOB_POST_CREATE_URL,"Job Post Create");
	
	echo '
		</ul>
		<div id="main_stuff">
		';
}

function echo_non_user_session_navigation_and_register_login()
{
	echo '
		<ul id="login_register">';
		
	create_menu_link(LOGIN_URL,"Login");
	create_menu_accent_link(REGISTER_URL,"Register");
	
	echo '
		</ul>
		</div>
		<ul id=\'menu\'>';
		
	echo_public_navigation_links();
	
	echo '
		</ul>
		<div id="main_stuff">
		';
}

function display_messages(&$page_settings)
{
	if (isset($page_settings['display_message'])) 
	{
		//currently displays only 1 message
		/*
		foreach ($page_settings['display_message'] as $msg) 
		{
			echo '
			<p>' . $page_settings["display_message"] . '</p>';
		}
		*/
		echo '
			<p>' . $page_settings["display_message"] . '</p>';
	}
}

///////////////////////////////////////////////////////////////////

function print_footer(&$page_settings)
{
	echo '
	</div>
	<div id=\'footer\'>
	<p>2013 All rights reserved by Quy.<p>
	</div></div>
	</body></html>';
}

//deprecated
function get_page_settings($key,&$page_settings)
{
	if (isset($page_settings[$key]))
		return $page_settings[$key];
	else
		return '';
}

function create_menu_accent_link($url, $display)
{
	echo '<li> <a href=\'' . $url . '\' id="accent_item_in_login_register">' . $display .'</a> </li>';
}

function create_menu_link($url, $display)
{
	/*
	if (get_page_settings('title',$page_settings)==$display)
	{
		echo '<li > <a href=\'' . $url . '\' class="active">' . $display .'</a> </li>';
	}
	else
	*/
	echo '<li> <a href=\'' . $url . '\'>' . $display .'</a> </li>';
}
?>