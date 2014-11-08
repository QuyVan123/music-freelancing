<?php

function checkAndAddFieldError($type, $field, $value, &$errors)
{
	if ($type=="login")
	{
		$err = loginCheckAndReturnFieldError($field,$value);
		if (!empty($err))
		{
			$errors[$field] = $err;
		}
	}
	else if ($type=="register")
	{
		$err = registerCheckAndReturnFieldError($field,$value);
		if (!empty($err))
		{
			$errors[$field] = $err;
		}
	}
}

function loginCheckAndReturnFieldError($field,$value)
{
	if (empty($value))
	{
		$msg = new ErrorMEssage('Required ' . $field);
		$msg->addMessage();
		return;
	}
	if($field=='username')
	{
		return loginCheckAndReturnUsername($value);
	}
	elseif($field=='password')
	{
		return loginCheckAndReturnPassword($value);
	}
}
	
function RegisterCheckAndReturnFieldError($field,$value)
{
	if (empty($value))
	{
		$msg = new ErrorMEssage('Required ' . $field);
		$msg->addMessage();
		return;
	}
	if ($field=='first_name')
	{
		return registerCheckAndReturnFirstName($value);
	}
	elseif($field=='last_name')
	{
		return registerCheckAndReturnLastName($value);
	}
	elseif($field=='username')
	{
		return registerCheckAndReturnUsername($value);
	}
	elseif($field=='email')
	{
		return registerCheckAndReturnEmail($value);
	}
	elseif($field=='password')
	{
		return registerCheckAndReturnPassword($value);
	}
	else
	{
		echo "registeR_check_and_return_field_error problem"; die();
	}
}

function loginCheckAndReturnUsername($value)
{
	return '';
}

function loginCheckAndReturnPassword($value)
{
	return '';
}

function registerCheckAndReturnFirstName($value)
{
	return '';
}
function registerCheckAndReturnLastName($value)
{
	return '';
}

function registerCheckAndReturnEmail($value)
{
	if(userFieldInUse('email',$value))
	{
		$msg = new ErrorMEssage('Email Already Exists');
		$msg->addMessage();
		return;
	}
	return '';
}

function userFieldInUse($field,$value)
{
	$result = queryUserFieldForUniqueCheck($field,$value);
	$rows = $result->rowCount();

	if ($rows>=1)
	{
		return true;
	}
	else
	{
		return false;
	}
}


function registerCheckAndReturnUsername($value)
{
	if(userFieldInUse('username',$value))
	{
		$msg = new ErrorMEssage('Username Already Exists');
		$msg->addMessage();
		return;
	}
	else
	{
		return '';
	}
}

function registerCheckAndReturnPassword($value)
{
	return '';
}

?>