<?php
require_once('./config.php');
require_once(FORM_MISC_LIB_URL);
class Form
{
	
	static function echoFormTextField($field, $required, $focus)
	{
		echo '
		<tr>
			<td>' . getDisplayableFieldString($field) . '</td>
			<td><input id="' . $field . '" type="text" value="' . (isset($_SESSION[$field]) ? $_SESSION[$field] : '') . '" name="' . $field .'" placeholder=" ' . ucfirst($required) . '" ' . $required . ' ' . $focus . '/></td>
		</tr>';

	}
	
	static function echoFormEmailField($required, $focus)
	{
		$field='email';
		echo '
		<tr>
			<td>' . getDisplayableFieldString($field) . '</td>
			<td><input id="' . $field . '" type="email" value="' . (isset($_SESSION[$field]) ? $_SESSION[$field] : '') . '" name="' . $field .'" placeholder=" ' . ucfirst($required) . '" ' . $required . ' ' . $focus . '/></td>
		</tr>';

	}
	
	static function echoFormPasswordField($required, $focus)
	{
		$field='password';
		echo '
		<tr>
			<td>' . getDisplayableFieldString($field) . '</td>
			<td><input id="' . $field . '" type="password" name="' . $field .'" placeholder=" ' . ucfirst($required) . '" ' . $required . ' ' . $focus . '/></td>
		</tr>';

	}
	
	
	

}



?>