<?php
require_once('config.php');

if (!isset($_GET['username']))
{
	header('Location: ' . INDEX_URL);
	die();
}
$page = new ViewProfilePage($_GET['username']);
$page->display();

?>