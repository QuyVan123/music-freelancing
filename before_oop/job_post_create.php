<?php
require_once('libs/libs.php');

$page_settings = array('title'=>'New Job Post', 'file'=>'job_post_create.php');
prev_page_handler($page_settings);
  

function print_body(&$page_settings)
{
	echo '<h1>' . $page_settings['title'] . '</h1>';
	echo_form($page_settings);
	
}

function echo_form(&$page_settings)
{
	$page_settings['errors'] = isset($_SESSION['errors']) ? $_SESSION['errors'] : array();
	$page_settings['inputs'] = isset($_SESSION['inputs']) ? $_SESSION['inputs'] : array();
	echo "
	<form method='post' action='" . PROCESS_URL . "'>
    <input type='hidden' name='act' value='new_job_post' />
		<table>"; 
	
	echo_job_post_create_form_text_field('job_post_title',$page_settings);
	echo_job_post_create_form_text_field('payment_method',$page_settings);
	echo_job_post_create_form_text_field('number_of_songs',$page_settings);
	echo_job_post_create_form_text_field('deadline',$page_settings);
	echo_job_post_create_form_text_area_field('description',$page_settings);
	//tags??? genre???
	
	//PROCESS TIME!!!!!!!
			
	echo "		
			<tr>
				<td colspan='3'>
					<input type='submit' value='Create New Job Post' />
					<td id='submitfield'></td>
				</td>
			</tr>
		</table>
	</form>";
}


message_handler($page_settings);
print_page($page_settings);
?>
