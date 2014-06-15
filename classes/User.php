<?php
//class
require_once('./config.php');
require_once(USER_VALIDATION_LIB_URL);
require_once(SQL_LIB_URL);
class User
{
	protected $firstName;
	protected $lastName;
	protected $username;
	protected $email;
	protected $tags;
	protected $userFolder;
	protected $aboutMe;
	protected $picURL;
	
	function get($field)
	{
		return $this->$field;
	}
	
	function echoTags()
	{
		$tags=$this->tags;
		if ($tags['musician']==1)
		{
			echo '<div class="tags">Musician</div>';
		}
		if ($tags['engineer']==1)
		{
			echo '<div class="tags">Engineer</div>';
		}
	}
	
	private function setValueFromDB($field)
	{
		if ($field=='tags')
		{
			$result= queryUserTags($this->username)->fetchAll();
			$this->tags=$result[0];
		}
		else
		{
			$this->$field=$this->getValueFromDB($field);
		}
	}
	public function fillData($username)
	{
		$this->username=$username;//this is the exception to the others because a username is required to retreive data from db
		$this->setValueFromDB('firstName');
		$this->setValueFromDB('lastName');
		$this->setValueFromDB('email');
		$this->setValueFromDB('userFolder');
		$this->setValueFromDB('tags');
		$this->setValueFromDB('aboutMe');
		$this->picURL = $this->userFolder . 'ProfilePic';
	}
	
	
	
	private function getValueFromDB($field)
	{
		return queryUserData($field, $this->username);
	}
	
	public function login($username, $password)
	{
		if ($this->loginValidInputs($username,$password))
		{
			$result = loginQuery($username,$password);
			if ($this->processLoginResult($result))
			{
				$this->fillData($username);
				$_SESSION['user'] = serialize($this);		
				header ("Location: " . INDEX_URL);
				die();
			}
			else
			{
				$msg = new ErrorMessage('Log in failed');
				$msg->addMessageAndRedirect(LOGIN_URL);
			}
		}
		else
		{
			$msg = new ErrorMessage('Invalid Inputs for log in.');
			$msg->addMessageAndRedirect(LOGIN_URL);
		}
	}
	
	public function register($firstName, $lastName, $username, $email, $password)
	{
		if ($this->registerValidInputs($firstName, $lastName, $username, $email, $password))
		{
			$userFolder = UPLOAD_URL . $username . '/';
			$result = registerQuery($firstName, $lastName, $username, $email, $password, $userFolder);
			if  ($this->processRegisterResult($result))
			{
				$this->fillData($username);
				$this->createDir();
				$this->insertIntoTagTable();
				$_SESSION['user'] = serialize($this);
				header ("Location: " . INDEX_URL);
				die();
			}
			else
			{
				$msg = new ErrorMessage('Register failed');
				$msg->addMessageAndRedirect(REGISTER_URL);
			}
		}
		else
		{
			$msg = new ErrorMessage('Register inputs invalid');
			$msg->addMessageAndRedirect(REGISTER_URL);
		}
	}
	
	function insertIntoTagTable()
	{
		insertIntoTagTable($this->username);
	}
	
	function createDir()
	{
		$path = UPLOAD_URL . $this->username . '/';
		if (!file_exists($path))
		{
			if (!mkdir($path, 0775, true))
			{
				//making directory fails due to permissions on the server end
				echo "permissions fail while creating dir";die();
				return false;
			}
			return true;
		}
		else
		{
			echo "creating dir ERROR, should never see";die();
			return false;
			//could send an error
			//should not reach this point EVER
		}
	
	}
	
	private function processRegisterResult($result)
	{
		return $result;
	}
	
	private function processLoginResult($result)
	{
		$rows = $result->rowCount();

		if ($rows>1)
		{
			//return false
			echo "more than 1 user, shouldn't happen"; die();
		}
		elseif ($rows==1)
		{
			return true;

		}
		elseif ($rows==0)
		{
			return false;
			
		}
	}
	
	private function loginValidInputs($username,$password)
	{
		checkAndAddFieldError('login', 'username', $username, $errors);
		checkAndAddFieldError('login', 'password', $password, $errors);
		if (empty($_SESSION['message'])) 
		{
			return true;
		}
		
	}
	
	private function registerValidInputs($first_name, $last_name, $username, $email, $password)
	{
		checkAndAddFieldError('register', 'first_name', $first_name, $errors);
		checkAndAddFieldError('register', 'last_name', $last_name, $errors);
		checkAndAddFieldError('register', 'username', $username, $errors);
		checkAndAddFieldError('register', 'email', $email, $errors);
		checkAndAddFieldError('register', 'password', $password, $errors);
		if (empty($_SESSION['message'])) 
		{
			return true;
		}
		
	}
}


?>