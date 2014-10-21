<?php

require_once('libs/libs.php');

$page_settings = array('title'=>'Job Post Listings', 'file'=>'job_post_listing.php');
prev_page_handler($page_settings);

function print_body(&$page_settings)
{
	echo '<p> This is the Job Post Listing Page</p>';
	get_and_display_job_posts();
}

message_handler($page_settings);
print_page($page_settings);
?>
