<?php
if ($_SESSION['logged_in']) 
{	
	if ($_SESSION['permission'] >= 2 AND $_SESSION['hosting'] == 1) 
	{
		$select_mysql_user_count = mysql_query("SELECT COUNT(User),User FROM mysql.user WHERE User = '{$_SESSION['nick']}' ") or die (mysql_error());
	 	$mysql_user_count = mysql_fetch_array($select_mysql_user_count);
	 	if ($mysql_user_count['COUNT(User)'] == 1 && $_SESSION['admin'] == 0) 
	 	{
			echo "<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
			<tr>
			<td width='235' valign='top'><div class='border' id='leftdiv'>
			<h3><strong>{$lang['BODY_LIGHT_USER_PANEL_NAME']}</strong></h3>
			<hr align='center' noshade='noshade' />
			<strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_LIMIT']}</strong><br />";
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
			echo "".check_hosting_plan_dates()."
			<hr align='center' noshade='noshade' />
			<strong>{$lang['BODY_LIGHT_USER_PANEL']}</strong><br />
			{$lang['BODY_LIGHT_USER_PANEL_NAME_VERSION']}
			</div></td>
			<td width='665' valign='top'>
			<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'>
			<tr>
			<td width='29%'><strong>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_NAME']}</strong></td>
			</tr>
			<tr><td>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_USER_LIMIT_REACH']}
			</td></tr></table></td></tr></table>";
	 	}
	 	elseif ($mysql_user_count['COUNT(User)'] == 0 && $_SESSION['admin'] == 0 || $_SESSION['admin'] == 1)
	 	{
	 		if (isset($_POST['Submit']))
			{
				$errors = array(); // set the errors array to empty, by default
				$fields = array(); // stores the field values
				$success_message = "Paldies Jusu Informacija Nosutita";	
				// import the validation library
				#require("include/validation.php");
				require ("include/validation.php");
				$rules = array(); // stores the validation rules
	
				// standard form fields
				$rules[] = "required,mysql_user_pass,{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_USER_VALIDATION_FILL_MYSQL_USER_PASSWORD']}";
				$rules[] = "is_alpha,mysql_user_pass,{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_USER_VALIDATION_INVALID_FORMAT_MYSQL_USER_PASSWORD']}";
						  
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
						$mysql_user_pass = $_POST['mysql_user_pass'];
						$mysql_user_pass = mysql_real_escape_string($_POST['mysql_user_pass']);
						$mysql_user_pass = htmlentities($_POST['mysql_user_pass']);
						$mysql_user_pass = trim($_POST['mysql_user_pass']);
						$mysql_user_pass = stripslashes($_POST['mysql_user_pass']);
						$mysql_user_pass = addslashes($_POST['mysql_user_pass']);
			
						if (isset($_POST['Submit'])) 
						{
							$mysql_insert_user = "INSERT INTO mysql.user (Host, User, Password, Select_priv, Insert_priv, Update_priv, Delete_priv, Create_priv, Drop_priv, Reload_priv, Shutdown_priv, Process_priv, File_priv, Grant_priv, References_priv, Index_priv, Alter_priv, Show_db_priv, Super_priv, Create_tmp_table_priv, Lock_tables_priv, Execute_priv, Repl_slave_priv, Repl_client_priv, Create_view_priv, Show_view_priv, Create_routine_priv, Alter_routine_priv, Create_user_priv, Event_priv, Trigger_priv, ssl_type, ssl_cipher, x509_issuer, x509_subject, max_questions, max_updates, max_connections, max_user_connections) 
							VALUES ('".localhost."', '".$_SESSION['nick']."',PASSWORD('{$mysql_user_pass}'), 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '', '', '', '', 0, 0, 0, 0);";
							mysql_query($mysql_insert_user) or die (mysql_error());
							
							$mysql_user_flush = "FLUSH PRIVILEGES;";
							mysql_query($mysql_user_flush) or die (mysql_error());
							echo "<meta http-equiv='REFRESH' content='0;url=/?section=lightuserpanelmysqlmanage'>"; 
						}
					}
				}
			}
			
				$token = sha1(uniqid(rand(), true));
				$_SESSION['token'] = $token;
						
				echo "<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
				<tr>
				<td width='235' valign='top'><div class='border' id='leftdiv'>
				<h3><strong>{$lang['BODY_LIGHT_USER_PANEL_NAME']}</strong></h3>
				        <hr align='center' noshade='noshade' />
				        <strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_LIMIT']}</strong><br />";
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
				        echo "".check_hosting_plan_dates()."
				        <hr align='center' noshade='noshade' />
				        <strong>{$lang['BODY_LIGHT_USER_PANEL']}</strong><br />
				       {$lang['BODY_LIGHT_USER_PANEL_NAME_VERSION']}
				    </div></td>
				    <td width='665' valign='top'>
					<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'>
				      <tr>
				        <td width='29%'><strong>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_NAME']}</strong></td>
				        </tr>
				       <tr><td><form  method='post'>
					 {$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_USER_FORM_TITLE_USER_PASSWORD']}:&nbsp;<br>";
						if (!empty($errors))
						{
					    	 {
						     	echo "<div class='error' style='width:100%;'><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_USER_VALIDATION_TEXT']}</b><br>";
						      	foreach ($errors as $error)
						        echo "<span style='color:darkred'>$error</span><br>";
						    
						      	echo "</ul></div>"; 
					    	 }
					    
					    	 if (!empty($message))
					    	 {
						     	echo "<div class='notify'>$success_message</div>";
					    	 }
						}
							 echo "<input name='mysql_user_pass' type='password' id='pass' size='45' />
							<br>
							 <input type='hidden' name='token' value='{$token}'/> 
					      <input type='Submit' name='Submit' id='Submit' value='{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_USER_BUTTON_SUBMIT']}' />
					      <input type='reset' name='Reset' id='Reset' value='{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_USER_BUTTON_RESET']}' />
					    </p>
					</form>
				       </td></tr></table></td></tr></table>";
	 	}
	 	elseif ($mysql_user_count['COUNT(User)'] >= 1 && $_SESSION['admin'] == 1)
	 	{
	 		if (isset($_POST['Submit']))
			{
				$errors = array(); // set the errors array to empty, by default
				$fields = array(); // stores the field values
				$success_message = "Paldies Jusu Informacija Nosutita";	
				// import the validation library
				#require("include/validation.php");
				require ("include/validation.php");
				$rules = array(); // stores the validation rules
	
				// standard form fields
				$rules[] = "required,mysql_user_pass,{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_USER_VALIDATION_FILL_MYSQL_USER_PASSWORD']}";
				$rules[] = "is_alpha,mysql_user_pass,{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_USER_VALIDATION_INVALID_FORMAT_MYSQL_USER_PASSWORD']}";
						  
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
						$mysql_user_pass = $_POST['mysql_user_pass'];
						$mysql_user_pass = mysql_real_escape_string($_POST['mysql_user_pass']);
						$mysql_user_pass = htmlentities($_POST['mysql_user_pass']);
						$mysql_user_pass = trim($_POST['mysql_user_pass']);
						$mysql_user_pass = stripslashes($_POST['mysql_user_pass']);
						$mysql_user_pass = addslashes($_POST['mysql_user_pass']);
			
						if (isset($_POST['Submit'])) 
						{
							$mysql_insert_user = "INSERT INTO mysql.user (Host, User, Password, Select_priv, Insert_priv, Update_priv, Delete_priv, Create_priv, Drop_priv, Reload_priv, Shutdown_priv, Process_priv, File_priv, Grant_priv, References_priv, Index_priv, Alter_priv, Show_db_priv, Super_priv, Create_tmp_table_priv, Lock_tables_priv, Execute_priv, Repl_slave_priv, Repl_client_priv, Create_view_priv, Show_view_priv, Create_routine_priv, Alter_routine_priv, Create_user_priv, Event_priv, Trigger_priv, ssl_type, ssl_cipher, x509_issuer, x509_subject, max_questions, max_updates, max_connections, max_user_connections) 
							VALUES ('".localhost."', '".$_SESSION['nick']."',PASSWORD('{$mysql_user_pass}'), 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '', '', '', '', 0, 0, 0, 0);";
							mysql_query($mysql_insert_user) or die (mysql_error());
							
							$mysql_user_flush = "FLUSH PRIVILEGES;";
							mysql_query($mysql_user_flush) or die (mysql_error());
							echo "<meta http-equiv='REFRESH' content='0;url=/?section=lightuserpanelmysqlmanage'>"; 
						}
					}
				}
			}
			
				$token = sha1(uniqid(rand(), true));
				$_SESSION['token'] = $token;
						
				echo "<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
				<tr>
				<td width='235' valign='top'><div class='border' id='leftdiv'>
				<h3><strong>{$lang['BODY_LIGHT_USER_PANEL_NAME']}</strong></h3>
				        <hr align='center' noshade='noshade' />
				        <strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_LIMIT']}</strong><br />";
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
				        echo "".check_hosting_plan_dates()."
				        <hr align='center' noshade='noshade' />
				        <strong>{$lang['BODY_LIGHT_USER_PANEL']}</strong><br />
				       {$lang['BODY_LIGHT_USER_PANEL_NAME_VERSION']}
				    </div></td>
				    <td width='665' valign='top'>
					<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'>
				      <tr>
				        <td width='29%'><strong>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_NAME']}</strong></td>
				        </tr>
				       <tr><td><form  method='post'>
					 {$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_USER_FORM_TITLE_USER_PASSWORD']}:&nbsp;<br>";
						if (!empty($errors))
						{
					    	 {
						     	echo "<div class='error' style='width:100%;'><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_USER_VALIDATION_TEXT']}</b><br>";
						      	foreach ($errors as $error)
						        echo "<span style='color:darkred'>$error</span><br>";
						    
						      	echo "</ul></div>"; 
					    	 }
					    
					    	 if (!empty($message))
					    	 {
						     	echo "<div class='notify'>$success_message</div>";
					    	 }
						}
							 echo "<input name='mysql_user_pass' type='password' id='pass' size='45' />
							<br>
							 <input type='hidden' name='token' value='{$token}'/> 
					      <input type='Submit' name='Submit' id='Submit' value='{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_USER_BUTTON_SUBMIT']}' />
					      <input type='reset' name='Reset' id='Reset' value='{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_USER_BUTTON_RESET']}' />
					    </p>
					</form>
				       </td></tr></table></td></tr></table>";
	 	}
	}
	elseif ($_SESSION['permission'] <= 2 AND $_SESSION['hosting'] == 0)
	{
		echo $redirect;
	}
}	
else
{
	echo $redirect;
}
?>