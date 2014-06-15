<?php
require_once('./config.php');

class SuccessMessage extends Message
{
	function __construct($message)
	{
		parent::__construct($message);
		$this->type="successMessage";
	}
}


?>