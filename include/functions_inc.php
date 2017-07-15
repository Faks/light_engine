<?php
function generateSalt($username) 
{
	$salt = '$2a$13$';
	$salt = $salt . hash('sha512', strtolower($username));;
	return $salt;
}

function generateHash($salt, $password) 
{
	$hash = crypt($password, $salt);
	$hash = substr($hash, 29);
	return $hash;
}

//Majas lapas generacijas laika kalkulators
function pagetimingcalculator()
{
	$timer = round(microtime(),3);
	return ($timer);
}

function mysqlutf8()
{
	mysql_query("SET NAMES UTF8");
	return;
}

//skaita cik lietotajs izmanto mysql datubazes
function check_mysqldb_limit()
{
	$check_mysql = mysql_query("SELECT COUNT(user) FROM mysql.db WHERE user = '{$_SESSION['nick']}' ") or die (mysql_error());
	while ($mysql_check = mysql_fetch_array($check_mysql))
	{
		echo $mysql_check['COUNT(user)'];
	}
	return $mysql_check;
}

//skaita cik ir mysql lietotaji
function check_mysqluser_limit($mysql_check_user_limit) 
{
	$check_mysql_user_limit = mysql_query("SELECT COUNT(User) FROM mysql.user WHERE User = '{$_SESSION['nick']}' ") or die (mysql_error());
	while ($mysql_check_user_limit = mysql_fetch_array($check_mysql_user_limit)) 
	{
		echo $mysql_check_user_limit['COUNT(User)'];
	}
	return $mysql_check_user_limit;
}

//parbauda cik lietotajam ir domeni izmantoti
function check_domain_limit()
{
	$check_domain = mysql_query("SELECT COUNT(hosting_domain_owner) FROM hosting_domain WHERE hosting_domain_owner = '{$_SESSION['nick']}' ") or die (mysql_error());
	while ($domain_check = mysql_fetch_array($check_domain))
	{
		echo $domain_check['COUNT(hosting_domain_owner)'];
	}
	return $domain_check;
}

//Parbauda Cik ir ftp lietotaji un ierobezo
function check_ftp_user_limit() 
{
	$count_ftp_user = mysql_query("SELECT COUNT(ftpd_owner) FROM hosting.hosting_ftpd WHERE ftpd_owner = '{$_SESSION['nick']}' ") or die (mysql_error());
	while($ftp_user_check = mysql_fetch_array($count_ftp_user))
	{
		echo $ftp_user_check['COUNT(ftpd_owner)'];
	}
	return $ftp_user_check;
}

//Parbaude cik daudz ir vestulu
function check_inbox_pm_limit() 
{
	$count_inbox_pm = mysql_query("SELECT COUNT(hosting_pm_receiver) FROM hosting_pm WHERE hosting_pm_receiver = '".$_SESSION['nick']."' ");
	while ($inbox_pm_check = mysql_fetch_array($count_inbox_pm))
	{
		echo $inbox_pm_check['COUNT(hosting_pm_receiver)'];
	}
	return $inbox_pm_check;
}

//Parbaude cik daudz ir izsutitas vestules
function check_outbox_pm_limit() 
{
	$count_outbox_pm = mysql_query("SELECT COUNT(hosting_pm_outbox_author) FROM hosting_pm_outbox WHERE hosting_pm_outbox_author = '".$_SESSION['nick']."' ");
	while ($outbox_pm_check = mysql_fetch_array($count_outbox_pm))
	{
		echo $outbox_pm_check['COUNT(hosting_pm_outbox_author)'];
	}
	return $outbox_pm_check;
}

//izvada hostinga sakuma datumu un beigu
function check_hosting_plan_dates() 
{
	$hosting_dates_cheker = mysql_query("SELECT * FROM hosting.hosting_user WHERE hosting_user_name = '{$_SESSION['nick']}' ") or die (mysql_error());
	while ($cheker_hosting_dates = mysql_fetch_array($hosting_dates_cheker))
	{
		echo $cheker_hosting_dates['hosting_user_hosting_plan_start']."|".$cheker_hosting_dates['hosting_user_hosting_plan_end'];
	}
	return $cheker_hosting_dates;
}

//hostinga planu datumu beigu termiòa liedz pieeju uz userpaneli,ftp,domain un driz ari uz mysql
function check_hosting_plan_expire() 
{
	//Datums Gads,Menesis,datums
	$date = date("Y-m-d");
	
	$check_hosting_plan = mysql_query("SELECT * FROM hosting_user WHERE hosting_user_name = '{$_SESSION['nick']}' ");
	while ($hosting_plan_check = mysql_fetch_array($check_hosting_plan))
	
	if ($hosting_plan_check['hosting_user_hosting_plan_start'] != $hosting_plan_check['hosting_user_hosting_plan_end'])
	{
		$hosting_date_update = "UPDATE hosting_user SET hosting_user_hosting_plan_start = '".$date."' WHERE hosting_user_name = '{$_SESSION['nick']}' ";	
		mysql_query($hosting_date_update) or die (mysql_error());
	}
	elseif ($hosting_plan_check['hosting_user_hosting_plan_start'] == $hosting_plan_check['hosting_user_hosting_plan_end'])
	{
		//Atsledz domenus
		$hosting_domain_off = "UPDATE hosting_domain SET hosting_domain_status = '1' WHERE hosting_domain_owner = '{$_SESSION['nick']}' ";
		mysql_query($hosting_domain_off) or die (mysql_error());
		
		//Atsledz FTP
		$hosting_ftp_off = "UPDATE hosting_ftpd SET status = '0' WHERE ftpd_owner = '{$_SESSION['nick']}' ";
		mysql_query($hosting_ftp_off) or die (mysql_error());
		
		//Atsledz Hostinga Paneli
		$hosting_user_panel_off = "UPDATE hosting_user SET hosting_permission_for_status = '0',hosting_user_fee_transfer = '0' WHERE hosting_user_name = '{$_SESSION['nick']}' ";
		mysql_query($hosting_user_panel_off) or die (mysql_error());
	}
	elseif ($hosting_plan_check['hosting_user_hosting_plan_end'] != $hosting_plan_check['hosting_user_hosting_plan_start'])
	{
		//Atsledz domenus
		$hosting_domain_off = "UPDATE hosting_domain SET hosting_domain_status = '1' WHERE hosting_domain_owner = '{$_SESSION['nick']}' ";
		mysql_query($hosting_domain_off) or die (mysql_error());
		
		//Atsledz FTP
		$hosting_ftp_off = "UPDATE hosting_ftpd SET status = '0' WHERE ftpd_owner = '{$_SESSION['nick']}' ";
		mysql_query($hosting_ftp_off) or die (mysql_error());
		
		//Atsledz Hostinga Paneli
		$hosting_user_panel_off = "UPDATE hosting_user SET hosting_permission_for_status = '0',hosting_user_fee_transfer = '0' WHERE hosting_user_name = '{$_SESSION['nick']}' ";
		mysql_query($hosting_user_panel_off) or die (mysql_error());
	}
	
	return;
}

//Parbauda Cik palidzibas biletes ir pieejamas katrai grupai | How Many Tickets Avaible for each group
function check_ticket_limit()
{
	//Parasts Lietotajs
	if ($_SESSION['permission'] == 2 AND $_SESSION['hosting'] == 1)
	{
		echo "5";
	}
	//Super Administrators
	elseif ($_SESSION['permission'] == 6 AND $_SESSION['hosting'] == 1 AND $_SESSION['admin'] == 1)
	{
		echo "~";
	}
	return;		
}

//Parbauda Cik Domenu ir pieejami katrai lietotaja grupai
function check_domain_name_limit()
{
	$select_hosting_plan = mysql_query("SELECT * FROM hosting_user WHERE hosting_user_name = '".$_SESSION['nick']."' ");
	$hosting_plan = mysql_fetch_array($select_hosting_plan);
	{
		//Parasts Lietotajs
		if ($_SESSION['permission'] >= 2 && $_SESSION['hosting'] == 1 && $hosting_plan['hosting_user_hosting_plan'] == 1)
		{
			echo '2';
		}
		elseif ($_SESSION['permission'] >= 2 && $_SESSION['hosting'] == 1 && $hosting_plan['hosting_user_hosting_plan'] == 2)
		{
			echo '5';
		}
		elseif ($_SESSION['permission'] >= 2 && $_SESSION['hosting'] == 1 && $hosting_plan['hosting_user_hosting_plan'] == 3) 
		{
			echo '10';
		}
		elseif ($_SESSION['permission'] >= 2 && $_SESSION['hosting'] == 1 && $hosting_plan['hosting_user_hosting_plan'] == 4) 
		{
			echo '15';
		}
		elseif ($_SESSION['permission'] >= 2 && $_SESSION['hosting'] == 1 && $hosting_plan['hosting_user_hosting_plan'] == 5) 
		{
			echo '20';
		}
		elseif ($_SESSION['permission'] >= 2 && $_SESSION['hosting'] == 1 && $hosting_plan['hosting_user_hosting_plan'] == 6) 
		{
			echo '~';
		}
	}
	return;
}

//Parbauda cik ir pieejami ftp lietotaji katrai lietotaja grupai
function check_ftp_limit() 
{
	//Parasts Lietotajs
	if ($_SESSION['permission'] == 2 AND $_SESSION['hosting'] == 1 )
	{
		echo "1";
	}
	//Super Administrators
	elseif ($_SESSION['permission'] == 6 AND $_SESSION['hosting'] == 1 AND $_SESSION['admin'] == 1)
	{
		echo "~";
	}
	return;
}

//Parbauda cik ir pieejamas datubazes mysql katrai lietotaja grupai
function check_mysql_database_limit() 
{
	$select_hosting_plan = mysql_query("SELECT * FROM hosting_user WHERE hosting_user_name = '".$_SESSION['nick']."' ");
	$hosting_plan = mysql_fetch_array($select_hosting_plan);
	{
		//Parasts Lietotajs
		if ($_SESSION['permission'] >= 2 && $_SESSION['hosting'] == 1 && $hosting_plan['hosting_user_hosting_plan'] == 1)
		{
			echo '1';
		}
		elseif ($_SESSION['permission'] >= 2 && $_SESSION['hosting'] == 1 && $hosting_plan['hosting_user_hosting_plan'] == 2) 
		{
			echo '2';
		}
		elseif ($_SESSION['permission'] >= 2 && $_SESSION['hosting'] == 1 && $hosting_plan['hosting_user_hosting_plan'] == 3) 
		{
			echo '5';
		}
		elseif ($_SESSION['permission'] >= 2 && $_SESSION['hosting'] == 1 && $hosting_plan['hosting_user_hosting_plan'] == 4) 
		{
			echo '8';
		}
		elseif ($_SESSION['permission'] >= 2 && $_SESSION['hosting'] == 1 && $hosting_plan['hosting_user_hosting_plan'] == 5) 
		{
			echo '10';
		}
		elseif ($_SESSION['permission'] >= 2 && $_SESSION['hosting'] == 1 && $hosting_plan['hosting_user_hosting_plan'] == 6) 
		{
			echo '~';
		}
	}
	return;
}

//Parbauda cik ir pieejami lietotaji uz mysql
function check_mysql_user_limit() 
{
	//Parasts Lietotajs
	if ($_SESSION['permission'] == 2 && $_SESSION['hosting'] == 1)
	{
		echo "1";
	}
	//Super Administrators
	elseif ($_SESSION['permission'] == 6 && $_SESSION['hosting'] == 1 && $_SESSION['admin'] == 1)
	{
		echo "~";
	}
	return;
}

//Parbauda cik ir pieejamas pavisam vestules
function check_inbox_limit() 
{
	//Parasts Lietotajs
	if ($_SESSION['permission'] == 2)
	{
		echo "15";
	}
	//Super Administrators
	elseif ($_SESSION['permission'] == 6 AND $_SESSION['admin'] == 1)
	{
		echo "~";
	}
	return;
}

function check_outbox_limit() 
{
	//Parasts Lietotajs
	if ($_SESSION['permission'] == 2)
	{
		echo "15";
	}
	//Super Administrators
	elseif ($_SESSION['permission'] == 6 AND $_SESSION['admin'] == 1)
	{
		echo "~";
	}
	return;
}

function online_status_set_on() 
{
	mysql_query("UPDATE hosting_user SET hosting_user_online_status = 'yes' WHERE hosting_user_online_status = 'no' AND hosting_user_name = '".$_SESSION['nick']."' ") or die(mysql_error());
	return;
}

function online_status_set_off() 
{
	mysql_query("UPDATE hosting_user SET hosting_user_online_status = 'no' WHERE hosting_user_online_status = 'yes' AND hosting_user_name = '".$_SESSION['nick']."' ") or die(mysql_error());
	return;
}

function online_users() 
{
	$select_online_status = mysql_query("SELECT * FROM  hosting_user WHERE hosting_user_online_status = 'yes' AND hosting_user_rights = '6' ") or die(mysql_error());
	if (mysql_numrows($select_online_status) > 0) 
	{
		echo "<br><span style='color:green'>Online Users:</span> ";
		while ($online_users = mysql_fetch_array($select_online_status))
		{
			echo "<a href='/?section=viewprofile&name={$online_users['hosting_user_name']}'><span style='color:red'>{$online_users['hosting_user_name']}</span></a> ";
		}
	}
	else
	{
		echo "<span style='color:gray'>Nobody is Online</span>";
	}
		return;
}

function online_guests() 
{
	  //Guest Online
	#$db_host = "localhost";
	#$db_user = "Faks"; 
	#$db_pass = "hakerx80";
	#$db_name = "hosting";
	#$dbc = mysql_connect($db_host, $db_user, $db_pass);
	#$dbs = mysql_select_db($db_name);
	$tm = time();
	$timeout = $tm - (300);  //300 is 5 mins
	if($_SERVER["REMOTE_ADDR"])
	{$ip=$_SERVER["REMOTE_ADDR"];}
 	else
	{$ip=$_SERVER["HTTP_X_FORWARDED_FOR"];}
	$brws = explode("(",$_SERVER["HTTP_USER_AGENT"]);
	$browser = $brws[0];
	 mysql_query("INSERT INTO guest SET  time='".$tm."', ip='".$ip."', browser='".$browser."'");
	$delete = mysql_db_query("DELETE FROM guest WHERE time<$timeout"); 
	
	if($delete) 
	{ 
		print "Guests Cleared"; 
	} 
	
	$count = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM guest"));
	#mysql_close();
	echo "<br/><a href='#'><b>Total Guest Online In Last 5 mins:</b> $count[0]</a><br/>";
	
	return;
}


function online_guests2() 
{
	$ip = $_SERVER['REMOTE_ADDR'];
	for ($i > 0; $i < count($ip); $i++) 
	{
		#echo $i;
	}
}

function bbcode_parser($text)
{
    #$text = trim(htmlentities($text));
    $text = trim($text);
    // BBCode to find...
    $in = array( 
                     '/\[b\](.*?)\[\/b\]/si',    
                     '/\[i\](.*?)\[\/i\]/si',
                     '/\[u\](.*?)\[\/u\]/si',
                     '#\[img\](https?://[-A-Z0-9+&@\#/%?=~_|!:,.;]*[-A-Z0-9+&@\#/%=~_|]\.(?:jpg|jpeg|gif|png|bmp))\[\/img\]#si',
                     '#\[email\]([-A-Z0-9+&@\#/%?=~_|!:,.;]*[-A-Z0-9+&@\#/%=~_|])\[\/email\]#si',
                     '#\[url\=((?:ftp|https?)://[-A-Z0-9+&@\#/%?=~_|!:,.;]*[-A-Z0-9+&@\#/%=~_|])\](.*?)\[\/url\]#si',
                     '/\[size\="?(.*?)"?\](.*?)\[\/size\]/si',
                     '/\[color\="?(.*?)"?\](.*?)\[\/color\]/si',
                     '/\[list\=(.*?)\](.*?)\[\/list\]/si',
                     '/\[list\](.*?)\[\/list\]/si',
                     '/\[\*\]\s?(.*?)\n/si',
    				 '/\[ol\=(.*?)\](.*?)\[\/ol\]/si',
    				 '/\[ul](.*?)\[\/ul\]/si',
				     '/\[li](.*?)\[\/li\]/si',
                     '/\[align\=(left|center|right)\](.*?)\[\/align\]/is'         
    );
    // And replace them by...
    $out = array(
                     '<strong>\1</strong>',
                     '<em>\1</em>',
                     '<u>\1</u>',
                     '<img src="\1" alt="\1" />',
                     '<a href="mailto:\1">\1</a>',
                     '<a href="\1">\2</a>',
                     '<span style="font-size:\1%">\2</span>',
                     '<span style="color:\1">\2</span>',
                     '<ol start="\1">\2</ol>',
                     '<ul>\1</ul>',
                     '<li>\1</li>',
    				 '<div style="text-align: $1;">$2</div>'
    );
    return preg_replace($in, $out, $text);
}

function strip_script($string)
{
	$reason = "Tried Hack Website";
	$type = '';
	 			
	// Prevent inline scripting
	$string = preg_replace("/<script[^>]*>.*<*script[^>]*>/i", "$type", $string);

	$string = preg_replace("/<script[^>]*>.*?< *script[^>]*>/i", "$type", $string);
	// Prevent linking to source files
	$string = preg_replace("/<script[^>]*>/i", "$type", $string);
			
	//styles
	$string = preg_replace("/<style[^>]*>.*<*style[^>]*>/i", "$type", $string);
	// Prevent linking to source files
	$string = preg_replace("/<style[^>]*>/i", "$type", $string);
			    
		if (strlen($type) == 0) 
		{
			mysql_query("UPDATE hosting_user SET hosting_user_warnings = '".$reason."' WHERE hosting_user_name = '".$_SESSION['nick']."' ");
		}
	    
	return $string;
}

			function bbcode($content)
			{
				$content = htmlspecialchars($content);
				
				$content = preg_replace("~\[b\](.+?)\[\/b\]~i", "<b>$1</b>", $content);
				$content = preg_replace("~\[i\](.+?)\[\/i\]~i", "<i>$1</i>", $content);
				$content = preg_replace("~\[u\](.+?)\[\/u\]~i", "<u>$1</u>", $content);
				$content = preg_replace("~\[img\](.+?)\[\/img\]~i", "<img src=\"$1\" alt=\"\" />", $content);
				$content = preg_replace("~\[url\](.+?)\[\/url\]~i", "<a href=\"$1\">[Link]</a>", $content);
				$content = preg_replace("~\[url=http://(.+?)\](.+?)\[\/url\]~i", "<a href=\"$1\">$2</a>", $content);
				$content = preg_replace( "#\[url\](?:http:\/\/)?(.+?)\[/url\]#is", "<a href=\"http://$1\">$2</a>", $content );
				$content = preg_replace("~\[code\](.+?)\[\/code\]~i", "<div class=\"box\">$1</div>", $content);
				return($content);
			}	
?>