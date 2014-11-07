<?php
/*
require_once('./config.php');
require_once(SQL_LIB_URL);
*/
class InboxPage extends Page
{
	protected $contactList;
	function __construct()
	{
		parent::__construct(null);
		$this->set('title','Inbox');
		$contactList = array();
		
	}
	function echoPageBody()
	{
		echo "<p>This is the " . $this->get('title') . " page </p>";
		$this->echoContacts();
	}
	
	function echoContacts()
	{
		$result = getChatContacts($this->user->get('username'));
		
		echo "
		<table id='contactList'>";
		
		while ($row = $result->fetch(PDO::FETCH_ASSOC))
		{
			echo '
			<tr>';
			if ($row['sender']==$this->user->get('username')) // if its a sent message
			{
				if (!isset($this->contactList[$row['receiver']]))
				{
					$selectedUser = $row['receiver'];
				}
				
			}
			else // if its a received msg
			{
				if (!isset($this->contactList[$row['sender']]))
				{
					$selectedUser = $row['sender'];
				}
			}
			
			if (isset($selectedUser))
			{
				$this->echoChatURL($selectedUser);
				unset($selectedUser);
			}
			
			echo '
			</tr>';
		}
		echo '
		</table>';
	}
	
	function echoChatURL($user)
	{
		$this->contactList[$user]=true;
		echo '
		<li><a href ="' . CHAT_URL . "?username=" . $user . '">' . $user . '</a></li>';
	}
}

?>