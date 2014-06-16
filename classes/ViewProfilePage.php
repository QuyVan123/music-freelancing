<?php
class ViewProfilePage extends ProfilePage
{
	protected $selectedUser;
	function __construct($username)
	{
		parent::__construct(null);
		
		$tempUser= new User();
		$tempUser->fillData($username);
		$this->selectedUser=$tempUser;
		$this->set('title',$this->selectedUser->get('username') . "'s profile");
		
	}
	function echoPageBody()
	{
		echo "<p>This is " . $this->selectedUser->get('username') . "'s profile page </p>";
		$this->echoPageBodyHeader();
		$this->echoUserData();
		$this->echoFiles();
	}
	
	function echoPageBodyHeader()
	{
		$this->echoProfilePic();
		echo'
		<div id="display_profile_name"><h1>' . $this->selectedUser->get('username') .  '\'s Profile</div>';
		$this->echoButton();
	}
	
	function echoUserData()
	{
		
		$this->echoUserProfessionTags();

		echo '
		<table id="user_info">
			<tr>
			<td>Username: ' .  $this->selectedUser->get('username') . '</td>
			</tr>
			<tr>
			<td>First Name: ' .  $this->selectedUser->get('firstName'). '</td>
			</tr>
			<tr>
			<td>Last Name: ' .  $this->selectedUser->get('lastName') . '</td>
			</tr>
			<tr>
			<td>About Me: ' .  $this->selectedUser->get('aboutMe') . '</td>
			</tr>
		
		</table>
		';
		
		
	}
	
	
	
	function echoUserProfessionTags()
	{
		echo '
		<div id="profession_tags">';
		$this->selectedUser->echoTags();
		echo'
		</div>';
	}
	
	function profileAndSessionUserEquals()
	{
		if ($this->user->get('username')==$this->selectedUser->get('username'))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function echoButton()
	{
		if ($this->userSignedIn())
		{
			if ($this->profileAndSessionUserEquals())
			{
				echo '
				<div id="edit_chat_button_area">';
				$this->echoEditButton();
				echo '
				</div>';
			}
			else
			{
				$this->echoChatButton();
			}
		}
		else
		{
			$this->echoChatButton();
		}
	}
	function echoEditButton()
	{
		echo "
		<button id='edit_chat_button' type='button'><a href='" . EDIT_PROFILE_URL . "'>Edit Profile</a></button>";
	}

	function echoChatButton()
	{
		echo '
		<td><form action = ' . CHAT_URL .  '>
					<input type="submit" value="Message">
					<input type="hidden" name="username" value="' . $_GET['username'] . '"></form></td>';
	}
	
	
	function echoFiles()
	{
		$path = $this->user->get('userFolder');

		$dir_handle = @opendir($path);
		
		echo '
		<ul id="userFiles">
		<table>';
		if ($dir_handle!==false)
		{
			while ($file = readdir($dir_handle)) 
			{	
				//the if below is to skip fillers
				if($file == "." || $file == ".." || $file == "index.php" )
				{
					continue;
				}
				$audio_ext = array("audio/mpeg");
				$finfo = finfo_open(FILEINFO_MIME_TYPE);
				if (in_array(finfo_file($finfo, $path.$file),$audio_ext))
				{
					echo "
					<tr><td><a href=" . $path . $file. ">$file</a></li></td>";
					
					echo '<td>
					<audio controls>
					<source src="' . $path.$file . '" type="' . finfo_file($finfo, $path.$file) . '">
					Your browser doesn\'t support audio. Please upgrade your browser.
					</audio></td>';
					
				}
				else // image!
				{
					echo "
					<tr><td><a href=" . $path . $file. ">$file</a><br /></td></tr>";
				}
				finfo_close($finfo);
				
			}
			
			closedir($dir_handle);
		}
		else
		{
			echo "directory pathing to view files error";die();
		}	
		echo '
		</table>
		</ul>';
		
	}
}

?>