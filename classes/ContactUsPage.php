<?php
class ContactUsPage extends Page
{
	function __construct()
	{
		parent::__construct(null);
		$this->set('title','Contact Us');
	}
	function echoPageBody()
	{
		echo "<p>This is the " . $this->get('title') . " page </p>";
	}
}

?>