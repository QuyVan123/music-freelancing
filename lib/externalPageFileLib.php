<?php
//to be used with Page class

function handleAndPrintExternalFiles($externalPageFiles)
{
	styleSheetHandler($externalPageFiles);
	scriptHandler($externalPageFiles);
}

//the css urls array is kind of messy
//should modify the config file making $CSS_URLS_ARRAY into CSS_URLS_LIST as a string
// then explode the list into the array below
function styleSheetHandler($externalPageFiles)
{
	global $CSS_URLS_ARRAY;
	if (!isset($externalPageFiles['stylesheets']))
	{
		$externalPageFiles['stylesheets']=array();
	}
	$externalPageFiles['stylesheets'] = array_merge($CSS_URLS_ARRAY,$externalPageFiles['stylesheets']);
	echoStyleSheets($externalPageFiles);
}

function scriptHandler($externalPageFiles)
{
	if (!isset($externalPageFiles['scripts']))
	{
		$externalPageFiles['scripts'] = array();
	}
	echoScripts($externalPageFiles);
}

function echoStyleSheets($externalPageFiles)
{
	foreach ($externalPageFiles['stylesheets'] as $css_href)
	{
		echo '
		<link href=\'' . htmlspecialchars($css_href) .'\' type=\'text/css\' rel=\'stylesheet\'>';
	}
}

function echoScripts($externalPageFiles)
{
	
	foreach ($externalPageFiles['scripts'] as $script_src) 
	{
		echo '
		<script src=' . htmlspecialchars($script_src) . ' type="text/javascript"></script>';
	}
}
?>