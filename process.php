<?php
require_once('config.php');


function processLogin()
{
	
	$username = htmlspecialchars($_POST['username']);
	$password = htmlspecialchars($_POST['password']);
	$user = new User();
	$user->login($username,$password);
	
}

function processRegister()
{
	$firstName = htmlspecialchars($_POST['firstName']);
	$lastName = htmlspecialchars($_POST['lastName']);
	$username = htmlspecialchars($_POST['username']);
	$email = htmlspecialchars($_POST['email']);
	$password = htmlspecialchars($_POST['password']);
	$user= new User();
	$user->register($firstName, $lastName, $username, $email, $password);
	
}

function uploadProfilePic()
{
	$user=unserialize($_SESSION['user']);
	
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
			die();
		}
		else
		{
			$path = $user->get('userFolder') . 'ProfilePic';

			if (move_uploaded_file($_FILES["file"]["tmp_name"],$path))
			{
				$msg = new SuccessMessage("Picture Uploaded Successfully");
				$msg->addMessageAndRedirect(EDIT_PROFILE_URL);
			}
			else
			{
				echo "failed uploading file"; die();
			}
		}
	}
	else
	{
		echo "not valid ext"; die();
	}
}

function updateProfile()
{
	$user=unserialize($_SESSION['user']);
	$changes = array();
	//1 db hit to refresh data
	// or 1 for each field
	foreach ($_POST as $field => $value)
	{
		if ($value != $user->get($field))
		{
			$changes[$field] = $value;
		}
	}
	updateUserFieldsInDB($user->get('username'),$changes);
	resetSessionUser();
	$msg = new SuccessMessage("Successfully updated profile");
	$msg->addMessageAndRedirect(EDIT_PROFILE_URL);
}

function resetSessionUser()
{
	$oldUser =unserialize($_SESSION['user']);
	$user = new User();
	$user->fillData($oldUser->get('username'));
	$_SESSION['user'] = serialize($user);
}

function uploadFile()
{
	$user=unserialize($_SESSION['user']);
	$temp = explode(".", $_FILES["file"]["name"]);
	$_FILES["file"]["name"]=htmlspecialchars($_FILES["file"]["name"]);
	$extension = end($temp);
	if ($_FILES["file"]["error"] > 0)
	{
		//To see error uncomment the section below
		// refer to http://www.php.net/manual/en/features.file-upload.errors.php for the errors
		/*
		var_dump($_FILES["file"]["error"]);
		die();
		*/
		echo "error uploading file"; die();
	}
	else
	{
		if (empty($_POST['fileName']))
		{
			$path = $user->get('userFolder') . $_FILES["file"]["name"];
			
		}
		else
		{
			$path = $user->get('userFolder') . $_POST['fileName'] . '.' .  $extension;
		}
		if (file_exists($path))
		{
			//TODO confirmation button to overwrite
		}
		if (move_uploaded_file($_FILES["file"]["tmp_name"],$path))
		{
			$msg = new SuccessMessage("File Uploaded Successfully");
			$msg->addMessageAndRedirect(EDIT_PROFILE_URL);
		}
		else
		{
			echo "failed uploading file"; die();
		}
	}
}

function processHandler()
{
	$action=actionHandler();
	if ($action == 'register') 
	{
		processRegister();
	} 
	elseif ($action == 'login')
	{
		processLogin();
	}
	elseif ($action =='updateProfile')
	{
		updateProfile();
	}
	elseif ($action == 'uploadFile')
	{
		uploadFile();
	}

	elseif ($action=='uploadProfilePic')
	{
		uploadProfilePic();
	}

	elseif ($action=='message')
	{
		processMessage();
	}

	elseif($action=='editTags')
	{
		processTags();
	}

	elseif($action=='newJobPost')
	{
		processNewJobPost();
	}

	else
	{
		echo "act invalid";
		die();
	}
}

function actionHandler()
{
	
	// All forms have a hidden field called 'act' so we can tell what page they
	// came from.
	if (isset($_POST['act'])) 
	{
		$act= $_POST['act'];
		unset($_POST['act']);
		return $act;
	} 
	else 
	{
		/*
		//if it goes here either they attempted to hack this
		//or the process logic is flawed...check the functions being called
		$_SESSION['message_buffer'] = create_message("warningMessage", "shouldnt see this, action not valid");
		//die(header("location: " . INDEX_URL));
		die();
		*/
		//return false;
		echo "act not set";
		die();
	}
}

processHandler();


?>