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
		#require_once ('functions/functions_process_edit.php');
		#Grupas parbaude lietotajam 
		$group_check = mysql_query("SELECT hosting_user_name,hosting_user_sysop_rights,hosting_user_administrator_rights,hosting_user_moderator_rights,hosting_user_vip_rights,hosting_user_default_rights FROM hosting_user WHERE hosting_user_name = '".$_SESSION['nick']."' ") or die (mysql_error());
		$group = mysql_fetch_array($group_check);
		
		if ($group['hosting_user_sysop_rights'] == "yes") #Sistemas administrators
		{
			if ($_GET['comment'] == "news")
			{
				news_read_more($id,$row_news,$bbcode,$redirect);  #Izvada zinas pie komentaru edit
						
				if ((INT)$_GET['comment_id'])
				{
					news_section_edit_comment($comment_edit_news,$comment_edit,$id_filter,$edit_comment_text,$edit_comment_text,$comment_texts,$lang,$id);
				}
				else
				{
					echo $redirect;
				}
			}
			elseif ($_GET['comment'] == "blog")
			{
				blog_read_more($id,$row_blog,$bbcode,$redirect);
				
				if ((INT)$_GET['comment_id'])
				{
					blog_section_edit_comment($comment_edit_news,$comment_edit,$id_filter,$edit_comment_text,$edit_comment_text,$comment_texts,$lang,$id);
				}
				else
				{
					echo $redirect;
				}
			}
			elseif ($_GET['comment'] == "forum")
			{
				forum_topic_read_more($id,$forum_view,$bbcode,$comment_user_information,$user_comments,$redirect);
			
				if ((INT)$_GET['comment_id'])
				{
					forum_section_edit_comment($comment_edit_news,$comment_edit,$id_filter,$edit_comment_text,$edit_comment_text,$comment_texts,$lang,$id);
				}
				else
				{
					echo $redirect;
				}
			}
			elseif ($_GET['news'] == "edit")
			{
				#forum_topic_read_more($id,$forum_view,$bbcode,$comment_user_information,$user_comments,$redirect);
			
				if ((INT)$_GET['news_id'])
				{
					news_section_edit($id,$news_id,$redirect);
				}
				else
				{
					echo $redirect;
				}
			}
			elseif ($_GET['download'] == edit)
			{
				$id = (int)$_GET['id'];
				
				$id_select_filter = mysql_query("SELECT MIN(id),MAX(id) FROM download_game WHERE id = '$id' ");
				while ($id_filter = mysql_fetch_array($id_select_filter))
				{
					if ($id_filter['MAX(id)'] == $id)
					{			
						$select_download_game = mysql_query("SELECT * FROM download_game WHERE id = '$id' ");
						while($download_game = mysql_fetch_array($select_download_game))
						{
							$icon = $download_game['icon'];
							$icon_edit = mysql_real_escape_string($_POST['icon']);
							$icon_edit = htmlentities($_POST['icon']);
							$icon_edit = trim($_POST['cion']);
							$icon_edit = stripslashes($_POST['icon']);
							$icon_edit = addslashes($_POST['icon']);
							
							$name = $download_game['name'];
							$name_edit = mysql_real_escape_string($_POST['icon']);
							$name_edit = htmlentities($_POST['icon']);
							$name_edit = trim($_POST['cion']);
							$name_edit = stripslashes($_POST['icon']);
							$name_edit = addslashes($_POST['icon']);
															
							$description = $download_game['description'];
							$description_edit = mysql_real_escape_string($_POST['description']);
							$description_edit = htmlentities($_POST['description']);
							$description_edit = trim($_POST['description']);
							$description_edit = stripslashes($_POST['description']);
							$description_edit = addslashes($_POST['description']);
						}
							
							if (isset($_POST['Submit'])) 
							{
								if (mysql_query("UPDATE download_game SET icon = '{$icon_edit}',description = '{$description_edit}',name = '{$name_edit}' WHERE id = '{$id}' ")) 
								{
									echo "<meta http-equiv='REFRESH' content='0;url=/?section=download'>";
								}
							}

						echo "<div class='subholder'>
			           	  <form action='' method='post' name='form1' id='form1'>
			                	<h1 class='post_title'>Download Edit</h1>
									<p>
									<label>
										<span>Game Icon:</span> <input name='icon' type='text' id='icon' size='50' value='{$icon}' />
									</label>
									</p>
									<p>
									<label>
										<span>Name:</span> <input name='name' type='text' id='name' size='50' value='{$name}' />
									</label>
									</p>
									<p>
									<label for='description'><span>Game Description:</span><input name='description' type='text' id='description' size='50' value='{$description}' />
									</label>
									</p>
									<p>
									<input type='submit' name='Submit' id='submit_b' value='Submit' />
									</p>
									 </form>
			            </div>";
					}
					else
					{
						echo $redirect;
					}
				}
			}
			elseif ($_GET['downloadgroup'] == 'edit')
			{
				$id = (int)$_GET['id'];
				
				$id_select_filter = mysql_query("SELECT MIN(id),MAX(id) FROM download_category WHERE id = '$id' ");
				while ($id_filter = mysql_fetch_array($id_select_filter))
				{
					if ($id_filter['MAX(id)'] == $id)
					{
						$select_download_category = mysql_query("SELECT * FROM download_category where id = '$id' ");
						while($download_category = mysql_fetch_array($select_download_category))
						{
							$hide = $download_category['hide'];
							$hide_edit = mysql_real_escape_string($_POST['hide']);
							$hide_edit = htmlentities($_POST['hide']);
							$hide_edit = trim($_POST['hide']);
							$hide_edit = stripslashes($_POST['hide']);
							$hide_edit = addslashes($_POST['hide']);
								
							$name = $download_category['name'];
							$name_edit = mysql_real_escape_string($_POST['name']);
							$name_edit = htmlentities($_POST['name']);
							$name_edit = trim($_POST['name']);
							$name_edit = stripslashes($_POST['name']);
							$name_edit = addslashes($_POST['name']);	
						}
						
						#Laiks Stundas,minutes,sekundes
						$time = date("H:i:s");
						#Datums datums,menesis,gads
						$date = date("d/m/Y");
							
						if (isset($_POST['Submit']))
						{
							if (mysql_query("UPDATE download_category SET hide = '{$hide_edit}',name = '{$name_edit}',time = '{$time}',date = '{$date}',author = '{$_SESSION['nick']}' WHERE id = '{$id}' "))
							{
								$select_download_game_id = mysql_query("SELECT id,download_game_id FROM download_category WHERE id = '{$id}' ");
								$download_game_id = mysql_fetch_array($select_download_game_id);
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=downloadmore&id={$download_game_id['download_game_id']}'>";
							}
						}
				
						echo "<div class='subholder'>
            

           	  <form action='' method='post' name='form1' id='form1'>
               	<h1 class='post_title'>Download Edit Game Group</h1>
                <label>
                  <span>Hide</span><select name='hide' id='hide'>
                    <option selected='selected'>no</option>
                    <option>yes</option>
                  </select>
                </label>
               	<label>
                    	<span>Name:</span> 
                    	<input name='name' type='text' id='name' value='{$name}'/>
                </label>
               	<input type='hidden' name='token' value='{$token}'/>
                
                  <input name='Submit' type='submit' id='submit_b' value='Submit' /> 
              </form>
            </div>";
					}
					else
					{
						echo $redirect;
					}
				}
			}
			elseif ($_GET['downloadtopic'] == 'edit')
			{
				#ini_set('display_errors', 'On');
				#error_reporting(E_ALL);
				#ini_set('display_errors', '1');
				#$id = (int)$_GET['id'];
				
				$id_select_filter = mysql_query("SELECT MIN(id),MAX(id) FROM download_topic WHERE id = '$id' ");
				while ($id_filter = mysql_fetch_array($id_select_filter))
				{
					if ($id_filter['MAX(id)'] == $id)
					{
						$select_download_category = mysql_query("SELECT * FROM download_topic WHERE id = '$id' ");
						while($download_topic = mysql_fetch_array($select_download_category))
						{
							$hide_edit = mysql_real_escape_string($_POST['hide']);
							$hide_edit = htmlentities($_POST['hide']);
							$hide_edit = trim($_POST['hide']);
							$hide_edit = stripslashes($_POST['hide']);
							$hide_edit = addslashes($_POST['hide']);
								
							$name = $download_topic['name'];
							$name_edit = mysql_real_escape_string($_POST['name']);
							$name_edit = htmlentities($_POST['name']);
							$name_edit = trim($_POST['name']);
							$name_edit = stripslashes($_POST['name']);
							$name_edit = addslashes($_POST['name']);	
							
							$size = $download_topic['size'];
							$size_edit = mysql_real_escape_string($_POST['size']);
							$size_edit = htmlentities($_POST['size']);
							$size_edit = trim($_POST['size']);
							$size_edit = stripslashes($_POST['size']);
							$size_edit = addslashes($_POST['size']);
							
							$version = $download_topic['version'];
							$version_edit = mysql_real_escape_string($_POST['version']);
							$version_edit = htmlentities($_POST['version']);
							$version_edit = trim($_POST['version']);
							$version_edit = stripslashes($_POST['version']);
							$version_edit = addslashes($_POST['version']);
							
							$short_version = $download_topic['short_version'];
							$short_version_edit = mysql_real_escape_string($_POST['short_version']);
							$short_version_edit = htmlentities($_POST['short_version']);
							$short_version_edit = trim($_POST['short_version']);
							$short_version_edit = stripslashes($_POST['short_version']);
							$short_version_edit = addslashes($_POST['short_version']);
							
							$build = $download_topic['build'];
							$build_edit = mysql_real_escape_string($_POST['build']);
							$build_edit = htmlentities($_POST['build']);
							$build_edit = trim($_POST['build']);
							$build_edit = stripslashes($_POST['build']);
							$build_edit = addslashes($_POST['build']);
							
							$type = $download_topic['type'];
							$type_edit = mysql_real_escape_string($_POST['type']);
							$type_edit = htmlentities($_POST['type']);
							$type_edit = trim($_POST['type']);
							$type_edit = stripslashes($_POST['type']);
							$type_edit = addslashes($_POST['type']);
							
							$description = $download_topic['description'];
							$description_edit = mysql_real_escape_string($_POST['description']);
							$description_edit = htmlentities($_POST['description']);
							$description_edit = trim($_POST['description']);
							$description_edit = stripslashes($_POST['description']);
							$description_edit = addslashes($_POST['description']);
							
							$link = $download_topic['link'];
							$link_edit = mysql_real_escape_string($_POST['link']);
							$link_edit = htmlentities($_POST['link']);
							$link_edit = trim($_POST['link']);
							$link_edit = stripslashes($_POST['link']);
							$link_edit = addslashes($_POST['link']);
							
							$link_mirror = $download_topic['link_mirror'];
							$link_mirror_edit = mysql_real_escape_string($_POST['link_mirror']);
							$link_mirror_edit = htmlentities($_POST['link_mirror']);
							$link_mirror_edit = trim($_POST['link_mirror']);
							$link_mirror_edit = stripslashes($_POST['link_mirror']);
							$link_mirror_edit = addslashes($_POST['link_mirror']);
							
							$link_mirror2 = $download_topic['link_mirror2'];
							$link_mirror2_edit = mysql_real_escape_string($_POST['link_mirror2']);
							$link_mirror2_edit = htmlentities($_POST['link_mirror2']);
							$link_mirror2_edit = trim($_POST['link_mirror2']);
							$link_mirror2_edit = stripslashes($_POST['link_mirror2']);
							$link_mirror2_edit = addslashes($_POST['link_mirror2']);
							
							$link_torrent = $download_topic['link_torrent'];
							$link_torrent_edit = mysql_real_escape_string($_POST['link_torrent']);
							$link_torrent_edit = htmlentities($_POST['link_torrent']);
							$link_torrent_edit = trim($_POST['link_torrent']);
							$link_torrent_edit = stripslashes($_POST['link_torrent']);
							$link_torrent_edit = addslashes($_POST['link_torrent']);
							
							$link_wuala = $download_topic['link_wuala'];
							$link_wuala_edit = mysql_real_escape_string($_POST['link_wuala']);
							$link_wuala_edit = htmlentities($_POST['link_wuala']);
							$link_wuala_edit = trim($_POST['link_wuala']);
							$link_wuala_edit = stripslashes($_POST['link_wuala']);
							$link_wuala_edit = addslashes($_POST['link_wuala']);
							
							$link_dropbox = $download_topic['link_dropbox'];
							$link_dropbox_edit = mysql_real_escape_string($_POST['link_dropbox']);
							$link_dropbox_edit = htmlentities($_POST['link_dropbox']);
							$link_dropbox_edit = trim($_POST['link_dropbox']);
							$link_dropbox_edit = stripslashes($_POST['link_dropbox']);
							$link_dropbox_edit = addslashes($_POST['link_dropbox']);
							
							$link_skydrive = $download_topic['link_skydrive'];
							$link_skydrive_edit = mysql_real_escape_string($_POST['link_skydrive']);
							$link_skydrive_edit = htmlentities($_POST['link_skydrive']);
							$link_skydrive_edit = trim($_POST['link_skydrive']);
							$link_skydrive_edit = stripslashes($_POST['link_skydrive']);
							$link_skydrive_edit = addslashes($_POST['link_skydrive']);
							
							$link_mega = $download_topic['link_mega'];
							$link_mega_edit = mysql_real_escape_string($_POST['link_mega']);
							$link_mega_edit = htmlentities($_POST['link_mega']);
							$link_mega_edit = trim($_POST['link_mega']);
							$link_mega_edit = stripslashes($_POST['link_mega']);
							$link_mega_edit = addslashes($_POST['link_mega']);
						}
							
						#Laiks Stundas,minutes,sekundes
						$time = date("H:i:s");
						#Datums datums,menesis,gads
						$date = date("d/m/Y");
						
						if (isset($_POST['Submit']))
						{
							if (mysql_query("UPDATE download_topic SET author = '{$_SESSION['nick']}',date = '{$date}',time = '{$time}',hide = '{$hide_edit}',name = '{$name_edit}',size = '{$size_edit}',version = '{$version_edit}',short_version = '{$short_version_edit}',build = '{$build_edit}',type = '{$type_edit}',description = '{$description_edit}',link = '{$link_edit}',link_mirror = '{$link_mirror_edit}',link_mirror2 = '{$link_mirror2_edit}',link_torrent = '{$link_torrent_edit}',link_wuala = '{$link_wuala_edit}',link_dropbox = '{$link_dropbox_edit}',link_skydrive = '{$link_skydrive_edit}',link_mega = '{$link_mega_edit}' WHERE id = '{$id}' "))
							{
								$select_download_id = mysql_query("SELECT id,download_category_id FROM download_topic WHERE id = '{$id}' ");
								$download_id = mysql_fetch_array($select_download_id);
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=downloadgroup&id={$download_id['download_category_id']}'>";
							}
							else
							{
								echo "eror query";
							}
						}
				
						echo "<div class='subholder'>
				
				
				<form action='' method='post' name='form1' id='form1'>
				<h1 class='post_title'>Download Edit</h1>
				<label>
				<span>Hide:</span>
				<select name='hide' id='hide'>
				<option selected='selected'>no</option>
				<option>yes</option>
				</select>
				</label>
				<label><span>Name:</span><input name='name' type='text' value='{$name}' id='name'/>
				</label>
				
				<label>
				<span>Size:</span><input name='size' type='text' value='{$size}' />
				</label>
				
				
				<label><span>Version:</span><input name='version' type='text' value='{$version}' /></label>
				<label><span>Short Verison:</span><input name='shotr_version' type='text' value='{$short_version}' /></label>
				<label><span>Build:</span><input name='build' type='text' value='{$build}' /></label>
				<label><span>Type:</span>
				<select name='type' id='type'>
				<option>Client</option>
				<option>Patch</option>
				<option>Maps</option>
				</select>
				</label>
				<label><span>Description:</span>
				<textarea name='description' cols='' rows=''>{$description}</textarea></label>
				<label><span>Direct:</span><input name='link' type='text' value='{$link}' /></label>
				<label><span>Mirror I:</span><input name='link_mirror' type='text' value='{$link_mirror}' /></label>
				<label><span>Mirror II:</span><input name='link_mirror2' type='text' value='{$link_mirror2}' /></label>
				<label><span>Torrent:</span><input name='link_torrent' type='text' value='{$link_torrent}' /></label>
				<label><span>Wuala:</span><input name='link_wuala' type='text' value='{$link_wuala}' /></label>
				<label><span>Dropbox:</span><input name='link_dropbox' type='text' value='{$link_dropbox}' /></label>
				<label><span>Skydrive:</span><input name='link_skydrive' type='text' value='{$link_skydrive}' /></label>
				<label><span>Mega:</span><input name='link_mega' type='text' value='{$link_mega}' /></label>
				
				<input type='hidden' name='token' value='{$token}'/>
				
				<input name='Submit' type='submit' id='submit_b' value='Submit' />
				</form>
				</div>";
					}
					else
					{
						echo $redirect;
					}
				}
			}
		}
		elseif ($group['hosting_user_administrator_rights'] == "yes") #Administrators
		{
			if ($_GET['comment'] == "news")
			{
				news_read_more($id,$row_news,$bbcode,$redirect); #Izvada zinas pie komentaru edit
					
				if ((INT)$_GET['comment_id'])
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
								if ((INT)$_GET['comment_id'])
								{
									news_section_edit_comment($comment_edit_news,$comment_edit,$id_filter,$edit_comment_text,$edit_comment_text,$comment_texts,$lang,$id);
								}
								else
								{
									echo $redirect;
								}
							}
							elseif ($sub_group['hosting_user_moderator_rights'] == "yes")
							{
								if ((INT)$_GET['comment_id'])
								{
									news_section_edit_comment($comment_edit_news,$comment_edit,$id_filter,$edit_comment_text,$edit_comment_text,$comment_texts,$lang,$id);
								}
								else
								{
									echo $redirect;
								}
							}
							elseif ($sub_group['hosting_user_vip_rights'] == "yes")
							{
								if ((INT)$_GET['comment_id'])
								{
									news_section_edit_comment($comment_edit_news,$comment_edit,$id_filter,$edit_comment_text,$edit_comment_text,$comment_texts,$lang,$id);
								}
								else
								{
									echo $redirect;
								}
							}
							elseif ($sub_group['hosting_user_sysop_rights'] == "no" && $sub_group['hosting_user_administrator_rights'] == "no"  && $sub_group['hosting_user_moderator_rights'] == "no" && $sub_group['hosting_user_vip_rights'] == "no")
							{
								if ((INT)$_GET['comment_id'])
								{
									news_section_edit_comment($comment_edit_news,$comment_edit,$id_filter,$edit_comment_text,$edit_comment_text,$comment_texts,$lang,$id);
								}
								else
								{
									echo $redirect;
								}
							}
						}
					}
				}
				else 
				{
					echo $redirect;
				}
			}
			elseif ($_GET['comment'] == "blog")
			{
				blog_section($id,$row_blog,$bbcode);
				
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
							if ((INT)$_GET['comment_id'])
							{
								blog_section_edit_comment($comment_edit_news,$comment_edit,$id_filter,$edit_comment_text,$edit_comment_text,$comment_texts,$lang,$id);
							}
							else
							{
								echo $redirect;
							}
						}
						elseif ($sub_group['hosting_user_moderator_rights'] == "yes")
						{
							if ((INT)$_GET['comment_id'])
							{
								blog_section_edit_comment($comment_edit_news,$comment_edit,$id_filter,$edit_comment_text,$edit_comment_text,$comment_texts,$lang,$id);
							}
							else
							{
								echo $redirect;
							}
						}
						elseif ($sub_group['hosting_user_vip_rights'] == "yes")
						{
							if ((INT)$_GET['comment_id'])
							{
								blog_section_edit_comment($comment_edit_news,$comment_edit,$id_filter,$edit_comment_text,$edit_comment_text,$comment_texts,$lang,$id);
							}
							else
							{
								echo $redirect;
							}
						}
						elseif ($sub_group['hosting_user_sysop_rights'] == "no" && $sub_group['hosting_user_administrator_rights'] == "no"  && $sub_group['hosting_user_moderator_rights'] == "no" && $sub_group['hosting_user_vip_rights'] == "no")
						{
							if ((INT)$_GET['comment_id'])
							{
								blog_section_edit_comment($comment_edit_news,$comment_edit,$id_filter,$edit_comment_text,$edit_comment_text,$comment_texts,$lang,$id);
							}
							else
							{
								echo $redirect;
							}
						}
					}
				}
			}
			elseif ($_GET['comment'] == "forum")
			{
				forum_topic_read_more($id,$forum_view,$bbcode,$comment_user_information,$user_comments,$redirect);
			
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
							if ((INT)$_GET['comment_id'])
							{
								forum_section_edit_comment($comment_edit_news,$comment_edit,$id_filter,$edit_comment_text,$edit_comment_text,$comment_texts,$lang,$id);
							}
							else
							{
								echo $redirect;
							}
						}
						elseif ($sub_group['hosting_user_moderator_rights'] == "yes")
						{
							if ((INT)$_GET['comment_id'])
							{
								forum_section_edit_comment($comment_edit_news,$comment_edit,$id_filter,$edit_comment_text,$edit_comment_text,$comment_texts,$lang,$id);
							}
							else
							{
								echo $redirect;
							}
						}
						elseif ($sub_group['hosting_user_vip_rights'] == "yes")
						{
							if ((INT)$_GET['comment_id'])
							{
								forum_section_edit_comment($comment_edit_news,$comment_edit,$id_filter,$edit_comment_text,$edit_comment_text,$comment_texts,$lang,$id);
							}
							else
							{
								echo $redirect;
							}
						}
						elseif ($sub_group['hosting_user_sysop_rights'] == "no" && $sub_group['hosting_user_administrator_rights'] == "no"  && $sub_group['hosting_user_moderator_rights'] == "no" && $sub_group['hosting_user_vip_rights'] == "no")
						{
							if ((INT)$_GET['comment_id'])
							{
								forum_section_edit_comment($comment_edit_news,$comment_edit,$id_filter,$edit_comment_text,$edit_comment_text,$comment_texts,$lang,$id);
							}
							else
							{
								echo $redirect;
							}
						}
					}
				}
			}
		}
		elseif ($group['hosting_user_moderator_rights'] == "yes") #Moderators
		{
			if ($_GET['comment'] == "news")
			{
				news_read_more($id,$row_news,$bbcode,$redirect); #Izvada zinas pie komentaru edit
				
				if ((INT)$_GET['comment_id'])
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
								if ((INT)$_GET['comment_id'])
								{
									news_section_edit_comment($comment_edit_news,$comment_edit,$id_filter,$edit_comment_text,$edit_comment_text,$comment_texts,$lang,$id);
								}
								else
								{
									echo $redirect;
								}
							}
							elseif ($sub_group['hosting_user_vip_rights'] == "yes")
							{
								if ((INT)$_GET['comment_id'])
								{
									news_section_edit_comment($comment_edit_news,$comment_edit,$id_filter,$edit_comment_text,$edit_comment_text,$comment_texts,$lang,$id);
								}
								else
								{
									echo $redirect;
								}
							}
							elseif ($sub_group['hosting_user_sysop_rights'] == "no" && $sub_group['hosting_user_administrator_rights'] == "no"  && $sub_group['hosting_user_moderator_rights'] == "no" && $sub_group['hosting_user_vip_rights'] == "no")
							{
								if ((INT)$_GET['comment_id'])
								{
									news_section_edit_comment($comment_edit_news,$comment_edit,$id_filter,$edit_comment_text,$edit_comment_text,$comment_texts,$lang,$id);
								}
								else
								{
									echo $redirect;
								}
							}
						}
					}
				}
			}
			elseif ($_GET['comment'] == "blog")
			{
				blog_section($id,$row_blog,$bbcode);
			
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
							if ((INT)$_GET['comment_id'])
							{
								blog_section_edit_comment($comment_edit_news,$comment_edit,$id_filter,$edit_comment_text,$edit_comment_text,$comment_texts,$lang,$id);
							}
							else
							{
								echo $redirect;
							}
						}
						elseif ($sub_group['hosting_user_vip_rights'] == "yes")
						{
							if ((INT)$_GET['comment_id'])
							{
								blog_section_edit_comment($comment_edit_news,$comment_edit,$id_filter,$edit_comment_text,$edit_comment_text,$comment_texts,$lang,$id);
							}
							else
							{
								echo $redirect;
							}
						}
						elseif ($sub_group['hosting_user_sysop_rights'] == "no" && $sub_group['hosting_user_administrator_rights'] == "no"  && $sub_group['hosting_user_moderator_rights'] == "no" && $sub_group['hosting_user_vip_rights'] == "no")
						{
							if ((INT)$_GET['comment_id'])
							{
								blog_section_edit_comment($comment_edit_news,$comment_edit,$id_filter,$edit_comment_text,$edit_comment_text,$comment_texts,$lang,$id);
							}
							else
							{
								echo $redirect;
							}
						}
					}
				}
			}
			elseif ($_GET['comment'] == "forum")
			{
				forum_topic_read_more($id,$forum_view,$bbcode,$comment_user_information,$user_comments,$redirect);
					
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
							if ((INT)$_GET['comment_id'])
							{
								forum_section_edit_comment($comment_edit_news,$comment_edit,$id_filter,$edit_comment_text,$edit_comment_text,$comment_texts,$lang,$id);
							}
							else
							{
								echo $redirect;
							}
						}
						elseif ($sub_group['hosting_user_vip_rights'] == "yes")
						{
							if ((INT)$_GET['comment_id'])
							{
								forum_section_edit_comment($comment_edit_news,$comment_edit,$id_filter,$edit_comment_text,$edit_comment_text,$comment_texts,$lang,$id);
							}
							else
							{
								echo $redirect;
							}
						}
						elseif ($sub_group['hosting_user_sysop_rights'] == "no" && $sub_group['hosting_user_administrator_rights'] == "no"  && $sub_group['hosting_user_moderator_rights'] == "no" && $sub_group['hosting_user_vip_rights'] == "no")
						{
							if ((INT)$_GET['comment_id'])
							{
								forum_section_edit_comment($comment_edit_news,$comment_edit,$id_filter,$edit_comment_text,$edit_comment_text,$comment_texts,$lang,$id);
							}
							else
							{
								echo $redirect;
							}
						}
					}
				}
			}
		}
		elseif ($group['hosting_user_default_rights'] == "yes") #Parasti Lietotaji taisa savu edit bet tikai savus komentarus
		{
			if ($_GET['comment'] == "news")
			{
				news_read_more($id,$row_news,$bbcode,$redirect); #Izvada zinas pie komentaru edit
					
				if ((INT)$_GET['comment_id'])
				{
					$comment_edit_news = (INT)$_GET['comment_id'];
					$select_comment_edit = mysql_query("SELECT id,author,text FROM comment WHERE id = '".$comment_edit_news."' AND author = '".$_SESSION['nick']."' ") or die (mysql_error());
					$comment_edit = mysql_fetch_array($select_comment_edit);

					if ($comment_edit['author'] == $_SESSION['nick'])
					{
						news_section_edit_user_comment($comment_edit_news,$comment_edit,$id_filter,$edit_comment_text,$edit_comment_text,$comment_texts,$lang,$id);
					}
					else
					{
						echo $redirect;
					}	
				}
				else
				{
					echo $redirect;
				}
			}
			elseif($_GET['comment'] == "blog")
			{
				blog_section($id,$row_news,$bbcode); #Izvada zinas pie komentaru edit
				
				if ((INT)$_GET['comment_id'])
				{
					$comment_edit_news = (INT)$_GET['comment_id'];
					$select_comment_edit = mysql_query("SELECT id,author,text FROM comment WHERE id = '".$comment_edit_news."' AND author = '".$_SESSION['nick']."' ") or die (mysql_error());
					$comment_edit = mysql_fetch_array($select_comment_edit);
				
					if ($comment_edit['author'] == $_SESSION['nick'])
					{
						blog_section_edit_user_comment($comment_edit_news,$comment_edit,$id_filter,$edit_comment_text,$edit_comment_text,$comment_texts,$lang,$id);
					}
					else
					{
						echo $redirect;
					}
				}
				else
				{
					echo $redirect;
				}
			}
			elseif($_GET['comment'] == "forum")
			{
				forum_topic_read_more($id,$forum_view,$bbcode,$comment_user_information,$user_comments,$redirect); #Izvada zinas pie komentaru edit
			
				if ((INT)$_GET['comment_id'])
				{
					$comment_edit_news = (INT)$_GET['comment_id'];
					$select_comment_edit = mysql_query("SELECT id,author,text FROM comment WHERE id = '".$comment_edit_news."' AND author = '".$_SESSION['nick']."' ") or die (mysql_error());
					$comment_edit = mysql_fetch_array($select_comment_edit);
			
					if ($comment_edit['author'] == $_SESSION['nick'])
					{
						forum_section_edit_user_comment($comment_edit_news,$comment_edit,$id_filter,$edit_comment_text,$edit_comment_text,$comment_texts,$lang,$id);
					}
					else
					{
						echo $redirect;
					}
				}
				else
				{
					echo $redirect;
				}
			}
		}
	}
}
else 
{
	echo $redirect;
}
	
?>