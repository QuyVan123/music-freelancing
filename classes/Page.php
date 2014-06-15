<?php
require_once('./config.php');
require_once (EXTERNAL_PAGE_FILE_LIB_URL);

abstract class Page
{
	abstract function echoPageBody();
	protected $externalFilesArray;
	protected $user;
	protected $message;
	
	function __construct($externalFilesArrayInput)
	{
		$externalFilesArray = array();
		$message = array();
		if (isset($externalFilesArrayInput))
		{
			$this->externalFilesArray=$externalFilesArrayInput;
		}
		$this->preProcess();
		
	}
	
	public function display()
	{
		$this->echoFileHeader();
		$this->echoFileBody();
	}
	
	//everything that needs to be done before echoing the page
	protected function preProcess()
	{
		$this->userHandler();
		$this->messageHandler();
	}
	
	protected function messageHandler()
	{
		if (isset($_SESSION['message'])) 
		{
			$this->message = $_SESSION['message'];
			unset($_SESSION['message']);
		}
	}
	
	
	protected function userHandler()
	{
		if (isset($_SESSION['user']))
		{
			$this->user = unserialize($_SESSION['user']);
		}
	}
	
	
	protected function echoFileHeader()
	{

		echo'
		<!DOCTYPE html>
		<html lang="en">
		<head>
		<title>' . $this->get('title') . '</title>
		<meta charset=\'UTF-8\'>';
		
		
		handleAndPrintExternalFiles($this->externalFilesArray);
		
	}
	
	protected function echoFileBody()
	{
		$this->echoPageHeader();
		$this->echoNav();
		$this->echoMessages();
		$this->echoPageBody();
		$this->echoPageFooter();
	}
	
	protected function echoPageHeader()
	{
		//navigator
		echo '
		</head>
		<body>
			<div id=\'pageWrapper\'>
			<div id=\'page\'> 
				<div id=\'header\'>
					<a id=\'title_header\' href=\'' . INDEX_URL . '\'>' . WEBSITE_NAME . '</a>';
		
	}
	
	protected function echoMessages()
	{
		if (!empty($this->message))
		{
			$messageArray=$this->message;
			foreach ($messageArray as $msg)
			{
				$msg=unserialize($msg);
				$msg->echoMessage();
			}
		}
	}
	
	protected function echoNav()
	{
		if ($this->userSignedIn())
		{
			$this->echoUserNav();
		}
		else
		{
			$this->echoNonUserNav();
		}
	}
	
	
	protected function publicNav()
	{
		$this->create_menu_link(INDEX_URL,"Index");
		$this->create_menu_link(USER_LIST_URL,"User List");
	}
	
	protected function echoUserNav()
	{
		echo '
		<ul id="login_register">';
		
		$this->create_menu_link(LOGOUT_URL,"Logout");
		//$this->create_menu_accent_link(DISPLAY_PROFILE_URL . '?username=' . $this->user->get('username'), $this->user->get('username') . "'s Profile"); 
		$this->create_menu_accent_link(VIEW_PROFILE_URL . '?username=' . $this->user->get('username'), $this->user->get('username') . "'s Profile"); 
		echo '
		</ul>
		</div>
		<ul id=\'menu\'>';
		$this->publicNav();
		$this->create_menu_link(INBOX_URL,"Inbox");
		echo '
		</ul>
		<div id="main_stuff">
		';
	}
	
	protected function echoNonUserNav()
	{
		echo '
		<ul id="login_register">';
		
		$this->create_menu_link(LOGIN_URL,"Login");
		$this->create_menu_accent_link(REGISTER_URL,"Register");
	
		echo '
		</ul>
		</div>
		<ul id=\'menu\'>';
		$this->publicNav();
		
		echo '
		</ul>
		<div id="main_stuff">
		';
	}
	
	protected function userSignedIn()
	{
		if (isset($_SESSION['user']))
		{
			return true;
		}
		return false;
	}
	
	protected function userMustBeSignedIn()
	{
		if (!$this->userSignedIn())
		{
			$msg = new ErrorMessage("Must sign in to edit profile");
			$msg->addMessageAndRedirect(LOGIN_URL);
		}
	}
	
	
	protected function echoPageFooter()
	{
		echo '
		</div>
		<div id=\'footer\'>';
		$this->create_menu_link(CONTACT_US_URL,"Contact Us");
		echo '
		<p>2013 All rights reserved by Quy.<p>
		</div></div></div>
		</body></html>';
	}
	
	public function set($field, $input)
	{
		$this->$field=htmlspecialchars($input);
	}
	
	public function get($field)
	{
		if (isset($this->$field))
		{
			return $this->$field;
		}
		return false;
	}
	
	
	protected function create_menu_accent_link($url, $display)
	{
		echo '<li> <a href=\'' . $url . '\' id="accent_item_in_login_register">' . $display .'</a> </li>';
	}

	protected function create_menu_link($url, $display)
	{
		echo '<li> <a href=\'' . $url . '\'>' . $display .'</a> </li>';
	}

}

?>
