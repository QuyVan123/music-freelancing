<?php
class InboxPage extends Page
{
	function __construct()
	{
		parent::__construct(null);
		$this->set('title','Inbox');
		
		//$extFiles['stylesheet']=array(css1,css2);
		//$extFiles['javascript']=array(js1,js2);
		//parent::__construct($extFiles);
	}
	function echoPageBody()
	{
		echo "<p>This is the " . $this->get('title') . " page </p>";
	}
	
	function echoContacts()
	{
		
	}
}

?>