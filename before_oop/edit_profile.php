<?php
require_once('libs/libs.php');
$page_settings = array('title'=>'Edit Profile',
			'stylesheets'=>array(PROFILE_STYLE_URL), 'file'=>'edit_profile.php');
			
			
prev_page_handler($page_settings);
require_login();

function print_body(&$page_settings)
{
	echo '<p>' . $_SESSION['user'] .  '\'s Edit Profile Page</p>
	<button id="view_my_profile_button" type="button">
	<a href ="' . DISPLAY_PROFILE_URL . '?username=' . $_SESSION['user'] . '">View Profile
	</a></button>';

	echo_edit_profile_pic_form();
	
	echo_edit_profile_user_data_form($page_settings);
	
	echo_edit_profile_user_tag_form($page_settings);
	
}


message_handler($page_settings);
print_page($page_settings);
?>
