<?php
//Page used to display any profile
require_once('libs/libs.php');

$page_settings = array('title'=>$_GET['job_post_title'], 'file'=>'display_job_post.php');
prev_page_handler($page_settings);
			
function print_body(&$page_settings)
{
	echo_chat_button();
	echo_job_post_info($page_settings);
}

function echo_job_post_info(&$page_settings)
{
	//job_post_title payment_method number_of_songs deadline description
	echo '
	<table id="user_info">
		<tr>
		<td>Title: ' . $_GET['job_post_title'] . '</td>
		<tr>
		<tr>
		<td>Submitted by: ' . get_job_post_value($_GET['job_post_title'], 'Username') . '</td>
		<tr>
		<tr>
		<td>Payment Method: ' .  get_job_post_value($_GET['job_post_title'], 'Payment_Method') . '</td>
		</tr>
		<tr>
		<td>Number of Songs: ' .  get_job_post_value($_GET['job_post_title'], 'Number_Of_Songs') . '</td>
		</tr>
		<tr>
		<td>Deadline: ' .  get_job_post_value($_GET['job_post_title'], 'Deadline') . '</td>
		</tr>
		<tr>
		<td>Description: ' .  get_job_post_value($_GET['job_post_title'], 'Description') . '</td>
		</tr>
	
	</table>
	';

}

function echo_chat_button()
{
	if ($_SESSION['user']!= get_job_post_value($_GET['job_post_title'], 'Username'))
	{
		echo '
		<td><form action = ' . DISPLAY_CHAT_URL .  '>
					<input type="submit" value="Message">
					<input type="hidden" name="username" value="' . get_job_post_value($_GET['job_post_title'], 'Username') . '"></form></td>';
	}
}

message_handler($page_settings);
print_page($page_settings);
?>
