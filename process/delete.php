<?php
if ($_SESSION['logged_in']) 
{
	if ($id = ((isset($_GET['id'])) && (ctype_digit($_GET['id'])) ? (int)$_GET['id'] : ''))
	{
		true;
	}
	else
	{
		echo $redirect.false;
	}
	
		#Lietotaja Pakape
		if ($_SESSION['permission'] == 2) 
		{
			echo $redirect;
		}
		#Vares dzest vip,moderator,administrator,system administrator
		elseif ($_SESSION['permission'] >= 3)
		{
			require_once ('functions/functions_process_delete.php');
			#Grupas parbaude lietotajam
			$group_check = mysql_query("SELECT hosting_user_name,hosting_user_sysop_rights,hosting_user_administrator_rights,hosting_user_moderator_rights,hosting_user_vip_rights FROM hosting_user WHERE hosting_user_name = '".$_SESSION['nick']."' ") or die (mysql_error());
			$group = mysql_fetch_array($group_check);
			
			if ($group['hosting_user_sysop_rights'] == "yes") #Sistemas administrators
			{
				if ($_GET['comment'] == 'news')
				{
					if ((INT)$_GET['id_delete'])
					{
						commenent_delete();
						echo "<meta http-equiv='REFRESH' content='0;url=/?section=newsmore&id=".$id."'>";
					}
					else
					{
						echo $redirect;
					}
				}
				elseif ($_GET['comment'] == 'blog')
				{
					if ((INT)$_GET['id_delete'])
					{
						commenent_delete();
						echo "<meta http-equiv='REFRESH' content='0;url=/?section=blogmore&id=".$id."'>";
					}
					else
					{
						echo $redirect;
					}
				}
				elseif ($_GET['comment'] == 'forum')
				{
					if ((INT)$_GET['id_delete'])
					{
						commenent_delete();
						echo "<meta http-equiv='REFRESH' content='0;url=/?section=forumtopic&id=".$id."'>";
					}
				}
				elseif ($_GET['download'] == 'game')
				{
					if ((INT)$_GET['id_delete'])
					{
						download_game_delete();
						echo "<meta http-equiv='REFRESH' content='0;url=/?section=download'>";
					}
				}
				elseif ($_GET['download'] == 'category')
				{
					if ((INT)$_GET['id_delete'])
					{
						download_category_delete();
					}
				}
				elseif ($_GET['download'] == 'topic')
				{
					if ((INT)$_GET['id_delete']) 
					{
						download_topic_delete();
					}
				}
			}
			elseif ($group['hosting_user_administrator_rights'] == "yes") #Administrators
			{
				$comment_id_delete = (INT)$_GET['id_delete'];
				$select_comment_delete_check = mysql_query("SELECT id,author,text FROM comment WHERE id = '".$comment_id_delete."' ") or die (mysql_error());
				$comment_delete = mysql_fetch_array($select_comment_delete_check);
				
				$sub_group_check = mysql_query("SELECT hosting_user_name,hosting_user_sysop_rights,hosting_user_administrator_rights,hosting_user_moderator_rights,hosting_user_vip_rights FROM hosting_user WHERE hosting_user_name = '".$comment_delete["author"]."' ") or die (mysql_error());
				while($sub_group = mysql_fetch_array($sub_group_check))
				{
					if ($sub_group['hosting_user_sysop_rights'] == "yes")
					{
						echo "Nevaru Dzest Sistemas administratora Komentarus";
					}
					elseif ($sub_group['hosting_user_administrator_rights'] == "yes")
					{
						if ($_GET['comment'] == 'news')
						{
							if ((INT)$_GET['id_delete'])
							{
								commenent_delete();
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=newsmore&id=".$id."'>";
							}
							else
							{
								echo $redirect;
							}
						}
						elseif ($_GET['comment'] == 'blog')
						{
							if ((INT)$_GET['id_delete'])
							{
								commenent_delete();
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=blogmore&id=".$id."'>";
							}
							else
							{
								echo $redirect;
							}
						}
						elseif ($_GET['comment'] == 'forum')
						{
							if ((INT)$_GET['id_delete'])
							{
								commenent_delete();
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=forumtopic&id=".$id."'>";
							}
						}
					}
					elseif ($sub_group['hosting_user_moderator_rights'] == "yes")
					{
						if ($_GET['comment'] == 'news')
						{
							if ((INT)$_GET['id_delete'])
							{
								commenent_delete();
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=newsmore&id=".$id."'>";
							}
							else
							{
								echo $redirect;
							}
						}
						elseif ($_GET['comment'] == 'blog')
						{
							if ((INT)$_GET['id_delete'])
							{
								commenent_delete();
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=blogmore&id=".$id."'>";
							}
							else
							{
								echo $redirect;
							}
						}
						elseif ($_GET['comment'] == 'forum')
						{
							if ((INT)$_GET['id_delete'])
							{
								commenent_delete();
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=forumtopic&id=".$id."'>";
							}
						}
					}
					elseif ($sub_group['hosting_user_vip_rights'] == "yes")
					{
						if ($_GET['comment'] == 'news')
						{
							if ((INT)$_GET['id_delete'])
							{
								commenent_delete();
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=newsmore&id=".$id."'>";
							}
							else
							{
								echo $redirect;
							}
						}
						elseif ($_GET['comment'] == 'blog')
						{
							if ((INT)$_GET['id_delete'])
							{
								commenent_delete();
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=blogmore&id=".$id."'>";
							}
							else
							{
								echo $redirect;
							}
						}
						elseif ($_GET['comment'] == 'forum')
						{
							if ((INT)$_GET['id_delete'])
							{
								commenent_delete();
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=forumtopic&id=".$id."'>";
							}
						}
					}
					elseif ($sub_group['hosting_user_sysop_rights'] == "no" && $sub_group['hosting_user_administrator_rights'] == "no"  && $sub_group['hosting_user_moderator_rights'] == "no" && $sub_group['hosting_user_vip_rights'] == "no")
					{
						if ($_GET['comment'] == 'news')
						{
							if ((INT)$_GET['id_delete'])
							{
								commenent_delete();
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=newsmore&id=".$id."'>";
							}
							else
							{
								echo $redirect;
							}
						}
						elseif ($_GET['comment'] == 'blog')
						{
							if ((INT)$_GET['id_delete'])
							{
								commenent_delete();
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=blogmore&id=".$id."'>";
							}
							else
							{
								echo $redirect;
							}
						}
						elseif ($_GET['comment'] == 'forum')
						{
							if ((INT)$_GET['id_delete'])
							{
								commenent_delete();
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=forumtopic&id=".$id."'>";
							}
						}
					}
				}
						
			}
			elseif ($group['hosting_user_moderator_rights'] == "yes") #Moderators
			{
				$comment_id_delete = (INT)$_GET['id_delete'];
				$select_comment_delete_check = mysql_query("SELECT id,author,text FROM comment WHERE id = '".$comment_id_delete."' ") or die (mysql_error());
				$comment_delete = mysql_fetch_array($select_comment_delete_check);
				
				$sub_group_check = mysql_query("SELECT hosting_user_name,hosting_user_sysop_rights,hosting_user_administrator_rights,hosting_user_moderator_rights,hosting_user_vip_rights FROM hosting_user WHERE hosting_user_name = '".$comment_delete["author"]."' ") or die (mysql_error());
				while($sub_group = mysql_fetch_array($sub_group_check))
				{
					if ($sub_group['hosting_user_sysop_rights'] == "yes")
					{
						echo "Nevar Dzest Sistemas administratora Komentarus";
					}
					elseif ($sub_group['hosting_user_administrator_rights'] == "yes")
					{
						echo "Nevaru Dzest Administratora Komentarus";
					}
					elseif ($sub_group['hosting_user_moderator_rights'] == "yes")
					{
						if ($_GET['comment'] == 'news')
						{
							if ((INT)$_GET['id_delete'])
							{
								commenent_delete();
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=newsmore&id=".$id."'>";
							}
							else
							{
								echo $redirect;
							}
						}
						elseif ($_GET['comment'] == 'blog')
						{
							if ((INT)$_GET['id_delete'])
							{
								commenent_delete();
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=blogmore&id=".$id."'>";
							}
							else
							{
								echo $redirect;
							}
						}
						elseif ($_GET['comment'] == 'forum')
						{
							if ((INT)$_GET['id_delete'])
							{
								commenent_delete();
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=forumtopic&id=".$id."'>";
							}
						}
					}
					elseif ($sub_group['hosting_user_vip_rights'] == "yes")
					{
						if ($_GET['comment'] == 'news')
						{
							if ((INT)$_GET['id_delete'])
							{
								commenent_delete();
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=newsmore&id=".$id."'>";
							}
							else
							{
								echo $redirect;
							}
						}
						elseif ($_GET['comment'] == 'blog')
						{
							if ((INT)$_GET['id_delete'])
							{
								commenent_delete();
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=blogmore&id=".$id."'>";
							}
							else
							{
								echo $redirect;
							}
						}
						elseif ($_GET['comment'] == 'forum')
						{
							if ((INT)$_GET['id_delete'])
							{
								commenent_delete();
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=forumtopic&id=".$id."'>";
							}
						}
					}
					elseif ($sub_group['hosting_user_sysop_rights'] == "no" && $sub_group['hosting_user_administrator_rights'] == "no"  && $sub_group['hosting_user_moderator_rights'] == "no" && $sub_group['hosting_user_vip_rights'] == "no")
					{
						if ($_GET['comment'] == 'news')
						{
							if ((INT)$_GET['id_delete'])
							{
								commenent_delete();
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=newsmore&id=".$id."'>";
							}
							else
							{
								echo $redirect;
							}
						}
						elseif ($_GET['comment'] == 'blog')
						{
							if ((INT)$_GET['id_delete'])
							{
								commenent_delete();
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=blogmore&id=".$id."'>";
							}
							else
							{
								echo $redirect;
							}
						}
						elseif ($_GET['comment'] == 'forum')
						{
							if ((INT)$_GET['id_delete'])
							{
								commenent_delete();
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=forumtopic&id=".$id."'>";
							}
						}
					}
				}
			}
			elseif ($group['hosting_user_vip_rights'] == "yes") #VIP
			{
				#News Delete
				if ($_GET['vip'] == "news") #Update uz news
				{
					if ((INT)$_GET['vip_id'])
					{
						commenet_vip_delete_news($vip_id,$comment_vip_delete,$id);
					}
					else
					{
						echo $redirect;
					}
				}
				elseif ($_GET['vip'] == "blog")
				{
					if ((INT)$_GET['vip_id'])
					{
						commenet_vip_delete_blog($vip_id,$comment_vip_delete,$id);
					}
					else
					{
						echo $redirect;
					}		
				}
				elseif ($_GET['vip'] == "forum")
				{
					if ((INT)$_GET['vip_id'])
					{
						commenet_vip_delete_forum($vip_id,$comment_vip_delete,$id);
					}
					else
					{
						echo $redirect;
					}
				}
				#Nakosais get nak ar if vai 
			}
			
		}
}
else 
{
	echo $redirect;
}
?>