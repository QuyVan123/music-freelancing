<?php
//page_settings and ABSOLUTE variables

define ('WEBSITE_NAME', 'Studio Pulse');
//different places the website might be hosted on
if ($_SERVER['HTTP_HOST']=="localhost")
{
	define ('HOST_NAME', 'localhost');
	define ('USER_NAME', 'root');
	define ('PASSWORD', '');
	define('BASE_URL','http://localhost/web_developing/before_oop/');
	define('PRIVATE_URL','http://localhost/web_developing/private/');
}
elseif ($_SERVER['HTTP_HOST']=="studiopulse.net" )
{
	define ('HOST_NAME', 'localhost'); //ip-172-31-41-34
	define ('USER_NAME', 'root');
	define ('PASSWORD', '7Ttqn3^');
	
	define('BASE_URL','http://studiopulse.net/');
	define('PRIVATE_URL','');
}
/*
elseif ($_SERVER['HTTP_HOST']=="ec2-54-86-51-118.compute-1.amazonaws.com")
{
	define ('HOST_NAME', 'localhost'); //ip-172-31-41-34
	define ('USER_NAME', 'root');
	define ('PASSWORD', '12345qwert');
	
	define('BASE_URL','http://ec2-54-86-51-118.compute-1.amazonaws.com/');
	define('PRIVATE_URL','');
}
*/
else
{
	echo "error config";
	die();
}

//function that prepends base url
function base_url($ext)
{
	return BASE_URL.$ext;
}
//function that prepends private url
function private_url($ext)
{
	return PRIVATE_URL.$ext;
}

//DATABASE
define ('USER_DATABASE_NAME', 'user_database');
define ('USER_TABLE_NAME', 'user_table');
define ('CHAT_TABLE_NAME', 'chat_table');
define ('TAG_TABLE_NAME', 'tag_table');
define ('JOB_POST_TABLE_NAME', 'job_post_table');

//ADMIN DATABASE USEAGE URLS
define('FIRST_CONFIG_URL',base_url('run_once/first_config.php'));
define('CREATE_USER_DATABASE_URL',base_url('run_once/create_user_database.php'));
define('CREATE_USER_TABLE_URL',base_url('run_once/create_user_table.php'));
define('CREATE_CHAT_TABLE_URL',base_url('run_once/create_chat_table.php'));
define('CREATE_TAG_TABLE_URL',base_url('run_once/create_tag_table.php'));
define('DELETE_USER_TABLE_URL',base_url('run_once/delete_user_table.php'));

//LIBS
//libraries are not included in config file
//they can be found in the libs folder


//css

define ('PAGE_STYLE_URL', base_url('css/page_style_7.css')); // modify this
define ('MESSAGE_STYLE_URL',base_url('css/message_style.css'));
define ('KEYWORDS_STYLE_URL',base_url('css/keywords_style.css'));
define ('MISC_STYLE_URL', base_url('css/misc_style.css'));
define ('PROFILE_STYLE_URL', base_url('css/profile_style.css'));
$CSS_URLS_ARRAY=array(PAGE_STYLE_URL, MESSAGE_STYLE_URL, KEYWORDS_STYLE_URL, MISC_STYLE_URL);

//Navigation Menu URLS
define ('INDEX_URL', base_url('index.php/'));
define ('REGISTER_URL', base_url('register.php/'));
define ('LOGIN_URL', base_url('login.php/'));
define ('LOGOUT_URL', base_url('logout.php/'));
define ('PROCESS_URL', base_url('process.php/'));

define ('ERROR_URL', base_url('error.php'));
define ('USER_LIST_URL', base_url('user_list.php'));
define ('DISPLAY_PROFILE_URL',base_url('display_profile.php'));
define ('EDIT_PROFILE_URL',base_url('edit_profile.php'));
define ('UPLOAD_FILE_URL',base_url('upload_file.php'));
define ('VIEW_FILES_URL',base_url('view_files.php'));
define ('INBOX_URL',base_url('inbox.php'));
define ('DISPLAY_CHAT_URL',base_url('display_chat.php'));
define ('IMAGES_FOLDER_URL',base_url('images/'));
define ('JOB_POST_CREATE_URL',base_url('job_post_create.php'));
define ('JOB_POST_LISTING_URL',base_url('job_post_listing.php'));
define ('DISPLAY_JOB_POST_URL',base_url('display_job_post.php'));
define ('FIRST_CONFIG_PROCESS_URL', base_url('run_once/first_config_process.php'));
define ('PAYMENT_TEST_URL',base_url('payment_test.php'));
define ('CONTACT_US_URL',base_url('contact_us.php'));

//Javascript URLS
define ('JS_LAND_IMG_URL',base_url('js/landing.js'));


//If the user is logged in
if (isset($_SESSION['user']))
{
	define ('USER_BASE_URL', "upload/" . $_SESSION['user'] . "/");
}
//misc




?>

