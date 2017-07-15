<?php
if ($_SESSION['logged_in']) 
{
		if ((isset($_GET['action'])) && (ctype_alpha($_GET['action'])) ? ctype_lower($_GET['action']) : '')		
		{
			true;
		}
		else 
		{
			echo $redirect.false;
		}
		
		if ($_SESSION['permission'] >= 2) 
		{
			if ($_GET['action'] == 'dbdelete') 
			{
				$db_name = $_POST['db_name'];
				$db_name = mysql_real_escape_string($_POST['db_name']);
				$db_name = htmlentities($_POST['db_name']);
				$db_name = trim($_POST['db_name']);
				
				if (isset($_POST['Submit'])) 
				{
					$delete_mysql_db = ("DELETE FROM mysql.db WHERE User = '".$_SESSION['nick']."' AND Db = '".$db_name."' ");
					mysql_query($delete_mysql_db) or die (mysql_error());
							
					$delete_db = 'DROP DATABASE ' . $db_name;
					mysql_query($delete_db) or die(mysql_error());
					
					$after_delete_db = "FLUSH PRIVILEGES;";
					mysql_query($after_delete_db) or die(mysql_error());
					
					echo "<meta http-equiv='REFRESH' content='0;url=/?section=lightuserpanelmysqlmanage'>"; 
				}
						
				$select_db_names = mysql_query("SELECT Db,User FROM mysql.db WHERE User = '".$_SESSION['nick']."' ") or die(mysql_error());
				if (mysql_num_rows($select_db_names) > 0) 
				{
					echo ("<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
			 		<tr>
			    	<td width='235' valign='top'><div class='border' id='leftdiv'>
			        <h3><strong>{$lang['BODY_LIGHT_USER_PANEL_NAME']}</strong></h3>
			        <hr align='center' noshade='noshade' />
			        <strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_LIMIT']}</strong><br />");
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
			        <td width='29%'><strong>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_NAME']}</strong></td>
			        </tr>
			      	<tr>
		        	<td>");
					echo "<form id='form1' name='form1' method='post'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_FORM_TITLE_MYSQL_DATABASE_NAME']}<br /><label for='select'></label><select name='db_name' id='select'>";
					while ($db_names = mysql_fetch_array($select_db_names))
					{
						echo "<option>{$db_names['Db']}</option>";
					}
					echo "</select><br /><input type='submit' name='Submit' id='Submit' value='{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_BUTTON_SUBMIT']}' /><input type='reset' name='Reset' id='Reset' value='{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_BUTTON_RESET']}' /></form>";
				   	echo ("</table></td></tr></table></td></tr></table>");
				}
				else
				{
					echo "<meta http-equiv='REFRESH' content='0;url=/?section=lightuserpanelmysqlmanage'>"; 
				}	
			}
			elseif($_GET['action'] == 'mysqluserdelete') 
			{
				$mysql_user_name = $_POST['User'];
				$mysql_user_name = mysql_real_escape_string($_POST['User']);
				$mysql_user_name = htmlentities($_POST['User']);
				$mysql_user_name = trim($_POST['User']);
				$mysql_user_name = $_SESSION['nick'];
				
				if (isset($_POST['Submit'])) 
				{
					$delete_mysql_user = ("DELETE FROM mysql.user WHERE User = '".$mysql_user_name."' ");
					mysql_query($delete_mysql_user) or die (mysql_error());
					
					$after_mysql_user_delete = "FLUSH PRIVILEGES;";
					mysql_query($after_mysql_user_delete) or die(mysql_error());
					
					echo "<meta http-equiv='REFRESH' content='0;url=/?section=lightuserpanelmysqlmanage'>"; 
				}
					$select_user_names = mysql_query("SELECT User,Password FROM mysql.user WHERE User = '".$_SESSION['nick']."' ") or die(mysql_error());
					if (mysql_num_rows($select_user_names) > 0) 
					{
						echo ("<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
				 		<tr>
				    	<td width='235' valign='top'><div class='border' id='leftdiv'>
				        <h3><strong>{$lang['BODY_LIGHT_USER_PANEL_NAME']}</strong></h3>
				        <hr align='center' noshade='noshade' />
				        <strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_LIMIT']}</strong><br />");
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
				        <td width='29%'><strong>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_NAME']}</strong></td>
				        </tr>
				      	<tr>
			        	<td><form id='form1' name='form1' method='post'>
						 <b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MYSQL_USERNAME']}:</b><br />
						 <input name='User' type='text' id='textfield' value='{$_SESSION['nick']}' size='45' />
						 <br />
						 <input type='submit' name='Submit' id='button' value='{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_USER_BUTTON_SUBMIT']}' />
						 <input type='reset' name='Reset' id='button2' value='{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_USER_BUTTON_RESET']}' />
						 </form></table></td></tr></table></td></tr></table>");	
					}
					else
					{
						echo "<meta http-equiv='REFRESH' content='0;url=/?section=lightuserpanelmysqlmanage'>";
					}
			}
			elseif ($_GET['action'] == 'inbox') 
			{
				if ($id = ((isset($_GET['id'])) && (ctype_digit($_GET['id'])) ? (int)$_GET['id'] : ''))		
				{
					mysql_query("DELETE FROM hosting_pm WHERE hosting_pm_id = '".$id."' AND hosting_pm_receiver = '".$_SESSION['nick']."' ");
					echo "<meta http-equiv='REFRESH' content='0;url=/?section=pm&action=inbox'>"; 
				}
				else 
				{
					echo $redirect.false;
				}
			}
			elseif ($_GET['action'] == 'outbox')
			{
				if ($id = ((isset($_GET['id'])) && (ctype_digit($_GET['id'])) ? (int)$_GET['id'] : ''))		
				{
					mysql_query("DELETE FROM hosting_pm_outbox WHERE hosting_pm_outbox_id = '".$id."' AND hosting_pm_outbox_author = '".$_SESSION['nick']."' ");
					echo "<meta http-equiv='REFRESH' content='0;url=/?section=pm&action=outbox'>"; 
				}
				else 
				{
					echo $redirect.false;
				}
			}
			elseif ($_GET['action'] = 'cancelorder')
			{
				if ($id = ((isset($_GET['id'])) && (ctype_digit($_GET['id'])) ? (int)$_GET['id'] : ''))		
				{
					if (mysql_query("DELETE FROM hosting_order_plan WHERE hosting_order_plan_id = '".$id."' AND hosting_order_plan_user_nick = '".$_SESSION['nick']."' ")) 
					{
						echo "<meta http-equiv='REFRESH' content='0;url=/?section=hosting'>"; 
					}
				}
			}
			elseif ($_GET['action'])
			{
				echo $redirect;
			}
			elseif ($_SESSION['permission'] <= 2)
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