<?php
require_once('../config.php');

function get_con_mysqli()
{
	$host = HOST_NAME;
	$username = USER_NAME;
	$password = PASSWORD;
	return mysqli_connect($host,$username,$password);
}

function get_user_db_con_mysqli()
{
	$host = HOST_NAME;
	$username = USER_NAME;
	$password = PASSWORD;
	$user_database = USER_DATABASE_NAME;
	return mysqli_connect($host,$username,$password,$user_database);
}



function create_user_database()
{
	$con=get_con_mysqli();
	$user_database_name = USER_DATABASE_NAME;
	$message = '';
	// Check connection
	if (mysqli_connect_errno())
	{
		$message .= "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	// Create database
	$sql="CREATE DATABASE " . $user_database_name;
	if (mysqli_query($con,$sql))
	{
		$message .= "User database created successfully";
	}
	else
	{
		$message .= "Error creating user database: " . mysqli_error($con);
	}
	echo $message . '<br><br>';
}

function delete_user_database()
{
	echo 'Not Implemeneted';
}

function create_table($type)
{
	$con=get_user_db_con_mysqli();
	
	if ($type=="user")
	{
		$table_name=USER_TABLE_NAME;
		$sql_fields = "(Id int NOT NULL AUTO_INCREMENT,
		First_Name varchar(30) NOT NULL,
		Last_Name varchar(30) NOT NULL,
		Username varchar(30) NOT NULL,
		Email varchar(30) NOT NULL,
		Password varchar(30) NOT NULL,
		Pic_URL varchar(50),
		About_Me text,
		PRIMARY KEY (Id))";
	}
	else if($type=="chat")
	{
		$table_name = CHAT_TABLE_NAME;
		$sql_fields='(Id int NOT NULL AUTO_INCREMENT,
		Sender varchar(30) NOT NULL,
		Receiver varchar(30) NOT NULL,
		Date datetime NOT NULL,
		Message text,
		PRIMARY KEY (Id))';
	}
	else if($type=="tag")
	{
		$table_name = TAG_TABLE_NAME;
		$sql_fields='(Username varchar(30) NOT NULL,
		Musician boolean NOT NULL,
		Engineer boolean NOT NULL,
		PRIMARY KEY (Username))';
	}
	else if ($type=='job post')
	{
		$table_name = JOB_POST_TABLE_NAME;
		$sql_fields='(Username varchar(30) NOT NULL,
		Job_Post_Title varchar(30) NOT NULL,
		Payment_Method varchar(30) NOT NULL,
		Number_Of_Songs varchar(30) NOT NULL,
		Deadline varchar(30) NOT NULL,
		Description varchar(500) NOT NULL,
		PRIMARY KEY (Job_Post_Title))';
	}
	else
	{
		$msg="type error";
	}
	
	
	if (mysqli_connect_errno())
	{
		$message .= "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	else
	{
		
		// Create table
		$sql="CREATE TABLE " . $table_name . " " . $sql_fields;

		// Execute query
		if (mysqli_query($con,$sql))
		{
			$message ='Table "' . $table_name . '" created successfully';
			echo $message . '<br><br>';
		}
		else
		{
			$message = "Error creating table: " . mysqli_error($con);
			echo $message . '<br><br>';
		}
		
	}
}

function delete_table($type)
{
	$con=get_user_db_con_mysqli();
	if ($type=="user")
	{
		$table_name=USER_TABLE_NAME;
	}
	else if($type=="chat")
	{
		$table_name = CHAT_TABLE_NAME;
	}
	else if($type=="tag")
	{
		$table_name = TAG_TABLE_NAME;
	}
	else if ($type=='job post')
	{
		$table_name = JOB_POST_TABLE_NAME;
	}
	
	// Check connection
	if (mysqli_connect_errno())
	{
		$message = "Failed to connect to MySQL: " . mysqli_connect_error();
		echo $message . '<br><br>';
	}
	else
	{
		
		// Create table
		$sql="DROP TABLE " . $table_name;

		// Execute query
		if (mysqli_query($con,$sql))
		{
			$message ='Table "' . $table_name . '" deleted successfully';
			echo $message . '<br><br>';
		}
		else
		{
			$message = "Error creating table: " . mysqli_error($con);
			echo $message . '<br><br>';
		}
		
	}
}

function create_user_upload_dir()
{
	mkdir('../upload/');
	$message= "User Upload Directory Created Successfull";
	echo $message . '<br><br>';
}

function delete_user_upload_dir()
{
	$src = '../upload/';
	if (is_dir($src))
	{
		delete_dir($src);
		$message = "Removed folder contents successfully";
		echo $message . '<br><br>';
	}
	else
	{
		$message = "Error removing folder contents";
		echo $message . '<br><br>';
	}

}
function delete_dir($src) { 
	if (is_dir($src))
	{
		$dir = opendir($src);
		while(false !== ( $file = readdir($dir)) ) { 
			if (( $file != '.' ) && ( $file != '..' )) { 
				if ( is_dir($src . '/' . $file) ) { 
					delete_dir($src . '/' . $file); 
				} 
				else { 
					unlink($src . '/' . $file); 
				} 
			} 
		} 
		rmdir($src);
		closedir($dir);
	}
	else
	{
		$message = "Error removing folder contents";
		echo $message . '<br><br>';
	}
}

function delete_tables_and_folders()
{
	delete_table('user');
	delete_table('chat');
	delete_table('tag');
	delete_table('job post');
	delete_user_upload_dir();
	
}

function create_tables_and_folders()
{
	create_table('user');
	create_table('chat');
	create_table('tag');
	create_table('job post');
	create_user_upload_dir();
}

function delete_and_create_tables_and_folders()
{
	delete_tables_and_folders();
	create_tables_and_folders();
}


if (isset($_POST['act'])) 
{
  $action = $_POST['act'];
} 
else 
{
	$msg = "processing error 1";
	echo $msg;
	die();
}
if ($action=='create user database')
{
	create_user_database();
}
else if($action=='create user table')
{
	create_table('user');
}
else if($action=='create chat table')
{
	create_table('chat');
}
else if($action=='create tag table')
{
	create_table('tag');
}
elseif ($action=='create user upload dir')
{
	create_user_upload_dir();
}

else if($action=='create job post table')
{
	create_table('job post');
}
else if($action=='delete user database')
{
	delete_user_database();
}
else if($action=='delete user table')
{
	delete_table('user');
}
else if($action=='delete chat table')
{
	delete_table('chat');
}
else if($action=='delete tag table')
{
	delete_table('tag');
}
else if($action=='delete job post table')
{
	delete_table('job post');
}
else if($action=='delete user upload dir')
{
	delete_user_upload_dir();
}
else if($action=='create tables and folders')
{
	create_tables_and_folders();
}
else if($action=='delete tables and folders')
{
	delete_tables_and_folders();
}
else if($action=='delete and create tables and folders')
{
	delete_and_create_tables_and_folders();
}
else
{
	$msg ="processing error 2";
	echo $msg;
	die();
}

echo"
<form action=" . FIRST_CONFIG_URL . ">
    <input type='submit' value = 'Return'>
</form>";

?>