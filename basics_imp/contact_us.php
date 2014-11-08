<?php

require_once('libs/libs.php');

$page_settings = array('title'=>'Contact Us Page', 'file'=>'contact_us.php');
prev_page_handler($page_settings);

function print_body(&$page_settings)
{
	echo '
	Email: customer-service@studiopulse.net</p>';
	
	echo_contact_form($page_settings); // not implemented yet
}

message_handler($page_settings);
print_page($page_settings);
?>
