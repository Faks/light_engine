<?php
function news_read_more($id,$row_news,$bbcode,$redirect) 
{
	$news = mysql_query("SELECT * FROM news WHERE id = '$id' ") or die(mysql_error());
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
		                		<li class='link'><a href='/?section=viewprofile&name={$bbcode->Parse($row_news["author"])}'>{$bbcode->Parse($row_news["author"])}</a></li>
		                		<li class='label'>Category:</li>
		                		<li class='link'><a href='#'>{$bbcode->Parse($row_news["category"])}</a></li>
		                		<li class='label'>Comments:</li>
		                		<li class='link'>";
		                		news_count_comments($count_news_comment,$row_news);
		                		echo "</li>
		                	</ul>
		                </div>
		                <div class='main_post'>
		                	<h1><a href='#'>{$bbcode->Parse($row_news["title"])}</a></h1>
		                    <a href='#' class='imga'>{$bbcode->Parse($row_news["image"])}</a>
		                    <ul class='social'>
		                    	<li><em>Share:</em></li>
		                    	<li><a href='http://twitter.com/faksx' class='icons twitter'></a></li>
		                    	<li><a href='http://facebook.com/faksx' class='icons facebook'></a></li>
		                    	<li><a href='#' class='icons google'></a></li>
		                    	<li><a href='#' class='icons myspace'></a></li>
		                    	<li><a href='#' class='icons email'></a></li>
		                    </ul>
		                    <p class='comment'>{$bbcode->Parse($row_news["text_long"])}</p>
		                </div>
				</div>";
		}
	}
	else
	{
		echo $redirect;
	}
}

function news_read_more_comment($id,$comment_limit,$row_news_comment,$bbcode,$lang,$date_comment,$time_comment,$errors,$error,$token) 
{
	$sql = "SELECT COUNT(id_news) FROM comment WHERE id_news = '$id'";
	$result = mysql_query($sql);
	$r = mysql_fetch_row($result);
	$numrows = $r[0];
		
	// find out total pages
	$totalpages = ceil($numrows / $comment_limit);
		
	if ((isset($_GET['page'])) && (ctype_digit($_GET['page'])))
	{
			$page = (int)$_GET['page'];
	}
	else
	{
		$page = 1;
	}
	// if current page is greater than total pages...
	if ($page > $totalpages) 
	{
		// set current page to last page
		$page = $totalpages;
	} // end if
		 
		// if current page is less than first page...
	if ($page < 1) 
	{
		// set current page to first page
		$page = 1;
	} // end if
		
	// the offset of the list, based on current page
	$offset = ($page - 1) * $comment_limit;
		
	$comment = mysql_query("SELECT id,date,time,author,text FROM comment WHERE id_news  = '$id' "."limit $offset, $comment_limit");
	if (mysql_num_rows($comment) != 0)
	{
		while ($row_news_comment = mysql_fetch_array($comment))
		{
			
			$bbcode = new BBCode;
			echo "<div class='article clearfix'>
				<div class='post_info'>
				<ul>
				<li class='link'><span class='link'><a href='javascript: void(0)'>{$bbcode->Parse($row_news_comment["date"])}<span>{$bbcode->Parse($row_news_comment["time"])}</span></a></span></li>
				<li class='label'>Posted By:</li>
				<li class='link'><a href='#'>{$bbcode->Parse($row_news_comment["author"])}</a></li>
				<li class='label'>Group:</li>";
				$comment_user_information_select = mysql_query("SELECT hosting_user_join,hosting_user_online_status,hosting_user_title FROM hosting_user WHERE hosting_user_name = '".$row_news_comment['author']."' ");
				while ($comment_user_information = mysql_fetch_array($comment_user_information_select))
				{
					echo "<li class='link'><a href='#'>{$comment_user_information['hosting_user_title']}</a></li>";
				
					echo "<li class='label'>{$lang['BODY_FORUM_THREAD_COMMENT_USER_STATUS']}:</li>";
				
					if ($comment_user_information['hosting_user_online_status'] == "yes")
					{
						echo "<li class='link'><a href='#'>".$lang['BODY_PROFILE_STATUS_ONLINE']."</li></a>";
					}
					elseif ($comment_user_information['hosting_user_online_status'] == "no")
					{
					echo "<li class='link'><a href='#'>".$lang['BODY_PROFILE_STATUS_OFFLINE']."</li></a>";
					}
							#echo '<br>'.$lang['BODY_FORUM_THREAD_COMMENT_USER_JOINED'].': '.$comment_user_information['hosting_user_join'];
				}
				echo "<li class='label'>Comments:</li>";
				$count_user_comments = mysql_query("SELECT COUNT(id) FROM comment WHERE author = '".$row_news_comment['author']."' ");
				$user_comments = mysql_fetch_array($count_user_comments);
				echo "<li class='link'><a href='#'>".(int)$user_comments['COUNT(id)']."</li></a>";
				if ($_SESSION['permission'] == 2)
				{
					if ($row_news_comment['author'] == $_SESSION['nick'])
					{
						echo "<li class='label'>Manage:</li><li class='link'><a href='/?section=edit&id=".$id."&comment=news&comment_id=".$row_news_comment['id']."'>{$lang['BODY_EDIT']}</a></li>";
					}
				}
				elseif ($_SESSION['permission'] == 3)
				{
					if ($row_news_comment['author'] == $_SESSION['nick'])
					{
						echo "<li class='label'>Manage:</li><li class='link'><a href='/?section=edit&id=".$id."&comment=news&comment_id=".$row_news_comment['id']."'>{$lang['BODY_EDIT']}</a>"."&nbsp;"."<a href='/?section=delete&id=".$id."&vip=news&vip_id=".$row_news_comment['id']."'>{$lang['BODY_DELETE']}</a></li>";
					}
				}
				elseif ($_SESSION['permission'] >= 4)
				{
					echo "<li class='label'>Manage:</li><li class='link'><a href='/?section=edit&id=".$id."&comment=news&comment_id=".$row_news_comment['id']."'>{$lang['BODY_EDIT']}</a>"."&nbsp;"."<a href='/?section=delete&id=".$id."&comment=news&id_delete=".$row_news_comment['id']."'>{$lang['BODY_DELETE']}</a></li>";
				}
				
				echo"</ul></div><div class='main_post'><p class='comment' id='comment'>{$bbcode->Parse($row_news_comment["text"])}</p></div></div></p>";
		
		}
			/******  build the pagination links ******/
			// range of num links to show
			$range = 50;
			// loop to show links to range of pages around current page
			echo "<div class='pagination'><center>{$lang['BODY_PAGE_PAGINATION']}&nbsp;";
			for ($x = ($page - $range); $x < (($page + $range) + 1); $x++) 
			{
				// if it's a valid page number...
				if (($x > 0) && ($x <= $totalpages)) 
				{
					// if we're on current page...
					if ($x == $page) 
					{
						// 'highlight' it but don't make a link
						echo "$x ";
						// if not current page...
					} 
					else 
					{
						// make it a link
						echo "<a href='/?section=newsmore&id=$id&page=$x'>$x</a>&nbsp;";
					} // end else
				} // end if
			} // end for
				echo "</center></div>";
					/****** end build pagination links ******/
	}
	else
	{
		echo "<div class='pagination'>".$lang['BODY_NEWS_COMMENT_COMMENTS_NOT_YET_DONE'].'</div>';
	}
	
	if ($_SESSION['logged_in'])
	{			
		if (isset($_POST['Submit']))
		{
			$errors = array(); // set the errors array to empty, by default
			$fields = array(); // stores the field values
			$success_message = "Paldies Jï¿½su Informï¿½cija Nosï¿½tï¿½ta";
			// import the form_validation library
			require ("include/library/form_validation.php");
			$rules = array(); // stores the form_validation rules
						
			// standard form fields
			$rules[] = "required,text,{$lang['BODY_NEWS_VALIDATION_FILL_TEXT']}";
						
			$errors = validateFields($_POST, $rules);
						
			// if there were errors, re-populate the form fields
			if (!empty($errors))
			{
				$fields = $_POST;
			}	// no errors! redirect the user to the thankyou page (or whatever)
			else
			{
				if (isset($_POST['token']) && $_POST['token'] == $_SESSION['token'])
				{
					$comment_text = mysql_real_escape_string($_POST['text']);
					$comment_text =	htmlentities($_POST['text']);			
					#$comment_text = htmlspecialchars($_POST['text'],ENT_QUOTES);
					$comment_text = trim($_POST['text']);
					$comment_text = stripslashes($_POST['text']);
					$comment_text = addslashes($_POST['text']);			
					#$comment_text = strip_script($_POST['text']);
					#$comment_text = strip_tags($_POST['text']);
					#$comment_text = bbcode_parser($_POST['text']);
									
					// process input
					#$comment_text = $myFilter->process($_POST["text"]);
					$id = (int)$_GET['id'];
					unset($_POST['token']);
					unset($_POST['text']);
						
						#mysql_query("INSERT INTO comment (author,date,text,id_news) VALUES ('".$_SESSION['nick']."','{$date_comment}','".$comment_text."','".$id."')") or die(mysql_error());
						if (mysql_query("INSERT INTO comment (author,date,time,text,id_news) VALUES ('".$_SESSION['nick']."','{$date_comment}','".$time_comment."','".$comment_text."','".$id."')"))
						{
							echo "<meta http-equiv='REFRESH' content='0'/>";
						}
						else
						{
							echo "<div class='pagination'>Having Issue</div>";
						}
				}
			}
		}
	
		$token = sha1(uniqid(rand(), true));
		$_SESSION['token'] = $token;
							
		if (!empty($errors))
		{
			{
				echo "<div class='pagination'><div class='error' style='width:100%;'><b>{$lang['BODY_NEWS_VALIDATION_TEXT']}</b><br>";
				foreach ($errors as $error)
				echo "<span style='color:darkred'>$error</span><br>";		
				echo "</ul></div></div>";
			}
						
			if (!empty($message))
			{
				echo "<div class='notify'>$success_message</div>";
			}
		}
		
		echo "<form id='form1' name='form1' method='post' class='pagination'>
				  <p>
				  <textarea name='text' cols='50' rows='10' class='bbcode'>{$lang['BODY_NEWS_COMMENT_HINT']}</textarea>
				  <input type='hidden' name='token' value='{$token}'/>
				  <input type='hidden' name='sent' value='yes'>	
				  <p>
				  <input type='submit' name='Submit' id='button' value='{$lang['BODY_NEWS_COMMENT_SUBMIT']}' />
				  <input type='reset' name='Reset' id='button' value='{$lang['BODY_NEWS_COMMENT_RESET']}' />
				  </p>
				  </form>";
	}				
}

function blog_read_more($id,$row_blog,$bbcode,$redirect) 
{
	$blog = mysql_query("SELECT * FROM blog WHERE id = '$id' ") or die(mysql_error());
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
		                		<li class='link'><a href='/?section=viewprofile&name={$bbcode->Parse($row_blog["author"])}'>{$bbcode->Parse($row_blog["author"])}</a></li>
		                		<li class='label'>Category:</li>
		                		<li class='link'><a href='#'>{$bbcode->Parse($row_blog["category"])}</a></li>
		                		<li class='label'>Comments:</li>
		                		<li class='link'>";blog_count_comments($count_blog_comment,$row_blog);
		                		echo "</li>
		                	</ul>
		                </div>
		                <div class='main_post'>
		                	<h1><a href='#'>{$bbcode->Parse($row_blog["title"])}</a></h1>
		                    <a href='#' class='imga'>{$bbcode->Parse($row_blog["image"])}</a>
		                    <ul class='social'>
		                    	<li><em>Share:</em></li>
		                    	<li><a href='http://twitter.com/faksx' class='icons twitter'></a></li>
		                    	<li><a href='http://facebook.com/faksx' class='icons facebook'></a></li>
		                    	<li><a href='#' class='icons google'></a></li>
		                    	<li><a href='#' class='icons myspace'></a></li>
		                    	<li><a href='#' class='icons email'></a></li>
		                    </ul>
		                    <p class='comment'>{$bbcode->Parse($row_blog["text_long"])}</p>
		            	</div>
            	</div>";
		}
	}
	else
	{
		echo $redirect;
	}
}

function blog_read_more_comment($id,$comment_limit,$row_blog_comment,$bbcode,$lang,$date_comment,$time_comment,$errors,$error,$token) 
{
	$sql = "SELECT COUNT(id_blog) FROM comment WHERE id_blog = '$id'";
	$result = mysql_query($sql);
	$r = mysql_fetch_row($result);
	$numrows = $r[0];
		
	// find out total pages
	$totalpages = ceil($numrows / $comment_limit);
		
	if ((isset($_GET['page'])) && (ctype_digit($_GET['page'])))
	{
		$page = (int)$_GET['page'];
	}
	else
	{
		$page = 1;
	}
	// if current page is greater than total pages...
	if ($page > $totalpages) 
	{
		// set current page to last page
		$page = $totalpages;
	} // end if
		// if current page is less than first page...
	if ($page < 1) 
	{
		// set current page to first page
		$page = 1;
	} // end if
		
	// the offset of the list, based on current page
	$offset = ($page - 1) * $comment_limit;
		
	$comment = mysql_query("SELECT id,date,time,author,text FROM comment WHERE id_blog  = '$id' "."limit $offset, $comment_limit");
	if (mysql_num_rows($comment) != 0)
	{
		while ($row_blog_comment = mysql_fetch_array($comment))
		{
			$bbcode = new BBCode;
			/*
			echo "<div class='article clearfix'>
				<div class='post_info'>
				<ul>
				<li>".$row_blog_comment['date']."</li>
				<li class='label'>Posted By:</li>
				<li class='link'><a href='/?section=viewprofile&name={$bbcode->Parse($row_blog_comment["author"])}'>{$bbcode->Parse($row_blog_comment["author"])}</a></li>";
			*/
			
			echo "<div class='article clearfix'>
				<div class='post_info'>
				<ul>
				<li class='link'><span class='link'><a href='javascript: void(0)'>{$bbcode->Parse($row_blog_comment["date"])}<span>{$bbcode->Parse($row_blog_comment["time"])}</span></a></span></li>
				<li class='label'>Posted By:</li>
				<li class='link'><a href='#'>{$bbcode->Parse($row_blog_comment["author"])}</a></li>
				<li class='label'>Group:</li>";
				$comment_user_information_select = mysql_query("SELECT hosting_user_join,hosting_user_online_status,hosting_user_title FROM hosting_user WHERE hosting_user_name = '".$row_blog_comment['author']."' ");
				while ($comment_user_information = mysql_fetch_array($comment_user_information_select))
				{
					echo "<li class='link'><a href='#'>{$comment_user_information['hosting_user_title']}</a></li>";
				
					echo "<li class='label'>{$lang['BODY_FORUM_THREAD_COMMENT_USER_STATUS']}:</li>";
				
					if ($comment_user_information['hosting_user_online_status'] == "yes")
					{
						echo "<li class='link'><a href='#'>".$lang['BODY_PROFILE_STATUS_ONLINE']."</li></a>";
					}
					elseif ($comment_user_information['hosting_user_online_status'] == "no")
					{
					echo "<li class='link'><a href='#'>".$lang['BODY_PROFILE_STATUS_OFFLINE']."</li></a>";
					}
							#echo '<br>'.$lang['BODY_FORUM_THREAD_COMMENT_USER_JOINED'].': '.$comment_user_information['hosting_user_join'];
				}
				echo "<li class='label'>Comments:</li>";
				$count_user_comments = mysql_query("SELECT COUNT(id) FROM comment WHERE author = '".$row_blog_comment['author']."' ");
				$user_comments = mysql_fetch_array($count_user_comments);
				echo "<li class='link'><a href='#'>".(int)$user_comments['COUNT(id)']."</li></a>";
				if ($_SESSION['permission'] == 2)
				{
					if ($row_blog_comment['author'] == $_SESSION['nick'])
					{
						echo "<li class='link'><a href='/?section=edit&id=".$id."&comment=blog&comment_id=".$row_blog_comment['id']."'>{$lang['BODY_EDIT']}</a></li>";
					}
				}
				elseif ($_SESSION['permission'] == 3)
				{
					if ($row_blog_comment['author'] == $_SESSION['nick'])
					{
						echo "<li class='link'><a href='/?section=edit&id=".$id."&comment=blog&comment_id=".$row_blog_comment['id']."'>{$lang['BODY_EDIT']}</a>"."&nbsp;"."<a href='/?section=delete&id=".$id."&vip=blog&vip_id=".$row_blog_comment['id']."'>{$lang['BODY_DELETE']}</a></li>";
					}
				}
				elseif ($_SESSION['permission'] >= 4)
				{
					echo "<li class='link'><a href='/?section=edit&id=".$id."&comment=blog&comment_id=".$row_blog_comment['id']."'>{$lang['BODY_EDIT']}</a>"."&nbsp;"."<a href='/?section=delete&id=".$id."&comment=blog&id_delete=".$row_blog_comment['id']."'>{$lang['BODY_DELETE']}</a></li>";
				}
				echo"</ul></div>
					 <div class='main_post'>
					 <p class='comment' id='comment'>{$bbcode->Parse($row_blog_comment["text"])}</p></div></div>";
		
		}
		/******  build the pagination links ******/
		// range of num links to show
		$range = 50;
		// loop to show links to range of pages around current page
		echo "<div class='pagination'><center>{$lang['BODY_PAGE_PAGINATION']}&nbsp;";
		for ($x = ($page - $range); $x < (($page + $range) + 1); $x++) 
		{
			// if it's a valid page number...
			if (($x > 0) && ($x <= $totalpages)) 
			{
				// if we're on current page...
				if ($x == $page) 
				{
					// 'highlight' it but don't make a link
					echo "$x ";
					// if not current page...
				} 
				else 
				{
					// make it a link
					echo "<a href='/?section=newsmore&id=$id&page=$x'>$x</a>&nbsp;";
				} // end else
			} // end if
		} // end for
			echo "</center></div>";
		/****** end build pagination links ******/
	}
	else
	{
		echo "<div class='pagination'>".$lang['BODY_BLOG_COMMENT_COMMENTS_NOT_YET_DONE'].'</div>';
	}
	
	if ($_SESSION['logged_in']) 
	{
		if (isset($_POST['Submit']))
		{
			$errors = array(); // set the errors array to empty, by default
			$fields = array(); // stores the field values
			$success_message = "Paldies Jï¿½su Informï¿½cija Nosï¿½tï¿½ta";
			// import the form_validation library
			require ("include/library/form_validation.php");
			$rules = array(); // stores the form_validation rules
					
			// standard form fields
			$rules[] = "required,text,{$lang['BODY_NEWS_VALIDATION_FILL_TEXT']}";
					
			$errors = validateFields($_POST, $rules);
					
			// if there were errors, re-populate the form fields
			if (!empty($errors))
			{
				$fields = $_POST;
			}
					
						// no errors! redirect the user to the thankyou page (or whatever)
			else
			{
				if (isset($_POST['token']) && $_POST['token'] == $_SESSION['token'])
				{
					$comment_text = mysql_real_escape_string($_POST['text']);
					$comment_text =	htmlentities($_POST['text']);
					#$comment_text = htmlspecialchars($_POST['text'],ENT_QUOTES);
					$comment_text = trim($_POST['text']);
					$comment_text = stripslashes($_POST['text']);
					$comment_text = addslashes($_POST['text']);
					#$comment_text = strip_script($_POST['text']);
					#$comment_text = strip_tags($_POST['text']);
					#$comment_text = bbcode_parser($_POST['text']);
								
					// process input
					#$comment_text = $myFilter->process($_POST["text"]);
					$id  = (int)$_GET['id'];
					unset($_POST['token']);
					unset($_POST['text']);
					
					if (mysql_query("INSERT INTO comment (author,date,time,text,id_blog) VALUES ('".$_SESSION['nick']."','{$date_comment}','".$time_comment."','".$comment_text."','".$id."')"))
					{
						echo "<meta http-equiv='REFRESH' content='0'/>";
					}
					else
					{
						echo "<div class='pagination'>Having Issue</div>";
					}
				}
			}
		}
		
		$token = sha1(uniqid(rand(), true));
		$_SESSION['token'] = $token;
						
		if (!empty($errors))
		{
			{
				echo "<div class='pagination'><div class='error' style='width:100%;'><b>{$lang['BODY_NEWS_VALIDATION_TEXT']}</b><br>";
				foreach ($errors as $error)
				echo "<span style='color:darkred'>$error</span><br>";
				echo "</ul></div></div>";
			}
					
			if (!empty($message))
			{
				echo "<div class='notify'>$success_message</div>";
			}
		}
					
		echo "<form id='form1' name='form1' method='post' class='pagination'>
			  <p>
			  <textarea name='text' cols='50' rows='10' id='bbcode'>{$lang['BODY_NEWS_COMMENT_HINT']}
			  </textarea>
			  <input type='hidden' name='token' value='{$token}'/>
			  <input type='hidden' name='sent' value='yes'>	
			  <p>
			  <input type='submit' name='Submit' id='button' value='{$lang['BODY_NEWS_COMMENT_SUBMIT']}' />
			  <input type='reset' name='Reset' id='button' value='{$lang['BODY_NEWS_COMMENT_RESET']}' />
			  </p>
			  </form>";
		}
}

function forum_read_more($submit_validation_check,$id,$forum_view,$count_comment,$bbcode,$lang,$redirect) 
{
	echo "<div class='forum clearfix'><div class='forum main_post'>";
		
	$submit_select_check = mysql_query("SELECT MIN(id),MAX(id) FROM forum WHERE id  = '$id'");
	while ($submit_validation_check = mysql_fetch_array($submit_select_check))
	{
		if ($submit_validation_check['MAX(id)'] == $id)
		{
			$forum_view_select = mysql_query("SELECT * FROM forum_thread WHERE forum_id = '$id' ORDER BY id ASC  ")or die (mysql_error());
				
			if (mysql_num_rows($forum_view_select) >= 1)
			{
				while ($forum_view = mysql_fetch_array($forum_view_select))
				{
					$coment_count_select = mysql_query("SELECT COUNT(id) FROM comment WHERE id_forum_topic = '".$forum_view['id']."' ") or die (mysql_error());
					$count_comment = mysql_fetch_array($coment_count_select);
					
					$bbcode = new BBCode;

					if ($forum_view['show'] == 'yes')
					{
						echo "<div class='quote'>
						  	<div class='bubble'>												
						  		<h2><a href='/?section=forumtopic&id=".$forum_view['id']."'>{$bbcode->Parse($forum_view["title"])}</a></h2>
						  	</div>
								
						  	<div class='arrow_h'>
						  		<img class='arrow' src='images/arrow.png' />
						  	</div>
																																	
						  	<p><a href='/?section=viewprofile&name={$bbcode->Parse($forum_view["author"])}'>{$bbcode->Parse($forum_view["author"])}</a>:{$bbcode->Parse($forum_view["date"])}/Replies:{$count_comment['COUNT(id)']}</p>
						  	</div>";
					}
					else
					{
						echo "<div class='thread'>{$lang['BODY_FORUM_THREAD_NOT_YET_PUBLISHED']}</div>";
					}
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
		echo "</div></div>";	
}

function forum_sub_read_more($submit_validation_check,$id,$forum_view,$count_comment,$bbcode,$lang,$redirect)
{
	echo "<div class='forum clearfix'><div class='forum main_post'>";

	$submit_select_check = mysql_query("SELECT MIN(id),MAX(id) FROM forum WHERE id  = '$id'");
	while ($submit_validation_check = mysql_fetch_array($submit_select_check))
	{
		if ($submit_validation_check['MAX(id)'] == $id)
		{
			$forum_view_select = mysql_query("SELECT * FROM forum_thread WHERE forum_sub_id = '$id' ORDER BY id ASC  ")or die (mysql_error());

			if (mysql_num_rows($forum_view_select) >= 1)
			{
				while ($forum_view = mysql_fetch_array($forum_view_select))
				{
					$coment_count_select = mysql_query("SELECT COUNT(id) FROM comment WHERE id_forum_sub_topic = '".$forum_view['id']."' ") or die (mysql_error());
					$count_comment = mysql_fetch_array($coment_count_select);
						
					$bbcode = new BBCode;

					if ($forum_view['show'] == 'yes')
					{
						echo "<div class='quote'>
						  	<div class='bubble'>
						  		<h2><a href='/?section=forumsubtopic&id=".$forum_view['id']."'>{$bbcode->Parse($forum_view["title"])}</a></h2>
						  		</div>

						  		<div class='arrow_h'>
						  		<img class='arrow' src='images/arrow.png' />
						  		</div>
						  			
						  		<p><a href='/?section=viewprofile&name={$bbcode->Parse($forum_view["author"])}'>{$bbcode->Parse($forum_view["author"])}</a>:{$bbcode->Parse($forum_view["date"])}/Replies:{$count_comment['COUNT(id)']}</p>
						  		</div>";
					}
					else
					{
						echo "<div class='thread'>{$lang['BODY_FORUM_THREAD_NOT_YET_PUBLISHED']}</div>";
					}
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
		echo "</div></div>";
}

function forum_topic_read_more($id,$forum_view,$bbcode,$comment_user_information,$user_comments,$redirect) 
{
	$forum_view_select = mysql_query("SELECT * FROM forum_thread WHERE id = '$id' ");
	if (mysql_num_rows($forum_view_select) != 0)
	{
		while ($forum_view = mysql_fetch_array($forum_view_select))
		{
			$bbcode = new BBCode;
			echo "<div class='forum article clearfix'><div class='forum main_post'><h1><a href='#'>".$bbcode->Parse($forum_view["title"])."</a></h1>
                    <div class='quote'>
						<div class='bubble'>
                        	<h2>
                        		<a href='#'>
                                	<span></span>{$bbcode->Parse($forum_view["text"])}<span></span>
                                </a>
							</h2>
                        </div>
                        <div class='arrow_h'>
							<img class='arrow' src='images/arrow.png' />
                        </div>
                    	<p><a href='/?section=viewprofile&name={$bbcode->Parse($forum_view["author"])}'>{$bbcode->Parse($forum_view["author"])}</a>:{$bbcode->Parse($forum_view["date"])} |";
				$comment_user_information_select = mysql_query("SELECT hosting_user_join,hosting_user_online_status,hosting_user_title FROM hosting_user WHERE hosting_user_name = '".$forum_view['author']."' ");
				$comment_user_information = mysql_fetch_array($comment_user_information_select);
				
				echo " ".$bbcode->Parse($comment_user_information["hosting_user_title"])."| ";
				$count_user_comments = mysql_query("SELECT COUNT(id) FROM forum_thread WHERE author = '".$forum_view['author']."'");
				$user_comments = mysql_fetch_array($count_user_comments);
				echo "Posts ".(int)$user_comments['COUNT(id)'];
                    
                    	echo "</p>
                    </div>
                    <ul class='social'>
                    	<li><em>Share:</em></li>
                    	<li><a href='#' class='icons twitter'></a></li>
                    	<li><a href='#' class='icons facebook'></a></li>
                    	<li><a href='#' class='icons google'></a></li>
                    	<li><a href='#' class='icons myspace'></a></li>
                    	<li><a href='#' class='icons email'></a></li>
                    </ul>
				</div></div>";
		}
	}
	else 
	{
		echo $redirect;
	}
}

function forum_sub_topic_read_more($id,$forum_view,$bbcode,$comment_user_information,$user_comments,$redirect)
{
	$forum_view_select = mysql_query("SELECT * FROM forum_thread WHERE id = '$id' ");
	if (mysql_num_rows($forum_view_select) != 0)
	{
		while ($forum_view = mysql_fetch_array($forum_view_select))
		{
			$bbcode = new BBCode;
			echo "<div class='forum article clearfix'><div class='forum main_post'><h1><a href='#'>".$bbcode->Parse($forum_view["title"])."</a></h1>
			<div class='quote'>
			<div class='bubble'>
			<h2>
			<a href='#'>
			<span></span>{$bbcode->Parse($forum_view["text"])}<span></span>
			</a>
			</h2>
			</div>
			<div class='arrow_h'>
			<img class='arrow' src='images/arrow.png' />
			</div>
			<p><a href='/?section=viewprofile&name={$bbcode->Parse($forum_view["author"])}'>{$bbcode->Parse($forum_view["author"])}</a>:{$bbcode->Parse($forum_view["date"])} |";
			$comment_user_information_select = mysql_query("SELECT hosting_user_join,hosting_user_online_status,hosting_user_title FROM hosting_user WHERE hosting_user_name = '".$forum_view['author']."' ");
				$comment_user_information = mysql_fetch_array($comment_user_information_select);

				echo " ".$bbcode->Parse($comment_user_information["hosting_user_title"])."| ";
				$count_user_comments = mysql_query("SELECT COUNT(id) FROM forum_thread WHERE author = '".$forum_view['author']."'");
				$user_comments = mysql_fetch_array($count_user_comments);
				echo "Posts ".(int)$user_comments['COUNT(id)'];

				echo "</p>
				</div>
                    <ul class='social'>
						<li><em>Share:</em></li>
						<li><a href='#' class='icons twitter'></a></li>
						<li><a href='#' class='icons facebook'></a></li>
				<li><a href='#' class='icons google'></a></li>
                    	<li><a href='#' class='icons myspace'></a></li>
                    	<li><a href='#' class='icons email'></a></li>
                    </ul>
				</div></div>";
		}
	}
	else
	{
		echo $redirect;
	}
}

function forum_topic_read_more_comment($id,$forum_view_check,$comment_limit,$forum_comment_thread,$bbcode,$comment_user_information,$user_comments,$lang,$date_comment,$time_comment,$errors,$error,$token) 
{
	$forum_check_view_select = mysql_query("SELECT id FROM forum_thread WHERE id = '$id' ");
	while ($forum_view_check = mysql_fetch_array($forum_check_view_select))
	if ($forum_view_check['id'] > "") 
	{
		$sql = "SELECT COUNT(id) FROM comment WHERE id_forum_topic = '$id' ORDER BY id";
		$result = mysql_query($sql);
		$r = mysql_fetch_row($result);
		$numrows = $r[0];
		
		// find out total pages
		$totalpages = ceil($numrows / $comment_limit);
		
		if ((isset($_GET['page'])) && (ctype_digit($_GET['page'])))		
		{
			$page = (int)$_GET['page'];
		}
		else 
		{
			$page = 1;
		}
		// if current page is greater than total pages...
		if ($page > $totalpages) 
		{
		// set current page to last page
		 	$page = $totalpages;
		} // end if
		// if current page is less than first page...
		if ($page < 1) 
		{
		// set current page to first page
			$page = 1;
		} // end if
	
		// the offset of the list, based on current page 
		$offset = ($page - 1) * $comment_limit;
		
		$comment_forum = mysql_query("SELECT id ,id_forum_topic,text,author,date,time FROM comment WHERE id_forum_topic = '$id' "."limit $offset, $comment_limit") or die(mysql_error());
		if (mysql_num_rows($comment_forum) != 0)
		{
			while ($forum_comment_thread = mysql_fetch_array($comment_forum))
			{
				$bbcode = new BBCode;
				echo "<div class='article clearfix'>
            	<div class='post_info'>
                	<ul>
                		<li class='link'><span class='link'><a href='javascript: void(0)'>{$bbcode->Parse($forum_comment_thread["date"])}<span>{$bbcode->Parse($forum_comment_thread["time"])}</span></a></span></li>
                		<li class='label'>Posted By:</li>
                		<li class='link'><a href='#'>{$bbcode->Parse($forum_comment_thread["author"])}</a></li>
                		<li class='label'>Group:</li>";
					$comment_user_information_select = mysql_query("SELECT hosting_user_join,hosting_user_online_status,hosting_user_title FROM hosting_user WHERE hosting_user_name = '".$forum_comment_thread['author']."' ");
					while ($comment_user_information = mysql_fetch_array($comment_user_information_select))
					{
	                       echo "<li class='link'><a href='#'>{$comment_user_information['hosting_user_title']}</a></li>";
	
								echo "<li class='label'>{$lang['BODY_FORUM_THREAD_COMMENT_USER_STATUS']}:</li>";
								
								if ($comment_user_information['hosting_user_online_status'] == "yes")
								{
									echo "<li class='link'><a href='#'>".$lang['BODY_PROFILE_STATUS_ONLINE']."</li></a>";
								}
								elseif ($comment_user_information['hosting_user_online_status'] == "no")
								{
									echo "<li class='link'><a href='#'>".$lang['BODY_PROFILE_STATUS_OFFLINE']."</li></a>";
								}
									#echo '<br>'.$lang['BODY_FORUM_THREAD_COMMENT_USER_JOINED'].': '.$comment_user_information['hosting_user_join'];
					}
                		echo "<li class='label'>Comments:</li>";
                		$count_user_comments = mysql_query("SELECT COUNT(id) FROM comment WHERE author = '".$forum_comment_thread['author']."' ");
                		$user_comments = mysql_fetch_array($count_user_comments);
                		echo "<li class='link'><a href='#'>".(int)$user_comments['COUNT(id)']."</li></a>";
                		if ($_SESSION['permission'] == 2)
                		{
                			if ($forum_comment_thread['author'] == $_SESSION['nick'])
                			{
                				echo "<li class='label'>Manage:</li><li class='link'><a href='/?section=edit&id=".$id."&comment=forum&comment_id=".$forum_comment_thread['id']."'>{$lang['BODY_EDIT']}</a></li>";
                			}
                		}
                		elseif ($_SESSION['permission'] == 3)
                		{
                			if ($forum_comment_thread['author'] == $_SESSION['nick'])
                			{
                				echo "<li class='label'>Manage:</li><li class='link'><a href='/?section=edit&id=".$id."&comment=forum&comment_id=".$forum_comment_thread['id']."'>{$lang['BODY_EDIT']}</a>"."&nbsp;"."<a href='/?section=delete&id=".$id."&vip=forum&vip_id=".$forum_comment_thread['id']."'>{$lang['BODY_DELETE']}</a></li>";
                			}
                		}
                		elseif ($_SESSION['permission'] >= 4)
                		{
                			echo "<li class='label'>Manage:</li><li class='link'><a href='/?section=edit&id=".$id."&comment=forum&comment_id=".$forum_comment_thread['id']."'>{$lang['BODY_EDIT']}</a>"."&nbsp;"."<a href='/?section=delete&id=".$id."&comment=forum&id_delete=".$forum_comment_thread['id']."'>{$lang['BODY_DELETE']}</a></li>";
                		}
                	echo "</ul>
	                </div>
	                <div class='main_post'><p>{$bbcode->Parse($forum_comment_thread["text"])}</p></div>
	            </div>";
			}
					
			/******  build the pagination links ******/
				// range of num links to show
				$range = 50;
				// loop to show links to range of pages around current page
				echo "<div class='pagination'><center>{$lang['BODY_PAGE_PAGINATION']}&nbsp;";
				for ($x = ($page - $range); $x < (($page + $range) + 1); $x++) 
				{
				   // if it's a valid page number...
				   if (($x > 0) && ($x <= $totalpages)) 
				   {
					  // if we're on current page...
					  if ($x == $page) 
					  {
						 // 'highlight' it but don't make a link
						 echo "$x ";
					  // if not current page...
					  } 
					  else 
					  {
						 // make it a link
						 echo "<a href='/?section=forumtopic&id=$id&page=$x'>$x</a>&nbsp;";
					  } // end else
				   } // end if 
				} // end for   
				echo "</center></div>";
				/****** end build pagination links ******/	
		}
		else 
		{
			echo "<div class='pagination'>{$lang['BODY_FORUM_THREAD_COMMENT_NOT_YET_DONE']}</div>";	
		}

		if ($_SESSION['logged_in']) 
		{
			if (isset($_POST['submit']))
			{
				$errors = array(); // set the errors array to empty, by default
				$fields = array(); // stores the field values
				$success_message = "Paldies Jûsu Informâcija Nosûtîta";	
				// import the validation library
				#require("include/validation.php");
				require ("include/library/form_validation.php");
				$rules = array(); // stores the validation rules
			
				// standard form fields
				$rules[] = "required,text,{$lang['BODY_FORUM_THREAD_COMMENT_VALIDATION_FILL_TEXT']}";
			  
				$errors = validateFields($_POST, $rules);
			
				// if there were errors, re-populate the form fields
				if (!empty($errors))
				{  
					$fields = $_POST;
				}
			  
				// no errors! redirect the user to the thankyou page (or whatever)
				else 
				{
					if (isset($_POST['token']) && $_POST['token'] == $_SESSION['token'])
			  		{
						$forum_thread_text = mysql_real_escape_string($_POST['text']);
						$forum_thread_text = htmlentities($_POST['text']);
						$forum_thread_text = trim($_POST['text']);
						$forum_thread_text = stripslashes($_POST['text']);
						$forum_thread_text = addslashes($_POST['text']);
						
						// process input
						#$forum_thread_text = $myFilter->process($_POST["text"]);
						unset($_POST['token']);
						 	
						/*
						$forum_thread_insert = "INSERT INTO comment (id_forum_topic,author,text,date) VALUES ('".$id."','".$_SESSION['nick']."','".$forum_thread_text."','".$date_comment."') ";
						mysql_query($forum_thread_insert);
				  		{
					    	echo "<meta http-equiv='REFRESH' content='0'/>"; 
				  		}
				  		*/
				  		
				  		if (mysql_query("INSERT INTO comment (id_forum_topic,author,text,date,time) VALUES ('".$id."','".$_SESSION['nick']."','".$forum_thread_text."','".$date_comment."','".$time_comment."')")) 
				  		{
				  			echo "<meta http-equiv='REFRESH' content='0'/>"; 
				  		}
				  		else
				  		{
				  			echo "<div class='pagination'>Having Issue</div>";
				  		}
			  		}
				}		
			}		
				
			$token = sha1(uniqid(rand(), true));
			$_SESSION['token'] = $token;
		
		    if (!empty($errors))
			{
		    	{
		      		echo "<div class='error' style='width:100%;'><b>{$lang['BODY_FORUM_THREAD_VALIDATION_TEXT']}</b><br>";
		      		foreach ($errors as $error)
		        	echo "<span style='color:darkred'>$error</span><br>";
		    
		      		echo "</ul></div>"; 
		    	}
		    
		    if (!empty($message))
		    	{
		      		echo "<div class='notify'>$success_message</div>";
		    	}
			}
			
			echo "<form name'forum_thread_comment' method='post'  class='pagination'>
				  <textarea name='text' id='textarea1' cols='60' rows='10' value='{$fields['forum_thread_text']}'></textarea><br />
				  <input type='hidden' name='token' value='{$token}'/> 
				  <input name='submit' type='submit' id='submit' value='{$lang['BODY_FORUM_THREAD_COMMENT_BUTTON_SUBMIT']}' />
				  <input type='reset' name='Reset' id='button' value='{$lang['BODY_FORUM_THREAD_COMMENT_BUTTON_RESET']}' />
				  </form>
				";
		}
	}
	else
	{
		echo $redirect;
	}
}

function forum_sub_topic_read_more_comment($id,$forum_view_check,$comment_limit,$forum_comment_thread,$bbcode,$comment_user_information,$user_comments,$lang,$date_comment,$time_comment,$errors,$error,$token)
{
	$forum_check_view_select = mysql_query("SELECT id FROM forum_thread WHERE id = '$id' ");
	while ($forum_view_check = mysql_fetch_array($forum_check_view_select))
	if ($forum_view_check['id'] > "")
	{
			$sql = "SELECT COUNT(id) FROM comment WHERE id_forum_sub_topic = '$id' ORDER BY id";
			$result = mysql_query($sql);
			$r = mysql_fetch_row($result);
			$numrows = $r[0];

			// find out total pages
			$totalpages = ceil($numrows / $comment_limit);

			if ((isset($_GET['page'])) && (ctype_digit($_GET['page'])))
			{
				$page = (int)$_GET['page'];
			}
			else
			{
				$page = 1;
			}
			// if current page is greater than total pages...
			if ($page > $totalpages)
			{
				// set current page to last page
		 	$page = $totalpages;
			} // end if
			// if current page is less than first page...
			if ($page < 1)
			{
				// set current page to first page
				$page = 1;
			} // end if

			// the offset of the list, based on current page
			$offset = ($page - 1) * $comment_limit;

			$comment_forum = mysql_query("SELECT id ,id_forum_topic,text,author,date,time FROM comment WHERE id_forum_sub_topic = '$id' "."limit $offset, $comment_limit") or die(mysql_error());
			if (mysql_num_rows($comment_forum) != 0)
			{
				while ($forum_comment_thread = mysql_fetch_array($comment_forum))
				{
					$bbcode = new BBCode;
					echo "<div class='article clearfix'>
					<div class='post_info'>
					<ul>
					<li class='link'><span class='link'><a href='javascript: void(0)'>{$bbcode->Parse($forum_comment_thread["date"])}<span>{$bbcode->Parse($forum_comment_thread["time"])}</span></a></span></li>
							<li class='label'>Posted By:</li>
							<li class='link'><a href='#'>{$bbcode->Parse($forum_comment_thread["author"])}</a></li>
							<li class='label'>Group:</li>";
							$comment_user_information_select = mysql_query("SELECT hosting_user_join,hosting_user_online_status,hosting_user_title FROM hosting_user WHERE hosting_user_name = '".$forum_comment_thread['author']."' ");
					while ($comment_user_information = mysql_fetch_array($comment_user_information_select))
					{
						echo "<li class='link'><a href='#'>{$comment_user_information['hosting_user_title']}</a></li>";
	
						echo "<li class='label'>{$lang['BODY_FORUM_THREAD_COMMENT_USER_STATUS']}:</li>";
	
						if ($comment_user_information['hosting_user_online_status'] == "yes")
						{
							echo "<li class='link'><a href='#'>".$lang['BODY_PROFILE_STATUS_ONLINE']."</li></a>";
						}
						elseif ($comment_user_information['hosting_user_online_status'] == "no")
						{
							echo "<li class='link'><a href='#'>".$lang['BODY_PROFILE_STATUS_OFFLINE']."</li></a>";
						}
							#echo '<br>'.$lang['BODY_FORUM_THREAD_COMMENT_USER_JOINED'].': '.$comment_user_information['hosting_user_join'];
					}
						echo "<li class='label'>Comments:</li>";
						$count_user_comments = mysql_query("SELECT COUNT(id) FROM comment WHERE author = '".$forum_comment_thread['author']."' ");
						$user_comments = mysql_fetch_array($count_user_comments);
                		echo "<li class='link'><a href='#'>".(int)$user_comments['COUNT(id)']."</li></a>";
                		if ($_SESSION['permission'] == 2)
                		{
                			if ($forum_comment_thread['author'] == $_SESSION['nick'])
                			{
                				echo "<li class='label'>Manage:</li><li class='link'><a href='/?section=edit&id=".$id."&comment=forum&comment_id=".$forum_comment_thread['id']."'>{$lang['BODY_EDIT']}</a></li>";
                			}
                		}
                				elseif ($_SESSION['permission'] == 3)
						{
							if ($forum_comment_thread['author'] == $_SESSION['nick'])
                			{
                				echo "<li class='label'>Manage:</li><li class='link'><a href='/?section=edit&id=".$id."&comment=forum&comment_id=".$forum_comment_thread['id']."'>{$lang['BODY_EDIT']}</a>"."&nbsp;"."<a href='/?section=delete&id=".$id."&vip=forum&vip_id=".$forum_comment_thread['id']."'>{$lang['BODY_DELETE']}</a></li>";
                			}
                		}
                		elseif ($_SESSION['permission'] >= 4)
                		{
                			echo "<li class='label'>Manage:</li><li class='link'><a href='/?section=edit&id=".$id."&comment=forum&comment_id=".$forum_comment_thread['id']."'>{$lang['BODY_EDIT']}</a>"."&nbsp;"."<a href='/?section=delete&id=".$id."&comment=forum&id_delete=".$forum_comment_thread['id']."'>{$lang['BODY_DELETE']}</a></li>";
                		}
                			echo "</ul>
                			</div>
                					<div class='main_post'><p>{$bbcode->Parse($forum_comment_thread["text"])}</p></div>
                			</div>";
				}
					
				/******  build the pagination links ******/
				// range of num links to show
				$range = 50;
				// loop to show links to range of pages around current page
				echo "<div class='pagination'><center>{$lang['BODY_PAGE_PAGINATION']}&nbsp;";
				for ($x = ($page - $range); $x < (($page + $range) + 1); $x++)
				{
					// if it's a valid page number...
					if (($x > 0) && ($x <= $totalpages))
					{
						// if we're on current page...
						if ($x == $page)
						{
							// 'highlight' it but don't make a link
							echo "$x ";
							// if not current page...
						}
						else
						{
							// make it a link
							echo "<a href='/?section=forumtopic&id=$id&page=$x'>$x</a>&nbsp;";
						} // end else
					} // end if
				} // end for
				echo "</center></div>";
				/****** end build pagination links ******/
				}
				else
				{
					echo "<div class='pagination'>{$lang['BODY_FORUM_THREAD_COMMENT_NOT_YET_DONE']}</div>";
				}

		if ($_SESSION['logged_in'])
		{
			if (isset($_POST['submit']))
			{
						$errors = array(); // set the errors array to empty, by default
						$fields = array(); // stores the field values
						$success_message = "Paldies Jûsu Informâcija Nosûtîta";
						// import the validation library
						#require("include/validation.php");
						require ("include/library/form_validation.php");
						$rules = array(); // stores the validation rules
		
						// standard form fields
						$rules[] = "required,text,{$lang['BODY_FORUM_THREAD_COMMENT_VALIDATION_FILL_TEXT']}";
			
						$errors = validateFields($_POST, $rules);
											
						// if there were errors, re-populate the form fields
						if (!empty($errors))
						{
							$fields = $_POST;
						}
							
						// no errors! redirect the user to the thankyou page (or whatever)
						else
						{
							if (isset($_POST['token']) && $_POST['token'] == $_SESSION['token'])
							{
								$forum_thread_text = mysql_real_escape_string($_POST['text']);
								$forum_thread_text = htmlentities($_POST['text']);
								$forum_thread_text = trim($_POST['text']);
								$forum_thread_text = stripslashes($_POST['text']);
								$forum_thread_text = addslashes($_POST['text']);
		
								// process input
								#$forum_thread_text = $myFilter->process($_POST["text"]);
								unset($_POST['token']);
		
								/*
								$forum_thread_insert = "INSERT INTO comment (id_forum_topic,author,text,date) VALUES ('".$id."','".$_SESSION['nick']."','".$forum_thread_text."','".$date_comment."') ";
								mysql_query($forum_thread_insert);
								{
								echo "<meta http-equiv='REFRESH' content='0'/>";
								}
								*/
		
								if (mysql_query("INSERT INTO comment (id_forum_sub_topic,author,text,date,time) VALUES ('".$id."','".$_SESSION['nick']."','".$forum_thread_text."','".$date_comment."','".$time_comment."')"))
								{
								echo "<meta http-equiv='REFRESH' content='0'/>";
						  		}
						  		else
						  		{
						  		echo "<div class='pagination'>Having Issue</div>";
								}
							}
						}
			}

						$token = sha1(uniqid(rand(), true));
			$_SESSION['token'] = $token;

		    if (!empty($errors))
		    {
		    	{
		      		echo "<div class='error' style='width:100%;'><b>{$lang['BODY_FORUM_THREAD_VALIDATION_TEXT']}</b><br>";
		      		foreach ($errors as $error)
		        	echo "<span style='color:darkred'>$error</span><br>";

		        	echo "</ul></div>";
		      	}

			    if (!empty($message))
			    {
			   		echo "<div class='notify'>$success_message</div>";
			    }
		    }
		      			
		      		echo "<form name'forum_thread_comment' method='post'  class='pagination'>
		      		<textarea name='text' id='textarea1' cols='60' rows='10' value='{$fields['forum_thread_text']}'></textarea><br />
		      		<input type='hidden' name='token' value='{$token}'/>
		      		<input name='submit' type='submit' id='submit' value='{$lang['BODY_FORUM_THREAD_COMMENT_BUTTON_SUBMIT']}' />
		      		<input type='reset' name='Reset' id='button' value='{$lang['BODY_FORUM_THREAD_COMMENT_BUTTON_RESET']}' />
		      		</form>";
		}
	}
	else
	{
		echo $redirect;
	}
}


function download_more($id,$download_validation_check,$redirect) 
{
	if ($id = ((isset($_GET['id'])) && (ctype_digit($_GET['id'])) ? (int)$_GET['id'] : ''))
	{
		$select_download_check = mysql_query("SELECT MIN(id),MAX(id) FROM download_category WHERE id  = '$id'");
		while ($download_validation_check = mysql_fetch_array($select_download_check))
		{
			if ($download_validation_check['MAX(id)'] == $id)
			{
				if ($_SESSION['logged_in'])
				{
					if ($_SESSION['permission'] >=4)
					{								
						echo "<div class='download clearfix'>
						<div class='download main_download_top'>
						<p><a href='?section=downloadaddgroup&id={$id}'>Add Game Category</a></p>
						</div>
						</div>";
					}
				}
					
				$select_download_category = mysql_query("SELECT * FROM download_category WHERE download_game_id = '".$id."' ");
				if (mysql_num_rows($select_download_category) >= 1) 
				{
					while ($download_category = mysql_fetch_array($select_download_category))
					{
						$select_download_game = mysql_query("SELECT * FROM download_game WHERE id = '".$download_category['download_game_id']."' ");
						while($download_game = mysql_fetch_array($select_download_game))
						{	
							echo "<div class='download clearfix'>
							
									  <div class='download post_download_icon'>
										  <ul>
											  <li class='link'><a href='?section=downloadgroup&id={$download_category['id']}'><img src='{$download_game['icon']}'  title='{$download_game['name']}'/></a></li>
										</ul>
									  </div>
							
										<div class='download main_download'>
							
										<p>{$download_category['name']}";
							
							if ($_SESSION['logged_in'])
							{
								if ($_SESSION['permission'] >= 4)
								{
									echo " <a href='?section=edit&id={$download_category['id']}&downloadgroup=edit&id={$download_category['id']}'>Edit</a> <a href='?section=delete&id={$download_category['id']}&download=category&id_delete={$download_category['id']}'>Delete</a>";
								}
							}
							echo "</p></div></div>";
						}
					}
				}
				else
				{
					echo "empty";
				}
			}
			else
			{
				echo $redirect;
			}
		}
	}
	else
	{
		echo $redirect;
	}
}

function download_group($id,$redirect) 
{
	if ($id = ((isset($_GET['id'])) && (ctype_digit($_GET['id'])) ? (int)$_GET['id'] : ''))
	{
		$select_download_check = mysql_query("SELECT MIN(id),MAX(id) FROM download_category WHERE id  = '$id'");
		while ($download_validation_check = mysql_fetch_array($select_download_check))
		{
			if ($download_validation_check['MAX(id)'] == $id)
			{	
				if ($_SESSION['logged_in'])
				{
					if ($_SESSION['permission'] >= 4)
					{
						echo "<div class='download clearfix'>
									    <div class='download main_download_top'>
										  <p><a href='?section=downloadaddtopic&id={$id}'>Add Download</a></p>
											</div>
									  </div>";
					}
				}
				
				$select_download_topic = mysql_query("SELECT id,name,download_category_id,download_game_id FROM download_topic WHERE download_category_id = '".$id."' ");
				if (mysql_num_rows($select_download_topic) >= 1)
				{
					while ($download_topic = mysql_fetch_array($select_download_topic))
					{	
						$select_download_category = mysql_query("SELECT * FROM download_category WHERE id = '".$download_topic['download_category_id']."' ");
						$download_category = mysql_fetch_array($select_download_category);
					
							$select_download_game = mysql_query("SELECT * FROM download_game WHERE id = '".$download_category['download_game_id']."' ");
							while($download_game = mysql_fetch_array($select_download_game))
							{
								echo "<div class='download clearfix'>
						
										  <div class='download post_download_icon'>
											  <ul>
												  <li class='link'><a href='?section=downloadtopic&id={$download_topic['id']}'><img src='{$download_game['icon']}'  title='{$download_game['name']}'/></a></li>
											</ul>
										  </div>
						                    
											<div class='download main_download'>
												<p>{$download_topic['name']}";
								if ($_SESSION['logged_in']) 
								{
									if ($_SESSION['permission'] >= 4) 
									{
										echo " <a href='?section=edit&id={$download_topic['id']}&downloadtopic=edit&id={$download_topic['id']}'>Edit</a> <a href='?section=delete&id={$download_topic['id']}&download=topic&id_delete={$download_topic['id']}'>Delete</a>";
									}
								}
								echo "</p></div></div>";
							}
					}
				}
				else
				{
					echo "No Topic";
				}
			}
			else
			{
				echo $redirect;
			}
		}
	}
	else
	{
		echo $redirect;
	}
}

function download_topic($id,$lang,$redirect) 
{
	if ($id = ((isset($_GET['id'])) && (ctype_digit($_GET['id'])) ? (int)$_GET['id'] : ''))
	{
		$select_download_check = mysql_query("SELECT MIN(id),MAX(id) FROM download_topic WHERE id  = '$id'");
		while ($download_validation_check = mysql_fetch_array($select_download_check))
		{
			if ($download_validation_check['MAX(id)'] == $id)
			{	
				$select_download_topic = mysql_query("SELECT * FROM download_topic WHERE id = '".$id."'");
				while ($download_topic = mysql_fetch_array($select_download_topic))
				{
					$bbcode = new BBCode;
					echo "<div class='download clearfix'>
				          <div class='download main_download_title'>
										
										<p class='download_topic_title'>{$download_topic['name']} {$download_topic['type']}</p>
				                </div>
							  </div>
				        <div class='download clearfix'>
				            	<div class='post_info'>
				                	<ul>
				                		<li>{$download_topic['date']}</li>
				                		<li class='label'>Posted By:</li>
				                		<li class='link'><a href='#'>{$bbcode->Parse($download_topic["author"])}</a></li>
				                        <li class='label'>Group:</li>";
										$comment_user_information_select = mysql_query("SELECT hosting_user_join,hosting_user_online_status,hosting_user_title FROM hosting_user WHERE hosting_user_name = '".$download_topic['author']."' ");
										while ($comment_user_information = mysql_fetch_array($comment_user_information_select))
										{
						                       echo "<li class='link'><a href='#'>{$comment_user_information['hosting_user_title']}</a></li>";
						
													echo "<li class='label'>{$lang['BODY_FORUM_THREAD_COMMENT_USER_STATUS']}:</li>";
													
													if ($comment_user_information['hosting_user_online_status'] == "yes")
													{
														echo "<li class='link'><a href='#'>".$lang['BODY_PROFILE_STATUS_ONLINE']."</li></a>";
													}
													elseif ($comment_user_information['hosting_user_online_status'] == "no")
													{
														echo "<li class='link'><a href='#'>".$lang['BODY_PROFILE_STATUS_OFFLINE']."</li></a>";
													}
										}
					                	echo "
					                	<li class='label'>Version:</li>
				                        <li class='link'><a href='#'>{$download_topic['version']}</a></li>
				                        <li class='label'>Build:</li>
				                        <li class='link'><a href='#'>{$download_topic['build']}</a></li>
				                        <li class='label'>Size</li>
				                        <li class='link'><a href='#'>{$download_topic['size']}</a></li>
				                        <li class='label'>Download:</li>";
					                	#in_array(".download_topic['link'].", "#");
				                   #  echo "<pre>";
					                #	print_r($download_topic['link']);
					                	##echo "</pre>";
					                	function download_link_filter($download_topic) 
					                	{
											#Direct Link
					                		if ($download_topic['link'] == "#")
					                		{
					                			;
					                		}
					                		elseif ($download_topic['link'] !== "#")
					                		{
					                			echo "<li class='link'><a href='{$download_topic['link_mirror']}'>Direct</a></li>";
					                		}
					                		#Mirror Link
						                		if ($download_topic['link_mirror'] == "#")
						                		{
						                			 ;
						                		}
						                		elseif ($download_topic['link_mirror'] !== "#")
						                		{
						                			echo "<li class='link'><a href='{$download_topic['link_mirror']}'>Miror I</a></li>";
						                		}
						                		#Mirror Link2
							                		if ($download_topic['link_mirror2'] == "#")
							                		{
							                			 ;
							                		}
							                		elseif ($download_topic['link_mirror2'] !== "#")
							                		{
							                			echo "<li class='link'><a href='{$download_topic['link_mirror']}'>Miror II</a></li>";
							                		}
							                		#Mirror Torrent
								                		if ($download_topic['link_torrent'] == "#")
								                		{
								                			 ;
								                		}
								                		elseif ($download_topic['link_torrent'] !== "#")
								                		{
								                			echo "<li class='link'><a href='{$download_topic['link_torrent']}'>Torrent</a></li>";
								                		}
						                				#Mirror Wuala
									                		if ($download_topic['link_wuala'] == "#")
									                		{
									                			 ;
									                		}
									                		elseif ($download_topic['link_wuala'] !== "#")
									                		{
									                			echo "<li class='link'><a href='{$download_topic['link_wuala']}'>Wuala</a></li>";
									                		}
								                			#Mirror Dropbox
										                		if ($download_topic['link_dropbox'] == "#")
										                		{
										                			 ;
										                		}
										                		elseif ($download_topic['link_dropbox'] !== "#")
										                		{
										                			echo "<li class='link'><a href='{$download_topic['link_dropbox']}'>Dropbox</a></li>";
										                		}
									                			#Mirror Skydrive
											                		if ($download_topic['link_skydrive'] == "#")
											                		{
											                			 ;
											                		}
											                		elseif ($download_topic['link_skydrive'] !== "#")
											                		{
											                			echo "<li class='link'><a href='{$download_topic['link_skydrive']}'>SkyDrive</a></li>";
											                		}
								                					#Mirror Mega
												                		if ($download_topic['link_mega'] == "#")
												                		{
												                			 ;
												                		}
												                		elseif ($download_topic['link_mega'] !== "#")
												                		{
												                			echo "<li class='link'><a href='{$download_topic['link_mega']}'>Mega</a></li>";
												                		}
					                	}

					                	download_link_filter($download_topic);
					                	
				                       #Comments still in devlopment
				                      #  echo "<li class='label'>Comments:</li>
				                		#<li class='link'><a href='#'>5 Comments</a></li>
				                		echo "
				                	</ul>
				                </div>
				                
				                <div class=' main_post' id='download_topic_description'>
				                  <p>{$bbcode->Parse($download_topic['description'])} </p>
				                </div>
				            </div>";
				}
			}
			else
			{
				echo $redirect;
			}
		}
	}
	else
	{
		echo $redirect;
	}
}