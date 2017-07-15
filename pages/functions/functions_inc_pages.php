<?php
function news($row,$news_limit,$row_news,$bbcode,$count_news_comment,$lang,$x) 
{
	$select = mysql_query("select * from hosting_maintenance");
	while($row = mysql_fetch_array($select))
	if($row[hosting_maintenance_status ] == "1" )
	{
		echo $row[hosting_maintenance_text];
	}
	else
	{
		$sql = "SELECT COUNT(*) FROM news";
		$result = mysql_query($sql);
		$r = mysql_fetch_row($result);
		$numrows = $r[0];

		// find out total pages
		$totalpages = ceil($numrows / $news_limit);

		if ((isset($_GET['page'])) && (ctype_digit($_GET['page'])))
		{
			$page = (int)$_GET['page'];
		}
		else
		{
			$page = 1;
		}
		// if current page is greater than total pages...
		if ($page > $totalpages) {
			// set current page to last page
			$page = $totalpages;
		} // end if
		// if current page is less than first page...
		if ($page < 1) {
			// set current page to first page
			$page = 1;
		} // end if
			
		// the offset of the list, based on current page
		$offset = ($page - 1) * $news_limit;

		$news = mysql_query("SELECT * FROM news ORDER BY id desc "."limit $offset, $news_limit") or die(mysql_error());
		if (mysql_num_rows($news) != 0)
		{
			while ($row_news = mysql_fetch_array($news))
			{
				$bbcode = new BBCode;
				echo "<div class='article clearfix'>
            	<div class='post_info'>
                	<ul>
						<li class='link'><span class='link'><a href='javascript: void(0)'>{$bbcode->Parse($row_news["date"])}<span>{$bbcode->Parse($row_news["time"])}</span></a></span></li>
                		<li class='label'>Posted By:</li>
                		<li class='link'><a href='/?section=viewprofile&name=".$bbcode->Parse($row_news["author"])."'>".$bbcode->Parse($row_news["author"])."</a></li>
                		<li class='label'>Category:</li>
                		<li class='link'><a href='#'>{$bbcode->Parse($row_news["category"])}</a></li>
                		<li class='label'>Comments:</li>
                		<li class='link'>";
						news_count_comments($count_news_comment,$row_news);
                		echo "</li>";
                		
                		
                		if ($_SESSION['logged_in']) 
                		{
                			if ($_SESSION["permission"] >= 4) 
                			{
                				#<li class='link'><a href='/?section=edit&id=".$id."&news=edit&comment_id=".$row_news_comment['id']."'>{$lang['BODY_EDIT']}</a>"."&nbsp;"."<a href='/?section=delete&id=".$id."&comment=news&id_delete=".$row_news_comment['id']."'>{$lang['BODY_DELETE']}</a></li>
                								  #  <a href='/?section=edit&id=".$row_news['id']."&news=edit&$news_id=".$row_news_comment['id']."'>
echo "<li class='label'>Manage</li><li class='link'><a href='/?section=edit&id=".$row_news['id']."&news=edit&news_id=".$row_news['id']."'>Edit</a>"."&nbsp;"."<a href='/?section=edit&name=".$bbcode->Parse($row_news["author"])."'>Delete</a></li>";
                			}
                		}
                				
                echo	"</ul>
                </div>
                <div class='main_post'>
                	<h1><a href='/?section=newsmore&id=".$row_news['id']."'>{$bbcode->Parse($row_news["title"])}</a></h1>
                    <a href='#' class='imga'>{$bbcode->Parse($row_news["image"])}</a>
                    
                    <p class='comment'>{$bbcode->Parse($row_news["text_short"])}</p>
                    <p class='read_more'><a href='/?section=newsmore&id=".$row_news['id']."'>Read More</a></p>
                    
                   
                </div>
            </div>";		
			}
		}
		else
		{
			echo  "<div class='pagination'>".$lang['BODY_NEWS_NOT_YET_PUBLISHED']."</div>";
		}
				/******  build the pagination links ******/
				// range of num links to show
				$range = 50;
				// loop to show links to range of pages around current page
				echo "<div class='pagination'><center>{$lang['BODY_PAGE_PAGINATION']}&nbsp;";
				for ($x = ($page - $range); $x < (($page + $range) + 1); $x++) {
				// if it's a valid page number...
					if (($x > 0) && ($x <= $totalpages)) {
					// if we're on current page...
					if ($x == $page) {
				// 'highlight' it but don't make a link
					echo "$x ";
				// if not current page...
				} else {
				// make it a link
				echo "<a href='/?section=news&page=$x'>$x</a>&nbsp;";
				} // end else
				} // end if
				} // end for
				echo "</center></div>";
				/****** end build pagination links ******/
	}	
	
}

function blog($row,$news_limit,$row_blog,$bbcode,$count_news_comment,$lang,$x) 
{
	$select = mysql_query("select * from hosting_maintenance");
	while($row = mysql_fetch_array($select))
	if($row[hosting_maintenance_status ] == "1" )
	{
		echo $row[hosting_maintenance_text];
	}
	else
	{
		$sql = "SELECT COUNT(*) FROM blog";
		$result = mysql_query($sql);
		$r = mysql_fetch_row($result);
		$numrows = $r[0];

		// find out total pages
		$totalpages = ceil($numrows / $news_limit);

		if ((isset($_GET['page'])) && (ctype_digit($_GET['page'])))
		{
			$page = (int)$_GET['page'];
		}
		else
		{
			$page = 1;
		}
		// if current page is greater than total pages...
		if ($page > $totalpages) {
			// set current page to last page
			$page = $totalpages;
		} // end if
		// if current page is less than first page...
		if ($page < 1) {
			// set current page to first page
			$page = 1;
		} // end if
			
		// the offset of the list, based on current page
		$offset = ($page - 1) * $news_limit;

		$blog = mysql_query("SELECT * FROM blog ORDER BY id desc "."limit $offset, $news_limit") or die(mysql_error());
		if (mysql_num_rows($blog) != 0)
		{
			while ($row_blog = mysql_fetch_array($blog))
			{
				$bbcode = new BBCode;
				echo "<div class='article clearfix'>
            	<div class='post_info'>
                	<ul>
						<li class='link'><span class='link'><a href='javascript: void(0)'>{$bbcode->Parse($row_blog["date"])}<span>{$bbcode->Parse($row_blog["time"])}</span></a></span></li>
                		<li class='label'>Posted By:</li>
                		<li class='link'><a href='/?section=viewprofile&name={$row_blog['author']}'>{$row_blog['author']}</a></li>
                		<li class='label'>Category:</li>
                		<li class='link'><a href='#'>{$bbcode->Parse($row_blog["category"])}</a></li>
                		<li class='label'>Comments:</li>
                		<li class='link'>";
						blog_count_comments($count_blog_comment,$row_blog);
                		echo "</li>
                	</ul>
                </div>
                <div class='main_post'>
                	<h1><a href='/?section=blogmore&id=".$row_blog['id']."'>{$bbcode->Parse($row_blog["title"])}</a></h1>
                    <a href='#' class='imga'>{$bbcode->Parse($row_blog["image"])}</a>   
                    <p class='comment'>{$bbcode->Parse($row_blog["text_short"])}
					</p>
                    <p class='read_more'><a href='/?section=blogmore&id=".$row_blog['id']."'>Read More</a></p>
                    
                   
                </div>
            </div>";		
			}
		}
		else
		{
			echo  "<div class='pagination'>".$lang['BODY_BLOG_COMMENT_COMMENTS_NOT_YET_DONE']."</div>";
		}
				/******  build the pagination links ******/
				// range of num links to show
				$range = 50;
				// loop to show links to range of pages around current page
				echo "<div class='pagination'><center>{$lang['BODY_PAGE_PAGINATION']}&nbsp;";
				for ($x = ($page - $range); $x < (($page + $range) + 1); $x++) {
				// if it's a valid page number...
					if (($x > 0) && ($x <= $totalpages)) {
					// if we're on current page...
					if ($x == $page) {
				// 'highlight' it but don't make a link
					echo "$x ";
				// if not current page...
				} else {
				// make it a link
				echo "<a href='/?section=blog&page=$x'>$x</a>&nbsp;";
				} // end else
				} // end if
				} // end for
				echo "</center></div>";
				/****** end build pagination links ******/
	}
}

function forum($forum_group_name,$forum_show,$topic_count,$lang,$date) 
{
	echo "<div class='download clearfix'>";
	
	$forum_name = mysql_query("SELECT * FROM forum_group WHERE group_show = 'yes' order by group_id ASC  ") or die (mysql_error());
	if (mysql_num_rows($forum_name) > 0)
	{
		while ($forum_group_name = mysql_fetch_array($forum_name))
		{
			echo "<div class='forum-bg'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='1' class='ftbl-border'>
  <tbody><tr>
<td colspan='6' class='forum-caption' style='padding:7px;'><div style='float:right'></div>".$forum_group_name['group_name']."</td>
		</tr>
<tr><td colspan='3' class='tbl2'>Forum</td>
<td class='tbl2' style='white-space:nowrap;width:33%;'>Last Post</td>
<td class='tbl2' style='white-space:nowrap' align='center' width='1%'>Threads</td>
<td class='tbl2' style='white-space:nowrap' align='center' width='1%'>Posts</td>
</tr>
		";
			$forum_select = mysql_query("SELECT * FROM forum WHERE group_id = '".$forum_group_name['group_id']."' ") or die (mysql_error());
			while ($forum_show = mysql_fetch_array($forum_select))
			{
				if (mysql_num_rows($forum_select) > 0)
				{
					if ($forum_group_name['group_id'] == $forum_show['group_id'])
					{
						echo "<tr>
		<td align='center' ></td><td class='tbl2' style='white-space:nowrap; padding:14px;' align='center' width='2%'><img src='images/forum/on.png' alt=''></td>
<td class='tbl1' style='padding:7px;'><a href='/?section=forummore&id={$forum_show['group_id']}' style='font-size:12px; text-decoration:underline; font-weight:bold;'>
		<!--forum_name_cell-->{$forum_show['title']}</a><br>
<span class='small'><strong>Moderated by: </strong>";
echo $forum_show['moderated_by'];
echo "</span>
<br><span class='small'>{$forum_show['description']}<br>";
if ($forum_show['sub_forums'] == "yes")
{
					$select_sub_forum = mysql_query("SELECT * FROM forum_group_sub WHERE group_id = '{$forum_show['group_id']}' ") or die(mysql_error());
					if (mysql_num_rows($select_sub_forum) != 0) 
					{
						echo "<img src='images/forum/folder_open.png' alt='' style='vertical-align:middle;'><span class='small' style='font-weight:bold;'>Subforums:</span><br><table style='padding-left:6px;' border='0' cellpadding='0' cellspacing='0' width='100%'>
							  <tbody><tr><td class='small' style='padding-left:3px; padding-right:3px; vertical-align:top;' width='50%'><img src='images/forum/subforum.png' alt='' style='vertical-align:middle;'> ";
						
						while ($sub_forum = mysql_fetch_array($select_sub_forum))
						{
							echo "<a href='/?section=forumsubmore&id={$sub_forum['group_id']}' class='small'>".$sub_forum['group_sub_title']."</a>";
						}
						
						echo "<br></td></tr></tbody></table>";
					}
					else
					{
						;
					}		
}
else
{
	;
}
					echo "</td>";
							echo "<td class='tbl2' style='white-space:nowrap; padding:5px;' nowrap='nowrap' width='1%'>";
							#No Posts

						$select_forum_thread = mysql_query("SELECT * FROM forum_thread WHERE forum_id = '{$forum_show['group_id']}' ") or die(mysql_error());
						if (mysql_num_rows($select_forum_thread) > 0)
						{
							while($forum_thread = mysql_fetch_array($select_forum_thread))
						
							$select_comment_forum = mysql_query("SELECT id_forum_topic,author,date,time FROM comment WHERE id_forum_topic = '".$forum_thread['id']."'  ORDER BY `comment`.`id` DESC  ") or die(mysql_error());
							if (mysql_num_rows($select_comment_forum) != 0) 
							{
								while($comment_forum = mysql_fetch_array($select_comment_forum))
								{
									echo $comment_forum['author']."<br>".$comment_forum['date']." : ".$comment_forum['time'];
								}
							}
							else
							{
								echo "No Post";
							}
						}
						else
						{
							echo "No Post";
						}
						
						$topic_count_select = mysql_query("SELECT COUNT(id) FROM forum_thread WHERE forum_id = '{$forum_show['group_id']}' ") or die (mysql_error());
						$topic_count = mysql_fetch_array($topic_count_select);
						
						
						$post_count_select = mysql_query("SELECT COUNT(id_forum_topic) FROM comment WHERE id_forum_topic = '".$forum_thread['id']."'  ") or die (mysql_error());
						$post_count = mysql_fetch_array($post_count_select);
						
							echo "</td>
<td class='tbl1' style='white-space:nowrap' align='center' width='1%'>{$topic_count['COUNT(id)']}</td>
<td class='tbl2' style='white-space:nowrap' align='center' width='1%'>";

							$select_forum_thread = mysql_query("SELECT * FROM forum_thread WHERE forum_id = '{$forum_show['group_id']}' ") or die(mysql_error());
							if (mysql_num_rows($select_forum_thread) > 0)
							{
								while($forum_thread = mysql_fetch_array($select_forum_thread))
							
								$select_comment_posts_forum = mysql_query("SELECT COUNT(id) FROM comment WHERE id_forum_topic = '".$forum_thread['id']."' ") or die(mysql_error());
								if (mysql_num_rows($select_comment_posts_forum) != 0)
								{
									while($comment_posts_forum = mysql_fetch_array($select_comment_posts_forum))
									{
										echo $comment_posts_forum['COUNT(id)'];
									}
								}
								else
								{
									echo "0";
								}
							}
							else
							{
								echo "0";
							}

echo "</td></tr>";
					}
				}
				else
				{
					echo $lang['BODY_FORUM_NO_THREAD'];
				}
			}
		}
	}
	else
	{
		echo "<div align='center' class='thread'>{$lang['BODY_FORUM_NO_FORUM']}</div>";
	}
	
	echo "</tbody></table></div></div>";
	
	echo "<table width='692' align='center' cellpadding='0' cellspacing='0'>
<tbody><tr>
<td class='forum'><br> <br>

</td></tr>
<tr>
<td class='forum' align='right' valign='bottom'>
<form name='searchform' method='get' action='#'>
<input name='stext' class='textbox' style='width:150px' type='text'>
<input name='search' value='Search' class='button' type='submit'>
</form>
</td>
</tr>
</tbody></table><br>";
	
	echo "<div class='forum-bg'><table width='692' align='center' cellpadding='0' cellspacing='1' class='tbl-border'>
	<tbody><tr>
		<td colspan='2' class='tbl2' style='font-weight:bold'> Who Is Online</td>
	</tr>
	<tr>
<td class='tbl2' rowspan='2' width='32'><img src='images/forum/users.png' alt=''></td>
		<td class='tbl1' style='padding:6px;'>";
	
	$select_online_status = mysql_query("SELECT * FROM  hosting_user WHERE hosting_user_online_status = 'yes' LIMIT 10 ") or die(mysql_error());
	if (mysql_numrows($select_online_status) > 0)
	{
		while ($online_users = mysql_fetch_array($select_online_status))
		{
			$group_check = mysql_query("SELECT hosting_user_name,hosting_user_sysop_rights,hosting_user_administrator_rights,hosting_user_moderator_rights,hosting_user_vip_rights,hosting_user_default_rights FROM hosting_user WHERE hosting_user_name = '".$online_users['hosting_user_name']."' ") or die (mysql_error());
			$group = mysql_fetch_array($group_check);
				
			if ($group['hosting_user_sysop_rights'] == "yes")
			{
				echo "<a href='#' style='color:#FC0' title='System Administrator'>".$group['hosting_user_name']."</a> ";
			}
	
			if ($group['hosting_user_administrator_rights'] == "yes")
			{
				echo "<a href='#' style='color:#900' title='Administrator'>".$group['hosting_user_name']."</a> ";
			}
	
			if ($group['hosting_user_moderator_rights'] == "yes")
			{
				echo "<a href='#' style='color: #3C0' title='Moderator'>".$group['hosting_user_name']."</a> ";
			}
	
			if ($group['hosting_user_vip_rights'] == "yes")
			{
				echo "<a href='#' style='color:#F90' title='VIP'>".$group['hosting_user_name']."</a> ";
			}
	
			if ($group['hosting_user_default_rights'] == "yes")
			{
				echo "<a href='#' style='color:#39F' title='Member'>".$group['hosting_user_name']."</a> ";
			}
		}
	}
	else
	{
		echo "<span style='color:gray'>No Members Online</span>";
	}
	
		echo "<br><br></td></tr>
<tr><td class='tbl1' style='padding:6px;'>Top Posters: "; 
		$select_top_poster = mysql_query("SELECT hosting_user_name,hosting_user_total_forum_comments FROM hosting_user WHERE hosting_user_total_forum_comments > 0 ORDER BY `hosting_user`.`hosting_user_total_forum_comments` DESC LIMIT 5") or die(mysql_error());
		while ($top_poster = mysql_fetch_array($select_top_poster))
		{
			echo "<a href='#'>".$top_poster['hosting_user_name']."</a> (".$top_poster['hosting_user_total_forum_comments'].") ";
		}
    echo "<tr>
		<td colspan='2' class='tbl2' style='font-weight:bold'><strong>Legend</strong>: <span style='color:#FC0'>System Administrator</span>,  <span style='color:#900'>Administrator</span>, <span style='color: #3C0'>Moderator</span>, <span style='color:#F90'>VIP</span>, <span style='color:#39F'>Member</span></td>
	</tr>
	</td>
	</tr>
<tr>
			
		</tr>
		
<tr>
		<td colspan='2' class='tbl2' style='font-weight:bold'>Board Statistics</td>
	</tr>
	<tr>
		<td width='32' height='106' class='tbl2'><img src='images/forum/stats.png' alt=''></td>
		<td class='tbl1' style='padding:6px;'>Our members have made a total of <b>";
    $select_forum_post_count = mysql_query("SELECT COUNT(id_forum_topic) FROM comment WHERE id_forum_topic") or die(mysql_error());
    while($forum_post_count = mysql_fetch_array($select_forum_post_count))
    {
    	echo $forum_post_count['COUNT(id_forum_topic)'];
    }
		echo "</b> posts and <b>";
		$select_forum_thread_count = mysql_query("SELECT COUNT(id) FROM forum_thread");
		while ($forum_thread_count = mysql_fetch_array($select_forum_thread_count)) 
		{
			echo $forum_thread_count['COUNT(id)'];
		}
		echo "</b> threads.<br>
A total of <b>0</b> scrolls have been earned.<br>
We have <b>";
$select_member_count = mysql_query("SELECT COUNT(hosting_user_id) FROM hosting_user") or die(mysql_error());
while ($member_count = mysql_fetch_array($select_member_count)) 
{
	echo $member_count['COUNT(hosting_user_id)'];
}
echo "</b> registered members.<br>
		";
		$select_newest_member = mysql_query("SELECT * FROM hosting_new_member ORDER BY `hosting_new_member`.`id` DESC LIMIT 1") or die(mysql_error()); 
		if (mysql_num_rows($select_newest_member) > 0) 
		{
			while ($newest_member = mysql_fetch_array($select_newest_member)) 
			{
				echo "Please welcome our newest member, <b>".$newest_member['hosting_new_member_name'];
			}
		}
		else
		{
			echo "Please sorry we have no new member today<b>";
		}
		echo "</b>!<br>
		Most users online was today <b>";
			$select_most_online_ever_check = mysql_query("SELECT * FROM hosting_most_online WHERE hosting_most_online_stamp = '{$date}' ") or die(mysql_error());
			 $most_online_ever = mysql_fetch_array($select_most_online_ever_check);
			 if (mysql_num_rows($select_most_online_ever_check) > 0)
			 {
			 	echo $most_online_ever['hosting_most_online_record'];
			 }
			 else
			 {
			 	$select_most_online = mysql_query("SELECT hosting_user_name,COUNT(hosting_user_id) FROM hosting_user WHERE hosting_user_online_status = 'yes' ") or die(mysql_error());
			 	while ($most_online = mysql_fetch_array($select_most_online))
			 	{
			 		echo "0";
			 		mysql_query("INSERT INTO hosting_most_online (hosting_most_online_stamp,hosting_most_online_record) VALUES ('{$date}','{$most_online['COUNT(hosting_user_id)']}') ") or die(mysql_error());		
			 	}
			 }
			
		echo "</b>.</td>
	</tr>
</tbody></table>
</div>";
}

function download_game($bbcode) 
{
	if ($_SESSION['logged_in'])
	{
		if ($_SESSION['permission'] >= 4)
		{
			echo "<div class='download clearfix'>
			    <div class='download main_download_top'>
						
				  <p><a href='?section=downloadaddgame'>Add Game</a></p>
					</div>
                    
                   
			  </div>";
			#echo "<a href='?section=downloadaddgame'>Add Game</a> <br></br>";
		}
	}
	
	$select_download_game = mysql_query("SELECT * FROM download_game WHERE hide = 'no' ");
	if (mysql_num_rows($select_download_game) >= 1) 
	{
		while($download_game = mysql_fetch_array($select_download_game))
		{
			$bbcode = new BBCode;
			echo "   
			  <div class='download clearfix'>
		
				  <div class='download post_download_icon'>
					  <ul>
						  <li class='link'><a href='?section=downloadmore&id={$download_game['id']}'><img src='{$bbcode->Parse($download_game['icon'])}'  title='{$bbcode->Parse($download_game['name'])}'/></a></li>
					</ul>
				  </div>
                    
					<div class='download main_download'>
					
							<p>{$bbcode->Parse($download_game['description'])}";
							if ($_SESSION['logged_in'])
							{
								if ($_SESSION['permission'] >= 4)
								{
									echo " <a href='?section=edit&id={$download_game['id']}&download=edit&id={$download_game['id']}'>Edit</a> <a href='?section=delete&id={$download_game['id']}&download=game&id_delete={$download_game['id']}'>Delete</a>";
								}
							}
							echo "</p>
					</div>
                    
                   
			  </div>";
		}
	}
	else
	{
		echo "<div class='download clearfix'>
          <div class='download main_download_title'>
						
						<p class='download_topic_title'>Download is empty</p>
                </div>
			  </div>";
	}
}

function profile($name,$user)
{
	#Input Sanitize
	$name = mysql_real_escape_string($_GET['name']);
	$name = htmlentities($_GET['name']);
	
	#($name = ((isset($_GET['name'])) && (ctype_alnum($_GET['name'])))
	if (ctype_alnum($_GET['name']) == $name) #addinationl layer for filtering ctype_alnum($_GET['name']) == $name
	{
		$select_user = mysql_query("SELECT * FROM hosting_user WHERE hosting_user_name = '{$name}' ") or die(mysql_error());
		if (mysql_num_rows($select_user) >= 1) 
		{
			while ($user = mysql_fetch_array($select_user))
			{
				$bbcode = new BBCode;
				echo "<div class='article clearfix'>
				<div class='post_info'>
				<ul>
				<li class='label'>{$user['hosting_user_name']}</li>
				<hr />
				<li><img src='{$user['hosting_user_avatar']}' /></li>
				<hr />
				<li class='link'><span class='link'><a href='javascript: void(0)'>Join Date<span>{$bbcode->Parse($user["hosting_user_join"])}</span></a></span></li>
				<hr />
				<li class='link'><a href='#'>Age</a></li>
				<hr />
				<li class='link'><a href='http://{$user['hosting_user_homepage']}'>Website</a></li>
				<hr />
				<li class='link'><a href='#'>Memmber</a></li>
				<hr />
				<li class='link'><span class='link'><a href='javascript: void(0)'>Stats<span>{$bbcode->Parse($user["hosting_user_join"])}</span></a></span></li>
				</ul>
				</div>
			
				<div class='main_post'>
				<p>{$user[hosting_user_signature]}</p>
				</div>
				</div>";
			}
		}
		else
		{
			echo "<div class='download clearfix'>
	        <div class='download main_download_top'>User Doesn't Exist.</div></div>";
		}
	}
	elseif (ctype_alnum($_GET['name']) != $name)
	{
		echo "<div class='download clearfix'>
	        <div class='download main_download_top'>Error 404</div></div>";
	}
}

function news_count_comments($count_news_comment,$row_news)
{
	$count_news_comment_select = mysql_query("SELECT COUNT(id) FROM comment WHERE id_news = '{$row_news['id']}' ") or die(mysql_error());
	$count_news_comment = mysql_fetch_array($count_news_comment_select);

	echo $count_news_comment['COUNT(id)'];
}

function blog_count_comments($count_blog_comment,$row_blog) 
{
	$count_blog_comment_select = mysql_query("SELECT COUNT(id) FROM comment WHERE id_blog = '{$row_blog['id']}' ") or die(mysql_error());
	$count_blog_comment = mysql_fetch_array($count_blog_comment_select);
                		
	echo $count_blog_comment['COUNT(id)'];
}

function pm_inbox($param) 
{
	;
}

function pm_sendbox($param) 
{
	;
}

function tips()
{
	echo "<div class='download clearfix'>
	        <div class='download main_download_top'>
					<img src='/images/tips/tips.jpg' alt='Tips Jar' title='Tips'>
	        		<table width='400' border='0' align='left' cellpadding='0' cellspacing='0'>
	  <tr>
	    <td width='50'><img src='/images/tips/bc.png '  alt='bc' name='bc'width='50' height='50' id='bc' title='Bitcoin'></td>
	    <td width='550'>1PiWJtBQ7PnCVH2xHjxKQEFZrGDxGV1nvx</td>
	  </tr>
	  <tr>
	    <td><img src='/images/tips/ltc.png' alt='ltc' name='ltc' width='50' height='50' id='ltc' title='Litecoin'></td>
	    <td>LZd9igM7ELRR7yrVP37vZEJW98LrdMVKFX</td>
	  </tr>
	  <tr>
	    <td><img src='/images/tips/dogec.png' alt='dogec' name='dogec' width='50' height='50' id='dogec' title='Dogecoin'></td>
	    <td>DNAwti5EAH6xu4wmkSCVfYf53s23CnSLoS</td>
	  </tr>
	  <tr>
	    <td><img src='/images/tips/megac.png' alt='megac' name='megac' width='50' height='50' id='megac' title='Megacoin'></td>
	    <td>MQ94W3M3Lmnh6Ymqv6gjcgLxNzPMSZ2Rck</td>
	  </tr>
	  <tr>
	    <td><img src='/images/tips/paypal.png' alt='paypal' name='paypal' width='50' height='50' id='paypal' title='Paypal'></td>
		
	  </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td><form action='https://www.paypal.com/cgi-bin/webscr' method='post' target='_top'>
	  <input type='hidden' name='cmd' value='_s-xclick'>
	  <input type='hidden' name='hosted_button_id' value='485K8LT74TBRQ'>
	  <input type='image' src='https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif' border='0' name='submit' alt='PayPal - The safer, easier way to pay online!'>
	  <img alt='' border='0' src='https://www.paypalobjects.com/en_US/i/scr/pixel.gif' width='1' height='1'>
	  </form></td>
	  </tr>
	  <tr>
	    <td></td>
	    <td></td>
	  </tr>
	</table>
					</div>
					</div>";
	return;
}
?>