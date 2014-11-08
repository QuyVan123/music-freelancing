<?php
require_once('libs/libs.php');

$page_settings = array('title'=>'Register', 'file'=>'register.php');
prev_page_handler($page_settings);
  

function print_body(&$_page_settings)
{
	$page_settings['errors'] = isset($_SESSION['errors']) ? $_SESSION['errors'] : array();
	$page_settings['$inputs'] = isset($_SESSION['inputs']) ? $_SESSION['inputs'] : array();
	echo "
	<form method='post' action='" . PROCESS_URL . "'>
    <input type='hidden' name='act' value='register' />
		<table>";
		
	echo_register_form_text_field('first_name',$page_settings);
	echo_register_form_text_field('last_name',$page_settings);
	echo_register_form_text_field('username',$page_settings);
	echo_register_form_text_field('email',$page_settings);
	echo_register_form_text_field_no_prev_value('password',$page_settings);
	echo"
			<tr>
				<td colspan='3'>
					<input type='submit' value='Create Account' />
					<td id='submitfield' class='error'></td>
				</td>
			</tr>
		</table>
	</form>";
	return $page_settings;
}

message_handler($page_settings);
print_page($page_settings);
?>
