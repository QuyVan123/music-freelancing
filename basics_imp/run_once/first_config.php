<?php
require_once('../config.php');
echo"
<form method='post' action=" . FIRST_CONFIG_PROCESS_URL . ">
    <input type='submit' name='act' value = 'delete tables and folders'>
</form>

<form method='post' action=" . FIRST_CONFIG_PROCESS_URL . ">
    <input type='submit' name='act' value = 'create tables and folders'>
</form>

<form method='post' action=" . FIRST_CONFIG_PROCESS_URL . ">
    <input type='submit' name='act' value = 'delete and create tables and folders'>
</form>


<form method='post' action=" . FIRST_CONFIG_PROCESS_URL . ">
    <input type='submit' name='act' value = 'create user database'>
</form>

<form method='post' action=" . FIRST_CONFIG_PROCESS_URL . ">
    <input type='submit' name='act' value = 'create user table'>
</form>

<form method='post' action=" . FIRST_CONFIG_PROCESS_URL . ">
    <input type='submit' name='act' value = 'create chat table'>
</form>

<form method='post' action=" . FIRST_CONFIG_PROCESS_URL . ">
    <input type='submit' name='act' value = 'create tag table'>
</form>

<form method='post' action=" . FIRST_CONFIG_PROCESS_URL . ">
    <input type='submit' name='act' value = 'create job post table'>
</form>

<form method='post' action=" . FIRST_CONFIG_PROCESS_URL . ">
    <input type='submit' name='act' value = 'create user upload dir'>
</form>

<form method='post' action=" . FIRST_CONFIG_PROCESS_URL . ">
    <input type='submit' name='act' value = 'delete user database'>
</form>

<form method='post' action=" . FIRST_CONFIG_PROCESS_URL . ">
    <input type='submit' name='act' value = 'delete user table'>
</form>

<form method='post' action=" . FIRST_CONFIG_PROCESS_URL . ">
    <input type='submit' name='act' value = 'delete chat table'>
</form>

<form method='post' action=" . FIRST_CONFIG_PROCESS_URL . ">
    <input type='submit' name='act' value = 'delete tag table'>
</form>

<form method='post' action=" . FIRST_CONFIG_PROCESS_URL . ">
    <input type='submit' name='act' value = 'delete job post table'>
</form>

<form method='post' action=" . FIRST_CONFIG_PROCESS_URL . ">
    <input type='submit' name='act' value = 'delete user upload dir'>
</form>


";

?>