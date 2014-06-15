<?php

function queryUserTags($username)
{
	$con=dbConnect();
	
	$query = "SELECT * FROM " . TAG_TABLE_NAME . " WHERE username='" . $username . "'";
	$result = $con->prepare($query);
	$result->execute();
	return $result;
}
function insertIntoTagTable($username)
{
	$con=dbConnect();
	$query = "INSERT INTO " . TAG_TABLE_NAME . " (username, musician, engineer)
VALUES ('" . $username . "', 0, 0 )";

	$result = $con->prepare($query);
	$result->execute();
	return $result;
}
function queryDisplayUsers($type)
{
	$con=dbConnect();
	if ($type=='All')
	{
		$query = "SELECT username FROM " . TAG_TABLE_NAME;
	}
	else
	{
		$query = "SELECT username FROM " . TAG_TABLE_NAME . " WHERE " . htmlspecialchars($type) . "=1";
	}
	
	$result = $con->prepare($query);
	$result->execute();
	return $result;
}

function updateUserFieldsInDB($username, $changes)
{
	$con=dbConnect();
	$changesString = '';
	
	foreach ($changes as $key=>$value)
	{
		$changesString .= $key . "='" . $value . "', ";
	}
	$changesString = substr($changesString, 0, -2);
	$query = "UPDATE " .  USER_TABLE_NAME . " SET " . $changesString . " WHERE username = '" . $username . "'";
	$result = $con->prepare($query);
	$result->execute();
	return $result;
}

function dbConnect()
{
	require_once('/../config.php');

	$host = HOST_NAME;
	$username = USER_NAME;
	$password = PASSWORD;
	$user_database = DATABASE_NAME;

	try
	{
		$con=new PDO('mysql:host=' . $host . '; dbname=' . $user_database, $username, $password );
		return $con;
	}

	catch (PDOException $e)
	{
		echo "failed to connect to server"; die();
	}
}

function queryUserData($field, $username)
{
	$con=dbConnect();
	$query = "SELECT " . $field . " FROM " . USER_TABLE_NAME . " WHERE username = '" . $username . "'";
	$result = $con->prepare($query);
	$result->execute();
	$value = $result->fetch(PDO::FETCH_ASSOC);
	return $value[$field];
}

function loginQuery($username, $password)
{
	$con=dbConnect();
	$query = "SELECT * FROM " . USER_TABLE_NAME . " WHERE username = '" . htmlspecialchars($username) .
	"' AND password = '" . htmlspecialchars($password) . "'";
	$result = $con->prepare($query);
	$result->execute();
	return $result;
}

function registerQuery($firstName, $lastName, $username, $email, $password, $userFolder)
{
	$con=dbConnect();
	$query = 'INSERT INTO ' . USER_TABLE_NAME . ' (firstName, lastName, username, email, password, userFolder)
	VALUES("' . htmlspecialchars($firstName) . '", "' . htmlspecialchars($lastName) . '", "' . htmlspecialchars($username) .
	'", "' . htmlspecialchars($email) . '", "' . htmlspecialchars($password) . '", "' . $userFolder . '" )';
	
	$result = $con->prepare($query);
	$result->execute();
	return $result;
}

function queryUserFieldForUniqueCheck($field,$value)
{
	$con=dbConnect();
	$query="SELECT " . htmlspecialchars($field) . " FROM " . USER_TABLE_NAME . " WHERE " . htmlspecialchars($field) . " = '" . htmlspecialchars($value) . "'";
	$result = $con->prepare($query);
	$result->execute();
	return $result;
}

?>