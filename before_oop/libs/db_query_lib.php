<?php


function db_connect()
{
	require_once('config.php');
	require_once('libs/misc_lib.php');

	$host = HOST_NAME;
	$username = USER_NAME;
	$password = PASSWORD;
	$user_database = USER_DATABASE_NAME;

	try
	{
		$con=new PDO('mysql:host=' . $host . '; dbname=' . $user_database, $username, $password );
		return $con;
	}

	catch (PDOException $e)
	{
		error_msg_redirect_index('Error 1'); // failed to connect to server
	}
}

function authenticate_user($username, $password)
{
	$con=db_connect();
	$query = "SELECT * FROM " . USER_TABLE_NAME . " WHERE Username = '" . $username . "' AND Password = '" . $password . "'";
	$result = $con->prepare($query);
	$result->execute();
	return $result;
}

function create_user($first_name, $last_name, $username, $email, $password)
{
	$con=db_connect();
	$query = 'INSERT INTO ' . USER_TABLE_NAME . ' (First_Name, Last_Name, Username, Email, Password)
	VALUES("' . $first_name . '", "' . $last_name . '", "' . $username . '", "' . $email . '", "' . $password . '" )';
	
	$result = $con->prepare($query);
	$result->execute();
	return $result;
}

function create_new_job_post($username, $job_post_title, $payment_method, $number_of_songs, $deadline, $description)
{
	$con=db_connect();
	$query = "INSERT INTO " . JOB_POST_TABLE_NAME . " (Username, Job_Post_Title, Payment_Method, Number_Of_Songs, Deadline, Description)
VALUES ('" .$username . "', '" . $job_post_title . "', '" . $payment_method . "', '" . $number_of_songs . "', '" . $deadline . "', '" . $description . "' )";

	$result = $con->prepare($query);
	$result->execute();
	return $result;
}

function create_user_tag($username)
{
	$con=db_connect();
	$query = "INSERT INTO " . TAG_TABLE_NAME . " (Username, Musician, Engineer)
VALUES ('" . $username . "', 0, 0 )";

	$result = $con->prepare($query);
	$result->execute();
	return $result;
}


function update_user($about_me)
{
	$con=db_connect();
	$query = "UPDATE " . USER_TABLE_NAME . " SET About_me = '" . $about_me . "' WHERE Username = '" . $_SESSION['user'] . "'";
	
	$result = $con->prepare($query);
	$result->execute();
	return $result;

}


function update_tags()
{
	$con=db_connect();
	$checked_tags = $_POST['tags'];
	//$size = count($_POST['tags']);
	$query = "UPDATE " . TAG_TABLE_NAME . " SET " . implode ("='1', ",array_values($checked_tags)) . "='1' WHERE Username='" . $_SESSION['user'] . "'" ;
	
	
	$result = $con->prepare($query);
	$result->execute();
	return $result;
}


//deletes the curreent session users row
//row should always exists
function deleteTagRow()
{
	$con=db_connect();
	$query = "DELETE FROM " . TAG_TABLE_NAME . " WHERE Username='" . $_SESSION['user'] . "'";
	
	$result = $con->prepare($query);
	$result->execute();
	return $result;
}


function update_profile_pic_db($pic_url)
{
	$con=db_connect();
	$query = "UPDATE " . USER_TABLE_NAME . " SET Pic_URL = '" . $pic_url . "' WHERE Username = '" . $_SESSION['user'] . "'";

	$result = $con->prepare($query);
	$result->execute();
	return $result;
}

function get_chat_users_query_results()
{
	$con=db_connect();
	$query = "SELECT * FROM " . CHAT_TABLE_NAME . " WHERE SENDER='" . htmlspecialchars($_SESSION['user']) . "' OR RECEIVER='" . htmlspecialchars($_SESSION['user']) . "' ORDER BY DATE ASC" ;

	
	$result = $con->prepare($query);
	$result->execute();
	return $result;

}

function get_mysqli_query_for_unique_check_user($field,$value)
{
	$con=db_connect();
	$query="SELECT * FROM " . USER_TABLE_NAME . " WHERE " . htmlspecialchars($field) . " = '" . htmlspecialchars($value) . "'";
	$result = $con->prepare($query);
	$result->execute();
	return $result;
}

function get_mysqli_query_for_unique_check_job_post($field,$value)
{
	$con=db_connect();
	$query="SELECT * FROM " . JOB_POST_TABLE_NAME . " WHERE " . htmlspecialchars($field) . " = '" . htmlspecialchars($value) . "'";
	$result = $con->prepare($query);
	$result->execute();
	return $result;
}


function send_message()
{
	$con=db_connect();
	$query = "INSERT INTO " . CHAT_TABLE_NAME . " (Sender, Receiver, Date, Message)
VALUES ('" .$_SESSION['user'] . "', '" . $_POST['receiver'] . "', NOW(), '" . $_POST['message'] . "' )";
	
	$result = $con->prepare($query);
	$result->execute();
	return $result;
	
	
}


function get_and_display_users_query_result($type)
{
	$con=db_connect();
	
	if ($type=='All')
	{
		$query = "SELECT Username FROM " . TAG_TABLE_NAME;
	}
	else
	{
		$query = "SELECT Username FROM " . TAG_TABLE_NAME . " WHERE " . htmlspecialchars($type) . "=1";
	}
	
	$result = $con->prepare($query);
	$result->execute();
	return $result;
}

function get_and_display_job_posts_query_result()
{
	$con=db_connect();
	$query = "SELECT Job_Post_Title FROM " . JOB_POST_TABLE_NAME;
	$result = $con->prepare($query);
	$result->execute();
	return $result;
	
}

function get_user_value_query_result_value($username, $field)
{
	$con=db_connect();
	$query = "SELECT " . $field . " FROM " . USER_TABLE_NAME . " WHERE Username = '" . $username . "'";
	$result = $con->prepare($query);
	$result->execute();
	$value = $result->fetch(PDO::FETCH_ASSOC);
	return $value;
	
}

function get_job_post_value_query_result_value($job_post_title,$field)
{
	$con=db_connect();
	$query = "SELECT " . $field . " FROM " . JOB_POST_TABLE_NAME . " WHERE Job_Post_Title = '" . $job_post_title . "'";
	$result = $con->prepare($query);
	$result->execute();
	$value = $result->fetch(PDO::FETCH_ASSOC);
	return $value;

}

function get_user_tag_value_query_result_value($username, $tag)
{
	$con=db_connect();
	$query = "SELECT " . $tag . " FROM " . TAG_TABLE_NAME . " WHERE Username = '" . $username . "'";
	
	$result = $con->prepare($query);
	$result->execute();
	$value = $result->fetch(PDO::FETCH_ASSOC);
	return $value;
}

?>