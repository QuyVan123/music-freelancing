<?php
//Page used to display any profile
require_once('libs/libs.php');

$page_settings = array('title'=>$_GET['username'] . "'s Profile",
			'stylesheets'=>array(PROFILE_STYLE_URL), 'file'=>'display_profile.php');
prev_page_handler($page_settings);
			
function print_body(&$page_settings)
{
	echo_front_user_tags();
	echo_display_user_name();
	echo_user_data();
	echo_end_user_tags();
	echo_files($page_settings,$_GET['username']);
}

function echo_front_user_tags()
{
	
}

function echo_display_user_name()
{
	
}



function echo_user_data()
{
	echo'
	<div id = "profile_pic_space"><img  src="' . get_user_value($_GET['username'], 'Pic_URL') . '"></div>
	<div id="display_profile_name"><h1>' . $_GET['username'] .  '\'s Profile</div>
	<div id="profession_tags">';
	
	echo_user_profession_tags();
	
	echo'
	</div>';
	
	
	
	if (is_current_user())
	{
		echo '
		<div id="edit_chat_button_area">';
		echo_edit_button();
		echo '
		</div>';
	}
	else
	{
		echo_chat_button();
	}
	echo '
	<table id="user_info">
		<tr>
		<td>Username: ' .  get_user_value($_GET['username'], 'Username') . '</td>
		</tr>
		<tr>
		<td>First Name: ' .  get_user_value($_GET['username'], 'First_Name') . '</td>
		</tr>
		<tr>
		<td>Last Name: ' .  get_user_value($_GET['username'], 'Last_Name') . '</td>
		</tr>
		<tr>
		<td>About Me: ' .  get_user_value($_GET['username'], 'About_Me') . '</td>
		</tr>
	
	</table>
	';
	
	/*
	echo '
	</tr>
	<td></td><td></td><td>Username: ' . get_user_value($_GET['username'], 'Username') . '</td>
	<tr><td></td><td>First Name: ' . get_user_value($_GET['username'], 'First_Name') . '</td><tr>
	<tr><td></td><td>Last Name: ' . get_user_value($_GET['username'], 'Last_Name') . '</td><tr>
	<tr><td></td><td>About Me: ' . get_user_value($_GET['username'], 'About_Me') .'</td><tr>
	<tr><td></td><td>Tags: ';
	
	
	echo_user_profession_tags();
	*/
}

function echo_edit_button()
{
	echo "
	<button id='edit_chat_button' type='button'><a href='" . EDIT_PROFILE_URL . "'>Edit Profile</a></button>";
}

function echo_chat_button()
{
	echo '<td><form action = ' . DISPLAY_CHAT_URL .  '>
				<input type="submit" value="Message">
				<input type="hidden" name="username" value="' . $_GET['username'] . '"></form></td>';
}

function echo_user_profession_tags()
{
	if (get_user_tag_value($_GET['username'],'Musician'))
	{
		echo '<div class="tags">Musician</div>';
	}
	if (get_user_tag_value($_GET['username'],'Engineer'))
	{
		echo '<div class="tags">Engineer</div>';
	}
}

function echo_end_user_tags()
{
}



//if there is an issue with the  selected user
//function will display error and redirect
function check_valid_current_state()
{
	if (!isset($_GET['username']))
	{
		error_redirect('Error 5');
	}
}


check_valid_current_state();
message_handler($page_settings);
print_page($page_settings);
?>
