<?php
//All files used to handle any type of user input go here

function is_unique_user($field,$value)
{
	$result = get_mysqli_query_for_unique_check_user($field,$value);
	$rows = $result->rowCount();

	if ($rows==0)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}

function is_unique_job_post($field,$value)
{
	$result = get_mysqli_query_for_unique_check_job_post($field,$value);
	$rows = $result->rowCount();

	if ($rows==0)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}


function job_post_check_and_return_field_error_new($field,$value)
{
	if (empty($value))
	{
		return 'Required ' . $field . '. ';
	}
	
	if ($field=='job_post_title')
	{
		return check_and_return_new_job_post_title($value);
	}
	elseif ($field=='payment_method')
	{
		return check_and_return_new_payment_method($value);
	}
	elseif ($field=='number_of_songs')
	{
		return check_and_return_new_number_of_songs($value);
	}
	elseif ($field=='deadline')
	{
		return check_and_return_new_deadline($value);
	}
	elseif ($field=='description')
	{
		return check_and_return_new_description($value);
	}
	else
	{
		echo $field; die();
		error_msg_redirect_current('Error 13');
	}
}

function check_and_return_new_job_post_title($value)
{
	if(!is_unique_job_post('job_post_title',$value))
	{
		return 'Job post title exists';
	}
	else
	{
		return '';
	}
}

function check_and_return_new_payment_method($value)
{
	return '';
}

function check_and_return_new_number_of_songs($value)
{
	return '';
}

function check_and_return_new_deadline($value)
{
	return '';
}

function check_and_return_new_description($value)
{
	return '';
}

//used while processing a new user
////////////////////////
function user_check_and_return_field_error_new($field,$value)
{
	if (empty($value))
	{
		return 'Required ' . $field . '. ';
	}
	if ($field=='first_name')
	{
		return check_and_return_new_first_name($value);
	}
	elseif($field=='last_name')
	{
		return check_and_return_new_last_name($value);
	}
	elseif($field=='username')
	{
		return check_and_return_new_username($value);
	}
	elseif($field=='email')
	{
		return check_and_return_new_email($value);
	}
	elseif($field=='password')
	{
		return check_and_return_new_password($value);
	}
	else
	{
		error_msg_redirect_current('Error 3');
	}
}
function check_and_return_new_first_name($value)
{
	return '';
}
function check_and_return_new_last_name($value)
{
	return '';
}


function check_and_return_new_username($value)
{
	if(!is_unique_user('username',$value))
	{
		return 'Username exists. ';
	}
	else
	{
		return '';
	}
}

function check_and_return_new_email($value)
{
	if (!filter_var($value, FILTER_VALIDATE_EMAIL))
	{
		return 'Invalid email address. ';
	}
	else if(!is_unique_user('email',$value))
	{
		return 'Email exists. ';
	}
	else
	{
		return '';
	}
}

function check_and_return_new_password($value)
{
	return '';
}

//check and return NOT NEW
//////////////////////////////
function check_and_return_field_error($field,$value)
{
	if (empty($value))
	{
		return 'Required';
	}
	if ($field=='first_name')
	{
		return check_and_return_first_name($value);
	}
	elseif($field=='last_name')
	{
		return check_and_return_last_name($value);
	}
	elseif($field=='username')
	{
		return check_and_return_username($value);
	}
	elseif($field=='email')
	{
		return check_and_return_email($value);
	}
	elseif($field=='password')
	{
		return check_and_return_password($value);
	}
	else
	{
		error_msg_redirect_current('Error 4');
	}
}
function check_and_return_first_name($value)
{
	return '';
}
function check_and_return_last_name($value)
{
	return '';
}


function check_and_return_username($value)
{
	return '';
}

function check_and_return_email($value)
{
	return '';
}

function check_and_return_password($value)
{
	return '';
}
?>