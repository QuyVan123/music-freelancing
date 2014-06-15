<?php
require_once('./config.php');

class ErrorMessage extends Message
{
	function __construct($message)
	{
		parent::__construct($message);
		$this->type="errorMessage";
	}
}


?>