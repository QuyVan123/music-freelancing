<?php
require_once('libs/libs.php');

$page_settings = array('title'=>'User List', 'file'=>'user_list.php');
prev_page_handler($page_settings);

function print_body(&$_page_settings)
{
	//MUST CONSIDER IF NONE....
	//MAYBE CHANGE IT AROUND SO THAT THEY REGISTER AS MUSICIAN OR SOUND ENGINEEER
	echo "
	<input id= 'htype' type='hidden' name='type' value='All' />
	
	<button class='user_sort_button' type='button'><a href='" . USER_LIST_URL . "?htype=All'>All</a></button>
	<button class='user_sort_button' type='button'><a href='" . USER_LIST_URL . "?htype=Musician'>Musician</a></button>
	<button class='user_sort_button' type='button'><a href='" . USER_LIST_URL . "?htype=Engineer'>Sound Engineer</a></button>
	
	";
	$search="All";
	if (isset($_GET['htype']))
	{
		$search=$_GET['htype'];
	}
	get_and_display_users($search);
	
}



message_handler($page_settings);
  
print_page($page_settings);
?>
