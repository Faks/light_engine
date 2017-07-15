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

		echo "<div align='center' class='thread'>{$lang['BODY_FORUM_TITLE']}</div><br>";
		echo "<table width='900' border='1' align='center' cellpadding='0' cellspacing='0'>";
		$forum_view_select = mysql_query("SELECT * FROM hosting_forum_thread WHERE hosting_forum_thread_id = '$id' ");
		if (mysql_num_rows($forum_view_select) != 0)
		{
			while ($forum_view = mysql_fetch_array($forum_view_select))
			{
				
				echo "<tr><td width='200' valign='top'><b><a href='/?section=viewprofile&name={$forum_view['hosting_forum_thread_author']}'>{$forum_view['hosting_forum_thread_author']}</a></b><br>{$lang['BODY_FORUM_THREAD_COMMENT_USER_JOINED']}";
				$user_information_select = mysql_query("SELECT hosting_user_join,hosting_user_online_status FROM hosting_user WHERE hosting_user_name = '".$forum_view['hosting_forum_thread_author']."' ");
				while ($user_information = mysql_fetch_array($user_information_select))
				{
				#{$lang['BODY_FORUM_THREAD_COMMENT_USER_REPUTATION']}
					echo ': '.$user_information['hosting_user_join'];
					echo "<br>{$lang['BODY_FORUM_THREAD_COMMENT_USER_STATUS']}";
						
					if ($user_information['hosting_user_online_status'] == "yes") 
					{
						echo ': '.$lang['BODY_PROFILE_STATUS_ONLINE'];
					}
					elseif ($user_information['hosting_user_online_status'] == "no") 
					{
						echo ': '.$lang['BODY_PROFILE_STATUS_OFFLINE'];
					}
				}
				echo "</td><td width='600' valign='top'>".$forum_view['hosting_forum_thread_title']."&nbsp;";
					if ($_SESSION['permission'] == 2)
					{
						if ($forum_view['hosting_forum_thread_author'] == $_SESSION['nick'])
						{
							echo "|<a href='/?section=edit&id=".$id."&comment=fbtpgedit&id_edit=".$forum_view['hosting_forum_thread_id']."'>{$lang['BODY_EDIT']}</a>"."&nbsp;";
						}
					}
					elseif ($_SESSION['permission'] == 6)
					{
						echo "|<a href='/?section=edit&id=".$id."&comment=fbtpgedit&id_edit=".$forum_view['hosting_forum_thread_id']."'>{$lang['BODY_EDIT']}</a>"."&nbsp;";
						#"<a href='/?section=forumthreadview&id=".$id."&comment=delete&id_delete=".$forum_comment_thread['hosting_comment_id']."'>{$lang['BODY_DELETE']}</a>"
					}
				 echo "<hr align='center' width='100%' />".$forum_view['hosting_forum_thread_text']."</td></tr>";
			}
		echo "</table><br>";
		}
		else 
		{
			echo $redirect;
		}
		
			
		$forum_check_view_select = mysql_query("SELECT hosting_forum_thread_id FROM hosting_forum_thread WHERE hosting_forum_thread_id = '$id' ");
		while ($forum_view_check = mysql_fetch_array($forum_check_view_select))
			if ($forum_view_check['hosting_forum_thread_id'] > "") 
			{
		$sql = "SELECT COUNT(hosting_comment_forum_thread_id) FROM hosting_comment WHERE hosting_comment_forum_thread_id = '$id' ORDER BY hosting_comment_id";
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
		$offset = ($page - 1) * $comment_limit;
		
		$comment_forum = mysql_query("SELECT hosting_comment_id ,hosting_comment_forum_thread_id,hosting_comment_text,hosting_comment_nick,hosting_comment_date FROM hosting_comment WHERE hosting_comment_forum_thread_id = '$id' "."limit $offset, $comment_limit") or die(mysql_error());
		if (mysql_num_rows($comment_forum) != 0)
		{
			while ($forum_comment_thread = mysql_fetch_array($comment_forum))
			{
			echo "<table width='900' border='1' align='center' cellpadding='0' cellspacing='0'><tr><td width='200' valign='top'>".$forum_comment_thread['hosting_comment_date']."</td>".
				
			 "<td width='600' valign='bottom'>";
					if ($_SESSION['permission'] == 2)
					{
						if ($forum_comment_thread['hosting_comment_nick'] == $_SESSION['nick'])
						{
							echo "<a href='/?section=edit&id=".$id."&comment=fbthgedit&id_edit=".$forum_comment_thread['hosting_comment_id']."'>{$lang['BODY_EDIT']}</a>"."&nbsp;";
							#."<a href='/?section=nwcomment&id=".$id."&comment=delete&id_delete=".$row_news_comment['hosting_comment_id']."'>{$lang['BODY_DELETE']}</a>"
							/*
							if ($_GET['comment'] == 'delete') 
							{
								$comment_id_delete = (INT)$_GET['id_delete'];
								mysql_query("DELETE FROM hosting_comment WHERE hosting_comment_id = '".$comment_id_delete."' AND hosting_comment_nick = '".$_SESSION['nick']."' ") or die (mysql_error());
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=nwcomment&id=".$id."'>"; 
							}
							*/
						}
					}
					elseif ($_SESSION['permission'] == 6)
					{
						echo "<a href='/?section=edit&id=".$id."&comment=fbthgedit&id_edit=".$forum_comment_thread['hosting_comment_id']."'>{$lang['BODY_EDIT']}</a>"."&nbsp;"."<a href='/?section=forumthreadview&id=".$id."&comment=delete&id_delete=".$forum_comment_thread['hosting_comment_id']."'>{$lang['BODY_DELETE']}</a>";
						if ($_GET['comment'] == 'delete') 
						{
							$comment_id_delete = (INT)$_GET['id_delete'];
							mysql_query("DELETE FROM hosting_comment WHERE hosting_comment_id = '".$comment_id_delete."' ") or die (mysql_error());
							echo "<meta http-equiv='REFRESH' content='0;url=/?section=forumthreadview&id=".$id."'>"; 
						}
					}
			 echo "<div align='right'>#".$forum_comment_thread['hosting_comment_id'].'</div></td></tr>'
			
			. "<tr><td width='200' valign='top'><a href='/?section=viewprofile&name={$forum_comment_thread['hosting_comment_nick']}'>{$forum_comment_thread['hosting_comment_nick']}</a>";
				$comment_user_information_select = mysql_query("SELECT hosting_user_join,hosting_user_online_status FROM hosting_user WHERE hosting_user_name = '".$forum_comment_thread['hosting_comment_nick']."' ");
				while ($comment_user_information = mysql_fetch_array($comment_user_information_select))
				{
					echo "<br>{$lang['BODY_FORUM_THREAD_COMMENT_USER_STATUS']}";
					if ($comment_user_information['hosting_user_online_status'] == "yes") 
					{
						echo ': '.$lang['BODY_PROFILE_STATUS_ONLINE'];
					}
					elseif ($comment_user_information['hosting_user_online_status'] == "no") 
					{
						echo ': '.$lang['BODY_PROFILE_STATUS_OFFLINE'];
					}
					echo '<br>'.$lang['BODY_FORUM_THREAD_COMMENT_USER_JOINED'].': '.$comment_user_information['hosting_user_join'];
				}
			echo "</td> <td width='600' valign='top'>".$forum_comment_thread['hosting_comment_text']."</td></tr></table><br>";
			}
					
			/******  build the pagination links ******/
				// range of num links to show
				$range = 50;
				// loop to show links to range of pages around current page
				echo "<center>{$lang['BODY_PAGE_PAGINATION']}&nbsp;";
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
						 echo "<a href='/?section=forumthreadview&id=$id&page=$x'>$x</a>&nbsp;";
					  } // end else
				   } // end if 
				} // end for   
				echo "</center><br>";
				/****** end build pagination links ******/	
		}
		else 
		{
			echo "<div class='thread'>{$lang['BODY_FORUM_THREAD_COMMENT_NOT_YET_DONE']}</div><br>";	
		}

if (isset($_POST['submit']))
{
   $errors = array(); // set the errors array to empty, by default
   $fields = array(); // stores the field values
   $success_message = "Paldies Jūsu Informācija Nosūtīta";	
	// import the validation library
  #require("include/validation.php");
  require ("include/validation.php");
  $rules = array(); // stores the validation rules

  // standard form fields
  $rules[] = "required,forum_thread_text,{$lang['BODY_FORUM_THREAD_COMMENT_VALIDATION_FILL_TEXT']}";
  
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
  		$forum_thread_text = $_POST['forum_thread_text'];
		$forum_thread_text = mysql_real_escape_string($_POST['forum_thread_text']);
		$forum_thread_text = htmlentities($_POST['forum_thread_text']);
		$forum_thread_text = trim($_POST['forum_thread_text']);
		$forum_thread_text = stripslashes($_POST['forum_thread_text']);
		$forum_thread_text = addslashes($_POST['forum_thread_text']);
		$forum_thread_text = strip_script($_POST['forum_thread_text']);
		$forum_thread_text = bbcode_parser($_POST['forum_thread_text']);
		unset($_POST['token']);
		 	
		$forum_thread_insert = "INSERT INTO hosting_comment (hosting_comment_forum_thread_id,hosting_comment_nick,hosting_comment_text,hosting_comment_date) VALUES ('".$id."','".$_SESSION['nick']."','".$forum_thread_text."','".$last_time_seen."') ";
		mysql_query($forum_thread_insert);
  		{
	    	echo "<meta http-equiv='REFRESH' content='0'/>"; 
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
	
	echo "<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
					  <tr>
					    <td><form name'forum_thread_comment' method='post'>
					    <textarea name='forum_thread_text' id='textarea1' cols='110' rows='10' value='{$fields['forum_thread_text']}'></textarea><br />
					    <input type='hidden' name='token' value='{$token}'/> 
						<input name='submit' type='submit' id='submit' value='{$lang['BODY_FORUM_THREAD_COMMENT_BUTTON_SUBMIT']}' />
						 <input type='reset' name='Reset' id='button' value='{$lang['BODY_FORUM_THREAD_COMMENT_BUTTON_RESET']}' />
						</form></td>
					  </tr>
					</table>";
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
?>