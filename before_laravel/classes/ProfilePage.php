<?php
abstract class ProfilePage extends Page
{
	
	function __construct()
	{
		$extFiles['stylesheets']=array(PROFILE_STYLE_URL);
		parent::__construct($extFiles);

	}
	function echoProfilePic()
	{
		echo '
		<div id = "profilePicSpace"><img  src="' . $this->selectedUser->get('picURL') . '"></div>';
	}
}
?>