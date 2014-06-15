<?php
require_once('./config.php');
require_once(FORM_MISC_LIB_URL);
class Form
{
	
	static function echoFormTextField($field)
	{
		echo '
		<tr>
			<td>' . getDisplayableFieldString($field) . '</td>
			<td><input id=' . $field . '_input type="text" name=' . $field . ' /></td>
		</tr>';

	}
	
	
	

}



?>