<?php
require_once('libs/libs.php');

require_login();
$page_settings = array('title'=>'View Files', 'file'=>'view_files.php');
prev_page_handler($page_settings);


function print_body(&$page_settings)
{
	echo '<p>View Files Page</p>';
	echo_files($page_settings,$_SESSION['user']);
}

message_handler($page_settings);
print_page($page_settings);
?>
