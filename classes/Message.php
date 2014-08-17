<?php
//class or interface
//warning
//error message
//success message

abstract class Message
{
	protected $message;
	protected $type;
	
	function __construct($message)
	{
		$this->message=$message;
	}
	function echoMessage()
	{
		echo "<div class=" . $this->type . ">" . $this->message . "</div>";
	}
	
	function addMessageAndRedirect($URL)
	{
	
		$this->addMessage();
		header ("Location: " . $URL);
		die();
	}
	function redirect($URL)
	{
		header ("Location: " . $URL);
		die();
	}
	
	function addMessage()
	{
		if (!isset($_SESSION['message']) && empty($_SESSION['message']))
		{
			$_SESSION['message'] = array();
			
		}
		array_push($_SESSION['message'],serialize($this));
	}
}

?>