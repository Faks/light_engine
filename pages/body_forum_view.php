<?php
if ($_SESSION['logged_in'])
{
	if ($_SESSION['permission'] >= 2 )
	{
		if ($id = ((isset($_GET['id'])) && (ctype_digit($_GET['id'])) ? (int)$_GET['id'] : ''))		
		{
			true;
		}
		else 
		{
			echo $redirect.false;
		}
	
		$submit_select_check = mysql_query("SELECT MIN(hosting_forum_id),MAX(hosting_forum_id) FROM hosting_forum WHERE hosting_forum_id  = '$id'");
		while ($submit_validation_check = mysql_fetch_array($submit_select_check))
		{
			if ($submit_validation_check['MAX(hosting_forum_id)'] == $id)
			{
				echo "<div class='thread'>{$lang['BODY_FORUM_TITLE']}: <a href='/?section=forumthreadsubmit&id=".$id."'>{$lang['BODY_FORUM_THREAD_CREATE']}</a></div><br>";
				$forum_view_select = mysql_query("SELECT * FROM hosting_forum_thread WHERE hosting_forum_id = '$id' ORDER BY hosting_forum_thread_id ASC  ")or die (mysql_error());
		if (mysql_num_rows($forum_view_select) != 0)
		{
			while ($forum_view = mysql_fetch_array($forum_view_select))
			{
			$coment_count_select = mysql_query("SELECT COUNT(hosting_comment_forum_thread_id) FROM hosting_comment WHERE hosting_comment_forum_thread_id = '{$forum_view['hosting_forum_thread_id']}' ")or die (mysql_error());
			echo "<table width='900' border='1' align='center' cellpadding='0' cellspacing='0'>";
			
			while($count_comment = mysql_fetch_array($coment_count_select))
			{
				if ($forum_view_select['hosting_forum_thread_id'] == $count_comment['hosting_comment_forum_thread_id'])
				{
				echo "<tr><td width='30'>".$forum_view['hosting_forum_thread_icon']."</td>".
	   			"<td width='355'><a href='/?section=forumthreadview&id=".$forum_view['hosting_forum_thread_id']."'>".$forum_view[hosting_forum_thread_title]."</a><br>{$lang['BODY_FORUM_THREAD_BY']} <a href='/?section=viewprofile&name={$forum_view['hosting_forum_thread_author']}'>{$forum_view['hosting_forum_thread_author']}</a></td>".
	   			"<td width='250'>{$lang['BODY_FORUM_THREAD_STARTED']}<br>".$forum_view['hosting_forum_thread_date']."</td>".
	  		 	 "<td width='250'>{$lang['BODY_FORUM_THREAD_TOTAL_COMMENTS']}: {$count_comment['COUNT(hosting_comment_forum_thread_id)']}</td></tr>";
				}
				else
				{
					echo $lang['BODY_FORUM_THREAD_BUG'];
				}
	  		 
			}
			echo  "</table><br>";
			}
		}
		else 
		{
			echo "<div class='thread'>{$lang['BODY_FORUM_THREAD_NOT_YET_PUBLISHED']}</div>";
			
		}
			}
			else
			{
				echo $redirect;
			}
		}	
	}
}
else 
{
	echo $redirect;
}
?>