<?php
require_once('config.php');

session_destroy();
header('Location: ' . INDEX_URL);
exit();

?>