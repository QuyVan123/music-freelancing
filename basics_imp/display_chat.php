<?php
require_once('libs/libs.php');

$page_settings = array('title'=>'Profile', 'file'=>'display_chat.php');
prev_page_handler($page_settings);

function page_authentication()
{
	check_get_user();
	check_session_user();
	
}

function check_get_user()
{
	if (!isset($_GET['username']))
	{
		error_msg_redirect_index('Error 2'); // username not in $_GET
	}
	else
	{
		//decided to exclude this because a user may want to keep a chat with a previous job
		/*
		if (is_unique('username',$_GET['username']))
		{
			error_msg_redirect_index_custom('The Username you are looking for does not exist or no longer exists');
		}
		*/
	}
}

function check_session_user()
{
	require_login();
	check_get_and_session_user_not_same();
	
	

}

function check_get_and_session_user_not_same()
{
	if ($_SESSION['user'] == $_GET['username'])
	{
		error_msg_redirect_index('Error 7'); // attempting to chat with yourself
	}
}






function print_body()
{
	$current = htmlspecialchars($_GET['username']);
	
	echo '
	<h1>Messages with ' . $current . '</h1>';
	//check if messages between them exists...if not create a blank slate
	display_chat_box($current);
	//chat input area
	
}

page_authentication();
message_handler($page_settings);
print_page($page_settings);
?>
