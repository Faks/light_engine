<?php
//Ja rewrite nedarbojas atrisina to pasu
if (strstr($_SERVER['REQUEST_URI'],'index.php'))
{
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: /?section=news");
}

if (isset($_GET['PHPSESSID']))
{
	$requesturi = preg_replace('/?PHPSESSID=[^&]+/',"",$_SERVER['REQUEST_URI']);
	$requesturi = preg_replace('/&PHPSESSID=[^&]+/',"",$requesturi);
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: http://".$_SERVER['HTTP_HOST'].$requesturi);
	exit;
}

if (isset($_GET['login']))
{
	$requesturi = preg_replace('/?login=[^&]+/',"",$_SERVER['REQUEST_URI']);
	$requesturi = preg_replace('/&login=[^&]+/',"",$requesturi);
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: http://".$_SERVER['HTTP_HOST'].$requesturi);
	exit;
}

if (isset($_GET['logged_in']))
{
	$requesturi = preg_replace('/?logged_in=[^&]+/',"",$_SERVER['REQUEST_URI']);
	$requesturi = preg_replace('/&logged_in=[^&]+/',"",$requesturi);
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: http://".$_SERVER['HTTP_HOST'].$requesturi);
	exit;
}

if (isset($_GET['pages']))
{
	$requesturi = preg_replace('/pages/[^&]+/',"",$_SERVER['REQUEST_URI']);
	$requesturi = preg_replace('/pages/[^&]+/',"",$requesturi);
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: http://".$_SERVER['HTTP_HOST'].$requesturi);
	exit;
}

if (isset($_GET['HEAD']))
{
	$requesturi = preg_replace('/?HEAD=[^&]+/',"",$_SERVER['REQUEST_URI']);
	$requesturi = preg_replace('/&HEAD=[^&]+/',"",$requesturi);
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: http://".$_SERVER['HTTP_HOST'].$requesturi);
	exit;
}


if (isset($_GET['HTTP']))
{
	$requesturi = preg_replace('/?HTTP=[^&]+/',"",$_SERVER['REQUEST_URI']);
	$requesturi = preg_replace('/&HTTP=[^&]+/',"",$requesturi);
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: http://".$_SERVER['HTTP_HOST'].$requesturi);
	exit;
}

?>
