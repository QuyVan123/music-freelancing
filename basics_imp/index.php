<?php

require_once('libs/libs.php');

$page_settings = array('title'=>'Home Page','scripts'=>array(JS_LAND_IMG_URL), 'file'=>'index.php');
prev_page_handler($page_settings);

function print_body(&$page_settings)
{
	echo '<p> This is the home page</p>';
	/*
	<div id="land_img" >
	<img name="slide" src="' . get_image_url('one.jpg') . '" width="100%" height="100%"/>
	</div>';
	*/
	/*
	$test1=password_hash("abc",PASSWORD_BCRYPT);
	$test2=password_hash("abc",PASSWORD_BCRYPT);
	$test3=password_hash("abc",PASSWORD_BCRYPT);
	if (password_verify("abc",$test1))
	{
		echo "test1=test2<br>";
	}
	if (password_verify("abc",$test2))
	{
		echo "test1=test3<br>";
	}
	echo "done";
	*/
}

message_handler($page_settings);
print_page($page_settings);
?>
