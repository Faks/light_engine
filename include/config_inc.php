<?php
/*
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip'))
{
	ob_start("ob_gzhandler");
}
else
{
	ob_start();
}
*/
/* set the cache limiter to 'private' */
#ini_set('display_errors', 'On');
session_cache_limiter('private,must-revalidate');
$cache_limiter = session_cache_limiter();

/* set the cache expire to 30 minutes */
session_cache_expire(30);
$cache_expire = session_cache_expire();

/* start the session */

session_start();
$old_session_id = session_id();
session_regenerate_id();
$new_session_id = session_id();

header( 'Cache-Control: no-cache, must-revalidate, post-check=3600, pre-check=3600' );

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

#mysql
require ('mysql_connect.php');

#Functions
require ('functions_inc.php');

#langues locales core engine
require ('languages/language_core.php');

#require_once 'bbcode/stringparser_bbcode.class.php';

#Password Salt For Encryption Key
#$salt = "f5645afb4cbf993fc7fc71b12913a0cc127c1bd2592a16c2937a632f4e4f9b9d";

#header ('Content-type: text/html; charset=utf-8');
#setlocale ( LC_CTYPE, 'C' );
mysqlutf8();

//Parsuta uz citam lapam ka drosibas risinajums
$redirect = ("<meta http-equiv='REFRESH' content='0;url=/?section=news'>");

// Ierobezo Cik Zinu tiks paradits galvenaja lapa
$news_limit = 4;

//Koment�ru Limits katr� lap�
$comment_limit = 20;

//User ip 
$ip = $_SERVER['REMOTE_ADDR'];

//P�dejo Reizi Man�ts gads,m�nesis,datums un laiks
$last_time_seen = date("Y.m.d H:i:s");

//Datums Gads,Menesis,datums
$date = date("Y-m-d");

//Laiks Stundas,minutes,sekundes
$time = date("H:i:s");

//Hostinga Atsledzejs un mysql utf8
echo check_hosting_plan_expire();

if ($_GET[logout] == "yes")
{
	online_status_set_off();
	session_destroy();
	unset($_SESSION);
	echo $redirect;
}

if($_POST['login'] )
{
	$user = $_POST['name'];			
  	$user = mysql_real_escape_string($_POST['name']);
	$user = htmlentities($_POST['name']);
	$user = trim($_POST['name']);
	$user = stripslashes($_POST['name']);
	$user = addslashes($_POST['name']);

	$pass = $_POST['pass'];
	$pass = mysql_real_escape_string($_POST['pass']);
	$pass = htmlentities($_POST['pass']);
	$pass = trim($_POST['pass']);
	$pass = stripslashes($_POST['pass']);
	$pass = addslashes($_POST['pass']);
	#upgrade bcrypt hash test
	$salt = generateSalt($_POST['name']);
	$pass = generateHash($salt, $_POST['pass']);
	
	$password_check_query = mysql_query("SELECT hosting_user_name,hosting_user_password FROM hosting_user WHERE hosting_user_name = '{$_POST['name']}' ");
	if (mysql_num_rows($password_check_query) != 0)
	{
		$password_check = mysql_fetch_array($password_check_query);
	}
	else
	{
		return false;
	}
	
	if ($pass == $password_check['hosting_user_password'])
	{
		$select_user = sprintf('SELECT * FROM hosting_user where hosting_user_name = "%s" and hosting_user_password = "%s" limit 1',$user,$pass);
		$query = mysql_query($select_user) or die(mysql_error());
	  	
		if(mysql_num_rows($query) == 1)
		{
			$login_data = mysql_fetch_array($query);
			$_SESSION['logged_in'] 			= true;
			$_SESSION['id']					= $login_data['hosting_user_id']; // User id
			$_SESSION['nick'] 				= $login_data['hosting_user_name']; //Lietotaj niks
			$_SESSION['permission'] 		= $login_data['hosting_user_rights']; // Lietotaja Limenis
			$_SESSION['hosting']			= $login_data['hosting_permission_for_status'];  //Hostinga Atlauja
			$_SESSION['nullified']			= $login_data['hosting_user_delete_rights']; //Parbauda vai lietotajs var dzest sadalas
			$_SESSION['admin']				= $login_data['hosting_user_admin_rights'];
			$_SESSION['email']				= $login_data['hosting_user_email']; // Lietotaja E-pasts	
			$_SESSION['hostingplan'] 		= $login_data['hosting_user_hosting_plan']; //Lietotaja hostinga plans ja ir bijis pasutits tad atgriez vertibu
		}
	}
	else
	{
		$login_failed = true;
	}
}

 
if (isset($_SESSION['login']))
{
	if ((mktime() - $_SESSION['login'] - 60*30) > 0)
	{
		online_status_set_off();
		session_destroy();
		unset($_SESSION);
		echo $redirect;
	}
}
else
{
  $_SESSION['login'] = mktime();
}

//Hashing
/*
if ($_SESSION['permission'] == 6) 
{
	echo hash('sha512','e719cb94976ecd7e8ee79272692ff8b8 '.'f5645afb4cbf993fc7fc71b12913a0cc127c1bd2592a16c2937a632f4e4f9b9d');
}
*/
?>