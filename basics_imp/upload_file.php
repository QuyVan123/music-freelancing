<?php
require_once('libs/libs.php');

require_login();

$page_settings = array('title'=>'Upload File', 'file'=>'upload_file.php');
prev_page_handler($page_settings);



function print_body(&$_page_settings)
{
	echo '<p>Upload File Page</p>';


	$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : array();
	
	echo "<p>WARNING: All files will be overwritten</p>
	<form method='post' enctype='multipart/form-data' action='" . PROCESS_URL . "'>
		<input type='hidden' name='act' value='upload_file' />";
		//<label for='file'>Name file:</label> <input type='text' name ='filename' id=filename><br>
	echo"<input type='file' name='file' id='file'><br>
		<input type='submit' value='Upload File'>
	</form>";

}

message_handler($page_settings);
print_page($page_settings);
?>
