<?php
class LoginPage extends Page
{
	function __construct()
	{
		$this->set('title','Login');
		parent::__construct(null);
		//$extFiles['stylesheet']=array(css1,css2);
		//$extFiles['javascript']=array(js1,js2);
		//parent::__construct($extFiles);
	}
	function echoPageBody()
	{
		echo "
		<p>This is the " . $this->get('title') . " page </p>";
		
		LoginForm::echo_form();
		loginPage::clearPrevValues();
	}
	function clearPrevValues()
	{
		unset($_SESSION['username']);
	}
}

?>