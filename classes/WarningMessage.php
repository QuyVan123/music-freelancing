<?php
require_once('./config.php');

class WarningMessage extends Message
{
	function __construct($message)
	{
		parent::__construct($message);
		$this->type="warningMessage";
	}
}


?>