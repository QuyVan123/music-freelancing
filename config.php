<?php
require_once('/classes/Autoloader.php');
require_once('/lib/formMiscLib.php');
session_start();
define ('WEBSITE_NAME', 'Studio Pulse');

//reads only in the current directory
function defineAllURLConstants()
{
	foreach (glob("*.php") as $file)
	{
		define (fileNameToConstantFormat($file), $file);
	}
}

function fileNameToConstantFormat($string)
{
	$newString = '';
	foreach (splitAtUpperCase($string) as $str)
	{
		$str=str_replace('.php','',$str);
		$newString .= strtoupper($str) . '_';
	}
	$newString .= 'URL';
	return $newString;
	
}

spl_autoload_register('Autoloader::loader');
defineAllURLConstants();
if ($_SERVER['HTTP_HOST']=="localhost")
{
	define ('HOST_NAME', 'localhost');
	define ('USER_NAME', 'root');
	define ('PASSWORD', '');
	define('BASE_URL','./'); // not absolute path
	define('PRIVATE_URL','localhost/web_developing/private/');
	define ('UPLOAD_URL',BASE_URL. 'upload/');
	
	

	define ('PAGE_STYLE_URL', BASE_URL . 'css/page_style_7.css'); // modify this
	define ('MESSAGE_STYLE_URL',BASE_URL . 'css/message_style.css');
	define ('KEYWORDS_STYLE_URL',BASE_URL . 'css/keywords_style.css');
	define ('MISC_STYLE_URL', BASE_URL . 'css/misc_style.css');
	define ('PROFILE_STYLE_URL', BASE_URL . 'css/profile_style.css');
	define ('FORM_STYLE_URL', BASE_URL . 'css/form_style.css');
	define ('CHAT_STYLE_URL', BASE_URL . 'css/chat_style.css');
	$CSS_URLS_ARRAY=array(PAGE_STYLE_URL, MESSAGE_STYLE_URL, KEYWORDS_STYLE_URL, MISC_STYLE_URL, FORM_STYLE_URL, CHAT_STYLE_URL);
	
	//libs
	define ('EXTERNAL_PAGE_FILE_LIB_URL',BASE_URL . 'lib/externalPageFileLib.php');
	define ('USER_VALIDATION_LIB_URL', BASE_URL . 'lib/userValidationLib.php');
	define ('SQL_LIB_URL',BASE_URL . 'lib/sqlLib.php');
	define('FORM_MISC_LIB_URL',BASE_URL . 'lib/formMiscLib.php');
	
	//classes
	///dealt with by autoload 
	
	//interfaces
	define ('FORM_INTERFACE_URL', BASE_URL . 'interfaces/FormInterface.php');
}



//DATABASE
define ('DATABASE_NAME', 'iap_database');
define ('USER_TABLE_NAME', 'user_table');
define ('CHAT_TABLE_NAME', 'chat_table');
define ('TAG_TABLE_NAME', 'tag_table');
define ('JOB_POST_TABLE_NAME', 'job_post_table');





?>