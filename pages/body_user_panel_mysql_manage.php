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
	 				if ($mysql_user_count['COUNT(User)'] != 1) 
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
									<td><a href='?section=lightuserpanelmysqlcreateuser'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_CREATE_MYSQL_USER_NOW']}</a></table></td></tr></table></td></tr></table>");
					}
					elseif ($mysql_user_count['COUNT(User)'] == 1)
					{
						if ($hosting_plan['hosting_user_hosting_plan'] == 1 && $mysql_database_count['COUNT(user)'] == 0) 
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
									echo ("".check_mysql_database_limit()."<hr align='center' noshade='noshade' /> ");
									
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
						        	<td><a href='/?section=lightuserpanelmysqlcreateuser'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_CREATE_MYSQL_USER']}</a>&nbsp;<a href='/?section=lightuserpanelmysqlcreatedb'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_CREATE_DB']}</a><br><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr>");
										echo "<tr>
									    <td><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MYSQL_USERNAME']}</b> </td>
									    <td><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MYSQL_FUNCTIONS']}</b></td>
									  </tr>
									  <tr>
									    <td>".$mysql_user_count['User']."</td>
									 
									    <td><a href='#'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_CHANGE_PASSWORD']}</a> <a href='?section=delete&action=mysqluserdelete'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_DELETE_USER']}</a></td>
									  </tr>";
						        	echo ("</table></td></tr></table></td></tr></table>");
						}
							elseif ($hosting_plan['hosting_user_hosting_plan'] == 1 && $mysql_database_count['COUNT(user)'] == 1) 
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
						        	<td><a href='/?section=lightuserpanelmysqlcreateuser'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_CREATE_MYSQL_USER']}</a>&nbsp;<a href='/?section=lightuserpanelmysqlcreatedb'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_CREATE_DB']}</a><br><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr>");
									$mysql_select_db = mysql_query("SELECT * FROM mysql.db WHERE User = '{$_SESSION['nick']}' ") or die(mysql_error());
									while ($mysql_user_show = mysql_fetch_array($mysql_select_db)) 
									{
										echo "<tr>
									    <td><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MYSQL_USERNAME']}</b> </td>
									    <td><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MYSQL_HOST']}</b></td>
									    <td><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MYSQL_DATEBASE']}</b></td>
									    <td><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MYSQL_FUNCTIONS']}</b></td>
									  </tr>
									  <tr>
									    <td>".$mysql_user_show['User']."</td>
									    <td>".$mysql_user_show['Host']."</td>
									    <td>".$mysql_user_show['Db']."</td>
									    <td><a href='#'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_CHANGE_PASSWORD']}</a> <a href='?section=delete&action=mysqluserdelete'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_DELETE_USER']}</a> <a href='?section=delete&action=dbdelete'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_DELETE_DB']}</a></td>
									  </tr>";
									}
						        	echo ("</table></td></tr></table></td></tr></table>");
							}
						elseif ($hosting_plan['hosting_user_hosting_plan'] == 2 && $mysql_database_count['COUNT(user)'] == 0)
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
									echo ("".check_mysql_database_limit()."<hr align='center' noshade='noshade' /> ");
									
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
						        	<td><a href='/?section=lightuserpanelmysqlcreateuser'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_CREATE_MYSQL_USER']}</a>&nbsp;<a href='/?section=lightuserpanelmysqlcreatedb'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_CREATE_DB']}</a><br><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr>");
										echo "<tr>
									    <td><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MYSQL_USERNAME']}</b> </td>
									    <td><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MYSQL_FUNCTIONS']}</b></td>
									  </tr>
									  <tr>
									    <td>".$mysql_user_count['User']."</td>
									 
									    <td><a href='#'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_CHANGE_PASSWORD']}</a> <a href='?section=delete&action=mysqluserdelete'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_DELETE_USER']}</a></td>
									  </tr>";
						        	echo ("</table></td></tr></table></td></tr></table>");	
						}
							elseif ($hosting_plan['hosting_user_hosting_plan'] == 2 && $mysql_database_count['COUNT(user)'] >= 1)
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
						        	<td><a href='/?section=lightuserpanelmysqlcreateuser'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_CREATE_MYSQL_USER']}</a>&nbsp;<a href='/?section=lightuserpanelmysqlcreatedb'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_CREATE_DB']}</a><br><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr>");
									$mysql_select_db = mysql_query("SELECT * FROM mysql.db WHERE User = '{$_SESSION['nick']}' ") or die(mysql_error());
									while ($mysql_user_show = mysql_fetch_array($mysql_select_db)) 
									{
										echo "<tr>
									    <td><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MYSQL_USERNAME']}</b> </td>
									    <td><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MYSQL_HOST']}</b></td>
									    <td><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MYSQL_DATEBASE']}</b></td>
									    <td><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MYSQL_FUNCTIONS']}</b></td>
									  </tr>
									  <tr>
									    <td>".$mysql_user_show['User']."</td>
									    <td>".$mysql_user_show['Host']."</td>
									    <td>".$mysql_user_show['Db']."</td>
									    <td><a href='#'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_CHANGE_PASSWORD']}</a> <a href='?section=delete&action=mysqluserdelete'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_DELETE_USER']}</a> <a href='?section=delete&action=dbdelete'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_DELETE_DB']}</a></td>
									  </tr>";
									}
						        	echo ("</table></td></tr></table></td></tr></table>");	
							}
						elseif ($hosting_plan['hosting_user_hosting_plan'] == 3 && $mysql_database_count['COUNT(user)'] == 0) 
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
									echo ("".check_mysql_database_limit()."<hr align='center' noshade='noshade' /> ");
									
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
						        	<td><a href='/?section=lightuserpanelmysqlcreateuser'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_CREATE_MYSQL_USER']}</a>&nbsp;<a href='/?section=lightuserpanelmysqlcreatedb'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_CREATE_DB']}</a><br><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr>");
										echo "<tr>
									    <td><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MYSQL_USERNAME']}</b> </td>
									    <td><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MYSQL_FUNCTIONS']}</b></td>
									  </tr>
									  <tr>
									    <td>".$mysql_user_count['User']."</td>
									 
									    <td><a href='#'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_CHANGE_PASSWORD']}</a> <a href='?section=delete&action=mysqluserdelete'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_DELETE_USER']}</a></td>
									  </tr>";
						        	echo ("</table></td></tr></table></td></tr></table>");
						}
							elseif ($hosting_plan['hosting_user_hosting_plan'] == 3 && $mysql_database_count['COUNT(user)'] >= 1) 
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
						        	<td><a href='/?section=lightuserpanelmysqlcreateuser'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_CREATE_MYSQL_USER']}</a>&nbsp;<a href='/?section=lightuserpanelmysqlcreatedb'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_CREATE_DB']}</a><br><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr>");
									$mysql_select_db = mysql_query("SELECT * FROM mysql.db WHERE User = '{$_SESSION['nick']}' ") or die(mysql_error());
									while ($mysql_user_show = mysql_fetch_array($mysql_select_db)) 
									{
										echo "<tr>
									    <td><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MYSQL_USERNAME']}</b> </td>
									    <td><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MYSQL_HOST']}</b></td>
									    <td><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MYSQL_DATEBASE']}</b></td>
									    <td><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MYSQL_FUNCTIONS']}</b></td>
									  </tr>
									  <tr>
									    <td>".$mysql_user_show['User']."</td>
									    <td>".$mysql_user_show['Host']."</td>
									    <td>".$mysql_user_show['Db']."</td>
									    <td><a href='#'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_CHANGE_PASSWORD']}</a> <a href='?section=delete&action=mysqluserdelete'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_DELETE_USER']}</a> <a href='?section=delete&action=dbdelete'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_DELETE_DB']}</a></td>
									  </tr>";
									}
						        	echo ("</table></td></tr></table></td></tr></table>");
							}
						elseif ($hosting_plan['hosting_user_hosting_plan'] == 4 && $mysql_database_count['COUNT(user)'] == 0) 
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
									echo ("".check_mysql_database_limit()."<hr align='center' noshade='noshade' /> ");
									
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
						        	<td><a href='/?section=lightuserpanelmysqlcreateuser'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_CREATE_MYSQL_USER']}</a>&nbsp;<a href='/?section=lightuserpanelmysqlcreatedb'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_CREATE_DB']}</a><br><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr>");
										echo "<tr>
									    <td><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MYSQL_USERNAME']}</b> </td>
									    <td><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MYSQL_FUNCTIONS']}</b></td>
									  </tr>
									  <tr>
									    <td>".$mysql_user_count['User']."</td>
									 
									    <td><a href='#'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_CHANGE_PASSWORD']}</a> <a href='?section=delete&action=mysqluserdelete'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_DELETE_USER']}</a></td>
									  </tr>";
						        	echo ("</table></td></tr></table></td></tr></table>");
						}
							elseif ($hosting_plan['hosting_user_hosting_plan'] == 4 && $mysql_database_count['COUNT(user)'] >= 1) 
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
						        	<td><a href='/?section=lightuserpanelmysqlcreateuser'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_CREATE_MYSQL_USER']}</a>&nbsp;<a href='/?section=lightuserpanelmysqlcreatedb'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_CREATE_DB']}</a><br><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr>");
									$mysql_select_db = mysql_query("SELECT * FROM mysql.db WHERE User = '{$_SESSION['nick']}' ") or die(mysql_error());
									while ($mysql_user_show = mysql_fetch_array($mysql_select_db)) 
									{
										echo "<tr>
									    <td><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MYSQL_USERNAME']}</b> </td>
									    <td><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MYSQL_HOST']}</b></td>
									    <td><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MYSQL_DATEBASE']}</b></td>
									    <td><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MYSQL_FUNCTIONS']}</b></td>
									  </tr>
									  <tr>
									    <td>".$mysql_user_show['User']."</td>
									    <td>".$mysql_user_show['Host']."</td>
									    <td>".$mysql_user_show['Db']."</td>
									    <td><a href='#'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_CHANGE_PASSWORD']}</a> <a href='?section=delete&action=mysqluserdelete'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_DELETE_USER']}</a> <a href='?section=delete&action=dbdelete'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_DELETE_DB']}</a></td>
									  </tr>";
									}
						        	echo ("</table></td></tr></table></td></tr></table>");
							}
						elseif ($hosting_plan['hosting_user_hosting_plan'] == 5 && $mysql_database_count['COUNT(user)'] == 0) 
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
									echo ("".check_mysql_database_limit()."<hr align='center' noshade='noshade' /> ");
									
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
						        	<td><a href='/?section=lightuserpanelmysqlcreateuser'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_CREATE_MYSQL_USER']}</a>&nbsp;<a href='/?section=lightuserpanelmysqlcreatedb'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_CREATE_DB']}</a><br><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr>");
										echo "<tr>
									    <td><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MYSQL_USERNAME']}</b> </td>
									    <td><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MYSQL_FUNCTIONS']}</b></td>
									  </tr>
									  <tr>
									    <td>".$mysql_user_count['User']."</td>
									 
									    <td><a href='#'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_CHANGE_PASSWORD']}</a> <a href='?section=delete&action=mysqluserdelete'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_DELETE_USER']}</a></td>
									  </tr>";
						        	echo ("</table></td></tr></table></td></tr></table>");
						}
							elseif ($hosting_plan['hosting_user_hosting_plan'] == 5 && $mysql_database_count['COUNT(user)'] >= 1) 
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
						        	<td><a href='/?section=lightuserpanelmysqlcreateuser'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_CREATE_MYSQL_USER']}</a>&nbsp;<a href='/?section=lightuserpanelmysqlcreatedb'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_CREATE_DB']}</a><br><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr>");
									$mysql_select_db = mysql_query("SELECT * FROM mysql.db WHERE User = '{$_SESSION['nick']}' ") or die(mysql_error());
									while ($mysql_user_show = mysql_fetch_array($mysql_select_db)) 
									{
										echo "<tr>
									    <td><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MYSQL_USERNAME']}</b> </td>
									    <td><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MYSQL_HOST']}</b></td>
									    <td><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MYSQL_DATEBASE']}</b></td>
									    <td><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MYSQL_FUNCTIONS']}</b></td>
									  </tr>
									  <tr>
									    <td>".$mysql_user_show['User']."</td>
									    <td>".$mysql_user_show['Host']."</td>
									    <td>".$mysql_user_show['Db']."</td>
									    <td><a href='#'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_CHANGE_PASSWORD']}</a> <a href='?section=delete&action=mysqluserdelete'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_DELETE_USER']}</a> <a href='?section=delete&action=dbdelete'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_DELETE_DB']}</a></td>
									  </tr>";
									}
						        	echo ("</table></td></tr></table></td></tr></table>");
							}
						elseif ($hosting_plan['hosting_user_hosting_plan'] == 6 && $mysql_database_count['COUNT(user)'] >= 1) 
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
						        	<td><a href='/?section=lightuserpanelmysqlcreateuser'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_CREATE_MYSQL_USER']}</a>&nbsp;<a href='/?section=lightuserpanelmysqlcreatedb'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_CREATE_DB']}</a><br><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr>");
									$mysql_select_db = mysql_query("SELECT * FROM mysql.db WHERE User = '{$_SESSION['nick']}' ") or die(mysql_error());
									while ($mysql_user_show = mysql_fetch_array($mysql_select_db)) 
									{
										echo "<tr>
									    <td><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MYSQL_USERNAME']}</b> </td>
									    <td><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MYSQL_HOST']}</b></td>
									    <td><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MYSQL_DATEBASE']}</b></td>
									    <td><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MYSQL_FUNCTIONS']}</b></td>
									  </tr>
									  <tr>
									    <td>".$mysql_user_show['User']."</td>
									    <td>".$mysql_user_show['Host']."</td>
									    <td>".$mysql_user_show['Db']."</td>
									    <td><a href='#'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_CHANGE_PASSWORD']}</a> <a href='?section=delete&action=mysqluserdelete'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_DELETE_USER']}</a> <a href='?section=delete&action=dbdelete'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_DELETE_DB']}</a></td>
									  </tr>";
									}
						        	echo ("</table></td></tr></table></td></tr></table>");
						}
							elseif ($hosting_plan['hosting_user_hosting_plan'] == 6 && $mysql_database_count['COUNT(user)'] == 0) 
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
									echo ("".check_mysql_database_limit()."<hr align='center' noshade='noshade' /> ");
									
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
						        	<td><a href='/?section=lightuserpanelmysqlcreateuser'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_CREATE_MYSQL_USER']}</a>&nbsp;<a href='/?section=lightuserpanelmysqlcreatedb'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_CREATE_DB']}</a><br><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr>");
										echo "<tr>
									    <td><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MYSQL_USERNAME']}</b> </td>
									    <td><b>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MYSQL_FUNCTIONS']}</b></td>
									  </tr>
									  <tr>
									    <td>".$mysql_user_count['User']."</td>
									 
									    <td><a href='#'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_CHANGE_PASSWORD']}</a> <a href='?section=delete&action=mysqluserdelete'>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_LINK_DELETE_USER']}</a></td>
									  </tr>";
						        	echo ("</table></td></tr></table></td></tr></table>");
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