<?php
if ($_SESSION['logged_in']) 
{
	if ($_SESSION['permission'] >= 2) 
	{
		if ((isset($_GET['action'])) && (ctype_alpha($_GET['action'])) ? ctype_lower($_GET['action']) : '')		
		{
			$limit = 15;
			if ($_GET['action'] == 'sendbox') 
			{
				$count_inbox_pm = mysql_query("SELECT COUNT(hosting_pm_outbox_author) FROM hosting_pm_outbox WHERE hosting_pm_outbox_author = '".$_SESSION['nick']."' ");
				while ($inbox_pm_check = mysql_fetch_array($count_inbox_pm))
				if ($inbox_pm_check['COUNT(hosting_pm_outbox_author)'] != 15) 
				{
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
					  $rules[] = "required,hosting_pm_title,{$lang['BODY_FORUM_THREAD_COMMENT_VALIDATION_FILL_TEXT']}";
					  $rules[] = "required,hosting_pm_text,{$lang['BODY_FORUM_THREAD_COMMENT_VALIDATION_FILL_TEXT']}";
					  
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
								$pm_author = $_POST['hosting_pm_author'];
								$pm_author = mysql_real_escape_string($_POST['hosting_pm_author']);
								$pm_author = htmlentities($_POST['hosting_pm_author']);
								$pm_author = trim($_POST['hosting_pm_author']);
								$pm_author = addslashes($_POST['hosting_pm_author']);
								$pm_author = $_SESSION['nick'];
								
								$pm_title = $_POST['hosting_pm_title'];
								$pm_title = mysql_real_escape_string($_POST['hosting_pm_title']);
								$pm_title = htmlentities($_POST['hosting_pm_title']);
								$pm_title = trim($_POST['hosting_pm_title']);
								$pm_title = addslashes($_POST['hosting_pm_title']);
								
								$pm_receiver = $_POST['hosting_pm_receiver'];
								$pm_receiver = mysql_real_escape_string($_POST['hosting_pm_receiver']);
								$pm_receiver = htmlentities($_POST['hosting_pm_receiver']);
								$pm_receiver = trim($_POST['hosting_pm_receiver']);
								$pm_receiver = addslashes($_POST['hosting_pm_receiver']);
								
								$pm_text = $_POST['hosting_pm_text'];
								$pm_text = mysql_real_escape_string($_POST['hosting_pm_text']);
								$pm_text = htmlentities($_POST['hosting_pm_text']);
								$pm_text = trim($_POST['hosting_pm_text']);
								$pm_text = addslashes($_POST['hosting_pm_text']);
								$pm_text = strip_script($_POST['hosting_pm_text']);
								$pm_text = bbcode_parser($_POST['hosting_pm_text']);
								
								if (mysql_query("INSERT INTO hosting_pm (hosting_pm_author,hosting_pm_title,hosting_pm_receiver,hosting_pm_text,hosting_pm_date,hosting_pm_time) VALUES ('".$pm_author."','".$pm_title."','".$pm_receiver."','".$pm_text."','".$date."','".$time."'); ") or die(mysql_error())) 
								{
									mysql_query("INSERT INTO hosting_pm_outbox (hosting_pm_outbox_author,hosting_pm_outbox_title,hosting_pm_outbox_receiver,hosting_pm_outbox_text,hosting_pm_outbox_date,hosting_pm_outbox_time) VALUES ('".$pm_author."','".$pm_title."','".$pm_receiver."','".$pm_text."','".$date."','".$time."'); ") or die(mysql_error());
									echo "<meta http-equiv='REFRESH' content='0;url=/?section=pm&action=inbox'>";
								}
							}
						}		
					}
					
				$token = sha1(uniqid(rand(), true));
				$_SESSION['token'] = $token;
					
						$select_names_recipient = mysql_query("SELECT hosting_user_name FROM hosting_user WHERE hosting_user_rights >= '2' ") or die(mysql_error());
						if (mysql_numrows($select_names_recipient) > 0) 
						{		
							echo "<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
						  	<tr>
						    <td width='235' valign='top'><div class='border' id='leftdiv'>
						      <h3><strong>{$lang['BODY_LIGHT_EMAIL_PANEL_NAME']}</strong></h3>
						          <hr align='center' noshade='noshade' />
						        <strong>{$lang['BODY_LIGHT_EMAIL_PANEL_SECTION']}</strong><br />
						        <a href='/?section=pm&action=inbox'>{$lang['BODY_LIGHT_EMAIL_PANEL_LINK_INBOX']}</a><br />
						        <a href='/?section=pm&action=outbox'>{$lang['BODY_LIGHT_EMAIL_PANEL_LINK_OUTBOX']}</a><br />
						        <a href='/?section=pm&action=sendbox'>{$lang['BODY_LIGHT_EMAIL_PANEL_LINK_SEND_MESSAGE']}</a>
						      <hr align='center' noshade='noshade' />
						       <strong>{$lang['BODY_LIGHT_EMAIL_PANEL_INBOX_LIMIT']}</strong><br />";
						       echo "".check_inbox_pm_limit()."|";
						       echo "".check_inbox_limit()."<hr align='center' noshade='noshade' />
						        <strong>{$lang['BODY_LIGHT_EMAIL_PANEL_OUTBOX_LIMIT']}</strong><br />";
						      echo "".check_outbox_pm_limit()."|";
						      echo "".check_outbox_limit()."<hr align='center' noshade='noshade' />";
						      echo "<strong>{$lang['BODY_LIGHT_EMAIL_PANEL']}</strong><br />
						       {$lang['BODY_LIGHT_EMAIL_PANEL_VERSION']}
						    </div></td>
						    <td width='665' valign='top'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'>
						      <tr>
						        <td width='29%'><strong>{$lang['BODY_LIGHT_EMAIL_PANEL_SENDBOX_MANAGE']}</strong></td>
						        </tr>
						      <tr>
						        <td><div align='center'>
						        ";
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
						       echo "<form id='form1' name='form1' method='post'>
						          {$lang['BODY_LIGHT_EMAIL_PANEL_SENDBOX_RECIPIENT']}:<br /><select name='hosting_pm_receiver' id='select'>";
									while ($recipient_names = mysql_fetch_array($select_names_recipient))
									{
										echo "<option>{$recipient_names['hosting_user_name']}</option>";
									}
									echo "</select>
						          <br />
						          {$lang['BODY_LIGHT_EMAIL_PANEL_SENDBOX_TITLE']}:<br />
						          <input name='hosting_pm_title' type='text' id='textfield' size='50' />
						          <br />
						          {$lang['BODY_LIGHT_EMAIL_PANEL_SENDBOX_MESSAGE']}:<br />
						          <textarea name='hosting_pm_text' id='textarea' cols='60' rows='15'></textarea>
						          <br />
						             <input type='hidden' name='token' value='{$token}'/> 
						          <input type='submit' name='Submit' id='Submit' value='{$lang['BODY_LIGHT_EMAIL_PANEL_SENDBOX_BUTTON_SUBMIT']}' />
						          <input type='reset' name='Reset' id='Reset' value='{$lang['BODY_LIGHT_EMAIL_PANEL_SENDBOX_BUTTON_RESET']}' />
						        </form></div></td>
						      </tr>
						    </table></td>
						  </tr>
						</table>";
						}
						else
						{
							echo "mistake";
						}
				}
				else
				{
					echo "<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
						  <tr>
						    <td width='235' valign='top'><div class='border' id='leftdiv'>
						    	<h3><strong>{$lang['BODY_LIGHT_EMAIL_PANEL_NAME']}</strong></h3>
						          <hr align='center' noshade='noshade' />
						        <strong>{$lang['BODY_LIGHT_EMAIL_PANEL_SECTION']}</strong><br />
						        <a href='/?section=pm&action=inbox'>{$lang['BODY_LIGHT_EMAIL_PANEL_LINK_INBOX']}</a><br />
						        <a href='/?section=pm&action=outbox'>{$lang['BODY_LIGHT_EMAIL_PANEL_LINK_OUTBOX']}</a><br />
						        <a href='/?section=pm&action=sendbox'>{$lang['BODY_LIGHT_EMAIL_PANEL_LINK_SEND_MESSAGE']}</a>
						      <hr align='center' noshade='noshade' />
						       <strong>{$lang['BODY_LIGHT_EMAIL_PANEL_INBOX_LIMIT']}</strong><br />";
						       echo "".check_inbox_pm_limit()."|";
						       echo "".check_inbox_limit()."<hr align='center' noshade='noshade' />
						        <strong>{$lang['BODY_LIGHT_EMAIL_PANEL_OUTBOX_LIMIT']}</strong><br />";
						      echo "".check_outbox_pm_limit()."|";
						      echo "".check_outbox_limit()."<hr align='center' noshade='noshade' />";
						      echo "<strong>{$lang['BODY_LIGHT_EMAIL_PANEL']}</strong><br />
						       {$lang['BODY_LIGHT_EMAIL_PANEL_VERSION']}
						    </div></td>
						    <td width='665' valign='top'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'>
						      <tr>
						        <td width='29%'><strong>{$lang['BODY_LIGHT_EMAIL_PANEL_SENDBOX_MANAGE']}</strong></td>
						        </tr>
						        <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
						          <tr>
						            <td width='61%'>{$lang['BODY_LIGHT_EMAIL_PANEL_SENDBOX_OUTBOX_FULL']}</td>
						          </tr>
						          </table></td>
						      </tr>
						    </table></td>
						  </tr>
						</table>";
				}
			}
			elseif ($_GET['action'] == 'outbox')
			{
				$select_outbox = mysql_query("SELECT * FROM hosting_pm_outbox WHERE hosting_pm_outbox_author = '".$_SESSION['nick']."' LIMIT $limit");
				if (mysql_num_rows($select_outbox) != 0) 
				{
					echo "<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
							  <tr>
							    <td width='235' valign='top'><div class='border' id='leftdiv'>
							     <h3><strong>{$lang['BODY_LIGHT_EMAIL_PANEL_NAME']}</strong></h3>
						          <hr align='center' noshade='noshade' />
						        <strong>{$lang['BODY_LIGHT_EMAIL_PANEL_SECTION']}</strong><br />
						        <a href='/?section=pm&action=inbox'>{$lang['BODY_LIGHT_EMAIL_PANEL_LINK_INBOX']}</a><br />
						        <a href='/?section=pm&action=outbox'>{$lang['BODY_LIGHT_EMAIL_PANEL_LINK_OUTBOX']}</a><br />
						        <a href='/?section=pm&action=sendbox'>{$lang['BODY_LIGHT_EMAIL_PANEL_LINK_SEND_MESSAGE']}</a>
						      <hr align='center' noshade='noshade' />
						       <strong>{$lang['BODY_LIGHT_EMAIL_PANEL_INBOX_LIMIT']}</strong><br />";
						       echo "".check_inbox_pm_limit()."|";
						       echo "".check_inbox_limit()."<hr align='center' noshade='noshade' />
						        <strong>{$lang['BODY_LIGHT_EMAIL_PANEL_OUTBOX_LIMIT']}</strong><br />";
						      echo "".check_outbox_pm_limit()."|";
						      echo "".check_outbox_limit()."<hr align='center' noshade='noshade' />";
						      echo "<strong>{$lang['BODY_LIGHT_EMAIL_PANEL']}</strong><br />
						       {$lang['BODY_LIGHT_EMAIL_PANEL_VERSION']}
							    </div></td>
							    <td width='665' valign='top'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'>
							      <tr>
							        <td width='29%'><strong>{$lang['BODY_LIGHT_EMAIL_PANEL_OUTBOX']}</strong></td>
							        </tr>
							      <tr>
							        <td><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'>";
					$count_outbox_pm = mysql_query("SELECT COUNT(hosting_pm_outbox_author) FROM hosting_pm_outbox WHERE hosting_pm_outbox_author = '".$_SESSION['nick']."' LIMIT $limit ");
					while ($outbox_pm_check = mysql_fetch_array($count_outbox_pm))
					if ($outbox_pm_check['COUNT(hosting_pm_outbox_author)'] == $limit) 
					{
						echo "<span style='color:darkred'>{$lang['BODY_LIGHT_EMAIL_PANEL_OUTBOX_FULL']}</span>";
					}
					while ($outbox = mysql_fetch_array($select_outbox))
					{
						echo "<tr><td width='30%'>Title:<a href='/?section=pm&action=outboxread&id=".$outbox['hosting_pm_outbox_id']."'>".$outbox['hosting_pm_outbox_title']."</a></td>
							  <td width='30%'> Recipient:<a href='/?section=viewprofile&name={$outbox['hosting_pm_outbox_receiver']}'>{$outbox['hosting_pm_outbox_receiver']}</a></td>
							  <td width='40%'>Sent ".$outbox['hosting_pm_outbox_time'].": ".$outbox['hosting_pm_outbox_date']." <a href='/?section=delete&action=outbox&id=".$outbox['hosting_pm_outbox_id']."'>{$lang['BODY_DELETE']}</a></td></tr>";
					}
					echo "</table></td></tr></table></td></tr></table>";
				}
				else
				{
					echo "<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
						  <tr>
						    <td width='235' valign='top'><div class='border' id='leftdiv'>
						      <h3><strong>{$lang['BODY_LIGHT_EMAIL_PANEL_NAME']}</strong></h3>
						          <hr align='center' noshade='noshade' />
						        <strong>{$lang['BODY_LIGHT_EMAIL_PANEL_SECTION']}</strong><br />
						        <a href='/?section=pm&action=inbox'>{$lang['BODY_LIGHT_EMAIL_PANEL_LINK_INBOX']}</a><br />
						        <a href='/?section=pm&action=outbox'>{$lang['BODY_LIGHT_EMAIL_PANEL_LINK_OUTBOX']}</a><br />
						        <a href='/?section=pm&action=sendbox'>{$lang['BODY_LIGHT_EMAIL_PANEL_LINK_SEND_MESSAGE']}</a>
						      <hr align='center' noshade='noshade' />
						       <strong>{$lang['BODY_LIGHT_EMAIL_PANEL_INBOX_LIMIT']}</strong><br />";
						       echo "".check_inbox_pm_limit()."|";
						       echo "".check_inbox_limit()."<hr align='center' noshade='noshade' />
						        <strong>{$lang['BODY_LIGHT_EMAIL_PANEL_OUTBOX_LIMIT']}</strong><br />";
						      echo "".check_outbox_pm_limit()."|";
						      echo "".check_outbox_limit()."<hr align='center' noshade='noshade' />";
						      echo "<strong>{$lang['BODY_LIGHT_EMAIL_PANEL']}</strong><br />
						       {$lang['BODY_LIGHT_EMAIL_PANEL_VERSION']}
						    </div></td>
						    <td width='665' valign='top'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'>
						      <tr>
						        <td width='29%'><strong>{$lang['BODY_LIGHT_EMAIL_PANEL_OUTBOX']}</strong></td>
						        </tr>
						      <tr>
						        <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
						          <tr>
						            <td width='61%'>{$lang['BODY_LIGHT_EMAIL_PANEL_OUTBOX_EMPTY']}</td>
						          </tr>
						          </table></td>
						      </tr>
						    </table></td>
						  </tr>
						</table>";
				}
			}
			elseif ($_GET['action'] == 'outboxread')
			{
				if ($id = ((isset($_GET['id'])) && (ctype_digit($_GET['id'])) ? (int)$_GET['id'] : ''))		
				{
					$outboxread_select = mysql_query("SELECT * FROM hosting_pm_outbox WHERE hosting_pm_outbox_id = '".$id."' AND hosting_pm_outbox_author = '".$_SESSION['nick']."' ");
					if (mysql_num_rows($outboxread_select) != 0) 
					{
						echo "<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
						  <tr>
						    <td width='235' valign='top'><div class='border' id='leftdiv'>
						       <h3><strong>{$lang['BODY_LIGHT_EMAIL_PANEL_NAME']}</strong></h3>
						          <hr align='center' noshade='noshade' />
						        <strong>{$lang['BODY_LIGHT_EMAIL_PANEL_SECTION']}</strong><br />
						        <a href='/?section=pm&action=inbox'>{$lang['BODY_LIGHT_EMAIL_PANEL_LINK_INBOX']}</a><br />
						        <a href='/?section=pm&action=outbox'>{$lang['BODY_LIGHT_EMAIL_PANEL_LINK_OUTBOX']}</a><br />
						        <a href='/?section=pm&action=sendbox'>{$lang['BODY_LIGHT_EMAIL_PANEL_LINK_SEND_MESSAGE']}</a>
						      <hr align='center' noshade='noshade' />
						       <strong>{$lang['BODY_LIGHT_EMAIL_PANEL_INBOX_LIMIT']}</strong><br />";
						       echo "".check_inbox_pm_limit()."|";
						       echo "".check_inbox_limit()."<hr align='center' noshade='noshade' />
						        <strong>{$lang['BODY_LIGHT_EMAIL_PANEL_OUTBOX_LIMIT']}</strong><br />";
						      echo "".check_outbox_pm_limit()."|";
						      echo "".check_outbox_limit()."<hr align='center' noshade='noshade' />";
						      echo "<strong>{$lang['BODY_LIGHT_EMAIL_PANEL']}</strong><br />
						       {$lang['BODY_LIGHT_EMAIL_PANEL_VERSION']}
						    </div></td>
						    <td width='665' valign='top'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'>
						      <tr>
						        <td width='29%'><strong>{$lang['BODY_LIGHT_EMAIL_PANEL_OUTBOXREAD']}</strong></td>
						        </tr>
						      <tr>
						        <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
						          <tr>";
						while ($outboxread = mysql_fetch_array($outboxread_select))
						{
							echo "<td width='61%'>".$outboxread['hosting_pm_outbox_title']." {$lang['BODY_LIGHT_EMAIL_PANEL_OUTBOXREAD_FROM']}:<a href='/?section=viewprofile&name={$outboxread['hosting_pm_outbox_author']}'>{$outboxread['hosting_pm_outbox_author']}</a>".$outboxread['hosting_pm_outbox_time'].':'.$outboxread['hosting_pm_outbox_date']."</td></tr>
								  <tr>
	            				  <td>".$outboxread['hosting_pm_outbox_text']."</td>
	            				  </tr>";
						}
						echo "</table></td></tr></table></td></tr></table>";
					}
					else 
					{
						echo $redirect;
					}
				}
				else 
				{
					echo $redirect.false;
				}
			}
			elseif ($_GET['action'] == 'inbox')
			{
				$inbox_select = mysql_query("SELECT * FROM hosting_pm WHERE hosting_pm_receiver = '{$_SESSION['nick']}' LIMIT $limit ");
				if (mysql_num_rows($inbox_select) > 0) 
				{
					echo "<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
						  <tr>
						    <td width='235' valign='top'><div class='border' id='leftdiv'>
						     <h3><strong>{$lang['BODY_LIGHT_EMAIL_PANEL_NAME']}</strong></h3>
						          <hr align='center' noshade='noshade' />
						        <strong>{$lang['BODY_LIGHT_EMAIL_PANEL_SECTION']}</strong><br />
						        <a href='/?section=pm&action=inbox'>{$lang['BODY_LIGHT_EMAIL_PANEL_LINK_INBOX']}</a><br />
						        <a href='/?section=pm&action=outbox'>{$lang['BODY_LIGHT_EMAIL_PANEL_LINK_OUTBOX']}</a><br />
						        <a href='/?section=pm&action=sendbox'>{$lang['BODY_LIGHT_EMAIL_PANEL_LINK_SEND_MESSAGE']}</a>
						      <hr align='center' noshade='noshade' />
						       <strong>{$lang['BODY_LIGHT_EMAIL_PANEL_INBOX_LIMIT']}</strong><br />";
						       echo "".check_inbox_pm_limit()."|";
						       echo "".check_inbox_limit()."<hr align='center' noshade='noshade' />
						        <strong>{$lang['BODY_LIGHT_EMAIL_PANEL_OUTBOX_LIMIT']}</strong><br />";
						      echo "".check_outbox_pm_limit()."|";
						      echo "".check_outbox_limit()."<hr align='center' noshade='noshade' />";
						      echo "<strong>{$lang['BODY_LIGHT_EMAIL_PANEL']}</strong><br />
						       {$lang['BODY_LIGHT_EMAIL_PANEL_VERSION']}
						    </div></td>
						    <td width='665' valign='top'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'>
						      <tr>
						        <td width='29%'><strong>{$lang['BODY_LIGHT_EMAIL_PANEL_INBOX']}</strong></td>
						        </tr>
						      <tr>
						        <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
						          <tr>";
					$count_inbox_pm = mysql_query("SELECT COUNT(hosting_pm_receiver) FROM hosting_pm WHERE hosting_pm_receiver = '".$_SESSION['nick']."' LIMIT $limit ");
					while ($inbox_pm_check = mysql_fetch_array($count_inbox_pm))
					if ($inbox_pm_check['COUNT(hosting_pm_receiver)'] == $limit)
					{
						echo "<span style='color:darkred'>{$lang['BODY_EMAIL_PANEL_INBOX_FULL']}</span>";
					}
					while ($inbox = mysql_fetch_array($inbox_select))
					{
						echo "<td width='61%'><a href='/?section=pm&action=inboxread&id=".$inbox['hosting_pm_id']."'>".$inbox['hosting_pm_title']."</a> {$lang['BODY_EMAIL_PANEL_INBOX_FROM']}:<a href='/?section=viewprofile&name={$inbox['hosting_pm_author']}'>{$inbox['hosting_pm_author']}</a>: ".$inbox['hosting_pm_date'].' '.$inbox['hosting_pm_time']."</td>
							 <td width='39%'>{$lang['BODY_EMAIL_PANEL_INBOX_READED']}: ";
						if ($inbox['hosting_pm_read'] == 'yes') 
						{
							echo $lang['BODY_EMAIL_PANEL_INBOX_READED_YES'];
						}
						elseif ($inbox['hosting_pm_read'] == 'no')
						{
							echo $lang['BODY_EMAIL_PANEL_INBOX_READED_NO'];
						}
						echo " | <a href='/?section=delete&action=inbox&id=".$inbox['hosting_pm_id']."'>{$lang['BODY_DELETE']}</a></td></tr>";
					}
					echo "</table></td></tr></table></td></tr></table>";
				}
				else
				{
					echo "<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
						  <tr>
						    <td width='235' valign='top'><div class='border' id='leftdiv'>
						   		 <h3><strong>{$lang['BODY_LIGHT_EMAIL_PANEL_NAME']}</strong></h3>
						          <hr align='center' noshade='noshade' />
						        <strong>{$lang['BODY_LIGHT_EMAIL_PANEL_SECTION']}</strong><br />
						        <a href='/?section=pm&action=inbox'>{$lang['BODY_LIGHT_EMAIL_PANEL_LINK_INBOX']}</a><br />
						        <a href='/?section=pm&action=outbox'>{$lang['BODY_LIGHT_EMAIL_PANEL_LINK_OUTBOX']}</a><br />
						        <a href='/?section=pm&action=sendbox'>{$lang['BODY_LIGHT_EMAIL_PANEL_LINK_SEND_MESSAGE']}</a>
						      <hr align='center' noshade='noshade' />
						       <strong>{$lang['BODY_LIGHT_EMAIL_PANEL_INBOX_LIMIT']}</strong><br />";
						       echo "".check_inbox_pm_limit()."|";
						       echo "".check_inbox_limit()."<hr align='center' noshade='noshade' />
						        <strong>{$lang['BODY_LIGHT_EMAIL_PANEL_OUTBOX_LIMIT']}</strong><br />";
						      echo "".check_outbox_pm_limit()."|";
						      echo "".check_outbox_limit()."<hr align='center' noshade='noshade' />";
						      echo "<strong>{$lang['BODY_LIGHT_EMAIL_PANEL']}</strong><br />
						       {$lang['BODY_LIGHT_EMAIL_PANEL_VERSION']}
						    </div></td>
						    <td width='665' valign='top'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'>
						      <tr>
						        <td width='29%'><strong>{$lang['BODY_LIGHT_EMAIL_PANEL_INBOX']}</strong></td>
						        </tr>
						      <tr>
						        <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
						          <tr>
						            <td width='61%'>{$lang['BODY_EMAIL_PANEL_INBOX_EMPTY']}</td>
						          </tr>
						          </table></td>
						      </tr>
						    </table></td>
						  </tr>
						</table>";
				}
			}
			elseif ($_GET['action'] == 'inboxread')
			{
				if ($id = ((isset($_GET['id'])) && (ctype_digit($_GET['id'])) ? (int)$_GET['id'] : ''))		
				{
					$inboxread_select = mysql_query("SELECT * FROM hosting_pm WHERE hosting_pm_id = '".$id."' AND hosting_pm_receiver = '".$_SESSION['nick']."' ");
					if (mysql_num_rows($inboxread_select) != 0) 
					{
						echo "<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
						  <tr>
						    <td width='235' valign='top'><div class='border' id='leftdiv'>
						       <h3><strong>{$lang['BODY_LIGHT_EMAIL_PANEL_NAME']}</strong></h3>
						          <hr align='center' noshade='noshade' />
						        <strong>{$lang['BODY_LIGHT_EMAIL_PANEL_SECTION']}</strong><br />
						        <a href='/?section=pm&action=inbox'>{$lang['BODY_LIGHT_EMAIL_PANEL_LINK_INBOX']}</a><br />
						        <a href='/?section=pm&action=outbox'>{$lang['BODY_LIGHT_EMAIL_PANEL_LINK_OUTBOX']}</a><br />
						        <a href='/?section=pm&action=sendbox'>{$lang['BODY_LIGHT_EMAIL_PANEL_LINK_SEND_MESSAGE']}</a>
						      <hr align='center' noshade='noshade' />
						       <strong>{$lang['BODY_LIGHT_EMAIL_PANEL_INBOX_LIMIT']}</strong><br />";
						       echo "".check_inbox_pm_limit()."|";
						       echo "".check_inbox_limit()."<hr align='center' noshade='noshade' />
						        <strong>{$lang['BODY_LIGHT_EMAIL_PANEL_OUTBOX_LIMIT']}</strong><br />";
						      echo "".check_outbox_pm_limit()."|";
						      echo "".check_outbox_limit()."<hr align='center' noshade='noshade' />";
						      echo "<strong>{$lang['BODY_LIGHT_EMAIL_PANEL']}</strong><br />
						       {$lang['BODY_LIGHT_EMAIL_PANEL_VERSION']}
						    </div></td>
						    <td width='665' valign='top'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'>
						      <tr>
						        <td width='29%'><strong>{$lang['BODY_LIGHT_EMAIL_PANEL_INBOXREAD']}</strong></td>
						        </tr>
						      <tr>
						        <td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
						          <tr>";
						       mysql_query("UPDATE hosting_pm SET hosting_pm_read = 'yes' WHERE hosting_pm_read = 'no' AND hosting_pm_receiver = '".$_SESSION['nick']."'  ");
						while ($inboxread = mysql_fetch_array($inboxread_select))
						{
							echo "<td width='61%'>".$inboxread['hosting_pm_title']." {$lang['BODY_LIGHT_EMAIL_PANEL_INBOXREAD_FROM']}:<a href='/?section=viewprofile&name={$inboxread['hosting_pm_author']}'>{$inboxread['hosting_pm_author']}</a> ".$inboxread['hosting_pm_time'].':'.$inboxread['hosting_pm_date']."</td></tr>
								  <tr>
	            				  <td>".$inboxread['hosting_pm_text']."</td>
	            				  </tr>";
						}
						echo "</table></td></tr></table></td></tr></table>";
					}
					else 
					{
						echo $redirect;
					}
				}
				else 
				{
					echo $redirect.false;
				}
			}
			elseif ($_GET['action'])
			{
				echo $redirect;
			}
		}
		else 
		{
			echo $redirect.false;
		}
	}
	elseif ($_SESSION['permission'] <= 2)
	{
		echo $redirect;
	}
}
else
{
	echo $redirect;
}

?>