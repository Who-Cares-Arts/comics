<?php
	require_once(DOCUMENT_ROOT.'resources/kits/webKit.php');
	require_once(DOCUMENT_ROOT.'resources/kits/imageKit.php');

session_set_cookie_params(0, '/', 'whocaresarts.com');

	// Declare essential global variables for website
	$site = "home";
	$page = "home";
	$user = NULL;
	$value = NULL;

    if(!isset($siteType))
        $siteType = "sites";

	// Determine the trailing GET uri, add it as an array called $DATA
	$reqUri = $_SERVER['REQUEST_URI'];
	$pos = strpos($reqUri, '?');
	$reqUri = substr_replace($reqUri, '', 0, $pos);
	$reqUri = str_replace('/', '', $reqUri);
	$reqUri = str_replace('?', '', $reqUri);
	$tempData = explode('&', $reqUri);
	$DATA = array();
	for ($i = 0; $i < count($tempData); $i++)
	{
		$d = explode('=', $tempData[$i]);
		if(count($d) == 2)
			$DATA[$d[0]]=$d[1];
	}

	// BackgroundImage???
	$backgroundImage = "";

	// Assign URI variables to declared variables.
	if(!empty($_GET["site"]))
	{
		if($_GET["site"] != "articles")
			$site = $_GET["site"];
	}
	if(!empty($_GET["page"]))
		$page = $_GET["page"];
	if(!empty($_GET["user"]))
	{
		if($_GET["site"] != "articles")
			$site = "user";
		$user = $_GET["user"];
		include(USER_ROOT.'/'.$user.'/settings.inc');
	}
	if($_GET["site"] == "articles")
	{
		$article = $_GET["value"];
		$value = 'articleTemplate';
	}
	else
		$value = $_GET["value"];

	function PrintNavElement_href($printValue, $href)
	{
		LI_Begin();
			A_Begin(array('href'=>$href));
				WriteLine($printValue);
			A_End();
		LI_End();
	}
	function PrintNavElement($key, $printValue, $appendUrl = NULL)
	{
		global $site, $user, $page, $value;
		{
			$url = "http://art.whocaresarts.com".$appendUrl;
			if ($site == "user")
				$url = "http://user.whocaresarts.com".$appendUrl. "/" . $user;
			else
				$url = $url . "/" . $site;
			$url = $url . "/" . $key;
			//if (!empty($value) && $value !== NULL)
			//	$url = $url . "/" . $value;
			LI_Begin();
				A_Begin(array('href'=>$url));
					WriteLine($printValue);
				A_End();
			LI_End();
		}
	}
	function PrintNavElement_Home($key, $printValue)
	{
		global $site, $user, $page, $value;
		{
			$url = "http://art.whocaresarts.com";
			if (!empty($key) && $key !== NULL)
				$url = $url . "/" . $key;
			LI_Begin();
				A_Begin(array('href'=>$url));
					WriteLine($printValue);
				A_End();
			LI_End();
		}
	}
	function GetPage()
	{
		$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
			$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80")
		{
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		}
		else
		{
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
	// Alert( { alert-success, alert-info, alert-warning, alert-danger }, 'alert-dismissible', ...)
	function Alert($alertType, $alertDismissible, $heading, $message)
	{
		DIV_Begin(array('class'=>'no-margins alert '.$alertType." ".$alertDismissible, 'role'=>'alert'));
			if(!empty($alertDismissible))
			{
				BUTTON_Begin(array('class'=>'close', 'type'=>'button'), 'data-dismiss="alert" aria-label="Close"');
					SPAN_Begin(array(), 'aria-hidden="true"');
						WriteLine('&times;');
					SPAN_End();
				BUTTON_End();
			}
			STRONG_Begin();
				WriteLine($heading);
			STRONG_End();
			WriteLine($message);
		DIV_End();
	}
?>