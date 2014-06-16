<?php
class ChatPage extends Page
{
	protected $selectedUser;
	function __construct($username)
	{
		$this->userMustBeSignedIn();
		parent::__construct(null);
		$tempUser= new User();
		$tempUser->fillData($username);
		$this->selectedUser=$tempUser;
		$this->set('title','Chat with ' . $this->selectedUser->get('username'));
		
		//$extFiles['stylesheet']=array(css1,css2);
		//$extFiles['javascript']=array(js1,js2);
		//parent::__construct($extFiles);
	}
	
	function echoPageBody()
	{
		echo "<p>This is the " . $this->get('title') . " page </p>";
		$this->echoChatArea();
	}
	
	function echoChatArea()
	{
		$this->loadChatMessages();
		$this->echoInputArea();
	}
	
	function loadChatMessages()
	{
		$result=getChatMessages($this->user->get('username'), $this->selectedUser->get('username'));
		echo '
		<table id="chatDisplayTable">';
		while ($row = $result->fetch(PDO::FETCH_ASSOC))
		{
			$this->echoMessageLine($row);
		}
		echo '
		</table>';
	}
	
	function echoMessageLine($row)
	{
		echo "
		<tr>";
			
		if ($row['sender']==$this->user->get('username')) // if its a sent message
		{
			echo '
			<td><b>' . $row['sender'] . '</b>:</td>
			<td>' . $row['message'] . '</td>
			<td></td><td></td>';
		}
		else // if its a received message
		{
			echo '<td></td><td></td>
			<td><b>' . $row['sender'] . '</b>:</td>
			<td>' . $row['message'] . '</td>';
		}
		
		echo "
		</tr>";
	}
	function echoInputArea()
	{
		echo '
		<form method ="post" action = ' . PROCESS_URL .  '>
			<input type="hidden" name="act" value="message" />
			<input type="text" name="message" >
			<input type="submit" value="Submit">
			<input type="hidden" name="selectedUser" value="' . $this->selectedUser->get('username') . '" />
			<input type="hidden" name="user" value="' . $this->user->get('username') . '" />
		</form>';
	}
}

?>