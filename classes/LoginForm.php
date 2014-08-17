<?php
require_once ('./config.php');
require_once (FORM_INTERFACE_URL);

class LoginForm extends Form implements FormInterface
{
	static function echo_form()
	{
		LoginForm::echo_form_header();
		LoginForm::echo_form_body();
		LoginForm::echo_form_footer();
	}
	
	static function echo_form_header()
	{
		echo "
		<form class='colourCoded' method='post' action='" . PROCESS_URL . "'>
		<input type='hidden' name='act' value='login' />";
	}
	
	static function echo_form_body()
	{
		echo "
				<table>";
		Form::echoFormTextField('username', 'required', 'autofocus');
		Form::echoFormPasswordField('required', '');
		echo "
					<tr>
						<td colspan='3'>
							<input type='submit' value='Sign In' />
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