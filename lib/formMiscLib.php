<?php

function getDisplayableFieldString($string)
{
	$newString = '';
	foreach (splitAtUpperCase($string) as $str)
	{
		$newString .= $str . ' ';
	}
	return ucFirst($newString);
}

function splitAtUpperCase($s) {
        return preg_split('/(?=[A-Z])/', $s, -1, PREG_SPLIT_NO_EMPTY);
}
	
?>