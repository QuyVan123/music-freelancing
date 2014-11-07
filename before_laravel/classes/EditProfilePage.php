<?php
require_once('./config.php');
require_once(FORM_MISC_LIB_URL);
class EditProfilePage extends ProfilePage
{
	function __construct()
	{
		$this->userMustBeSignedIn();
		parent::__construct();
		$this->set('title',"Edit " . $this->user->get('username') . "'s Profile");

	}
	function echoPageBody()
	{
		$this->echoPageBodyHeader();
		$this->echoEditPic();
		$this->echoUserDataForm();
		$this->echoUploadFileForm();
		
	}
	
	protected function echoPageBodyHeader()
	{
		echo '
		<p>' . $this->get('title') . '</p>';
		$this->echoViewProfileButton();
	}
	
	protected function echoViewProfileButton()
	{
		echo '
		<button id="view_my_profile_button" type="button">
	<a href ="' . VIEW_PROFILE_URL . '?username=' . $this->user->get('username') . '">View Profile
	</a></button>';
	}
	
	protected function echoEditPic()
	{
		echo '
		<div id = "profile_pic_space"><img  src="' . $this->user->get('picURL') . '"></div>';
		
		echo "
	<form method='post' enctype='multipart/form-data' action='" . PROCESS_URL . "'>
    <input type='hidden' name='act' value='uploadProfilePic' />
		<input type='file' name='file' id='file'><br>
		<input type='submit' value='Upload Picture'>
	</form>";
	}
	
	protected function echoUserDataForm()
	{
		echo "
		<form method='post' action='" . PROCESS_URL . "'>
    <input type='hidden' name='act' value='updateProfile' />
		<table>";	
	$this->echoUserDataEditField('firstName');
	$this->echoUserDataEditField('lastName');
	$this->echoUserDataEditTextAreaField('aboutMe');
	//echo_edit_profile_form_text_area_field("about_me",$page_settings);

	echo "	
			<tr>
				<td colspan='3'>
					<input type='submit' value='Modify Profile' />
					<td id='submitfield' class='error'></td>
				</td>
			</tr>
		</table>
	</form>";
	}
	
	protected function echoUploadFileForm()
	{
		echo "
	<form method='post' enctype='multipart/form-data' action='" . PROCESS_URL . "'>
	<table>
		<tr><td><input type='hidden' name='act' value='uploadFile' /></td></tr>
		<tr><td><input type='file' name='file' id='file'></td></tr>
		<tr><td><label for='file'>Name file:</label> <input type='text' name ='fileName' id=fileName><br></td></tr>
		<tr><td><input type='submit' value='Upload File'></td></tr>
	</table>
	</form>";
	}
	
	protected function echoUserDataEditField($field)
	{
		echo '
		<tr>
			<td>' . getDisplayableFieldString($field) . '</td>
			<td><input id="' . $field . '" type="text" name="' . $field . '" value= "' . $this->user->get($field) . '" /></td>
		</tr>';
	}
	
	protected function echoUserDataEditTextAreaField($field)
	{
		echo '
		<tr>
			<td>' . getDisplayableFieldString($field) . '</td>
			<td><textarea id="' . $field . '" type="text" name="' . $field . '" rows="10" cols="100">' . $this->user->get($field) . '</textarea></td>
		</tr>';
	}

}