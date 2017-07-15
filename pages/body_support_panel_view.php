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
	
	if ($_SESSION['permission'] >= 2  AND $_SESSION['hosting'] == 1) 
	{
		$select_support_ticket = mysql_query("SELECT * FROM hosting_support WHERE ticket_id = '$id' AND ticket_nick = '".$_SESSION['nick']."' ");
		if (mysql_numrows($select_support_ticket) > 0)
		{
			while ($support_ticket = mysql_fetch_array($select_support_ticket))
			{
				echo "<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
				  <tr>
				    <td><table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
				  <tr>
				    <td><a href='/?section=viewprofile&name={$support_ticket['ticket_nick']}'>{$support_ticket['ticket_nick']}</a> : {$support_ticket['ticket_date']} - {$support_ticket['ticket_time']}</td>
				    <td>{$lang['BODY_LIGHT_SUPPORT_PANEL_VIEW_SUBJECT']} : {$support_ticket['ticket_title']} = {$lang['BODY_LIGHT_SUPPORT_PANEL_VIEW_ID']} {$support_ticket['ticket_id']}</td>
				    <td>{$lang['BODY_LIGHT_SUPPORT_PANEL_VIEW_STATUS']} : ";
					if ($support_ticket[ticket_status] == "0" AND $_SESSION['hosting'] == 1)
					{
						echo $lang['BODY_LIGHT_SUPPORT_PANEL_STATUS_0'];
					}	
					elseif ($support_ticket[ticket_status] == "1" AND $_SESSION['hosting'] == 1 )
					{
						echo $lang['BODY_LIGHT_SUPPORT_PANEL_STATUS_1'];	
					}
					elseif ($support_ticket[ticket_status] == "2" AND $_SESSION['hosting'] == 1)
					{
						echo $lang['BODY_LIGHT_SUPPORT_PANEL_STATUS_2'];
					}
					elseif ($support_ticket[ticket_status] == "3" AND $_SESSION['hosting'] == 1)
					{
						echo $lang['BODY_LIGHT_SUPPORT_PANEL_STATUS_3'];
					}	
				    echo "</td>
				    <td>{$lang['BODY_LIGHT_SUPPORT_PANEL_VIEW_PROBLEM_TYPE']} : {$support_ticket['ticket_issue_type']}</td>
				    <td>{$lang['BODY_LIGHT_SUPPORT_PANEL_VIEW_DOMAIN']} : {$support_ticket['ticket_domain_name']}</td>
				  </tr>
				</table></td>
				  </tr>
				  <tr>
				    <td>{$lang['BODY_LIGHT_SUPPORT_PANEL_PROBLEM_DESCRIPTION']} : {$support_ticket['ticket_text']}</td>
				  </tr>
				</table><br>";
			}
		}
		else 
		{
			echo $redirect;
		}
		
		$sql = "SELECT COUNT(hosting_comment_ticket_id) FROM hosting_comment WHERE hosting_comment_ticket_id = '$id'";
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
			
		$comment = mysql_query("SELECT hosting_comment_id,hosting_comment_ticket_id,hosting_comment_text,hosting_comment_nick,hosting_comment_date FROM hosting_comment WHERE hosting_comment_ticket_id = '$id' "."limit $offset, $comment_limit") or die(mysql_error());
		if (mysql_num_rows($comment) != 0)
		{
			while ($row_support_comment = mysql_fetch_array($comment))
			{
				echo "<a href='/?section=viewprofile&name={$row_support_comment['hosting_comment_nick']}'>{$row_support_comment['hosting_comment_nick']}</a> ".'&nbsp;'.$row_support_comment['hosting_comment_date'].'&nbsp;';

					if ($_SESSION['permission'] == 2)
					{
						if ($row_support_comment['hosting_comment_nick'] == $_SESSION['nick'])
						{
							echo "<a href='/?section=commentedt&id=".$id."&comment=bgedit&id_edit=".$row_support_comment['hosting_comment_id']."'>{$lang['BODY_EDIT']}</a>"."&nbsp;";
							#."<a href='/?section=bgcomment&id=".$id."&comment=delete&id_delete=".$row_support_comment['hosting_comment_id']."'>{$lang['BODY_DELETE']}</a>"
							/*if ($_GET['comment'] == 'delete') 
							{
								$comment_id_delete = (INT)$_GET['id_delete'];
								mysql_query("DELETE FROM hosting_comment WHERE hosting_comment_id = '".$comment_id_delete."' AND hosting_comment_nick = '".$_SESSION['nick']."' ") or die (mysql_error());
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=bgcomment&id=".$id."'>"; 
							}
							*/
						}
					}
					elseif ($_SESSION['permission'] == 6)
					{
						echo "<a href='/?section=commentedt&id=".$id."&comment=bgedit&id_edit=".$row_support_comment['hosting_comment_id']."'>{$lang['BODY_EDIT']}</a>"."&nbsp;"."<a href='/?section=lightusersupportpanelview&id=".$id."&comment=delete&id_delete=".$row_support_comment['hosting_comment_id']."'>{$lang['BODY_DELETE']}</a>";
						if ($_GET['comment'] == 'delete') 
						{
							$comment_id_delete = (INT)$_GET['id_delete'];
							mysql_query("DELETE FROM hosting_comment WHERE hosting_comment_id = '".$comment_id_delete."' ") or die (mysql_error());
							echo "<meta http-equiv='REFRESH' content='0;url=/?section=lightusersupportpanelview&id=".$id."'>"; 
						}
					}
				echo '<br>'.$row_support_comment['hosting_comment_text'].'<br><br>';
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
						 echo "<a href='/?section=lightusersupportpanelview&id=$id&page=$x'>$x</a>&nbsp;";
					  } // end else
				   } // end if 
				} // end for   
				echo "</center>";
				/****** end build pagination links ******/	
		}
		else 
		{
			echo $lang['BODY_LIGHT_SUPPORT_PANEL_COMMENT_COMMENTS_NOT_YET_DONE'];	
		}
		
		if (isset($_POST['Submit']))
		{
			$errors = array(); // set the errors array to empty, by default
		 	$fields = array(); // stores the field values
		 	$success_message = "Paldies Jûsu Informâcija Nosûtîta";	
		 	// import the validation library
		 	#require("include/validation.php");
		 	require ("include/validation.php");
		 	$rules = array(); // stores the validation rules
		
		 	// standard form fields
		 	$rules[] = "required,comment_text,{$lang['BODY_LIGHT_SUPPORT_PANEL_VALIDATION_FILL_TEXT']}";
		  
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
	 				$comment_text = $_POST['comment_text'];
					$comment_text = mysql_real_escape_string($_POST['comment_text']);
					$comment_text = htmlentities($_POST['comment_text']);
					$comment_text = trim($_POST['comment_text']);
					$comment_text = stripslashes($_POST['comment_text']);
					$comment_text = strip_script($_POST['comment_text']);
					$comment_text = bbcode_parser($_POST['comment_text']);
					$id 		  = (int)$_GET['id'];
					unset($_POST['token']);
		
					$insert_comment = "INSERT INTO hosting_comment (hosting_comment_nick,hosting_comment_date,hosting_comment_text,hosting_comment_ticket_id) VALUES ('".$_SESSION['nick']."','".$last_time_seen."','".$comment_text."','".$id."') ";
					mysql_query($insert_comment);
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
      		echo "<div class='error' style='width:100%;'><b>{$lang['BODY_LIGHT_SUPPORT_PANEL_VALIDATION_TEXT']}</b><br>";
      		foreach ($errors as $error)
        	echo "<span style='color:darkred'>$error</span><br>";
    
      		echo "</ul></div>"; 
    	}
    
    if (!empty($message))
    	{
      		echo "<div class='notify'>$success_message</div>";
    	}
	}
	
		echo ("<h4>{$lang['BODY_LIGHT_SUPPORT_PANEL_COMMENT_COMMENT_ADD']}</h4>
		<form id='form1' name='form1' method='post'>
	  	<p>
	    <textarea name='comment_text' cols='50' rows='10' id='textarea'>{$lang['BODY_LIGHT_SUPPORT_PANEL_COMMENT_HINT']}
	  	</textarea>
	  	<input type='hidden' name='token' value='{$token}'/> 
	  	<p>
	  	<input type='submit' name='Submit' id='button' value='{$lang['BODY_LIGHT_SUPPORT_PANEL_COMMENT_SUBMIT']}' />
	  	 <input type='reset' name='Reset' id='button' value='{$lang['BODY_LIGHT_SUPPORT_PANEL_COMMENT_RESET']}' />
	  	</p>
		</form>");
	}
	
	if ($_SESSION['permission'] <= 2 AND $_SESSION['hosting'] == 0)
	{
		echo $redirect;
	}	
}
else 
{
	echo $redirect;
}
?>