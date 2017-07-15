<?php
if ($_SESSION['logged_in']) 
{

	if ($id = ((isset($_GET['id'])) && (ctype_digit($_GET['id'])) ? (int)$_GET['id'] : ''))
	{
		true;
	}
	else
	{
		echo $redirect;
	}
	
	
		if ($_SESSION['permission'] >= 2)
		{
			
			$group_check = mysql_query("SELECT hosting_user_name,hosting_user_sysop_rights,hosting_user_administrator_rights,hosting_user_moderator_rights,hosting_user_vip_rights FROM hosting_user WHERE hosting_user_name = '".$_SESSION['nick']."' ") or die (mysql_error());
			$group = mysql_fetch_array($group_check);
			
			if ($_GET['comment'] == "news") 
			{
				
				$news = mysql_query("SELECT * FROM news WHERE id = '$id' ") or die(mysql_error());
				if (mysql_num_rows($news) != 0)
				{
					while ($row_news = mysql_fetch_array($news))
					{
						echo "<div class='article clearfix'>
						<div class='post_info'>
						<ul>
						<li>";
						$bbcode = new BBCode;
						print $bbcode->Parse($row_news["date"]);
						echo "</li>
						<li class='label'>Posted By:</li>
						<li class='link'><a href='/?section=viewprofile&name={$row_news['author']}'>{$row_news['author']}</a></li>
						<li class='label'>Category:</li>
						<li class='link'><a href='#'>";
						$bbcode = new BBCode;
						print $bbcode->Parse($row_news["category"]);
						echo "</a></li>
						<li class='label'>Comments:</li>
						<li class='link'>1,2,4</li>
						</ul>
						</div>
						<div class='main_post'>
						<h1><a href='#'>";
						$bbcode = new BBCode;
						print $bbcode->Parse($row_news["title"]);
						echo "</a></h1>
						<a href='#' class='imga'>";
						$bbcode = new BBCode;
						print $bbcode->Parse($row_news["image"]);
						echo "</a>
						<ul class='social'>
						<li><em>Share:</em></li>
						<li><a href='http://twitter.com/faksx' class='icons twitter'></a></li>
						<li><a href='http://facebook.com/faksx' class='icons facebook'></a></li>
						<li><a href='#' class='icons google'></a></li>
						<li><a href='#' class='icons myspace'></a></li>
						<li><a href='#' class='icons email'></a></li>
						</ul>
						<p class='comment'>";
						$bbcode = new BBCode;
						print $bbcode->Parse($row_news["text_long"]);
						echo "
						</p>
							
						</div>
						</div>";
					}
				}
				else
				{
					echo $redirect;
				}
					
				if ($group['hosting_user_sysop_rights'] == "yes") 
				{
					$comment_edit_news = (INT)$_GET['comment_id'];
					$select_comment_edit = mysql_query("SELECT id,author,text FROM comment WHERE id = '".$comment_edit_news."' ") or die (mysql_error());
					$comment_edit = mysql_fetch_array($select_comment_edit);

						
						$id_select_filter = mysql_query("SELECT MIN(id),MAX(id) FROM comment WHERE id = '$comment_edit_news' ");
						while ($id_filter = mysql_fetch_array($id_select_filter))
						{
							if ($id_filter['MAX(id)'] == $comment_edit_news)
							{
								$comment_texts 	   = $comment_edit['text'];
								$edit_comment_text = mysql_real_escape_string($_POST['text']);
								$edit_comment_text = htmlentities($_POST['text']);
								$edit_comment_text = trim($_POST['text']);
								$edit_comment_text = stripslashes($_POST['text']);
								$edit_comment_text = addslashes($_POST['text']);
								$edit_comment_text = $myFilter->process($_POST["text"]);
									
								if(isset($_POST['text']))
								{
									mysql_query("UPDATE comment SET text = '".$edit_comment_text."' WHERE id = '".$comment_edit_news."'  ") or die (mysql_error());
								}
									
								if (isset($_POST['Submit']))
								{
									echo "<meta http-equiv='REFRESH' content='0;url=/?section=newsmore&id=".$id."'>";
								}
								
								
									
								echo "<form  id='edit_comment' name='edit_comment' method='post' class='pagination'>
										<p>
										<textarea name='text' cols='50' rows='10' id='textarea' >$comment_texts</textarea>
										<p>
										<input type='hidden' name='token' value='{$token}'/>
										<input type='submit' name='Submit' id='button' value='{$lang['BODY_NEWS_COMMENT_SUBMIT']}' />
										<input type='reset' name='Reset' id='button' value='{$lang['BODY_NEWS_COMMENT_RESET']}' />
										</p>
										</form>";
							}
							else
							{
								echo $redirect;
							}
						}
				}
				elseif ($group['hosting_user_administrator_rights'] == "yes")
				{
					$comment_edit_news = (INT)$_GET['comment_id'];
					$select_comment_edit = mysql_query("SELECT id,author,text FROM comment WHERE id = '".$comment_edit_news."' ") or die (mysql_error());
					while($comment_edit = mysql_fetch_array($select_comment_edit))
					{
						$sub_group_check = mysql_query("SELECT hosting_user_name,hosting_user_sysop_rights,hosting_user_administrator_rights,hosting_user_moderator_rights,hosting_user_vip_rights FROM hosting_user WHERE hosting_user_name = '".$comment_edit["author"]."' ") or die (mysql_error());
						while($sub_group = mysql_fetch_array($sub_group_check))
						{
							if ($sub_group['hosting_user_sysop_rights'] == "yes")
							{
								echo "nevaru labot Sistemas administratoru";
							}
							elseif ($sub_group['hosting_user_administrator_rights'] == "yes")
							{
								echo "Lietotajam ir Administrators";
							}
							elseif ($sub_group['hosting_user_moderator_rights'] == "yes")
							{
								echo "Lietotajam ir moderators";
							}
							elseif ($sub_group['hosting_user_vip_rights'] == "yes")
							{
								echo "Lietotajm ir VIP";
							}
							elseif ($sub_group['hosting_user_sysop_rights'] == "no" && $sub_group['hosting_user_administrator_rights'] == "no"  && $sub_group['hosting_user_moderator_rights'] == "no" && $sub_group['hosting_user_vip_rights'] == "no")
							{
								echo "Lietotajam nau sysop,admin,moderator,vip";
							}
						}
					}
				}
				elseif ($group['hosting_user_moderator_rights'] == "yes")
				{
					$comment_edit_news = (INT)$_GET['comment_id'];
					$select_comment_edit = mysql_query("SELECT id,author,text FROM comment WHERE id = '".$comment_edit_news."' ") or die (mysql_error());
					while($comment_edit = mysql_fetch_array($select_comment_edit))
					{
						$sub_group_check = mysql_query("SELECT hosting_user_name,hosting_user_sysop_rights,hosting_user_administrator_rights,hosting_user_moderator_rights,hosting_user_vip_rights FROM hosting_user WHERE hosting_user_name = '".$comment_edit["author"]."' ") or die (mysql_error());
						while($sub_group = mysql_fetch_array($sub_group_check))
						{
							if ($sub_group['hosting_user_sysop_rights'] == "yes")
							{
								echo "nevaru labot Sistemas administratoru";
							}
							elseif ($sub_group['hosting_user_administrator_rights'] == "yes")
							{
								echo "Nevaru labot Administrators";
							}
							elseif ($sub_group['hosting_user_moderator_rights'] == "yes")
							{
								echo "Lietotajam ir moderators";
							}
							elseif ($sub_group['hosting_user_vip_rights'] == "yes")
							{
								echo "Lietotajm ir VIP";
							}
							elseif ($sub_group['hosting_user_sysop_rights'] == "no" && $sub_group['hosting_user_administrator_rights'] == "no"  && $sub_group['hosting_user_moderator_rights'] == "no" && $sub_group['hosting_user_vip_rights'] == "no")
							{
								echo "Lietotajam nau sysop,admin,moderator,vip";
							}
						}
					}
				}
			}
			elseif ($_GET['comment'] == "blog")
			{
			#
			}	
		}
}
else 
{
	echo $redirect;
}
?>