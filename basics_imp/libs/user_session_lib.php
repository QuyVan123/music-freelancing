<?php
//all files used to handle user session go here

function sign_out()
{
	session_destroy();
}

function require_login()
{
	require_session();
}

function require_session()
{
	if (!isset($_SESSION['user']))
	{
		error_msg_redirect_not_signed_in();
	}
}

function is_signed_in()
{
	if (isset($_SESSION['user']))
	{
		return 1;
	}
	else
	{
		return 0;
	}
}

function is_current_user()
{
	if (is_signed_in())
	{
		if ($_SESSION['user'] == $_GET['username'])
		{
			return true;
		}
	}
	else
	{
		return false;
	}
}



function get_user_value($username, $field)
{

	$value = get_user_value_query_result_value($username,$field);

	return $value[$field];// need to close!!
	
}

function get_user_tag_value($username, $tag)
{
	$value = get_user_tag_value_query_result_value($username,$tag);
	return $value[$tag];// need to close!!
}


?>