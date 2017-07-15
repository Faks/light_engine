<?php 
if ($_SESSION['logged_in']) 
{
	#online_users(); 
	echo "<br>";
	/*
	$select_top_poster = mysql_query("SELECT hosting_user_name,hosting_user_total_forum_comments FROM hosting_user WHERE hosting_user_total_forum_comments > 0 ORDER BY `hosting_user`.`hosting_user_total_forum_comments` DESC LIMIT 5") or die(mysql_error());
	while ($top_poster = mysql_fetch_array($select_top_poster))
	{
		echo "<a href='#'>".$top_poster['hosting_user_name']."</a> (".$top_poster['hosting_user_total_forum_comments'].") ";
	}
	
	$select_most_online = mysql_query("SELECT hosting_user_name,COUNT(hosting_user_id) FROM hosting_user WHERE hosting_user_online_status = 'yes' ") or die(mysql_error());
	while ($most_online = mysql_fetch_array($select_most_online)) 
	{
		$date = date("Y-m-d");
		
		$select_most_online_check = mysql_query("SELECT * FROM hosting_most_online") or die(mysql_error());
		while ($most_online_check = mysql_fetch_array($select_most_online_check)) 
		{
			if ($date == $most_online_check['hosting_most_online_stamp']) 
			{
				if ($most_online['COUNT(hosting_user_id)'] > $most_online_check['hosting_most_online_record']) 
				{
					mysql_query("UPDATE hosting_most_online SET hosting_most_online_record = '{$most_online['COUNT(hosting_user_id)']}' WHERE hosting_most_online_stamp = '{$date}' ") or die(mysql_error());
				}
				else
				{
					return;
				}
			}
			else
			{
				mysql_query("INSERT INTO hosting_most_online (hosting_most_online_stamp,hosting_most_online_record) VALUES (".$date.",".$most_online['COUNT(hosting_user_id)'].") WHERE hosting_most_online_stamp = '".$date."' ") or die(mysql_error());	
			}
		}
	}
	
	*/
	/*
	$date = date("Y-m-d");
	$select_forum_visited_today = mysql_query("SELECT * FROM hosting_forum_visited_today WHERE hosting_forum_visited_today_date = '{$date}' ") or die(mysql_error());
	if (mysql_num_rows($select_forum_visited_today) != 0)
	{
		while ($forum_visited_today = mysql_fetch_array($select_forum_visited_today))
		{
			if ($date == $forum_visited_today['hosting_forum_visited_today_date'])
			{
				#echo "<a href='#'><span style='color:gold'>".$forum_visited_today['hosting_forum_visited_today_name']."</span></a>";
				if ($_SESSION['nick'] == $forum_visited_today['hosting_forum_visited_today_name']) 
				{
					echo "<a href='#'><span style='color:gold'>".$forum_visited_today['hosting_forum_visited_today_name']."</span></a>";
				}
				else
				{
					mysql_query("INSERT INTO hosting_forum_visited_today (hosting_forum_visited_today_name,hosting_forum_visited_today_date) VALUES ('{$_SESSION['nick']}','{$date}') LIMIT 1") or die(mysql_error());
						
				}
				
			}
			elseif ($date != $forum_visited_today['hosting_forum_visited_today_date'])
			{
				mysql_query("INSERT INTO hosting_forum_visited_today (hosting_forum_visited_today_name,hosting_forum_visited_today_date) VALUES ('{$_SESSION['nick']}','{$date}') ") or die(mysql_error());
			}
		}
	}
	else
	{
		mysql_query("INSERT INTO hosting_forum_visited_today (hosting_forum_visited_today_name,hosting_forum_visited_today_date) VALUES ('{$_SESSION['nick']}','{$date}') ") or die(mysql_error());
	}
	
	*/
}
else 
{
	echo "please login";
}
?>