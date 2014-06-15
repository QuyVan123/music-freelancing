<?php
class RegisterPage extends Page
{
	function __construct()
	{
		$this->set('title','Register');
		parent::__construct(null);
		//$extFiles['stylesheet']=array(css1,css2);
		//$extFiles['javascript']=array(js1,js2);
		//parent::__construct($extFiles);
	}
	function echoPageBody()
	{
		echo "<p>This is the " . $this->get('title') . " page </p>";
		RegisterForm::echo_form();
	}
}

?>