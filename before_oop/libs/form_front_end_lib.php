<?php
//all files used to handle forms for the front end go here



function echo_job_post_create_form_text_field($current_field,&$page_settings)
{
	$error=get_form_error($current_field,$page_settings);
	
	$value = get_form_prev_value($current_field,$page_settings);
	if (isset($_SESSION['inputs']))
	{
		echo "
			<tr>
				<td>" . format_field_string_to_displayable_string($current_field) . "</td>
				<td><input id='$current_field' type='text' name='$current_field' value='" . $_SESSION['inputs'][$current_field] . "'/></td>
				<td class='error' id='$current_field'>" . $error . "</td>
			</tr>";
	}
	else
	{
		echo "
			<tr>
				<td>" . format_field_string_to_displayable_string($current_field) . "</td>
				<td><input id='$current_field' type='text' name='$current_field' value='$value'/></td>
				<td class='error' id='$current_field'>" . $error . "</td>
			</tr>";
	}
}

function echo_contact_form(&$page_settings)
{
	
}

function echo_login_form(&$page_settings)
{
	echo "
		<form method='post' action='" . PROCESS_URL . "'>
		<input type='hidden' name='act' value='login' />
			<table>";
	$error = isset($errors['username']) ? $errors['username'] : '';
	$value = isset($inputs['username']) ? htmlspecialchars($inputs['username']) : '';
	echo "
				<tr>
					<td>Username</td>
					<td><input id='username_input' type='text' name='username' value='$value' /></td>
					<td class='error' id='username_'>$error</td>
				</tr>";
	$error = isset($errors['password']) ? $errors['password'] : '';
		echo "	
				<tr>
					<td>Password</td>
					<td><input id='password_input' type='password' name='password' value='' /></td>
					<td class='error' id='password_'>$error</td>
				</tr>
				<tr>
					<td colspan='3'>
						<input type='submit' value='Sign In' />
					</td>
				</tr>
			</table>
		</form>";
}

function echo_job_post_create_form_text_area_field($current_field,&$page_settings)
{
	$error=get_form_error($current_field,$page_settings);
	$value =get_form_prev_value($current_field,$page_settings);
	if (isset($_SESSION['inputs']))
	{
		echo "
				<tr>
					<td>" . format_field_string_to_displayable_string($current_field) . "</td>
					<td><textarea id='$current_field' name='$current_field' rows='10' cols='100'>" . $_SESSION['inputs'][$current_field] . "</textarea></td>
					<td class='error' id='$current_field'>$error</td>
				</tr>";
	}
	else
	{
		echo "
				<tr>
					<td>" . format_field_string_to_displayable_string($current_field) . "</td>
					<td><textarea id='$current_field' name='$current_field' rows='10' cols='100'>" . $value . "</textarea></td>
					<td class='error' id='$current_field'>
					$error
					</td>
				</tr>";
	}
}

function echo_edit_profile_form_text_field($current_field,&$page_settings)
{
	$error=get_form_error($current_field,$page_settings);
	$value = get_user_value($_SESSION['user'],'First_Name');
	echo "
			<tr>
				<td>" . format_field_string_to_displayable_string($current_field) . "</td>
				<td><input id='$current_field' type='text' name='$current_field' value='$value'/></td>
				<td class='error' id='$current_field'>$error</td>
			</tr>";
	
}

function echo_edit_profile_form_text_area_field($current_field,&$page_settings)
{
	$error=get_form_error($current_field,$page_settings);
	$value =get_user_value($_SESSION['user'],'About_Me');
	echo "
			<tr>
				<td>" . format_field_string_to_displayable_string($current_field) . "</td>
				<td><textarea id= '" . $current_field . "' name='" . $current_field. "' rows='10' cols='100' />" . $value . "</textarea></td>
				<td class='error' id='$current_field'>$error</td>
			</tr>";
}

function echo_register_form_text_field($current_field,&$page_settings)
{
	echo_job_post_create_form_text_field($current_field,$page_settings);
}

function echo_register_form_text_field_no_prev_value($current_field,&$page_settings)
{
	$error=get_form_error($current_field,$page_settings);
	echo "
			<tr>
				<td>" . format_field_string_to_displayable_string($current_field) . "</td>
				<td><input id='$current_field' type='password' name='$current_field'/></td>
				<td class='error' id='$current_field'>$error</td>
			</tr>";
}

function echo_edit_profile_tag_form_checkbox_field($current_field,&$page_settings)
{
	echo "
		<tr>";
	$value=get_user_tag_value($_SESSION['user'],$current_field);
	if ($value=='1')
	{
		echo "<td><input type='checkbox' name='tags[]' value='$current_field' checked>$current_field</td>";
	}
	else
	{
		echo "<td><input type='checkbox' name='tags[]' value='$current_field'>$current_field</td>";
	}
	echo "</tr>";
}

function get_form_error($field,&$page_settings)
{
	if (isset ($page_settings['errors'][$field]))
	{
		return $page_settings['errors'][$field];
	}
	else
	{
		return '';
	}
}

function get_form_prev_value($field,&$page_settings)
{
	if (isset ($page_settings['inputs'][$field]))
	{
		return $page_settings['inputs'][$field];
	}
	else
	{
		return '';
	}
}	

//example job_post --> Job Post
function format_field_string_to_displayable_string($string)
{
	$token=strtok($string,'_');
	$new_string=" ";
	while ($token !== false) 
	{
		$new_string .= ucfirst($token) . ' ';
		$token=strtok('_');
	}
	return $new_string;
}

function echo_edit_profile_user_data_form(&$page_settings)
{
	//should move <img>
	echo "
	<div id = 'profile_pic_space'><img  src='" . get_user_value($_SESSION['user'], 'Pic_URL') . "'></div>
	
	<form method='post' action='" . PROCESS_URL . "'>
    <input type='hidden' name='act' value='edit_profile' />
		<table>";	
	echo_edit_profile_form_text_area_field("about_me",$page_settings);

	echo "	
			<tr>
				<td colspan='3'>
					<input type='submit' value='Modify Profile' />
					<td id='submitfield' class='error'></td>
				</td>
			</tr>
		</table>
	</form>";
}

function echo_edit_profile_pic_form()
{
	echo "
	<form method='post' enctype='multipart/form-data' action='" . PROCESS_URL . "'>
    <input type='hidden' name='act' value='upload_profile_pic' />
		<input type='file' name='file' id='file'><br>
		<input type='submit' value='Upload Picture'>
	</form>";
}

function echo_edit_profile_user_tag_form(&$page_settings)
{
	echo "
	<form method='post' action='" . PROCESS_URL . "'>
    <input type='hidden' name='act' value='edit_tags' />
	<table>
	
	<tr><td>Tags</td></tr>";

	echo_edit_profile_tag_form_checkbox_field('Musician',$page_settings);
	echo_edit_profile_tag_form_checkbox_field('Engineer',$page_settings);

	echo"
		<tr>
			<td colspan='3'>
				<input type='submit' value='Update Tags' />
				<td id='submitfield' class='error'></td>
			</td>
		</tr>
			
			</table>
	</form>";
}


?>