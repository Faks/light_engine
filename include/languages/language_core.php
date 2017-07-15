<?php
header('Cache-control: private'); // IE 6 FIX

if (isset($_GET['lang'])) 
{
	$lang = $_GET['lang'];
	$_SESSION['lang'] = $lang;
	setcookie("lang",$lang,time() + (3600 * 24 * 30));
}
elseif (isset($_SESSION['lang']))
{
	$lang = $_SESSION['lang'];
}
elseif (isset($_COOKIE['lang']))
{
	$lang = $_COOKIE['lang'];
}
else
{
	$lang = 'eng';
}

switch ($lang) 
{
	case 'eng':
	$lang_file = 'lang_eng.php';
	break;
	
	case 'lv':
	$lang_file = 'lang_lv.php';
	break;
	
	case 'ru';
	$lang_file = 'lang_ru.php';
	break;
	
	default:
	$lang_file = 'lang_eng.php';
	break;
}

include_once 'locales/'.$lang_file;
?>