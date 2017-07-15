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
		
	if ($_SESSION['permission'] == 2) 
	{
		if ($_GET['comment'] == 'bgedit')
		{
			#ini_set ("display_errors", "1");
			#error_reporting(E_ALL);
			$comment_id_edit = (INT)$_GET['id_edit'];
			$submit_select_check = mysql_query("SELECT MIN(hosting_comment_id),MAX(hosting_comment_id) FROM hosting_comment WHERE hosting_comment_id = '$comment_id_edit' ");
			while ($submit_validation_check = mysql_fetch_array($submit_select_check))
			{
				if ($submit_validation_check['MAX(hosting_comment_id)'] == $comment_id_edit)
				{
					$select_comment_edit = mysql_query("SELECT hosting_comment_id,hosting_comment_text,hosting_comment_nick FROM hosting_comment WHERE hosting_comment_id = '".$comment_id_edit."' AND hosting_comment_nick = '".$_SESSION['nick']."' ") or die (mysql_error());
           			$comment_edit = mysql_fetch_array($select_comment_edit);
            
           			if ($comment_edit['hosting_comment_nick'] == $_SESSION['nick'])
           			{
						$comment_texts = $comment_edit['hosting_comment_text'];
						$edit_comment_text = $_POST['hosting_comment_text'];
						$edit_comment_text = mysql_real_escape_string($_POST['hosting_comment_text']);
						$edit_comment_text = htmlentities($_POST['hosting_comment_text']);
						$edit_comment_text = trim($_POST['hosting_comment_text']);
						$edit_comment_text = stripslashes($_POST['hosting_comment_text']);
						$edit_comment_text = addslashes($_POST['hosting_comment_text']);
						$edit_comment_text = strip_script($_POST['hosting_comment_text']);
						$edit_comment_text = bbcode_parser($_POST['hosting_comment_text']);
																
						if(isset($_POST['hosting_comment_text']))
						{
							mysql_query("UPDATE hosting_comment SET hosting_comment_text = '".$edit_comment_text."' WHERE hosting_comment_id = '".$comment_id_edit."' AND hosting_comment_nick = '".$_SESSION['nick']."' ") or die (mysql_error());
						}
						
							if (isset($_POST['Submit']))
							{
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=bgcomment&id=".$id."'>";
							}
						
							echo ("<form  id='edit_comment' name='edit_comment' method='post'>
						  		<p>
						    	<textarea name='hosting_comment_text' cols='50' rows='10' id='textarea' >$comment_texts</textarea>
								<p>
								<input type='hidden' name='token' value='{$token}'/> 
								<input type='submit' name='Submit' id='button' value='{$lang['BODY_NEWS_COMMENT_SUBMIT']}' />
								<input type='reset' name='Reset' id='button' value='{$lang['BODY_NEWS_COMMENT_RESET']}' />
								</p>
								</form>");
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
		
		if ($_GET['action'] == 'dmedit')
		{
			#ini_set ("display_errors", "1");
			#error_reporting(E_ALL);
			$comment_id_edit = (INT)$_GET['id_edit'];
			$submit_select_check = mysql_query("SELECT MIN(hosting_domain_id),MAX(hosting_domain_id) FROM hosting_domain WHERE hosting_domain_id = '$comment_id_edit' ") or die (mysql_error());
			while ($submit_validation_check = mysql_fetch_array($submit_select_check))
			{
				if ($submit_validation_check['MAX(hosting_domain_id)'] == $comment_id_edit)
				{
					$select_comment_edit = mysql_query("SELECT hosting_domain_id,hosting_domain_domain,hosting_domain_owner FROM hosting_domain WHERE hosting_domain_id = '".$comment_id_edit."' AND hosting_domain_owner = '".$_SESSION['nick']."' ") or die (mysql_error());
           			$comment_edit = mysql_fetch_array($select_comment_edit);
           			
           			$select_dir_name = mysql_query("SELECT ftpd_owner,status,Dir from hosting_ftpd WHERE ftpd_owner = '".$_SESSION['nick']."' AND status = '1' ");
           			$dir_name = mysql_fetch_array($select_dir_name);
            
						$domain_name 	  = $comment_edit['hosting_domain_domain'];
						$domain_dir 	   = $dir_name['Dir'];
						
						#$edit_domain_name = $_POST['hosting_domain_domain'];
						$edit_domain_name = mysql_real_escape_string($_POST['hosting_domain_domain']);
						$edit_domain_name = htmlentities($_POST['hosting_domain_domain']);
						$edit_domain_name = trim($_POST['hosting_domain_domain']);
						$edit_domain_name = stripslashes($_POST['hosting_domain_domain']);
						$edit_domain_name = addslashes($_POST['hosting_domain_domain']);
																
						if(isset($_POST['hosting_domain_domain']))
						{
							mysql_query("UPDATE hosting_domain SET hosting_domain_domain = '".$edit_domain_name."', hosting_domain_docroot = '{$domain_dir}{$edit_domain_name}' WHERE hosting_domain_id = '".$comment_id_edit."' AND hosting_domain_owner = '".$_SESSION['nick']."' ") or die (mysql_error());
						}
						
							if (isset($_POST['submit']))
							{
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=lightuserpaneldomainmanage'>";
							}
							
							echo ("<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
							  <tr>
							    <td width='235' valign='top'><div class='border' id='leftdiv'>
							      <h3><strong>{$lang['BODY_LIGHT_USER_PANEL_NAME']}</strong></h3>
							      <hr align='center' noshade='noshade' />
							       <strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_LIMIT']}</strong><br />
							       ");
									echo ("".check_domain_limit()."|");
									echo ("".check_domain_name_limit()."<hr align='center' noshade='noshade' />
							        <strong>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_DB_LIMIT']}</strong><br />");
									echo ("".check_mysqldb_limit()."|");
									echo ("".check_mysql_database_limit()."<hr align='center' noshade='noshade' ");
									
									echo ("<b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_USER_LIMIT']}</b><br>");
									echo ("".check_mysqluser_limit($mysql_check_user_limit)."|");
									echo ("".check_mysql_user_limit()."<hr align='center' noshade='noshade' />");
									
									echo ("<b>{$lang['BODY_LIGHT_USER_PANEL_FTP_LIMIT']}</b><br>");
							        echo ("".check_ftp_user_limit()."|");
							        echo ("".check_ftp_limit()."<hr align='center' noshade='noshade' />
							        <strong>{$lang['BODY_LIGHT_USER_PANEL_HDD_LIMIT']}</strong><br />
							        {$lang['BODY_LIGHT_USER_PANEL_HDD_LIMIT_UNAVAILABLE']}
							        <hr align='center' noshade='noshade' />
							          <strong>{$lang['BODY_LIGHT_USER_PANEL_PLAN']} </strong><br />");
							        echo ("".check_hosting_plan_dates()."
							        <hr align='center' noshade='noshade' />
							        <strong>{$lang['BODY_LIGHT_USER_PANEL']}</strong><br />
							       {$lang['BODY_LIGHT_USER_PANEL_NAME_VERSION']}
							    </div></td>
							    <td width='665' valign='top'>");
							    
							 echo ("<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'>
							      <tr>
							        <td width='29%'><strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_FORM_NAME']}</strong></td>
							        </tr>
							      <tr>
							        <td><form id='form1' name='form1' method='post'>
							  <span id='domain'><strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_FORM_TITLE']}</strong><br />
							  <input name='hosting_domain_domain' type='text' id='text1' size='50' value='{$domain_name}' />
							  <span class='textfieldRequiredMsg'>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_NAME_DOMAIN_REQUIRED']}</span></span><br />
							  
							  <input type='hidden' name='token' value='{$token}'/> 
							  <input type='submit' name='submit' id='button' value='{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_BUTTON_SUBMIT']}' spry:hover='confirmRequiredMsg'/>
							  <input type='reset' name='button2' id='button2' value='{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_BUTTON_RESET']}' />
							</form></td>
							        </tr>
							    </table></td>
							  </tr>
							</table>");
							 
				}
				else
				{
					echo $redirect;
				}
			}
		}
			
	if ($_GET['action'] == 'ftpnedit')
	{
			#ini_set ("display_errors", "1");
			#error_reporting(E_ALL);
			$id_edit = (INT)$_GET['id_edit'];
			$submit_select_check = mysql_query("SELECT MIN(ftpd_id),MAX(ftpd_id) FROM hosting_ftpd WHERE ftpd_id = '$id_edit' ") or die (mysql_error());
			while ($submit_validation_check = mysql_fetch_array($submit_select_check))
			{
				if ($submit_validation_check['MAX(ftpd_id)'] == $id_edit)
				{
					$select_ftp_edit = mysql_query("SELECT * FROM hosting_ftpd WHERE ftpd_id = '".$id_edit."' AND ftpd_owner = '".$_SESSION['nick']."' ") or die (mysql_error());
           			$ftp_edit = mysql_fetch_array($select_ftp_edit);
            
						$ftp_name 	  = $ftp_edit['User'];
						$edit_ftp_name = $_POST['User'];
						$edit_ftp_name = mysql_real_escape_string($_POST['User']);
						$edit_ftp_name = htmlentities($_POST['User']);
						$edit_ftp_name = trim($_POST['User']);
						$edit_ftp_name = stripslashes($_POST['User']);
						$edit_ftp_name = addslashes($_POST['User']);
																
						if(isset($_POST['User']))
						{
							mysql_query("UPDATE hosting_ftpd SET User = '".$edit_ftp_name."' WHERE ftpd_id = '".$id_edit."' AND ftpd_owner = '".$_SESSION['nick']."' ") or die (mysql_error());
						}
						
							if (isset($_POST['submit']))
							{
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=lightuserpanelftpmanage'>";
							}
							
							echo ("<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
							  <tr>
							    <td width='235' valign='top'><div class='border' id='leftdiv'>
							      <h3><strong>{$lang['BODY_LIGHT_USER_PANEL_NAME']}</strong></h3>
							      <hr align='center' noshade='noshade' />
							       <strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_LIMIT']}</strong><br />
							       ");
									echo ("".check_domain_limit()."|");
									echo ("".check_domain_name_limit()."<hr align='center' noshade='noshade' />
							        <strong>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_DB_LIMIT']}</strong><br />");
									echo ("".check_mysqldb_limit()."|");
									echo ("".check_mysql_database_limit()."<hr align='center' noshade='noshade' ");
									
									echo ("<b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_USER_LIMIT']}</b><br>");
									echo ("".check_mysqluser_limit($mysql_check_user_limit)."|");
									echo ("".check_mysql_user_limit()."<hr align='center' noshade='noshade' />");
									
									echo ("<b>{$lang['BODY_LIGHT_USER_PANEL_FTP_LIMIT']}</b><br>");
							        echo ("".check_ftp_user_limit()."|");
							        echo ("".check_ftp_limit()."<hr align='center' noshade='noshade' />
							        <strong>{$lang['BODY_LIGHT_USER_PANEL_HDD_LIMIT']}</strong><br />
							        {$lang['BODY_LIGHT_USER_PANEL_HDD_LIMIT_UNAVAILABLE']}
							        <hr align='center' noshade='noshade' />
							          <strong>{$lang['BODY_LIGHT_USER_PANEL_PLAN']} </strong><br />");
							        echo ("".check_hosting_plan_dates()."
							        <hr align='center' noshade='noshade' />
							        <strong>{$lang['BODY_LIGHT_USER_PANEL']}</strong><br />
							       {$lang['BODY_LIGHT_USER_PANEL_NAME_VERSION']}
							    </div></td>
							    <td width='665' valign='top'>");
							    
							 echo ("<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'>
							      <tr>
							        <td width='29%'><strong>{$lang['BODY_LIGHT_USER_PANEL_FTP_FORM_NAME']}</strong></td>
							        </tr>
							      <tr>
							        <td><form id='form1' name='form1' method='post'>
							        {$lang['BODY_LIGHT_USER_PANEL_FTP_FORM_USERNAME']}<br />
							  <input name='User' type='text' id='text1' size='50' value='".$ftp_name."' />
							  <br>
							  <input type='hidden' name='token' value='{$token}'/> 
							  <input type='submit' name='submit' id='button' value='{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_BUTTON_SUBMIT']}' spry:hover='confirmRequiredMsg'/>
							  <input type='reset' name='button2' id='button2' value='{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_BUTTON_RESET']}' />
							</form></td>
							        </tr>
							    </table></td>
							  </tr>
							</table>"); 
				}
				else
				{
					echo $redirect;
				}
			}
		}
		
	if ($_GET['action'] == 'ftppedit')
	{
			#ini_set ("display_errors", "1");
			#error_reporting(E_ALL);
			$id_edit = (INT)$_GET['id_edit'];
			$submit_select_check = mysql_query("SELECT MIN(ftpd_id),MAX(ftpd_id) FROM hosting_ftpd WHERE ftpd_id = '$id_edit' ") or die (mysql_error());
			while ($submit_validation_check = mysql_fetch_array($submit_select_check))
			{
				if ($submit_validation_check['MAX(ftpd_id)'] == $id_edit)
				{
					$select_ftp_edit = mysql_query("SELECT * FROM hosting_ftpd WHERE ftpd_id = '".$id_edit."' AND ftpd_owner = '".$_SESSION['nick']."' ") or die (mysql_error());
           			$ftp_edit = mysql_fetch_array($select_ftp_edit);
            
						$edit_ftp_pass = $_POST['Password'];
						$edit_ftp_pass = mysql_real_escape_string($_POST['Password']);
						$edit_ftp_pass = htmlentities($_POST['Password']);
						$edit_ftp_pass = trim($_POST['Password']);
						$edit_ftp_pass = stripslashes($_POST['Password']);
						$edit_ftp_pass = addslashes($_POST['Password']);
						$edit_ftp_pass = md5($_POST['Password']);
																
						if(isset($_POST['Password']))
						{
							mysql_query("UPDATE hosting_ftpd SET Password = '".$edit_ftp_pass."' WHERE ftpd_id = '".$id_edit."' AND ftpd_owner = '".$_SESSION['nick']."' ") or die (mysql_error());
						}
						
							if (isset($_POST['submit']))
							{
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=lightuserpanelftpmanage'>";
							}
							
							echo ("<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
							  <tr>
							    <td width='235' valign='top'><div class='border' id='leftdiv'>
							      <h3><strong>{$lang['BODY_LIGHT_USER_PANEL_NAME']}</strong></h3>
							      <hr align='center' noshade='noshade' />
							       <strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_LIMIT']}</strong><br />
							       ");
									echo ("".check_domain_limit()."|");
									echo ("".check_domain_name_limit()."<hr align='center' noshade='noshade' />
							        <strong>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_DB_LIMIT']}</strong><br />");
									echo ("".check_mysqldb_limit()."|");
									echo ("".check_mysql_database_limit()."<hr align='center' noshade='noshade' ");
									
									echo ("<b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_USER_LIMIT']}</b><br>");
									echo ("".check_mysqluser_limit($mysql_check_user_limit)."|");
									echo ("".check_mysql_user_limit()."<hr align='center' noshade='noshade' />");
									
									echo ("<b>{$lang['BODY_LIGHT_USER_PANEL_FTP_LIMIT']}</b><br>");
							        echo ("".check_ftp_user_limit()."|");
							        echo ("".check_ftp_limit()."<hr align='center' noshade='noshade' />
							        <strong>{$lang['BODY_LIGHT_USER_PANEL_HDD_LIMIT']}</strong><br />
							        {$lang['BODY_LIGHT_USER_PANEL_HDD_LIMIT_UNAVAILABLE']}
							        <hr align='center' noshade='noshade' />
							          <strong>{$lang['BODY_LIGHT_USER_PANEL_PLAN']} </strong><br />");
							        echo ("".check_hosting_plan_dates()."
							        <hr align='center' noshade='noshade' />
							        <strong>{$lang['BODY_LIGHT_USER_PANEL']}</strong><br />
							       {$lang['BODY_LIGHT_USER_PANEL_NAME_VERSION']}
							    </div></td>
							    <td width='665' valign='top'>");
							    
							 echo ("<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'>
							      <tr>
							        <td width='29%'><strong>{$lang['BODY_LIGHT_USER_PANEL_FTP_FORM_NAME']}</strong></td>
							        </tr>
							      <tr>
							        <td><form id='form1' name='form1' method='post'>
							 {$lang['BODY_LIGHT_USER_PANEL_FTP_FROM_PASSWORD']}<br />
  							<input name='Password' type='password' id='password1' size='30' />
  							<br>
							  <input type='hidden' name='token' value='{$token}'/> 
							  <input type='submit' name='submit' id='button' value='{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_BUTTON_SUBMIT']}' spry:hover='confirmRequiredMsg'/>
							  <input type='reset' name='button2' id='button2' value='{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_BUTTON_RESET']}' />
							</form></td>
							        </tr>
							    </table></td>
							  </tr>
							</table>"); 
				}
				else
				{
					echo $redirect;
				}
			}
		}		
		
		if ($_GET['comment'] == 'fbtpgedit')
		{
			#ini_set ("display_errors", "1");
			#error_reporting(E_ALL);
			$comment_id_edit = (INT)$_GET['id_edit'];
			$submit_select_check = mysql_query("SELECT MIN(hosting_forum_thread_id),MAX(hosting_forum_thread_id) FROM hosting_forum_thread WHERE hosting_forum_thread_id = '$comment_id_edit' ");
			while ($submit_validation_check = mysql_fetch_array($submit_select_check))
			{
				if ($submit_validation_check['MAX(hosting_forum_thread_id)'] == $comment_id_edit)
				{
					$select_comment_edit = mysql_query("SELECT hosting_forum_thread_id,	hosting_forum_thread_title,hosting_forum_thread_text,hosting_forum_thread_author FROM hosting_forum_thread WHERE hosting_forum_thread_id = '".$comment_id_edit."' AND hosting_forum_thread_author = '".$_SESSION['nick']."' ") or die (mysql_error());
           			$comment_edit = mysql_fetch_array($select_comment_edit);
            
           			if ($comment_edit['hosting_forum_thread_author'] == $_SESSION['nick'])
           			{
						$comment_texts = $comment_edit['hosting_forum_thread_text'];
						$edit_comment_text = $_POST['hosting_forum_thread_text'];
						$edit_comment_text = mysql_real_escape_string($_POST['hosting_forum_thread_text']);
						$edit_comment_text = htmlentities($_POST['hosting_forum_thread_text']);
						$edit_comment_text = trim($_POST['hosting_forum_thread_text']);
						$edit_comment_text = stripslashes($_POST['hosting_forum_thread_text']);
						$edit_comment_text = addslashes($_POST['hosting_forum_thread_text']);
						$edit_comment_text = strip_script($_POST['hosting_forum_thread_text']);
						$edit_comment_text = bbcode_parser($_POST['hosting_forum_thread_text']);
												
						if(isset($_POST['hosting_forum_thread_text']))
						{
							mysql_query("UPDATE hosting_forum_thread SET hosting_forum_thread_text = '".$edit_comment_text."' WHERE hosting_forum_thread_id = '".$comment_id_edit."' AND hosting_forum_thread_author = '".$_SESSION['nick']."' ") or die (mysql_error());
						}
						
							if (isset($_POST['Submit']))
							{
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=forumthreadview&id=".$id."'>";
							}
						
							echo ("<form  id='edit_comment' name='edit_comment' method='post'>
						  		<p>
						    	<textarea name='hosting_forum_thread_text' cols='50' rows='10' id='textarea' >$comment_texts</textarea>
								<p>
								<input type='hidden' name='token' value='{$token}'/> 
								<input type='submit' name='Submit' id='button' value='{$lang['BODY_NEWS_COMMENT_SUBMIT']}' />
								<input type='reset' name='Reset' id='button' value='{$lang['BODY_NEWS_COMMENT_RESET']}' />
								</p>
								</form>");
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
		
	if ($_GET['comment'] == 'fbthgedit')
		{
			#ini_set ("display_errors", "1");
			#error_reporting(E_ALL);
			$comment_id_edit = (INT)$_GET['id_edit'];
			$submit_select_check = mysql_query("SELECT MIN(hosting_comment_id),MAX(hosting_comment_id) FROM hosting_comment WHERE hosting_comment_id = '$comment_id_edit' ");
			while ($submit_validation_check = mysql_fetch_array($submit_select_check))
			{
				if ($submit_validation_check['MAX(hosting_comment_id)'] == $comment_id_edit)
				{
					$select_comment_edit = mysql_query("SELECT hosting_comment_id,hosting_comment_text,hosting_comment_nick FROM hosting_comment WHERE hosting_comment_id = '".$comment_id_edit."' AND hosting_comment_nick = '".$_SESSION['nick']."' ") or die (mysql_error());
           			$comment_edit = mysql_fetch_array($select_comment_edit);
            
           			if ($comment_edit['hosting_comment_nick'] == $_SESSION['nick'])
           			{
						$comment_texts = $comment_edit['hosting_comment_text'];
						$edit_comment_text = $_POST['hosting_comment_text'];
						$edit_comment_text = mysql_real_escape_string($_POST['hosting_comment_text']);
						$edit_comment_text = htmlentities($_POST['hosting_comment_text']);
						$edit_comment_text = trim($_POST['hosting_comment_text']);
						$edit_comment_text = stripslashes($_POST['hosting_comment_text']);
						$edit_comment_text = addslashes($_POST['hosting_comment_text']);
						$edit_comment_text = strip_script($_POST['hosting_comment_text']);
						$edit_comment_text = bbcode_parser($_POST['hosting_comment_text']);
												
						if(isset($_POST['hosting_comment_text']))
						{
							mysql_query("UPDATE hosting_comment SET hosting_comment_text = '".$edit_comment_text."' WHERE hosting_comment_id = '".$comment_id_edit."' AND hosting_comment_nick = '".$_SESSION['nick']."' ") or die (mysql_error());
						}
						
							if (isset($_POST['Submit']))
							{
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=forumthreadview&id=".$id."'>";
							}
						
							echo ("<form  id='edit_comment' name='edit_comment' method='post'>
						  		<p>
						    	<textarea name='hosting_comment_text' cols='50' rows='10' id='textarea' >$comment_texts</textarea>
								<p>
								<input type='hidden' name='token' value='{$token}'/> 
								<input type='submit' name='Submit' id='button' value='{$lang['BODY_NEWS_COMMENT_SUBMIT']}' />
								<input type='reset' name='Reset' id='button' value='{$lang['BODY_NEWS_COMMENT_RESET']}' />
								</p>
								</form>");
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
		
		if ($_GET['comment'] == 'nwedit') 
		{
			#ini_set ("display_errors", "1");
			#error_reporting(E_ALL);
			$comment_id_edit = (INT)$_GET['id_edit'];
			$submit_select_check = mysql_query("SELECT MIN(hosting_comment_id),MAX(hosting_comment_id) FROM hosting_comment WHERE hosting_comment_id = '$comment_id_edit' ");
			while ($submit_validation_check = mysql_fetch_array($submit_select_check))
			{
				if ($submit_validation_check['MAX(hosting_comment_id)'] == $comment_id_edit)
				{
					$select_comment_edit = mysql_query("SELECT hosting_comment_id,hosting_comment_text,hosting_comment_nick FROM hosting_comment WHERE hosting_comment_id = '".$comment_id_edit."' AND hosting_comment_nick = '".$_SESSION['nick']."' ") or die (mysql_error());
           			$comment_edit = mysql_fetch_array($select_comment_edit);
            
           			if ($comment_edit['hosting_comment_nick'] == $_SESSION['nick'])
           			{
						$comment_texts = $comment_edit['hosting_comment_text'];
						$edit_comment_text = $_POST['hosting_comment_text'];
						$edit_comment_text = mysql_real_escape_string($_POST['hosting_comment_text']);
						$edit_comment_text = htmlentities($_POST['hosting_comment_text']);
						$edit_comment_text = trim($_POST['hosting_comment_text']);
						$edit_comment_text = stripslashes($_POST['hosting_comment_text']);
						$edit_comment_text = addslashes($_POST['hosting_comment_text']);
						$edit_comment_text = strip_script($_POST['hosting_comment_text']);
						$edit_comment_text = bbcode_parser($_POST['hosting_comment_text']);
						
						if(isset($_POST['hosting_comment_text']))
						{
							mysql_query("UPDATE hosting_comment SET hosting_comment_text = '".$edit_comment_text."' WHERE hosting_comment_id = '".$comment_id_edit."' AND hosting_comment_nick = '".$_SESSION['nick']."' ") or die (mysql_error());
						}
						
							if (isset($_POST['Submit']))
							{
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=nwcomment&id=".$id."'>";
							}
						
							echo ("<form  id='edit_comment' name='edit_comment' method='post'>
						  		<p>
						    	<textarea name='hosting_comment_text' cols='50' rows='10' id='textarea' >$comment_texts</textarea>
								<p>
								<input type='hidden' name='token' value='{$token}'/> 
								<input type='submit' name='Submit' id='button' value='{$lang['BODY_NEWS_COMMENT_SUBMIT']}' />
								<input type='reset' name='Reset' id='button' value='{$lang['BODY_NEWS_COMMENT_RESET']}' />
								</p>
								</form>");
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
		
		if ($_GET['profile'] == 'edite') 
		{
			$user_id_edit = (INT)$_GET['id'];
			$submit_user_select_check = mysql_query("SELECT MIN(hosting_user_id),MAX(hosting_user_id) FROM hosting_user WHERE hosting_user_id = '$user_id_edit' ");
			while ($submit_user_validation_check = mysql_fetch_array($submit_user_select_check))
			{
				if ($submit_user_validation_check['MAX(hosting_user_id)'] == $user_id_edit)
				{
					$select_user_edit = mysql_query("SELECT * FROM hosting_user WHERE hosting_user_id = '".$user_id_edit."' AND hosting_user_name = '".$_SESSION['nick']."' ") or die (mysql_error());
           			while($usert_edit = mysql_fetch_array($select_user_edit))
            
           			if ($usert_edit['hosting_user_name'] == $_SESSION['nick'])
           			{
						$orginal_user_avatar = $usert_edit['hosting_user_avatar'];
						$orginal_user_gender = $usert_edit['hosting_user_gender'];
						$orginal_user_email = $usert_edit['hosting_user_email'];
						$orginal_user_homepage = $usert_edit['hosting_user_homepage'];
						$orginal_user_signature= $usert_edit['hosting_user_signature'];
						
						$user_avatar = $_POST['hosting_user_avatar'];
						$user_avatar = mysql_real_escape_string($_POST['hosting_user_avatar']);
						$user_avatar = htmlentities($_POST['hosting_user_avatar']);
						$user_avatar = trim($_POST['hosting_user_avatar']);
						$user_avatar = stripslashes($_POST['hosting_user_avatar']);
						$user_avatar = addslashes($_POST['hosting_user_avatar']);
						
						$user_gender = $_POST['hosting_user_gender'];
						$user_gender = mysql_real_escape_string($_POST['hosting_user_gender']);
						$user_gender = htmlentities($_POST['hosting_user_gender']);
						$user_gender = trim($_POST['hosting_user_gender']);
						$user_gender = stripslashes($_POST['hosting_user_gender']);
						$user_gender = addslashes($_POST['hosting_user_gender']);
						
						$user_email = $_POST['hosting_user_email'];
						$user_email = mysql_real_escape_string($_POST['hosting_user_email']);
						$user_email = htmlentities($_POST['hosting_user_email']);
						$user_email = trim($_POST['hosting_user_email']);
						$user_email = stripslashes($_POST['hosting_user_email']);
						$user_email = addslashes($_POST['hosting_user_email']);
						
						$user_homepage = $_POST['hosting_user_homepage'];
						$user_homepage = mysql_real_escape_string($_POST['hosting_user_homepage']);
						$user_homepage = htmlentities($_POST['hosting_user_homepage']);
						$user_homepage = trim($_POST['hosting_user_homepage']);
						$user_homepage = stripslashes($_POST['hosting_user_homepage']);
						$user_homepage = addslashes($_POST['hosting_user_homepage']);
						
						$user_signature = $_POST['hosting_user_signature'];
						$user_signature = mysql_real_escape_string($_POST['hosting_user_signature']);
						$user_signature = htmlentities($_POST['hosting_user_signature']);
						$user_signature = trim($_POST['hosting_user_signature']);
						$user_signature = stripslashes($_POST['hosting_user_signature']);
						$user_signature = addslashes($_POST['hosting_user_signature']);
						$user_signature = strip_script($_POST['hosting_user_signature']);
						$user_signature = bbcode_parser($_POST['hosting_user_signature']);
												
						if (isset($_POST['Save']))
						{
							if (mysql_query("UPDATE hosting_user SET hosting_user_avatar = '".$user_avatar."', hosting_user_gender = '".$user_gender."', hosting_user_email = '".$user_email."', hosting_user_homepage = '".$user_homepage."', hosting_user_signature = '".$user_signature."' WHERE hosting_user_id = '".$user_id_edit."' AND hosting_user_name = '".$_SESSION['nick']."' ") or die (mysql_error())) 
							{
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=myprofile'>";
							}
						}
						
							echo "<table width='900' border='0' align='center' cellpadding='0' cellspacing='0' class='header' id='TableRoundCorners'>
  <tr>
    <td width='235' valign='top'><div class='border' id='leftdiv'>
        <h3><strong>My Information</strong> </h3>
        <hr align='center' noshade='noshade' />
        Total Contact Messages<br />
        <a href='#' class='tooltip'>1<span>Active tickets whom require attention</span></a>  | ~
        <hr align='center' noshade='noshade' />
        </p>
       Total News Comments </strong><br />
        <a href='#'>1</a> | ~
        <hr align='center' noshade='noshade' />
        Total Blog Comments </strong><br />
        <a href='#'>1</a> | ~
        <hr align='center' noshade='noshade' />
        Total Forum Comments </strong><br />
        <a href='#'>1</a> | ~
        <hr align='center' noshade='noshade' />
        Total Forum Treads <br />
        <a href='#'>1</a> | ~
        <hr align='center' noshade='noshade' />
        <strong>Light User Panel <br />
        Version | 0.0.1 <strong>
        <hr align='center' noshade='noshade' />
      </div></td>
    <td width='665' valign='top'>
    <table width='664' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'>
        <tr>
          <td width='200' ><strong>User Settings</strong></td>
        </tr>
        <tr>
          <td>
          <form method='post'>
          <table width='70%' border='0' align='center' cellpadding='0' cellspacing='0' class='border'>
  <tr>
    <td class='header' id='MyOrderTable'>Avatar</td>
      
    <td class='header' id='MyOrderTable'><label for='avatar'></label>
      <textarea name='hosting_user_avatar' id='avatar'>{$orginal_user_avatar}</textarea></td>
    </tr>
  <tr>
    <td class='header' id='MyOrderTable'>Gender</td>
    <td class='header' id='MyOrderTable'><select name='hosting_user_gender' id='gender' >";
							if ($orginal_user_gender == Male)
							{
								echo "<option>$orginal_user_gender</option>
									 <option>Female</option>";
							}
							elseif ($orginal_user_gender == Female)
							{
								echo "<option>$orginal_user_gender</option>
									 <option>Male</option>";
								
							}
							
	echo "</select></td>
    </tr>
  <tr>
    <td class='header' id='MyOrderTable'>E-Mail</td>
    <td class='header' id='MyOrderTable'><input name='hosting_user_email' type='text' id='email' value='{$orginal_user_email}' size='25' /></td>
    </tr>
  <tr>
    <td class='header' id='MyOrderTable'>Home Page</td>
    <td class='header' id='MyOrderTable'><input name='hosting_user_homepage' type='text' id='homepage' value='{$orginal_user_homepage}' size='25' /></td>
  </tr>
  <tr>
    <td class='header' id='MyOrderTable2'>My Signature</td>
    <td class='header' id='MyOrderTable2'><textarea name='hosting_user_signature' cols='25' id='mysignature'>{$orginal_user_signature}</textarea></td>
  </tr>
          </table>            
            <input type='submit' name='Save' id='Save' value='Save' />
          </form>
          <p></td>
        </tr>
    </table></td>
  </tr>
</table>";
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
	elseif($_SESSION['permission'] == 6) 
	{
		if ($_GET['comment'] == 'bgedit') 
		{
			#ini_set ("display_errors", "1");
			#error_reporting(E_ALL);
			$comment_id_edit = (INT)$_GET['id_edit'];
			$submit_select_check = mysql_query("SELECT MIN(hosting_comment_id),MAX(hosting_comment_id) FROM hosting_comment WHERE hosting_comment_id = '$comment_id_edit' ");
			while ($submit_validation_check = mysql_fetch_array($submit_select_check))
			{
				if ($submit_validation_check['MAX(hosting_comment_id)'] == $comment_id_edit)
				{
					$select_comment_edit = mysql_query("SELECT hosting_comment_id,hosting_comment_text,hosting_comment_nick FROM hosting_comment WHERE hosting_comment_id = '".$comment_id_edit."' ") or die (mysql_error());
           			$comment_edit = mysql_fetch_array($select_comment_edit);
          
						$comment_texts = $comment_edit['hosting_comment_text'];
						$edit_comment_text = $_POST['hosting_comment_text'];
						$edit_comment_text = mysql_real_escape_string($_POST['hosting_comment_text']);
						$edit_comment_text = htmlentities($_POST['hosting_comment_text']);
						$edit_comment_text = trim($_POST['hosting_comment_text']);
						$edit_comment_text = stripslashes($_POST['hosting_comment_text']);
						$edit_comment_text = addslashes($_POST['hosting_comment_text']);
						$edit_comment_text = strip_script($_POST['hosting_comment_text']);
						$edit_comment_text = bbcode_parser($_POST['hosting_comment_text']);
												
						if(isset($_POST['hosting_comment_text']))
						{
							mysql_query("UPDATE hosting_comment SET hosting_comment_text = '".$edit_comment_text."' WHERE hosting_comment_id = '".$comment_id_edit."' ") or die (mysql_error());
						}
						
							if (isset($_POST['Submit']))
							{
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=bgcomment&id=".$id."'>";
							}
						
							echo ("<form  id='edit_comment' name='edit_comment' method='post'>
						  		<p>
						    	<textarea name='hosting_comment_text' cols='50' rows='10' id='textarea' >$comment_texts</textarea>
								<p>
								<input type='hidden' name='token' value='{$token}'/> 
								<input type='submit' name='Submit' id='button' value='{$lang['BODY_NEWS_COMMENT_SUBMIT']}' />
								<input type='reset' name='Reset' id='button' value='{$lang['BODY_NEWS_COMMENT_RESET']}' />
								</p>
								</form>");	
				}
				else
				{
					echo $redirect;
				}
			}
		}
			
		if ($_GET['action'] == 'dmedit')
		{
			#ini_set ("display_errors", "1");
			#error_reporting(E_ALL);
			$comment_id_edit = (INT)$_GET['id_edit'];
			$submit_select_check = mysql_query("SELECT MIN(hosting_domain_id),MAX(hosting_domain_id) FROM hosting_domain WHERE hosting_domain_id = '$comment_id_edit' ") or die (mysql_error());
			while ($submit_validation_check = mysql_fetch_array($submit_select_check))
			{
				if ($submit_validation_check['MAX(hosting_domain_id)'] == $comment_id_edit)
				{
					$select_comment_edit = mysql_query("SELECT hosting_domain_id,hosting_domain_domain,hosting_domain_owner FROM hosting_domain WHERE hosting_domain_id = '".$comment_id_edit."' AND hosting_domain_owner = '".$_SESSION['nick']."' ") or die (mysql_error());
           			$comment_edit = mysql_fetch_array($select_comment_edit);
            
						$domain_name 	  = $comment_edit['hosting_domain_domain'];
						$edit_domain_name = $_POST['hosting_domain_domain'];
						$edit_domain_name = mysql_real_escape_string($_POST['hosting_domain_domain']);
						$edit_domain_name = htmlentities($_POST['hosting_domain_domain']);
						$edit_domain_name = trim($_POST['hosting_domain_domain']);
						$edit_domain_name = stripslashes($_POST['hosting_domain_domain']);
						$edit_domain_name = addslashes($_POST['hosting_domain_domain']);
																
						if(isset($_POST['hosting_domain_domain']))
						{
							mysql_query("UPDATE hosting_domain SET hosting_domain_domain = '".$edit_domain_name."' WHERE hosting_domain_id = '".$comment_id_edit."' AND hosting_domain_owner = '".$_SESSION['nick']."' ") or die (mysql_error());
						}
						
							if (isset($_POST['submit']))
							{
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=lightuserpaneldomainmanage'>";
							}
							
							echo ("<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
							  <tr>
							    <td width='235' valign='top'><div class='border' id='leftdiv'>
							      <h3><strong>{$lang['BODY_LIGHT_USER_PANEL_NAME']}</strong></h3>
							      <hr align='center' noshade='noshade' />
							       <strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_LIMIT']}</strong><br />
							       ");
									echo ("".check_domain_limit()."|");
									echo ("".check_domain_name_limit()."<hr align='center' noshade='noshade' />
							        <strong>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_DB_LIMIT']}</strong><br />");
									echo ("".check_mysqldb_limit()."|");
									echo ("".check_mysql_database_limit()."<hr align='center' noshade='noshade' ");
									
									echo ("<b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_USER_LIMIT']}</b><br>");
									echo ("".check_mysqluser_limit($mysql_check_user_limit)."|");
									echo ("".check_mysql_user_limit()."<hr align='center' noshade='noshade' />");
									
									echo ("<b>{$lang['BODY_LIGHT_USER_PANEL_FTP_LIMIT']}</b><br>");
							        echo ("".check_ftp_user_limit()."|");
							        echo ("".check_ftp_limit()."<hr align='center' noshade='noshade' />
							        <strong>{$lang['BODY_LIGHT_USER_PANEL_HDD_LIMIT']}</strong><br />
							        {$lang['BODY_LIGHT_USER_PANEL_HDD_LIMIT_UNAVAILABLE']}
							        <hr align='center' noshade='noshade' />
							          <strong>{$lang['BODY_LIGHT_USER_PANEL_PLAN']} </strong><br />");
							        echo ("".check_hosting_plan_dates()."
							        <hr align='center' noshade='noshade' />
							        <strong>{$lang['BODY_LIGHT_USER_PANEL']}</strong><br />
							       {$lang['BODY_LIGHT_USER_PANEL_NAME_VERSION']}
							    </div></td>
							    <td width='665' valign='top'>");
							    
							 echo ("<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'>
							      <tr>
							        <td width='29%'><strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_FORM_NAME']}</strong></td>
							        </tr>
							      <tr>
							        <td><form id='form1' name='form1' method='post'>
							  <span id='domain'><strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_FORM_TITLE']}</strong><br />
							  <input name='hosting_domain_domain' type='text' id='text1' size='50' value='{$domain_name}' />
							  <span class='textfieldRequiredMsg'>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_NAME_DOMAIN_REQUIRED']}</span></span><br />
							  
							  <input type='hidden' name='token' value='{$token}'/> 
							  <input type='submit' name='submit' id='button' value='{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_BUTTON_SUBMIT']}' spry:hover='confirmRequiredMsg'/>
							  <input type='reset' name='button2' id='button2' value='{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_BUTTON_RESET']}' />
							</form></td>
							        </tr>
							    </table></td>
							  </tr>
							</table>");
							 
				}
				else
				{
					echo $redirect;
				}
			}
		}
		
	if ($_GET['action'] == 'ftpnedit')
	{
			#ini_set ("display_errors", "1");
			#error_reporting(E_ALL);
			$id_edit = (INT)$_GET['id_edit'];
			$submit_select_check = mysql_query("SELECT MIN(ftpd_id),MAX(ftpd_id) FROM hosting_ftpd WHERE ftpd_id = '$id_edit' ") or die (mysql_error());
			while ($submit_validation_check = mysql_fetch_array($submit_select_check))
			{
				if ($submit_validation_check['MAX(ftpd_id)'] == $id_edit)
				{
					$select_ftp_edit = mysql_query("SELECT * FROM hosting_ftpd WHERE ftpd_id = '".$id_edit."' AND ftpd_owner = '".$_SESSION['nick']."' ") or die (mysql_error());
           			$ftp_edit = mysql_fetch_array($select_ftp_edit);
            
						$ftp_name 	  = $ftp_edit['User'];
						$edit_ftp_name = $_POST['User'];
						$edit_ftp_name = mysql_real_escape_string($_POST['User']);
						$edit_ftp_name = htmlentities($_POST['User']);
						$edit_ftp_name = trim($_POST['User']);
						$edit_ftp_name = stripslashes($_POST['User']);
						$edit_ftp_name = addslashes($_POST['User']);
																
						if(isset($_POST['User']))
						{
							mysql_query("UPDATE hosting_ftpd SET User = '".$edit_ftp_name."' WHERE ftpd_id = '".$id_edit."' AND ftpd_owner = '".$_SESSION['nick']."' ") or die (mysql_error());
						}
						
							if (isset($_POST['submit']))
							{
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=lightuserpanelftpmanage'>";
							}
							
							echo ("<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
							  <tr>
							    <td width='235' valign='top'><div class='border' id='leftdiv'>
							      <h3><strong>{$lang['BODY_LIGHT_USER_PANEL_NAME']}</strong></h3>
							      <hr align='center' noshade='noshade' />
							       <strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_LIMIT']}</strong><br />
							       ");
									echo ("".check_domain_limit()."|");
									echo ("".check_domain_name_limit()."<hr align='center' noshade='noshade' />
							        <strong>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_DB_LIMIT']}</strong><br />");
									echo ("".check_mysqldb_limit()."|");
									echo ("".check_mysql_database_limit()."<hr align='center' noshade='noshade' ");
									
									echo ("<b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_USER_LIMIT']}</b><br>");
									echo ("".check_mysqluser_limit($mysql_check_user_limit)."|");
									echo ("".check_mysql_user_limit()."<hr align='center' noshade='noshade' />");
									
									echo ("<b>{$lang['BODY_LIGHT_USER_PANEL_FTP_LIMIT']}</b><br>");
							        echo ("".check_ftp_user_limit()."|");
							        echo ("".check_ftp_limit()."<hr align='center' noshade='noshade' />
							        <strong>{$lang['BODY_LIGHT_USER_PANEL_HDD_LIMIT']}</strong><br />
							        {$lang['BODY_LIGHT_USER_PANEL_HDD_LIMIT_UNAVAILABLE']}
							        <hr align='center' noshade='noshade' />
							          <strong>{$lang['BODY_LIGHT_USER_PANEL_PLAN']} </strong><br />");
							        echo ("".check_hosting_plan_dates()."
							        <hr align='center' noshade='noshade' />
							        <strong>{$lang['BODY_LIGHT_USER_PANEL']}</strong><br />
							       {$lang['BODY_LIGHT_USER_PANEL_NAME_VERSION']}
							    </div></td>
							    <td width='665' valign='top'>");
							    
							 echo ("<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'>
							      <tr>
							        <td width='29%'><strong>{$lang['BODY_LIGHT_USER_PANEL_FTP_FORM_NAME']}</strong></td>
							        </tr>
							      <tr>
							        <td><form id='form1' name='form1' method='post'>
							        {$lang['BODY_LIGHT_USER_PANEL_FTP_FORM_USERNAME']}<br />
							  <input name='User' type='text' id='text1' size='50' value='".$ftp_name."' />
							  <br>
							  <input type='hidden' name='token' value='{$token}'/> 
							  <input type='submit' name='submit' id='button' value='{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_BUTTON_SUBMIT']}' spry:hover='confirmRequiredMsg'/>
							  <input type='reset' name='button2' id='button2' value='{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_BUTTON_RESET']}' />
							</form></td>
							        </tr>
							    </table></td>
							  </tr>
							</table>"); 
				}
				else
				{
					echo $redirect;
				}
			}
		}
		
	if ($_GET['action'] == 'ftppedit')
	{
			#ini_set ("display_errors", "1");
			#error_reporting(E_ALL);
			$id_edit = (INT)$_GET['id_edit'];
			$submit_select_check = mysql_query("SELECT MIN(ftpd_id),MAX(ftpd_id) FROM hosting_ftpd WHERE ftpd_id = '$id_edit' ") or die (mysql_error());
			while ($submit_validation_check = mysql_fetch_array($submit_select_check))
			{
				if ($submit_validation_check['MAX(ftpd_id)'] == $id_edit)
				{
					$select_ftp_edit = mysql_query("SELECT * FROM hosting_ftpd WHERE ftpd_id = '".$id_edit."' AND ftpd_owner = '".$_SESSION['nick']."' ") or die (mysql_error());
           			$ftp_edit = mysql_fetch_array($select_ftp_edit);
            
						$edit_ftp_pass = $_POST['Password'];
						$edit_ftp_pass = mysql_real_escape_string($_POST['Password']);
						$edit_ftp_pass = htmlentities($_POST['Password']);
						$edit_ftp_pass = trim($_POST['Password']);
						$edit_ftp_pass = stripslashes($_POST['Password']);
						$edit_ftp_pass = addslashes($_POST['Password']);
						$edit_ftp_pass = md5($_POST['Password']);
																
						if(isset($_POST['Password']))
						{
							mysql_query("UPDATE hosting_ftpd SET Password = '".$edit_ftp_pass."' WHERE ftpd_id = '".$id_edit."' AND ftpd_owner = '".$_SESSION['nick']."' ") or die (mysql_error());
						}
						
							if (isset($_POST['submit']))
							{
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=lightuserpanelftpmanage'>";
							}
							
							echo ("<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
							  <tr>
							    <td width='235' valign='top'><div class='border' id='leftdiv'>
							      <h3><strong>{$lang['BODY_LIGHT_USER_PANEL_NAME']}</strong></h3>
							      <hr align='center' noshade='noshade' />
							       <strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_LIMIT']}</strong><br />
							       ");
									echo ("".check_domain_limit()."|");
									echo ("".check_domain_name_limit()."<hr align='center' noshade='noshade' />
							        <strong>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_DB_LIMIT']}</strong><br />");
									echo ("".check_mysqldb_limit()."|");
									echo ("".check_mysql_database_limit()."<hr align='center' noshade='noshade' ");
									
									echo ("<b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_USER_LIMIT']}</b><br>");
									echo ("".check_mysqluser_limit($mysql_check_user_limit)."|");
									echo ("".check_mysql_user_limit()."<hr align='center' noshade='noshade' />");
									
									echo ("<b>{$lang['BODY_LIGHT_USER_PANEL_FTP_LIMIT']}</b><br>");
							        echo ("".check_ftp_user_limit()."|");
							        echo ("".check_ftp_limit()."<hr align='center' noshade='noshade' />
							        <strong>{$lang['BODY_LIGHT_USER_PANEL_HDD_LIMIT']}</strong><br />
							        {$lang['BODY_LIGHT_USER_PANEL_HDD_LIMIT_UNAVAILABLE']}
							        <hr align='center' noshade='noshade' />
							          <strong>{$lang['BODY_LIGHT_USER_PANEL_PLAN']} </strong><br />");
							        echo ("".check_hosting_plan_dates()."
							        <hr align='center' noshade='noshade' />
							        <strong>{$lang['BODY_LIGHT_USER_PANEL']}</strong><br />
							       {$lang['BODY_LIGHT_USER_PANEL_NAME_VERSION']}
							    </div></td>
							    <td width='665' valign='top'>");
							    
							 echo ("<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'>
							      <tr>
							        <td width='29%'><strong>{$lang['BODY_LIGHT_USER_PANEL_FTP_FORM_NAME']}</strong></td>
							        </tr>
							      <tr>
							        <td><form id='form1' name='form1' method='post'>
							 {$lang['BODY_LIGHT_USER_PANEL_FTP_FROM_PASSWORD']}<br />
  							<input name='Password' type='password' id='password1' size='30' />
  							<br>
							  <input type='hidden' name='token' value='{$token}'/> 
							  <input type='submit' name='submit' id='button' value='{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_BUTTON_SUBMIT']}' spry:hover='confirmRequiredMsg'/>
							  <input type='reset' name='button2' id='button2' value='{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_BUTTON_RESET']}' />
							</form></td>
							        </tr>
							    </table></td>
							  </tr>
							</table>"); 
				}
				else
				{
					echo $redirect;
				}
			}
		}		
		
		if ($_GET['comment'] == 'fbtpgedit')
		{
			#ini_set ("display_errors", "1");
			#error_reporting(E_ALL);
			$comment_id_edit = (INT)$_GET['id_edit'];
			$submit_select_check = mysql_query("SELECT MIN(hosting_forum_thread_id),MAX(hosting_forum_thread_id) FROM hosting_forum_thread WHERE hosting_forum_thread_id = '$comment_id_edit' ");
			while ($submit_validation_check = mysql_fetch_array($submit_select_check))
			{
				if ($submit_validation_check['MAX(hosting_forum_thread_id)'] == $comment_id_edit)
				{
					$select_comment_edit = mysql_query("SELECT hosting_forum_thread_id,	hosting_forum_thread_title,hosting_forum_thread_text,hosting_forum_thread_author FROM hosting_forum_thread WHERE hosting_forum_thread_id = '".$comment_id_edit."' ") or die (mysql_error());
           			$comment_edit = mysql_fetch_array($select_comment_edit);
            
						$comment_texts = $comment_edit['hosting_forum_thread_text'];
						$edit_comment_text = $_POST['hosting_forum_thread_text'];
						$edit_comment_text = mysql_real_escape_string($_POST['hosting_forum_thread_text']);
						$edit_comment_text = htmlentities($_POST['hosting_forum_thread_text']);
						$edit_comment_text = trim($_POST['hosting_forum_thread_text']);
						$edit_comment_text = stripslashes($_POST['hosting_forum_thread_text']);
						$edit_comment_text = addslashes($_POST['hosting_forum_thread_text']);
						$edit_comment_text = strip_script($_POST['hosting_forum_thread_text']);
						$edit_comment_text = bbcode_parser($_POST['hosting_forum_thread_text']);
												
						if(isset($_POST['hosting_forum_thread_text']))
						{
							mysql_query("UPDATE hosting_forum_thread SET hosting_forum_thread_text = '".$edit_comment_text."' WHERE hosting_forum_thread_id = '".$comment_id_edit."' ") or die (mysql_error());
						}
						
							if (isset($_POST['Submit']))
							{
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=forumthreadview&id=".$id."'>";
							}
						
							echo ("<form  id='edit_comment' name='edit_comment' method='post'>
						  		<p>
						    	<textarea name='hosting_forum_thread_text' cols='50' rows='10' id='textarea' >$comment_texts</textarea>
								<p>
								<input type='hidden' name='token' value='{$token}'/> 
								<input type='submit' name='Submit' id='button' value='{$lang['BODY_NEWS_COMMENT_SUBMIT']}' />
								<input type='reset' name='Reset' id='button' value='{$lang['BODY_NEWS_COMMENT_RESET']}' />
								</p>
								</form>");	
				}
				else
				{
					echo $redirect;
				}
			}
		}
		
		if ($_GET['comment'] == 'fbthgedit') 
		{
			#ini_set ("display_errors", "1");
			#error_reporting(E_ALL);
			$comment_id_edit = (INT)$_GET['id_edit'];
			$submit_select_check = mysql_query("SELECT MIN(hosting_comment_id),MAX(hosting_comment_id) FROM hosting_comment WHERE hosting_comment_id = '$comment_id_edit' ");
			while ($submit_validation_check = mysql_fetch_array($submit_select_check))
			{
				if ($submit_validation_check['MAX(hosting_comment_id)'] == $comment_id_edit)
				{
					$select_comment_edit = mysql_query("SELECT hosting_comment_id,hosting_comment_text,hosting_comment_nick FROM hosting_comment WHERE hosting_comment_id = '".$comment_id_edit."' ") or die (mysql_error());
           			$comment_edit = mysql_fetch_array($select_comment_edit);
          
						$comment_texts = $comment_edit['hosting_comment_text'];
						$edit_comment_text = $_POST['hosting_comment_text'];
						$edit_comment_text = mysql_real_escape_string($_POST['hosting_comment_text']);
						$edit_comment_text = htmlentities($_POST['hosting_comment_text']);
						$edit_comment_text = trim($_POST['hosting_comment_text']);
						$edit_comment_text = stripslashes($_POST['hosting_comment_text']);
						$edit_comment_text = addslashes($_POST['hosting_comment_text']);
						$edit_comment_text = strip_script($_POST['hosting_comment_text']);
						$edit_comment_text = bbcode_parser($_POST['hosting_comment_text']);
												
						if(isset($_POST['hosting_comment_text']))
						{
							mysql_query("UPDATE hosting_comment SET hosting_comment_text = '".$edit_comment_text."' WHERE hosting_comment_id = '".$comment_id_edit."' ") or die (mysql_error());
						}
						
							if (isset($_POST['Submit']))
							{
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=forumthreadview&id=".$id."'>";
							}
						
							echo ("<form  id='edit_comment' name='edit_comment' method='post'>
						  		<p>
						    	<textarea name='hosting_comment_text' cols='50' rows='10' id='textarea' >$comment_texts</textarea>
								<p>
								<input type='hidden' name='token' value='{$token}'/> 
								<input type='submit' name='Submit' id='button' value='{$lang['BODY_NEWS_COMMENT_SUBMIT']}' />
								<input type='reset' name='Reset' id='button' value='{$lang['BODY_NEWS_COMMENT_RESET']}' />
								</p>
								</form>");	
				}
				else
				{
					echo $redirect;
				}
			}
		}
		
		if ($_GET['comment'] == 'nwedit') 
		{
			#ini_set ("display_errors", "1");
			#error_reporting(E_ALL);
			$comment_id_edit = (INT)$_GET['id_edit'];
			$submit_select_check = mysql_query("SELECT MIN(hosting_comment_id),MAX(hosting_comment_id) FROM hosting_comment WHERE hosting_comment_id = '$comment_id_edit' ");
			while ($submit_validation_check = mysql_fetch_array($submit_select_check))
			{
				if ($submit_validation_check['MAX(hosting_comment_id)'] == $comment_id_edit)
				{
					$select_comment_edit = mysql_query("SELECT hosting_comment_id,hosting_comment_text,hosting_comment_nick FROM hosting_comment WHERE hosting_comment_id = '".$comment_id_edit."' ") or die (mysql_error());
           			$comment_edit = mysql_fetch_array($select_comment_edit);
          
						$comment_texts = $comment_edit['hosting_comment_text'];
						$edit_comment_text = $_POST['hosting_comment_text'];
						$edit_comment_text = mysql_real_escape_string($_POST['hosting_comment_text']);
						$edit_comment_text = htmlentities($_POST['hosting_comment_text']);
						$edit_comment_text = trim($_POST['hosting_comment_text']);
						$edit_comment_text = stripslashes($_POST['hosting_comment_text']);
						$edit_comment_text = addslashes($_POST['hosting_comment_text']);
						$edit_comment_text = strip_script($_POST['hosting_comment_text']);
						$edit_comment_text = bbcode_parser($_POST['hosting_comment_text']);
												
						if(isset($_POST['hosting_comment_text']))
						{
							mysql_query("UPDATE hosting_comment SET hosting_comment_text = '".$edit_comment_text."' WHERE hosting_comment_id = '".$comment_id_edit."' ") or die (mysql_error());
						}
						
							if (isset($_POST['Submit']))
							{
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=nwcomment&id=".$id."'>";
							}
						
							echo ("<form  id='edit_comment' name='edit_comment' method='post'>
						  		<p>
						    	<textarea name='hosting_comment_text' cols='50' rows='10' id='textarea' >$comment_texts</textarea>
								<p>
								<input type='hidden' name='token' value='{$token}'/> 
								<input type='submit' name='Submit' id='button' value='{$lang['BODY_NEWS_COMMENT_SUBMIT']}' />
								<input type='reset' name='Reset' id='button' value='{$lang['BODY_NEWS_COMMENT_RESET']}' />
								</p>
								</form>");	
				}
				else
				{
					echo $redirect;
				}
			}
		}
		
		if ($_GET['profile'] == 'edite') 
		{
			$user_id_edit = (INT)$_GET['id'];
			$submit_user_select_check = mysql_query("SELECT MIN(hosting_user_id),MAX(hosting_user_id) FROM hosting_user WHERE hosting_user_id = '$user_id_edit' ");
			while ($submit_user_validation_check = mysql_fetch_array($submit_user_select_check))
			{
				if ($submit_user_validation_check['MAX(hosting_user_id)'] == $user_id_edit)
				{
					$select_user_edit = mysql_query("SELECT * FROM hosting_user WHERE hosting_user_id = '".$user_id_edit."' AND hosting_user_name = '".$_SESSION['nick']."' ") or die (mysql_error());
           			while($usert_edit = mysql_fetch_array($select_user_edit))
            
           			if ($usert_edit['hosting_user_name'] == $_SESSION['nick'])
           			{
						$orginal_user_avatar = $usert_edit['hosting_user_avatar'];
						$orginal_user_gender = $usert_edit['hosting_user_gender'];
						$orginal_user_email = $usert_edit['hosting_user_email'];
						$orginal_user_homepage = $usert_edit['hosting_user_homepage'];
						$orginal_user_signature= $usert_edit['hosting_user_signature'];
						
						$user_avatar = $_POST['hosting_user_avatar'];
						$user_avatar = mysql_real_escape_string($_POST['hosting_user_avatar']);
						$user_avatar = htmlentities($_POST['hosting_user_avatar']);
						$user_avatar = trim($_POST['hosting_user_avatar']);
						$user_avatar = stripslashes($_POST['hosting_user_avatar']);
						$user_avatar = addslashes($_POST['hosting_user_avatar']);
						
						$user_gender = $_POST['hosting_user_gender'];
						$user_gender = mysql_real_escape_string($_POST['hosting_user_gender']);
						$user_gender = htmlentities($_POST['hosting_user_gender']);
						$user_gender = trim($_POST['hosting_user_gender']);
						$user_gender = stripslashes($_POST['hosting_user_gender']);
						$user_gender = addslashes($_POST['hosting_user_gender']);
						
						$user_email = $_POST['hosting_user_email'];
						$user_email = mysql_real_escape_string($_POST['hosting_user_email']);
						$user_email = htmlentities($_POST['hosting_user_email']);
						$user_email = trim($_POST['hosting_user_email']);
						$user_email = stripslashes($_POST['hosting_user_email']);
						$user_email = addslashes($_POST['hosting_user_email']);
						
						$user_homepage = $_POST['hosting_user_homepage'];
						$user_homepage = mysql_real_escape_string($_POST['hosting_user_homepage']);
						$user_homepage = htmlentities($_POST['hosting_user_homepage']);
						$user_homepage = trim($_POST['hosting_user_homepage']);
						$user_homepage = stripslashes($_POST['hosting_user_homepage']);
						$user_homepage = addslashes($_POST['hosting_user_homepage']);
						
						$user_signature = $_POST['hosting_user_signature'];
						$user_signature = mysql_real_escape_string($_POST['hosting_user_signature']);
						$user_signature = htmlentities($_POST['hosting_user_signature']);
						$user_signature = trim($_POST['hosting_user_signature']);
						$user_signature = stripslashes($_POST['hosting_user_signature']);
						$user_signature = addslashes($_POST['hosting_user_signature']);
						$user_signature = strip_script($_POST['hosting_user_signature']);
						$user_signature = bbcode_parser($_POST['hosting_user_signature']);
												
						if (isset($_POST['Save']))
						{
							if (mysql_query("UPDATE hosting_user SET hosting_user_avatar = '".$user_avatar."', hosting_user_gender = '".$user_gender."', hosting_user_email = '".$user_email."', hosting_user_homepage = '".$user_homepage."', hosting_user_signature = '".$user_signature."' WHERE hosting_user_id = '".$user_id_edit."' AND hosting_user_name = '".$_SESSION['nick']."' ") or die (mysql_error())) 
							{
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=myprofile'>";
							}
						}
						
							echo "<table width='900' border='0' align='center' cellpadding='0' cellspacing='0' class='header' id='TableRoundCorners'>
  <tr>
    <td width='235' valign='top'><div class='border' id='leftdiv'>
        <h3><strong>My Information</strong> </h3>
        <hr align='center' noshade='noshade' />
        Total Contact Messages<br />
        <a href='#' class='tooltip'>1<span>Active tickets whom require attention</span></a>  | ~
        <hr align='center' noshade='noshade' />
        </p>
       Total News Comments </strong><br />
        <a href='#'>1</a> | ~
        <hr align='center' noshade='noshade' />
        Total Blog Comments </strong><br />
        <a href='#'>1</a> | ~
        <hr align='center' noshade='noshade' />
        Total Forum Comments </strong><br />
        <a href='#'>1</a> | ~
        <hr align='center' noshade='noshade' />
        Total Forum Treads <br />
        <a href='#'>1</a> | ~
        <hr align='center' noshade='noshade' />
        <strong>Light User Panel <br />
        Version | 0.0.1 <strong>
        <hr align='center' noshade='noshade' />
      </div></td>
    <td width='665' valign='top'>
    <table width='664' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'>
        <tr>
          <td width='200' ><strong>User Settings</strong></td>
        </tr>
        <tr>
          <td>
          <form method='post'>
          <table width='70%' border='0' align='center' cellpadding='0' cellspacing='0' class='border'>
  <tr>
    <td class='header' id='MyOrderTable'>Avatar</td>
      
    <td class='header' id='MyOrderTable'><label for='avatar'></label>
      <textarea name='hosting_user_avatar' id='avatar'>{$orginal_user_avatar}</textarea></td>
    </tr>
  <tr>
    <td class='header' id='MyOrderTable'>Gender</td>
    <td class='header' id='MyOrderTable'><select name='hosting_user_gender' id='gender' >";
							if ($orginal_user_gender == Male)
							{
								echo "<option>$orginal_user_gender</option>
									 <option>Female</option>";
							}
							elseif ($orginal_user_gender == Female)
							{
								echo "<option>$orginal_user_gender</option>
									 <option>Male</option>";
								
							}
							
	echo "</select></td>
    </tr>
  <tr>
    <td class='header' id='MyOrderTable'>E-Mail</td>
    <td class='header' id='MyOrderTable'><input name='hosting_user_email' type='text' id='email' value='{$orginal_user_email}' size='25' /></td>
    </tr>
  <tr>
    <td class='header' id='MyOrderTable'>Home Page</td>
    <td class='header' id='MyOrderTable'><input name='hosting_user_homepage' type='text' id='homepage' value='{$orginal_user_homepage}' size='25' /></td>
  </tr>
  <tr>
    <td class='header' id='MyOrderTable2'>My Signature</td>
    <td class='header' id='MyOrderTable2'><textarea name='hosting_user_signature' cols='25' id='mysignature'>{$orginal_user_signature}</textarea></td>
  </tr>
          </table>            
            <input type='submit' name='Save' id='Save' value='Save' />
          </form>
          <p></td>
        </tr>
    </table></td>
  </tr>
</table>";
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
		
		if ($_GET['profile'] == 'manager') 
		{
			$user_mange_id_edit = (INT)$_GET['id'];
			$submit_user_select_check = mysql_query("SELECT MIN(hosting_user_id),MAX(hosting_user_id) FROM hosting_user WHERE hosting_user_id = '$user_mange_id_edit' ");
			while ($submit_user_validation_check = mysql_fetch_array($submit_user_select_check))
			{
				if ($submit_user_validation_check['MAX(hosting_user_id)'] == $user_mange_id_edit)
				{
           			$user_manager_select = mysql_query("SELECT * FROM hosting_user WHERE hosting_user_id = '{$user_mange_id_edit}' ") or die(mysql_error());
           			$user_profile_edit = mysql_fetch_array($user_manager_select);
           			 
           			//user orginal values fetch
						$my_user_avatar    			= $user_profile_edit['hosting_user_avatar'];
						$my_user_gender    			= $user_profile_edit['hosting_user_gender'];
						$my_user_email     			= $user_profile_edit['hosting_user_email'];
						$my_user_homepage  			= $user_profile_edit['hosting_user_homepage'];
						$my_user_signature 			= $user_profile_edit['hosting_user_signature'];
						$my_user_violation 			= $user_profile_edit['hosting_user_violation'];
						$my_user_warnings 	 		= $user_profile_edit['hosting_user_warnings'];
						
					//administraion orginal values fetch
						$my_user_rights 			= $user_profile_edit['hosting_user_rights'];
						$my_user_admin_rightst 		= $user_profile_edit['hosting_user_admin_rights'];
						$my_user_hosting_rights 	= $user_profile_edit['hosting_permission_for_status']; 
						$my_user_hosting_plan_start = $user_profile_edit['hosting_user_hosting_plan_start'];
						$my_user_hosting_plan_end 	= $user_profile_edit['hosting_user_hosting_plan_end'];
						$my_user_hosting_bonus 		= $user_profile_edit['hosting_user_bonus'];
							
					//user post values	
						$user_avatar = $_POST['hosting_user_avatar'];
						$user_avatar = mysql_real_escape_string($_POST['hosting_user_avatar']);
						$user_avatar = htmlentities($_POST['hosting_user_avatar']);
						$user_avatar = trim($_POST['hosting_user_avatar']);
						$user_avatar = stripslashes($_POST['hosting_user_avatar']);
						$user_avatar = addslashes($_POST['hosting_user_avatar']);
						
						$user_gender = $_POST['hosting_user_gender'];
						$user_gender = mysql_real_escape_string($_POST['hosting_user_gender']);
						$user_gender = htmlentities($_POST['hosting_user_gender']);
						$user_gender = trim($_POST['hosting_user_gender']);
						$user_gender = stripslashes($_POST['hosting_user_gender']);
						$user_gender = addslashes($_POST['hosting_user_gender']);
						
						$user_email = $_POST['hosting_user_email'];
						$user_email = mysql_real_escape_string($_POST['hosting_user_email']);
						$user_email = htmlentities($_POST['hosting_user_email']);
						$user_email = trim($_POST['hosting_user_email']);
						$user_email = stripslashes($_POST['hosting_user_email']);
						$user_email = addslashes($_POST['hosting_user_email']);
						
						$user_homepage = $_POST['hosting_user_homepage'];
						$user_homepage = mysql_real_escape_string($_POST['hosting_user_homepage']);
						$user_homepage = htmlentities($_POST['hosting_user_homepage']);
						$user_homepage = trim($_POST['hosting_user_homepage']);
						$user_homepage = stripslashes($_POST['hosting_user_homepage']);
						$user_homepage = addslashes($_POST['hosting_user_homepage']);
						
						$user_signature = $_POST['hosting_user_signature'];
						$user_signature = mysql_real_escape_string($_POST['hosting_user_signature']);
						$user_signature = htmlentities($_POST['hosting_user_signature']);
						$user_signature = trim($_POST['hosting_user_signature']);
						$user_signature = stripslashes($_POST['hosting_user_signature']);
						$user_signature = addslashes($_POST['hosting_user_signature']);
						$user_signature = strip_script($_POST['hosting_user_signature']);
						$user_signature = bbcode_parser($_POST['hosting_user_signature']);
						
						$user_violation = $_POST['hosting_user_violation'];
						$user_violation = mysql_real_escape_string($_POST['hosting_user_violation']);
						$user_violation = htmlentities($_POST['hosting_user_violation']);
						$user_violation = trim($_POST['hosting_user_violation']);
						$user_violation = stripslashes($_POST['hosting_user_violation']);
						$user_violation = addslashes($_POST['hosting_user_violation']);
						
						$user_warnings = $_POST['hosting_user_warnings'];
						$user_warnings = mysql_real_escape_string($_POST['hosting_user_warnings']);
						$user_warnings = htmlentities($_POST['hosting_user_warnings']);
						$user_warnings = trim($_POST['hosting_user_warnings']);
						$user_warnings = stripslashes($_POST['hosting_user_warnings']);
						$user_warnings = addslashes($_POST['hosting_user_warnings']);
						
					//administrator post values	
						$user_rights = $_POST['hosting_user_rights'];
						$user_rights = mysql_real_escape_string($_POST['hosting_user_rights']);
						$user_rights = htmlentities($_POST['hosting_user_rights']);
						$user_rights = trim($_POST['hosting_user_rights']);
						$user_rights = stripslashes($_POST['hosting_user_rights']);
						$user_rights = addslashes($_POST['hosting_user_rights']);
						
						$user_admin_rights = $_POST['hosting_user_admin_rights'];
						$user_admin_rights = mysql_real_escape_string($_POST['hosting_user_admin_rights']);
						$user_admin_rights = htmlentities($_POST['hosting_user_admin_rights']);
						$user_admin_rights = trim($_POST['hosting_user_admin_rights']);
						$user_admin_rights = stripslashes($_POST['hosting_user_admin_rights']);
						$user_admin_rights = addslashes($_POST['hosting_user_admin_rights']);
						
						
						$user_hosting_rights = $_POST['hosting_permission_for_status'];
						$user_hosting_rights = mysql_real_escape_string($_POST['hosting_permission_for_status']);
						$user_hosting_rights = htmlentities($_POST['hosting_permission_for_status']);
						$user_hosting_rights = trim($_POST['hosting_permission_for_status']);
						$user_hosting_rights = stripslashes($_POST['hosting_permission_for_status']);
						$user_hosting_rights = addslashes($_POST['hosting_permission_for_status']);
						
						$user_hosting_plan_start = $_POST['hosting_user_hosting_plan_start'];
						$user_hosting_plan_start = mysql_real_escape_string($_POST['hosting_user_hosting_plan_start']);
						$user_hosting_plan_start = htmlentities($_POST['hosting_user_hosting_plan_start']);
						$user_hosting_plan_start = trim($_POST['hosting_user_hosting_plan_start']);
						$user_hosting_plan_start = stripslashes($_POST['hosting_user_hosting_plan_start']);
						$user_hosting_plan_start = addslashes($_POST['hosting_user_hosting_plan_start']);
						
						$user_hosting_plan_end = $_POST['hosting_user_hosting_plan_end'];
						$user_hosting_plan_end = mysql_real_escape_string($_POST['hosting_user_hosting_plan_end']);
						$user_hosting_plan_end = htmlentities($_POST['hosting_user_hosting_plan_end']);
						$user_hosting_plan_end = trim($_POST['hosting_user_hosting_plan_end']);
						$user_hosting_plan_end = stripslashes($_POST['hosting_user_hosting_plan_end']);
						$user_hosting_plan_end = addslashes($_POST['hosting_user_hosting_plan_end']);
						
						$user_hosting_bonus = $_POST['hosting_user_bonus'];
						$user_hosting_bonus = mysql_real_escape_string($_POST['hosting_user_bonus']);
						$user_hosting_bonus = htmlentities($_POST['hosting_user_bonus']);
						$user_hosting_bonus = trim($_POST['hosting_user_bonus']);
						$user_hosting_bonus = stripslashes($_POST['hosting_user_bonus']);
						$user_hosting_bonus = addslashes($_POST['hosting_user_bonus']);
												
						if (isset($_POST['Save']))
						{
							if (mysql_query("UPDATE hosting_user SET hosting_user_avatar = '".$user_avatar."', hosting_user_gender = '".$user_gender."', hosting_user_email = '".$user_email."', hosting_user_homepage = '".$user_homepage."', hosting_user_signature = '".$user_signature."', hosting_user_violation = '".$user_violation."', hosting_user_warnings = '".$user_warnings."', hosting_user_rights  = '".$user_rights."', hosting_user_admin_rights = '".$user_admin_rights."', hosting_permission_for_status = '".$user_hosting_rights."', hosting_user_hosting_plan_start = '".$user_hosting_plan_start."', hosting_user_hosting_plan_end = '".$user_hosting_plan_end."', hosting_user_bonus = '".$user_hosting_bonus."' WHERE hosting_user_id = '".$user_mange_id_edit."' ") or die (mysql_error())) 
							{
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=news'>";
							}
						}
    
           			
			echo "<table width='900' border='0' align='center' cellpadding='0' cellspacing='0' class='header' id='TableRoundCorners'>
  <tr>
    <td width='235' valign='top'><div class='border' id='leftdiv'>
        <h3><strong>My Information</strong> </h3>
        <hr align='center' noshade='noshade' />
        Total Contact Messages<br />
        <a href='#' class='tooltip'>1<span>Active tickets whom require attention</span></a> | ~
        <hr align='center' noshade='noshade' />
        </p>
        Total News Comments </strong><br />
        <a href='#'>1</a> | ~
        <hr align='center' noshade='noshade' />
        Total Blog Comments </strong><br />
        <a href='#'>1</a> | ~
        <hr align='center' noshade='noshade' />
        Total Forum Comments </strong><br />
        <a href='#'>1</a> | ~
        <hr align='center' noshade='noshade' />
        Total Forum Treads <br />
        <a href='#'>1</a> | ~
        <hr align='center' noshade='noshade' />
        <strong>Light User Panel <br />
        Version | 0.0.1 <strong>
        <hr align='center' noshade='noshade' />
      </div></td>
    <form method='post'>
      <td width='665' valign='top'><table width='664' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'>
          <tr>
            <td width='200' ><strong>User Settings</strong></td>
          </tr>
          <tr>
            <td><table width='70%' border='0' align='center' cellpadding='0' cellspacing='0' class='border'>
                <tr>
                  <td class='header' id='MyOrderTable'>Avatar</td>
                  <td class='header' id='MyOrderTable'><label for='checkbox'>
                      <input name='hosting_user_avatar' type='text' id='hosting_user_avatar' value='{$my_user_avatar}' size='25' />
                  </label></td>
                </tr>
                <tr>
                  <td class='header' id='MyOrderTable'>Gender</td>
                  <td class='header' id='MyOrderTable'><select name='hosting_user_gender' id='hosting_user_gender' >";
                  if ($my_user_gender == Male)
				  {
				 	echo "<option>$my_user_gender</option>
						  <option>Female</option>";
				  }
				  elseif ($my_user_gender == Female)
				  {
				  	echo "<option>$my_user_gender</option>
						  <option>Male</option>";		
				  }
                      echo "
                    </select></td>
                    
                </tr>
                <tr>
                  <td class='header' id='MyOrderTable'>E-Mail</td>
                  <td class='header' id='MyOrderTable'><input name='hosting_user_email' type='text' id='hosting_user_email' value='{$my_user_email}' size='25' /></td>
                </tr>
                <tr>
                  <td class='header' id='MyOrderTable'>Home Page</td>
                  <td class='header' id='MyOrderTable'><input name='hosting_user_homepage' type='text' id='hosting_user_homepage' value='{$my_user_homepage}' size='25' /></td>
                </tr>
                <tr>
                  <td class='header' id='MyOrderTable'> Signature</td>
                  <td class='header' id='MyOrderTable'><input name='hosting_user_signature' type='text' id='hosting_user_signature' value='{$my_user_signature}' size='25' /></td>
                </tr>
                <tr>
                  <td class='header' id='MyOrderTable'>Warning</td>
                  <td class='header' id='MyOrderTable'><textarea name='hosting_user_warnings' cols='25' rows='1' id='hosting_user_warnings'>$my_user_warnings</textarea></td>
                </tr>
                <tr>
                  <td height='27' class='header' id='MyOrderTable'>Violation</td>
                  <td class='header' id='MyOrderTable'><label for='hostingstart'>
                      <textarea name='hosting_user_violation' cols='25' rows='1' id='hosting_user_violation'>$my_user_violation</textarea>
                    </label></td>
                </tr>
              </table>
              <p> </td>
          </tr>
          <tr>
            <td><b>Administrator Settings</b>
              <table width='70%' border='0' align='center' cellpadding='0' cellspacing='0' class='border'>
                <tr>
                  <td class='header' id='MyOrderTable'>User Group</td>
                  <td class='header' id='MyOrderTable'><select name='hosting_user_rights' id='hosting_user_rights'>
                      <option>0</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                      <option>6</option>
                    </select>
                    <label for='checkbox'></label></td>
                </tr>
                <tr>
                  <td class='header' id='MyOrderTable'>Administrator Rights</td>
                  <td class='header' id='MyOrderTable'><select name='hosting_user_admin_rights' id='hosting_user_admin_rights'>
                      <option>0</option>
                      <option>1</option>
                  </select></td>
                </tr>
                <tr>
                  <td class='header' id='MyOrderTable'>Hosting Rights</td>
                  <td class='header' id='MyOrderTable'><select name='hosting_permission_for_status' id='hosting_permission_for_status'>
                      <option>0</option>
                      <option>1</option>
                  </select></td>
                </tr>
                <tr>
                  <td class='header' id='MyOrderTable'>Hosting Plan Start</td>
                  <td class='header' id='MyOrderTable'><input type='text' name='hosting_user_hosting_plan_start' id='hosting_user_hosting_plan_start' value='{$my_user_hosting_plan_start}'  /></td>
                </tr>
                <tr>
                  <td class='header' id='MyOrderTable'>Hosting Plan End</td>
                  <td class='header' id='MyOrderTable'><input type='text' name='hosting_user_hosting_plan_end' id='hosting_user_hosting_plan_end' value='{$my_user_hosting_plan_end}'/></td>
                </tr>
                <tr>
                  <td class='header' id='MyOrderTable'>Bonus</td>
                  <td class='header' id='MyOrderTable'><input type='text' name='hosting_user_bonus' id='hosting_user_bonus' value='{$my_user_hosting_bonus}' /></td>
                </tr>
              </table>
              <br />
              <input type='submit' name='Save' id='Save' value='Save' /></td>
          </tr>
        </table>
    </form>
      </td>
  </tr>
</table>";

				}
				else
				{
					echo $redirect;
				}
			}
		}
	}
	elseif ($_SESSION['permission'] < 2)
	{
		echo $redirect;
	}
}
else 
{
	echo $redirect;	
}
?>