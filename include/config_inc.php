<?php
/* set the cache limiter to 'private' */
#ini_set('display_errors', 'On');
#error_reporting(E_ALL);
ini_set('display_errors', '0');
header("X-FRAME-OPTIONS: DENY");
session_cache_limiter('private,must-revalidate');
$cache_limiter = session_cache_limiter();

/* set the cache expire to 30 minutes */
#session_cache_expire(30);
#$cache_expire = session_cache_expire();

/* start the session */

session_start();
$old_session_id = session_id();
session_regenerate_id();
$new_session_id = session_id();

header( 'Cache-Control: no-cache, must-revalidate, post-check=3600, pre-check=3600' );

#mysql
require ('mysql_connect.php');

#Functions
require ('functions_inc.php');

#Pages Function
require ('pages/functions/functions_inc_pages.php');

#Read More Functions
require ('pages/functions/functions_inc_pages_read_more.php');

#izsauc edit funkcijas
require ('process/functions/functions_process_edit.php');

#langues locales core engine
require ('languages/language_core.php');

#aizsargs darbojas ka rewrite alternativa
require_once ('library/guardian.php');

#input filter
require_once ('security/modules/inputfilter/class.inputfilter_clean.php');

$tags = array('!doctype','a','abbr','acronym','address','applet','area','b','base','basefont','bdo','big','blockquote','body','br','button','caption','center','cite','code','col','colgroup','dd','del','dfn','dir','div','dl','dt','em','fieldset','font','form','frame','frameset','h1','h2','h3','h4','h5','h6','head','hr','html','i','iframe','img','input','ins','isindex','kbd','label','legend','li','link','map','menu','meta','noframes','noscript','object','ol','optgroup','option','p','param','pre','q','s','samp','script','select','small','span','strike','strong','style','sub','sup','table','tbody','td','textarea','tfoot','th','thead','title','tr','tt','u','ul','var','print', 'perl', 'post','bgsound','embed','id','ilayer','name','xml');
$attr = array('action', 'background', 'codebase', 'dynsrc', 'lowsrc','href' ,'src' ,'alt');
$tag_method = 1;
$attr_method = 1;
$xss_auto = 1;

// more info on parameters in documentation.
$myFilter = new InputFilter ($tags, $attr ,$tag_method, $attr_method, $xss_auto);
//Input filter End

#bbcode parser
require_once("include/modules/nbbc/nbbc.php");

#filter input htmLawed
require_once 'security/modules/htmLawed/htmLawed.php';

#header ('Content-type: text/html; charset=utf-8');
#setlocale ( LC_CTYPE, 'C' );
mysqlutf8();

total_news_comments_updater();
total_blog_comments_updater();
total_forum_comments_updater();
total_download_comments_updater();
#most_online_updater();

// Ierobezo Cik Zinu tiks paradits galvenaja lapa
$news_limit = 4;

//Koment�ru Limits katr� lap�
$comment_limit = 10;

//Parsuta uz citam lapam ka drosibas risinajums
$redirect = ("<meta http-equiv='REFRESH' content='0;url=/?section=news'>");

//User ip
$ip = $_SERVER['REMOTE_ADDR'];

//Pedejo Reizi Manits gads,mesis,datums un laiks
$last_time_seen = date("Y.m.d H:i:s");

//Datums Gads,Menesis,datums
$date = date("Y-m-d");

#Datums datums,menesis,gads
$date_comment = date("d/m/Y");

#Laiks,Minutes,sekundes
$time_comment = date("H:i:s");

//Laiks Stundas,minutes,sekundes
$time = date("H:i:s");

#refferalis dabun info kur lietotajs bija
$refering_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
$URL = $_SERVER['QUERY_STRING'];
$URI = $_SERVER['REQUEST_URI'];

if (isset($_GET['logout']))
{
	if ($_GET['logout'] == "yes") 
	{
		online_status_set_off();
		session_unset();
		session_destroy();
		unset($_SESSION);
		echo $redirect;
	}
}

if(isset($_POST['login']))
{
	#$user = $_POST['name'];			
  	$user = mysql_real_escape_string($_POST['name']);
	$user = htmlentities($_POST['name']);
	$user = trim($_POST['name']);
	$user = stripslashes($_POST['name']);
	$user = addslashes($_POST['name']);
	$user = $myFilter->process($_POST["name"]);

	#$pass = $_POST['pass'];
	$pass = mysql_real_escape_string($_POST['pass']);
	$pass = htmlentities($_POST['pass']);
	$pass = trim($_POST['pass']);
	$pass = stripslashes($_POST['pass']);
	$pass = addslashes($_POST['pass']);
	#upgrade bcrypt hash test
	$salt = generateSalt($_POST['name']);
	$pass = generateHash($salt, $_POST['pass']);
	
	$password_check_query = mysql_query("SELECT hosting_user_name,hosting_user_password FROM hosting_user WHERE hosting_user_name = '{$user}' ");
	if (mysql_num_rows($password_check_query) != 0)
	{
		$password_check = mysql_fetch_array($password_check_query);
		
		if ($pass == $password_check['hosting_user_password'])
		{
			$select_user = mysql_query("SELECT * FROM hosting_user where hosting_user_name = '{$user}' AND hosting_user_password = '{$pass}' limit 1 ") or die(mysql_error());
			if(count($select_user) == 1)
			{
				$login_data = mysql_fetch_array($select_user);
				$_SESSION['logged_in'] 				= true;
				$_SESSION['id']						= $login_data['hosting_user_id']; // User id
				$_SESSION['nick'] 					= $login_data['hosting_user_name']; //Lietotaj niks
				$_SESSION['permission'] 			= $login_data['hosting_user_rights']; // Lietotaja Limenis
				$_SESSION['system_administrator']	= $login_data['hosting_user_sysop_rights'];
				$_SESSION['administrator']			= $login_data['hosting_user_administrator_rights'];
				$_SESSION['moderator'] 				= $login_data['hosting_user_moderator_rights'];
				$_SESSION['email']					= $login_data['hosting_user_email']; // Lietotaja E-pasts
			}
		}
		else
		{
			$login_failed = true;
		}
	}
	else
	{
		$login_failed = true;
	}
}

if (isset($_SESSION['logged']))
{
	if ((time() - $_SESSION['logged'] - 60*30) > 0)
	{
		online_status_set_off();
		session_destroy();
		unset($_SESSION);
		echo $redirect;
	}
}
else
{
  $_SESSION['logged'] = time();
}
?>
