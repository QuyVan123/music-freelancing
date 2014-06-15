<?php
//INCOMPLETE - DOES NOT AFFECT PROGRAM
//started trying to automate files, this feature is not particular useful at the moment I created
//neat idea, might work on it one day
//6/14/2014

function create_url_pages()
{
	create_url_page($file)
}

function pageNameToPageClassNameFormat($string)
{
	return ucfirst($string) . 'Page';
}

function create_url_page($page_name)
{
	$file = fopen($page_name . ".php","w");
	
	fwrite ($file, sprintf(
	"
<?php
require_once('config.php');

$page = new " . pageNameToPageClassNameFormat($page_name) . "();
$page->display();

?>";
	
}




	
	
?>