<?php
if ($_SESSION['logged_in'])
{
	if ($_SESSION['permission'] >= 2)
	{
		echo "<div align='center' class='thread'>{$lang['BODY_FORUM_TITLE']}</div><br>";
		  	$forum_name = mysql_query("SELECT * FROM hosting_forum_group WHERE hosting_forum_group_show = '1'  ") or die (mysql_error());
		  	if (mysql_num_rows($forum_name) > 0)
		  	{
		        while ($forum_group_name = mysql_fetch_array($forum_name))
				{
					echo "<table width='900' border='1' align='center' cellpadding='0' cellspacing='0'>"; 
					echo "<tr><td colspan='6' style='padding: 7px;color:red'>".$forum_group_name['hosting_forum_group_name']."</td></tr>";
					$forum_select = mysql_query("SELECT * FROM hosting_forum WHERE hosting_forum_group_id = '".$forum_group_name['hosting_forum_group_id']."' ") or die (mysql_error());
					while ($forum_show = mysql_fetch_array($forum_select))
					{
						if (mysql_num_rows($forum_select) > 0)
						{
			            	if ($forum_group_name['hosting_forum_group_id'] == $forum_show['hosting_forum_group_id']) 
			            	{
			            		echo "<tr><td style='white-space: nowrap;' align='center' width='1%'>".$forum_show['hosting_forum_icon']."</td>".
			            		 "<td>"."<a href='/?section=forumview&id=".$forum_show['hosting_forum_id']." '>".$forum_show['hosting_forum_title']."</a><br />".$forum_show['hosting_forum_description']."</td>";
								$topic_count_select = mysql_query("SELECT COUNT(hosting_forum_thread_id) FROM hosting_forum_thread WHERE hosting_forum_id = '".$forum_show['hosting_forum_id']."' ") or die (mysql_error());
			            		while ($topic_count = mysql_fetch_array($topic_count_select))
								echo "<td width='230'>{$lang['BODY_FORUM_TOTAL_TOPICS']}: {$topic_count['COUNT(hosting_forum_thread_id)']}</td></tr>";
			            	}
						}
						else 
						{
							echo $lang['BODY_FORUM_NO_THREAD'];
						}
					}
					echo "</table>&nbsp;";
				}
		  	}
		  	else
		  	{
		  		echo "<div align='center' class='thread'>{$lang['BODY_FORUM_NO_FORUM']}</div>";
		  	}
	}
}
else 
{
	echo $lang['BODY_FORUM_MEMMBERS_ONLY'] ;
}
?>