<?php
require_once ('./config.php');
require_once (FORM_INTERFACE_URL);

class RegisterForm extends Form implements FormInterface
{
	
		
		
	static function echo_form()
	{
		RegisterForm::echo_form_header();
		RegisterForm::echo_form_body();
		RegisterForm::echo_form_footer();
	}
	
	static function echo_form_header()
	{
		echo "
		<form method='post' action='" . PROCESS_URL . "'>
		<input type='hidden' name='act' value='register' />
			<table>";
	}
	
	static function echo_form_body()
	{
		echo "
				<table>";
		Form::echoFormTextField('firstName');
		Form::echoFormTextField('lastName');
		Form::echoFormTextField('username');
		Form::echoFormTextField('email');
		Form::echoFormTextField('password');
		echo "
					<tr>
						<td colspan='3'>
							<input type='submit' value='Register' />
						</td>
					</tr>
				</table>";
	}
	static function echo_form_footer()
	{
		echo "
		</form>";
	}
}


?>