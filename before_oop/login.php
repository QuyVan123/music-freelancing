<?php
// This is the login page for the user.
require_once('libs/libs.php');
$page_settings=array('title'=>'Login','file'=>'login.php','scripts'=>array('js/login.js'));
prev_page_handler($page_settings);


if (is_signed_in())
{
	error_msg_redirect_index_custom('You attempted to login, you are already signed in');
}


function print_body(&$_page_settings)
{
	echo_login_form($page_settings);
	echo '
	<a href=' . REGISTER_URL . '>Don\'t have an account? Register</a>';
	return $page_settings;
}


message_handler($page_settings);
print_page($page_settings);
