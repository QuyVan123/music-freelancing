<?php
//functions not belonging in any current libraries go here

function echo_files(&$page_settings,$user)
{
	// Define the full path to your folder from root
    $path = "upload/" . $user . "/";
    // Open the folder
	$dir_handle = @opendir($path);
	
    /*if(!$dir_handler) // pathing is wierd... need to fix one day
	{
		error_msg_redirect_index('Error 6');
	}
	*/
    // Loop through the files
	echo '
	<ul id="user_files">';
	if ($dir_handle!=false)
	{
		while ($file = readdir($dir_handle)) 
		{
			if($file == "." || $file == ".." || $file == "index.php" )
			{
				continue;
			}
			$audio_ext = array("audio/mpeg");
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			if (in_array(finfo_file($finfo, $path.$file),$audio_ext))
			{
				echo "
				<li><a href=" . $path . $file. ">$file</a><br /></li>";
				
				echo '<li>
				<audio controls>
				<source src="' . $path.$file . '" type="' . finfo_file($finfo, $path.$file) . '">
				Your browser doesn\'t support audio. Please upgrade your browser.
				</audio></li>';
				
			}
			
			else // image!
			{
				echo "
				<li><a href=" . $path . $file. ">$file</a><br /></li>";
			}
			finfo_close($finfo);
			
		}
		// Close
		echo '
		</ul>';
		closedir($dir_handle);
	}
	
}
/*
function echo_user_files()
{
	echo '<h2>User Files</h2>';
	//view files
	$path = "upload/" . $_GET['username'] . "/";
  
    // Open the folder
    $dir_handle = @opendir($path) or die("Empty");
  
    // Loop through the files
    while ($file = readdir($dir_handle)) {
  
    if($file == "." || $file == ".." || $file == "index.php" )
  
        continue;
        echo "<a href=" . $path . $file. ">$file</a><br />";
  
    }
    // Close
    closedir($dir_handle);
}
*/

function get_and_display_users($type)
{
	$result = get_and_display_users_query_result($type);

	echo "
	<ul id='user_list'>";
	while ($row = $result->fetch(PDO::FETCH_ASSOC))
	{
		echo '
		<li><a href ="' . DISPLAY_PROFILE_URL . '?username=' . $row['Username'] . '">' . htmlspecialchars($row['Username']) . '</a></li>';
	}
	echo "</ul>";
}

function get_and_display_job_posts()
{


	$result = get_and_display_job_posts_query_result();

	echo "
	<ul id='job_list'>";
	while ($row = $result->fetch(PDO::FETCH_ASSOC))
	{
		echo '
		<li><a href ="' . DISPLAY_JOB_POST_URL . '?job_post_title=' . $row['Job_Post_Title'] . '">' . htmlspecialchars($row['Job_Post_Title']) . '</a></li>';
	}
	echo "</ul>";
}

function get_image_url($name)
{
	return IMAGES_FOLDER_URL . $name;
}

function prev_page_handler(&$page_settings)
{
	if (isset($_SESSION['current_page'])) 
	{
		$_SESSION['previous_page']=$_SESSION['current_page'];
		$_SESSION['current_page'] = $page_settings['file'];
	}
	else
	{
		$_SESSION['current_page'] = $page_settings['file'];
	}
}

function redirect_previous_page()
{
	if (isset($_SESSION['previous_page']))
	{
		header("Location: " . base_url($_SESSION['previous_page']));
		die();
		
	}
	else
	{
		redirect_index_page();
	}
}

function redirect_current_page()
{
	
	if (isset($_SESSION['current_page']))
	{	
		
		header("Location: " . base_url($_SESSION['current_page']));
		die();
	}
	else
	{
		redirect_index_page();
	}
}

function redirect_index_page()
{
	header("Location: " . INDEX_URL);
	die();
}

function get_job_post_value($job_post_title,$field)
{
	$value = get_job_post_value_query_result_value($job_post_title,$field);
	return $value[$field];
}
?>