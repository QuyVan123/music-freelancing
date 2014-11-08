<?php
require_once('libs/libs.php');

$page_settings = array('title'=>'Inbox', 'file'=>'inbox.php');
prev_page_handler($page_settings);

function print_body(&$page_settings)
{
	get_and_display_chat_users_list();
}

message_handler($page_settings);
print_page($page_settings);
?>
