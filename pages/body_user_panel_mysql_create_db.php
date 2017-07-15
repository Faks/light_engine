<?php
if ($_SESSION['logged_in']) 
{
	if ($_SESSION['permission'] >= 2 AND $_SESSION['hosting'] == 1) 
	{
		$select_mysql_user_count = mysql_query("SELECT COUNT(User),User FROM mysql.user WHERE User = '{$_SESSION['nick']}' ") or die (mysql_error());
	 	$mysql_user_count = mysql_fetch_array($select_mysql_user_count);
		{
			$select_mysql_database_count = mysql_query("SELECT COUNT(user) FROM mysql.db WHERE user = '{$_SESSION['nick']}' ") or die (mysql_error());
			$mysql_database_count = mysql_fetch_array($select_mysql_database_count);
	 		{
	 			$select_hosting_plan = mysql_query("SELECT * FROM hosting_user WHERE hosting_user_name = '".$_SESSION['nick']."' ");
	 			$hosting_plan = mysql_fetch_array($select_hosting_plan);
	 			{
					if ($mysql_user_count['COUNT(User)'] == 0) 
					{
						echo "<meta http-equiv='REFRESH' content='0;url=/?section=lightuserpanelmysqlcreateuser'>";
					}
					elseif ($mysql_user_count['COUNT(User)'] == 1) 
					{
						if ($hosting_plan['hosting_user_hosting_plan'] == 1 && $mysql_database_count['COUNT(user)'] != 1) 
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
							  	$rules[] = "required,db_name,{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_VALIDATION_FILL_MYSQL_USER_PASSWORD']}";
							  	$rules[] = "is_alpha,db_name,{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_VALIDATION_INVALID_FORMAT_MYSQL_DATBASE_NAME']}";
							  
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
										$db_name = $_POST['db_name'];			
									  	$db_name = mysql_real_escape_string($_POST['db_name']);
										$db_name = htmlentities($_POST['db_name']);
										$db_name = trim($_POST['db_name']);
										$db_name = stripslashes($_POST['db_name']);
										$db_name = addslashes($_POST['db_name']);
							
										if (isset($_POST['db_name'])) 
										{
											//Creates Database
											$create_db = 'CREATE DATABASE ' . $_SESSION['nick'].'_'.$db_name;
											mysql_query($create_db) or die(mysql_error());
											//Inserts into mysql Database Count 
											$create_db_insert_count = ("INSERT INTO mysql.db (Host,Db,User,Select_priv,Insert_priv,Update_priv,Delete_priv,Create_priv,Drop_priv,Grant_priv,References_priv,Index_priv,Alter_priv,Create_tmp_table_priv,Lock_tables_priv,Create_view_priv,Show_view_priv,Create_routine_priv,Alter_routine_priv,Execute_priv,Event_priv,Trigger_priv) VALUES('".localhost."','{$_SESSION['nick']}_{$db_name}','".$_SESSION['nick']."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."')");
											mysql_query($create_db_insert_count) or die(mysql_error());
											//Flushing Privilages
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
								 <tr><td>";
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
								 echo "<form  method='post'>
								 {$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_FORM_TITLE_MYSQL_DATABASE_NAME']}
								 <br />
								 <input name='db_name' type='text' id='CREATE' size='45' />
								 <br />
								 <input type='hidden' name='token' value='{$token}'/> 
								 <input name='Submit' type='submit' id='Submit' value='{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_BUTTON_SUBMIT']}' /><input name='Reset' type='reset' value='{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_BUTTON_RESET']}' id='Reset' />
								 </form>
								 </td></tr></table></td></tr></table>";
						}
							if ($hosting_plan['hosting_user_hosting_plan'] == 1 && $mysql_database_count['COUNT(user)'] == 1) 
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
						       <tr><td>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_LIMIT_REACH']}
						       </td></tr></table></td></tr></table>";
							}
						elseif ($hosting_plan['hosting_user_hosting_plan'] == 2 && $mysql_database_count['COUNT(user)'] != 2) 
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
							  	$rules[] = "required,db_name,{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_VALIDATION_FILL_MYSQL_USER_PASSWORD']}";
							  	$rules[] = "is_alpha,db_name,{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_VALIDATION_INVALID_FORMAT_MYSQL_DATBASE_NAME']}";
							  
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
										$db_name = $_POST['db_name'];			
									  	$db_name = mysql_real_escape_string($_POST['db_name']);
										$db_name = htmlentities($_POST['db_name']);
										$db_name = trim($_POST['db_name']);
										$db_name = stripslashes($_POST['db_name']);
										$db_name = addslashes($_POST['db_name']);
							
										if (isset($_POST['db_name'])) 
										{
											//Creates Database
											$create_db = 'CREATE DATABASE ' . $_SESSION['nick'].'_'.$db_name;
											mysql_query($create_db) or die(mysql_error());
											//Inserts into mysql Database Count 
											$create_db_insert_count = ("INSERT INTO mysql.db (Host,Db,User,Select_priv,Insert_priv,Update_priv,Delete_priv,Create_priv,Drop_priv,Grant_priv,References_priv,Index_priv,Alter_priv,Create_tmp_table_priv,Lock_tables_priv,Create_view_priv,Show_view_priv,Create_routine_priv,Alter_routine_priv,Execute_priv,Event_priv,Trigger_priv) VALUES('".localhost."','{$_SESSION['nick']}_{$db_name}','".$_SESSION['nick']."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."')");
											mysql_query($create_db_insert_count) or die(mysql_error());
											//Flushing Privilages
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
								 <tr><td>";
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
								 echo "<form  method='post'>
								 {$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_FORM_TITLE_MYSQL_DATABASE_NAME']}
								 <br />
								 <input name='db_name' type='text' id='CREATE' size='45' />
								 <br />
								 <input type='hidden' name='token' value='{$token}'/> 
								 <input name='Submit' type='submit' id='Submit' value='{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_BUTTON_SUBMIT']}' /><input name='Reset' type='reset' value='{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_BUTTON_RESET']}' id='Reset' />
								 </form>
								 </td></tr></table></td></tr></table>";
						}
							if ($hosting_plan['hosting_user_hosting_plan'] == 2 && $mysql_database_count['COUNT(user)'] == 2) 
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
						       <tr><td>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_LIMIT_REACH']}
						       </td></tr></table></td></tr></table>";
							}
						elseif ($hosting_plan['hosting_user_hosting_plan'] == 3 && $mysql_database_count['COUNT(user)'] != 5) 
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
							  	$rules[] = "required,db_name,{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_VALIDATION_FILL_MYSQL_USER_PASSWORD']}";
							  	$rules[] = "is_alpha,db_name,{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_VALIDATION_INVALID_FORMAT_MYSQL_DATBASE_NAME']}";
							  
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
										$db_name = $_POST['db_name'];			
									  	$db_name = mysql_real_escape_string($_POST['db_name']);
										$db_name = htmlentities($_POST['db_name']);
										$db_name = trim($_POST['db_name']);
										$db_name = stripslashes($_POST['db_name']);
										$db_name = addslashes($_POST['db_name']);
							
										if (isset($_POST['db_name'])) 
										{
											//Creates Database
											$create_db = 'CREATE DATABASE ' . $_SESSION['nick'].'_'.$db_name;
											mysql_query($create_db) or die(mysql_error());
											//Inserts into mysql Database Count 
											$create_db_insert_count = ("INSERT INTO mysql.db (Host,Db,User,Select_priv,Insert_priv,Update_priv,Delete_priv,Create_priv,Drop_priv,Grant_priv,References_priv,Index_priv,Alter_priv,Create_tmp_table_priv,Lock_tables_priv,Create_view_priv,Show_view_priv,Create_routine_priv,Alter_routine_priv,Execute_priv,Event_priv,Trigger_priv) VALUES('".localhost."','{$_SESSION['nick']}_{$db_name}','".$_SESSION['nick']."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."')");
											mysql_query($create_db_insert_count) or die(mysql_error());
											//Flushing Privilages
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
								 <tr><td>";
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
								 echo "<form  method='post'>
								 {$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_FORM_TITLE_MYSQL_DATABASE_NAME']}
								 <br />
								 <input name='db_name' type='text' id='CREATE' size='45' />
								 <br />
								 <input type='hidden' name='token' value='{$token}'/> 
								 <input name='Submit' type='submit' id='Submit' value='{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_BUTTON_SUBMIT']}' /><input name='Reset' type='reset' value='{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_BUTTON_RESET']}' id='Reset' />
								 </form>
								 </td></tr></table></td></tr></table>";
						}
							if ($hosting_plan['hosting_user_hosting_plan'] == 3 && $mysql_database_count['COUNT(user)'] == 5) 
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
						       <tr><td>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_LIMIT_REACH']}
						       </td></tr></table></td></tr></table>";
							}
						elseif ($hosting_plan['hosting_user_hosting_plan'] == 4 && $mysql_database_count['COUNT(user)'] != 8) 
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
							  	$rules[] = "required,db_name,{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_VALIDATION_FILL_MYSQL_USER_PASSWORD']}";
							  	$rules[] = "is_alpha,db_name,{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_VALIDATION_INVALID_FORMAT_MYSQL_DATBASE_NAME']}";
							  
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
										$db_name = $_POST['db_name'];			
									  	$db_name = mysql_real_escape_string($_POST['db_name']);
										$db_name = htmlentities($_POST['db_name']);
										$db_name = trim($_POST['db_name']);
										$db_name = stripslashes($_POST['db_name']);
										$db_name = addslashes($_POST['db_name']);
							
										if (isset($_POST['db_name'])) 
										{
											//Creates Database
											$create_db = 'CREATE DATABASE ' . $_SESSION['nick'].'_'.$db_name;
											mysql_query($create_db) or die(mysql_error());
											//Inserts into mysql Database Count 
											$create_db_insert_count = ("INSERT INTO mysql.db (Host,Db,User,Select_priv,Insert_priv,Update_priv,Delete_priv,Create_priv,Drop_priv,Grant_priv,References_priv,Index_priv,Alter_priv,Create_tmp_table_priv,Lock_tables_priv,Create_view_priv,Show_view_priv,Create_routine_priv,Alter_routine_priv,Execute_priv,Event_priv,Trigger_priv) VALUES('".localhost."','{$_SESSION['nick']}_{$db_name}','".$_SESSION['nick']."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."')");
											mysql_query($create_db_insert_count) or die(mysql_error());
											//Flushing Privilages
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
								 <tr><td>";
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
								 echo "<form  method='post'>
								 {$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_FORM_TITLE_MYSQL_DATABASE_NAME']}
								 <br />
								 <input name='db_name' type='text' id='CREATE' size='45' />
								 <br />
								 <input type='hidden' name='token' value='{$token}'/> 
								 <input name='Submit' type='submit' id='Submit' value='{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_BUTTON_SUBMIT']}' /><input name='Reset' type='reset' value='{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_BUTTON_RESET']}' id='Reset' />
								 </form>
								 </td></tr></table></td></tr></table>";
						}
							elseif ($hosting_plan['hosting_user_hosting_plan'] == 4 && $mysql_database_count['COUNT(user)'] == 8) 
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
						       <tr><td>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_LIMIT_REACH']}
						       </td></tr></table></td></tr></table>";
							}
						elseif ($hosting_plan['hosting_user_hosting_plan'] == 5 && $mysql_database_count['COUNT(user)'] != 10) 
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
							  	$rules[] = "required,db_name,{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_VALIDATION_FILL_MYSQL_USER_PASSWORD']}";
							  	$rules[] = "is_alpha,db_name,{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_VALIDATION_INVALID_FORMAT_MYSQL_DATBASE_NAME']}";
							  
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
										$db_name = $_POST['db_name'];			
									  	$db_name = mysql_real_escape_string($_POST['db_name']);
										$db_name = htmlentities($_POST['db_name']);
										$db_name = trim($_POST['db_name']);
										$db_name = stripslashes($_POST['db_name']);
										$db_name = addslashes($_POST['db_name']);
							
										if (isset($_POST['db_name'])) 
										{
											//Creates Database
											$create_db = 'CREATE DATABASE ' . $_SESSION['nick'].'_'.$db_name;
											mysql_query($create_db) or die(mysql_error());
											//Inserts into mysql Database Count 
											$create_db_insert_count = ("INSERT INTO mysql.db (Host,Db,User,Select_priv,Insert_priv,Update_priv,Delete_priv,Create_priv,Drop_priv,Grant_priv,References_priv,Index_priv,Alter_priv,Create_tmp_table_priv,Lock_tables_priv,Create_view_priv,Show_view_priv,Create_routine_priv,Alter_routine_priv,Execute_priv,Event_priv,Trigger_priv) VALUES('".localhost."','{$_SESSION['nick']}_{$db_name}','".$_SESSION['nick']."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."')");
											mysql_query($create_db_insert_count) or die(mysql_error());
											//Flushing Privilages
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
								 <tr><td>";
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
								 echo "<form  method='post'>
								 {$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_FORM_TITLE_MYSQL_DATABASE_NAME']}
								 <br />
								 <input name='db_name' type='text' id='CREATE' size='45' />
								 <br />
								 <input type='hidden' name='token' value='{$token}'/> 
								 <input name='Submit' type='submit' id='Submit' value='{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_BUTTON_SUBMIT']}' /><input name='Reset' type='reset' value='{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_BUTTON_RESET']}' id='Reset' />
								 </form>
								 </td></tr></table></td></tr></table>";
						}
							elseif ($hosting_plan['hosting_user_hosting_plan'] == 5 && $mysql_database_count['COUNT(user)'] == 10) 
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
						       <tr><td>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_LIMIT_REACH']}
						       </td></tr></table></td></tr></table>";
							}
						elseif ($hosting_plan['hosting_user_hosting_plan'] == 6 && $mysql_database_count['COUNT(user)'] >= 0) 
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
							  	$rules[] = "required,db_name,{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_VALIDATION_FILL_MYSQL_USER_PASSWORD']}";
							  	$rules[] = "is_alpha,db_name,{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_VALIDATION_INVALID_FORMAT_MYSQL_DATBASE_NAME']}";
							  
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
										$db_name = $_POST['db_name'];			
									  	$db_name = mysql_real_escape_string($_POST['db_name']);
										$db_name = htmlentities($_POST['db_name']);
										$db_name = trim($_POST['db_name']);
										$db_name = stripslashes($_POST['db_name']);
										$db_name = addslashes($_POST['db_name']);
							
										if (isset($_POST['db_name'])) 
										{
											//Creates Database
											$create_db = 'CREATE DATABASE ' . $_SESSION['nick'].'_'.$db_name;
											mysql_query($create_db) or die(mysql_error());
											//Inserts into mysql Database Count 
											$create_db_insert_count = ("INSERT INTO mysql.db (Host,Db,User,Select_priv,Insert_priv,Update_priv,Delete_priv,Create_priv,Drop_priv,Grant_priv,References_priv,Index_priv,Alter_priv,Create_tmp_table_priv,Lock_tables_priv,Create_view_priv,Show_view_priv,Create_routine_priv,Alter_routine_priv,Execute_priv,Event_priv,Trigger_priv) VALUES('".localhost."','{$_SESSION['nick']}_{$db_name}','".$_SESSION['nick']."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."')");
											mysql_query($create_db_insert_count) or die(mysql_error());
											//Flushing Privilages
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
								 <tr><td>";
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
								 echo "<form  method='post'>
								 {$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_FORM_TITLE_MYSQL_DATABASE_NAME']}
								 <br />
								 <input name='db_name' type='text' id='CREATE' size='45' />
								 <br />
								 <input type='hidden' name='token' value='{$token}'/> 
								 <input name='Submit' type='submit' id='Submit' value='{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_BUTTON_SUBMIT']}' /><input name='Reset' type='reset' value='{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_BUTTON_RESET']}' id='Reset' />
								 </form>
								 </td></tr></table></td></tr></table>";
						}
						elseif ($hosting_plan['hosting_user_hosting_plan'] == 6 && $mysql_database_count['COUNT(user)'] == 0) 
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
							  	$rules[] = "required,db_name,{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_VALIDATION_FILL_MYSQL_USER_PASSWORD']}";
							  	$rules[] = "is_alpha,db_name,{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_VALIDATION_INVALID_FORMAT_MYSQL_DATBASE_NAME']}";
							  
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
										$db_name = $_POST['db_name'];			
									  	$db_name = mysql_real_escape_string($_POST['db_name']);
										$db_name = htmlentities($_POST['db_name']);
										$db_name = trim($_POST['db_name']);
										$db_name = stripslashes($_POST['db_name']);
										$db_name = addslashes($_POST['db_name']);
							
										if (isset($_POST['db_name'])) 
										{
											//Creates Database
											$create_db = 'CREATE DATABASE ' . $_SESSION['nick'].'_'.$db_name;
											mysql_query($create_db) or die(mysql_error());
											//Inserts into mysql Database Count 
											$create_db_insert_count = ("INSERT INTO mysql.db (Host,Db,User,Select_priv,Insert_priv,Update_priv,Delete_priv,Create_priv,Drop_priv,Grant_priv,References_priv,Index_priv,Alter_priv,Create_tmp_table_priv,Lock_tables_priv,Create_view_priv,Show_view_priv,Create_routine_priv,Alter_routine_priv,Execute_priv,Event_priv,Trigger_priv) VALUES('".localhost."','{$_SESSION['nick']}_{$db_name}','".$_SESSION['nick']."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."','".Y."')");
											mysql_query($create_db_insert_count) or die(mysql_error());
											//Flushing Privilages
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
								 <tr><td>";
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
								 echo "<form  method='post'>
								 {$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_FORM_TITLE_MYSQL_DATABASE_NAME']}
								 <br />
								 <input name='db_name' type='text' id='CREATE' size='45' />
								 <br />
								 <input type='hidden' name='token' value='{$token}'/> 
								 <input name='Submit' type='submit' id='Submit' value='{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_BUTTON_SUBMIT']}' /><input name='Reset' type='reset' value='{$lang['BODY_LIGHT_USER_PANEL_MYSQL_CREATE_DB_BUTTON_RESET']}' id='Reset' />
								 </form>
								 </td></tr></table></td></tr></table>";
						}
						elseif ($hosting_plan['hosting_user_hosting_plan'] == "") 
						{
							$select_hosting_information = mysql_query("SELECT * FROM hosting_order_plan WHERE hosting_order_plan_user_nick = '".$_SESSION['nick']."' ");
							while($hosting_information = mysql_fetch_array($select_hosting_information))
							
							if ($hosting_information['hosting_order_plan_MySQL_total_db'] == "1") 
							{
								mysql_query("UPDATE hosting_user SET hosting_user_hosting_plan = 1 WHERE hosting_user_name = '".$_SESSION['nick']."' ");
								echo "<meta http-equiv='refresh' content='1'>"; 
							}
							elseif ($hosting_information['hosting_order_plan_MySQL_total_db'] == "2")
							{
								mysql_query("UPDATE hosting_user SET hosting_user_hosting_plan = 2 WHERE hosting_user_name = '".$_SESSION['nick']."' ");
								echo "<meta http-equiv='refresh' content='1'>"; 
							}
							elseif ($hosting_information['hosting_order_plan_MySQL_total_db'] == "5") 
							{
								mysql_query("UPDATE hosting_user SET hosting_user_hosting_plan = 3 WHERE hosting_user_name = '".$_SESSION['nick']."' ");
								echo "<meta http-equiv='refresh' content='1'>"; 
							}
							elseif ($hosting_information['hosting_order_plan_MySQL_total_db'] == "8")
							{
								mysql_query("UPDATE hosting_user SET hosting_user_hosting_plan = 4 WHERE hosting_user_name = '".$_SESSION['nick']."' ");
								echo "<meta http-equiv='refresh' content='1'>"; 
							}
							elseif ($hosting_information['hosting_order_plan_MySQL_total_db'] == "10") 
							{
								mysql_query("UPDATE hosting_user SET hosting_user_hosting_plan = 5 WHERE hosting_user_name = '".$_SESSION['nick']."' ");
								echo "<meta http-equiv='refresh' content='1'>"; 
							}
							elseif ($hosting_information['hosting_order_plan_MySQL_total_db'] == "~") 
							{
								mysql_query("UPDATE hosting_user SET hosting_user_hosting_plan = 6 WHERE hosting_user_name = '".$_SESSION['nick']."' ");
								echo "<meta http-equiv='refresh' content='1'>"; 
							}
						}
					}
	 			}
	 		}
		}	
	}
	elseif($_SESSION['permission'] <= 2 AND $_SESSION['hosting'] == 0) 
	{
		echo $redirect;
	}
}
else 
{
	echo $redirect;
}
?>