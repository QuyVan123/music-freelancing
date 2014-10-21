<?php

function create_error_msg($error_number)
{
	return $error_number . ', please report issue on the contact us page';
}

//current
function error_msg_redirect_current($error_number)
{
	$_SESSION['message_buffer'] = create_message("errorMessage",create_error_msg($error_number));
	redirect_current_page();
}

function error_msg_redirect_current_custom($message)
{
	$_SESSION['message_buffer'] = create_message("errorMessage",$message);
	redirect_current_page();
}

//index
function error_msg_redirect_index($error_number)
{
	$_SESSION['message_buffer'] = create_message("errorMessage",create_error_msg($error_number));
	redirect_index_page();
}

function error_msg_redirect_index_custom($msg)
{
	$_SESSION['message_buffer'] = create_message("errorMessage",$msg);
	redirect_index_page();
}

//previous
function error_msg_redirect_previous($error_number)
{
	$_SESSION['message_buffer'] = create_message("errorMessage",create_error_msg($error_number));
	redirect_previous_page();
}

function error_msg_redirect_previous_custom($message)
{
	$_SESSION['message_buffer'] = create_message("errorMessage",$message);
	redirect_previous_page();
}

function error_msg_redirect_not_signed_in()
{
	$_SESSION['message_buffer'] = create_message("errorMessage", "Please sign in first.");
	redirect_index_page();
}




function message_handler(&$page_settings)
{	
	if (isset($_SESSION['message_buffer'])) 
	{
		$page_settings['display_message'] = $_SESSION['message_buffer'];
		unset($_SESSION['message_buffer']);
	}
}

function create_message($type, $message) {
  // $type can be infoMessage, successMessage, warningMessage, errorMessage, or validationMessage
  return "<div class='$type'>$message</div>";
}


?>