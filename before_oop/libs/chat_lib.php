<?php


function get_and_display_chat_users_list()
{
	$result=get_chat_users_query_results(); // the sql results of current session user being receiver or sender of a chat
	$list_of_users=array();
	echo "<table id='inbox_list'>";
	if ($result!=false)
	{
		while ($row = $result->fetch(PDO::FETCH_ASSOC))
		{
			//because the query grabs all chat message results
			//must ensure there are no duplicates when displaying
			
			echo "<tr>";
			if ($row['Sender']==$_SESSION['user']) // if its a sent message
			{
				if (!isset($list_of_users[$row['Receiver']]))
				{
					$list_of_users[$row['Receiver']]=true;
				
					echo '
					<li><a href ="' . DISPLAY_CHAT_URL . '?username=' . htmlspecialchars($row['Receiver']) . '">' . htmlspecialchars($row['Receiver']) . '</a></li>';
				}
				
			}
			else // if its a received message
			{
				if (!isset($list_of_users[$row['Sender']]))
				{
					$list_of_users[$row['Sender']]=true;
					echo '
					<li><a href ="' . DISPLAY_CHAT_URL . '?username=' . htmlspecialchars($row['Sender']) . '">' . htmlspecialchars($row['Sender']) . '</a></li>';
				}
				
			}
			echo "</tr>";
			
		}
	}
	else
	{
		error_msg_redirect_current('Error 12');
	}
	echo "</table>";
	
}

//the box area for chat messages
function display_chat_box($receiver)
{
	display_chat_messages($receiver);
	echo '<form method ="post" action = ' . PROCESS_URL .  '>
			<input type="hidden" name="act" value="message" />
			<input type="text" name="message" >
			<input type="submit" value="Submit">
			<input type="hidden" name="receiver" value="' . $receiver . '" />
			</form>';
	
}

function display_chat_messages($other_user)
{
	$result=get_chat_users_query_results();
	
	
	echo "<table id='chat_display_list'>";
	if ($result!=false)
	{
		while ($row = $result->fetch(PDO::FETCH_ASSOC))
		{
			echo "<tr>";
			if ($row['Sender']==$other_user or $row['Receiver']==$other_user)
			{
				if ($row['Sender']==$_SESSION['user']) // if its a sent message
				{
					echo '
					<td><b>' . $row['Sender'] . '</b> says:</td>
					<td>' . $row['Message'] . '</td>
					<td></td><td></td>';
				}
				else // if its a received message
				{
					echo '<td></td><td></td>
					<td><b>' . $row['Sender'] . '</b> says:</td>
					<td>' . $row['Message'] . '</td>';
				}
			}
			echo "</tr>";
			
		}
	}
	else
	{
		echo 'failed';die();
	}
	echo "</table>";
}

?>