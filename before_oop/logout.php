<?php
require_once('libs/libs.php');

sign_out();

$_SESSION['message'] = create_message('successMessage', 'Successfully logged out.');
header('Location: ' . INDEX_URL);
exit();
?>
