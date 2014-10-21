<?php
// All forms submissions go to this page.
require_once('libs/libs.php');

function create_user_folder($username)
{
	$path = 'upload/' . $username . '/';
	if (!file_exists($path))
	{
		if (!mkdir($path, 0775, true))
		{
			error_msg_redirect_index('Error 9');
		}
	}
	else
	{
		error_msg_redirect_index('Error 10');
	}
}

//updates the tags
//It is very ineffecient...deletes,creates row instead of updating
//SHOULD always work
function process_tags()
{
	deleteTagRow();
	create_user_tag($_SESSION['user']);
	if (!update_tags())
	{
		error_msg_redirect_current('Error 8');
	}
	else
	{
		$_SESSION['message_buffer'] = create_message('successMessage', 'Tags Uploaded Successfully');
		header("Location: " . EDIT_PROFILE_URL);
		exit();
	}
	
}

function unset_session_errors_inputs_message_buffer()
{
	unset($_SESSION['errors']);
	unset($_SESSION['inputs']);
	unset($_SESSION['message_buffer']);
}

function process_login() 
{
	unset_session_errors_inputs_message_buffer();
	
	$username = htmlspecialchars($_POST['username']);
	$password = htmlspecialchars($_POST['password']);
	$inputs = array('username'=>$username);
	$message = "";
	if (isset($_POST['username'])&&isset($_POST['password'])) 
	{
		$err_username = check_and_return_field_error('username',$username);
		$err_password = check_and_return_field_error('password',$password);
		if (!empty($err_username) || !empty($err_password)) 
		{
			$message .= "Invalid Username or Password. ";
		}
		// Check if there were any errors, if so redirect to login.php
		if (sizeof($errors) > 0) {
			$_SESSION['inputs'] = $inputs;
			$_SESSION['message_buffer'] = create_message("errorMessage", $message);
			header("Location: " . LOGIN_URL);
			exit();
		}
		$result = authenticate_user($username,$password);
		$rows = $result->rowCount();

		if ($rows>1)
		{
			error_msg_redirect_index('Error 11');
		}
		elseif ($rows==1)
		{
			$_SESSION['user']=$username;
			$_SESSION['message_buffer'] = create_message("successMessage", "Logged in Successfully!");
			header("Location: " . INDEX_URL);
			exit();
		}
		elseif ($rows==0)
		{
			error_msg_redirect_current_custom('Wrong username/password.');
		}
	}
}

// This function processes a users attempt to register an account.
function process_register() 
{
	unset($_SESSION['errors']);
	unset($_SESSION['inputs']);
	unset($_SESSION['message_buffer']);
	$errors = array();
	$inputs = array();
	$message = "";
	if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) 
	{
		$first_name = htmlspecialchars($_POST['first_name']);
		$last_name = htmlspecialchars($_POST['last_name']);
		$username = htmlspecialchars($_POST['username']);
		$email = htmlspecialchars($_POST['email']);
		$password = htmlspecialchars($_POST['password']);

		$inputs = array('first_name' => $first_name, 'last_name' => $last_name, 'username'=>$username, 'email'=>$email);

		$err = user_check_and_return_field_error_new('first_name',$first_name);
		if (!empty($err)) 
		{
			$errors['first_name'] = $err;
			$message .= $err;
		}

		$err = user_check_and_return_field_error_new('last_name',$last_name);
		if (!empty($err)) 
		{
			$errors['last_name'] = $err;
			$message .= $err;
		}

		$err = user_check_and_return_field_error_new('username',$username);
		if (!empty($err)) 
		{
			$errors['username'] = $err;
			$message .= $err;
		}

		$err = user_check_and_return_field_error_new('email',$email);
		if (!empty($err)) 
		{
			$errors['email'] = $err;
			$message .= $err;
		}
		$err = user_check_and_return_field_error_new('password',$password);
		if (!empty($err)) 
		{
			$errors['password'] = $err;
			$message .= $err;
		}
		// Check if there were any errors, if so redirect to register.php
		if (sizeof($errors) > 0) 
		{
			$_SESSION['inputs'] = $inputs;
			$_SESSION['errors'] = $errors;
			
			$_SESSION['message_buffer'] = create_message("errorMessage", $message);
			header("Location: " . REGISTER_URL);
			exit();
		}
		
		create_user_folder($username);
		create_user($first_name, $last_name, $username, $email, $password);
		
		create_user_tag($username);
		$_SESSION['message_buffer'] = create_message('successMessage', 'Successfully created, please log in.');
		header("Location: " . LOGIN_URL);
		exit();
	}
}

// This function processes the users attempt to edit their account information
// (first name/last name, etc)
function update_profile() 
{
	unset($_SESSION['errors']);
	unset($_SESSION['inputs']);
	unset($_SESSION['message_buffer']);
	$errors = array();
	$inputs = array();
	$message = "";
  
	$about_me = htmlspecialchars($_POST['about_me']);

	$inputs = array('about_me' => $about_me);

	
	// Check if there were any errors, if so redirect to register.php
	if (sizeof($errors) > 0) 
	{
		$_SESSION['inputs'] = $inputs;
		$_SESSION['errors'] = $errors;
		error_msg_redirect_current_custom($message);
	}


	update_user($about_me);

	$_SESSION['message_buffer'] = create_message('successMessage', 'Profile Updated Successfully');
	header("Location: " . EDIT_PROFILE_URL);
	exit();
}

function upload_file()
{
	//$allowedExts = array("gif", "jpeg", "jpg", "png");
	$temp = explode(".", $_FILES["file"]["name"]);
	$_FILES["file"]["name"]=htmlspecialchars($_FILES["file"]["name"]);
	$extension = end($temp);
	/*
	if ((($_FILES["file"]["type"] == "image/gif")
	|| ($_FILES["file"]["type"] == "image/jpeg")
	|| ($_FILES["file"]["type"] == "image/jpg")
	|| ($_FILES["file"]["type"] == "image/pjpeg")
	|| ($_FILES["file"]["type"] == "image/x-png")
	|| ($_FILES["file"]["type"] == "image/png"))
	//&& ($_FILES["file"]["size"] < 20000)
	&& in_array($extension, $allowedExts))
	{
	*/
		if ($_FILES["file"]["error"] > 0)
		{
			//To see error uncomment the section below
			// refer to http://www.php.net/manual/en/features.file-upload.errors.php for the errors
			/*
			var_dump($_FILES["file"]["error"]);
			die();
			*/
			error_msg_redirect_current('Error 14');
		}
		else
		{
			/*
			if (file_exists("upload/" . $_FILES["file"]["name"]))
			{
				$_SESSION['message_buffer'] = create_message("errorMessage", "File already exit file");
				header("Location: " . UPLOAD_FILE_URL);
				exit();
			}*/
			
			$path = USER_BASE_URL;
			/* should be created when user is created
			if (!file_exists($path)) 
			{
				mkdir($path, 0777, true); // todo if this mkdir fails... should do something
			}
			*/
			$path = USER_BASE_URL . $_FILES["file"]["name"];
			move_uploaded_file($_FILES["file"]["tmp_name"], $path) ; // todo if this fails...do something
			$_SESSION['message_buffer'] = create_message('successMessage', 'File Uploaded Successfully');
			header("Location: " . UPLOAD_FILE_URL);
			exit();
		}
	/*}
	else
	{
		echo "Invalid file";
	}*/
}

function upload_profile_pic()
{
	$_FILES["file"]["name"]=htmlspecialchars($_FILES["file"]["name"]);
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$temp = explode(".", $_FILES["file"]["name"]);
	$extension = end($temp);
	if ((($_FILES["file"]["type"] == "image/gif")
	|| ($_FILES["file"]["type"] == "image/jpeg")
	|| ($_FILES["file"]["type"] == "image/jpg")
	|| ($_FILES["file"]["type"] == "image/pjpeg")
	|| ($_FILES["file"]["type"] == "image/x-png")
	|| ($_FILES["file"]["type"] == "image/png"))
	&& ($_FILES["file"]["size"] < 200000)
	&& in_array($extension, $allowedExts))
	{
		if ($_FILES["file"]["error"] > 0)
		{
			echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
		}
		else
		{
			/*
			if (file_exists("upload/" . $_FILES["file"]["name"]))
			{
				$_SESSION['message_buffer'] = create_message("errorMessage", "File already exit file");
				header("Location: " . UPLOAD_FILE_URL);
				exit();
			}*/
			
			$path = USER_BASE_URL;
			
			if (!file_exists($path)) 
			{
				mkdir($path, 0777, true);
			}
			$path = USER_BASE_URL . 'profile_pic.' . $extension;
			if (!update_profile_pic_db($path))
			{
				$_SESSION['message_buffer'] = create_message('errorMessage', 'PicURL to DB failed');
				header("Location: " . EDIT_PROFILE_URL);
				exit();
			}
			else
			{
			/*
				if(is_writable($path))
				{
					echo "true";
					die();
				}
				else
				{
					echo "false";
					die();
				}
				
			*/
				if (!move_uploaded_file($_FILES["file"]["tmp_name"], $path))
				{
					$_SESSION['message_buffer'] = create_message('errorMessage', ' Moving file failed.');
					header("Location: " . EDIT_PROFILE_URL);
					exit();
				}
				else
				{
					$_SESSION['message_buffer'] = create_message('successMessage', 'Picture Uploaded Successfully');
					header("Location: " . EDIT_PROFILE_URL);
					exit();
				}
				
			}
			
		}
	}
	else
	{
		$_SESSION['message_buffer'] = create_message('errorMessage', 'Error uploading picture');
		header("Location: " . EDIT_PROFILE_URL);
		exit();
	}
}

function process_message()
{
	send_message();
	$_SESSION['message_buffer'] = create_message('successMessage', 'Successfully sent message');
    header("Location: " . DISPLAY_CHAT_URL . "?username=" . $_POST['receiver']);
    exit();
}

function process_new_job_post()
{
	unset($_SESSION['errors']);
	unset($_SESSION['inputs']);
	unset($_SESSION['message_buffer']);
	$errors = array();
	$inputs = array();
	$message = "";
	//job_post_title payment_method number_of_songs deadline description
	if (isset($_POST['job_post_title']) && isset($_POST['payment_method']) && isset($_POST['number_of_songs']) && isset($_POST['deadline']) && isset($_POST['description'])) 
	{
		$job_post_title = htmlspecialchars($_POST['job_post_title']);
		$payment_method = htmlspecialchars($_POST['payment_method']);
		$number_of_songs = htmlspecialchars($_POST['number_of_songs']);
		$deadline = htmlspecialchars($_POST['deadline']);
		$description = htmlspecialchars($_POST['description']);
		$inputs = array('job_post_title' => $job_post_title, 'payment_method' => $payment_method, 
		'number_of_songs'=>$number_of_songs, 'deadline'=>$deadline, 'description'=>$description);

		$err = job_post_check_and_return_field_error_new('job_post_title',$job_post_title);
		if (!empty($err))
		{
			$errors['job_post_title'] = $err;
			$message .= $err;
		}
		
		$err = job_post_check_and_return_field_error_new('payment_method',$payment_method);
		if (!empty($err)) 
		{
			$errors['payment_method'] = $err;
			$message .= $err;
		}

		$err = job_post_check_and_return_field_error_new('number_of_songs',$number_of_songs);
		if (!empty($err)) 
		{
			$errors['number_of_songs'] = $err;
			$message .= $err;
		}

		$err = job_post_check_and_return_field_error_new('deadline',$deadline);
		if (!empty($err)) 
		{
			$errors['deadline'] = $err;
			$message .= $err;
		}
		$err = job_post_check_and_return_field_error_new('description',$description);
		if (!empty($err)) 
		{
			$errors['description'] = $err;
			$message .= $err;
		}
		// Check if there were any errors, if so redirect to register.php
		if (sizeof($errors) > 0) 
		{
			$_SESSION['inputs'] = $inputs;
			$_SESSION['errors'] = $errors;
			$_SESSION['message_buffer'] = create_message("errorMessage", $message);
			header("Location: " . JOB_POST_CREATE_URL);
			exit();
		}
		
		//username job_post_title payment_method number_of_songs deadline description
		$create_jp=create_new_job_post($_SESSION['user'], $job_post_title, $payment_method, $number_of_songs, $deadline, $description);
		if (($create_jp)!=false)
		{
			$_SESSION['message_buffer'] = create_message('successMessage', 'Successfully created job post');
			header("Location: " . JOB_POST_LISTING_URL);
			exit();
		}
		else
		{
			echo ' lazy error';
			die();
		}
//FINISH JOB POST PROCESS HERE
		/*
		create_user_folder($username);
		create_user($first_name, $last_name, $username, $email, $password);
		
		create_user_tag($username);
		$_SESSION['message_buffer'] = create_message('successMessage', 'Successfully created, please log in.');
		header("Location: " . LOGIN_URL);
		exit();
		*/
	}
}

// All forms have a hidden field called 'act' so we can tell what page they
// came from.
if (isset($_POST['act'])) 
{
	$action = $_POST['act'];
} 
else 
{
	//if it goes here either they attempted to hack this
	//or the process logic is flawed...check the functions being called
	$_SESSION['message_buffer'] = create_message("warningMessage", "shouldnt see this, action not valid");
	//die(header("location: " . INDEX_URL));
	die();
}
if ($action == 'register') 
{
  process_register();
} 
elseif ($action == 'login')
{
	process_login();
}
elseif ($action =='edit_profile')
{
	update_profile();
}
elseif ($action == 'upload_file')
{
	upload_file();
}

elseif ($action=='upload_profile_pic')
{
	upload_profile_pic();
}

elseif ($action=='message')
{
	process_message();
	
}

elseif($action=='edit_tags')
{
	process_tags();
}

elseif($action=='new_job_post')
{
	process_new_job_post();
}

else
{
	error_msg_redirect_previous_custom("Something went wrong while attempting to process123"); 
}	

?>
