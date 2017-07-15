<?php
if ($_SESSION['logged_in']) 
{
	if ($_SESSION['permission'] >= 2 AND $_SESSION['hosting'] == 1)
	{
		$select_ftp = mysql_query("SELECT * FROM hosting_ftpd WHERE ftpd_owner = '".$_SESSION['nick']."' ") or die (mysql_error());
		if (mysql_numrows($select_ftp) > 0) 
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
			    <td width='665' valign='top'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'><tr><td width='29%'><strong>{$lang['BODY_LIGHT_USER_PANEL_FTP_FORM_NAME']}</strong></td></tr><tr><td><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><center><a href='/?section=lightuserpanelftpsubmit'>{$lang['BODY_LIGHT_USER_PANEL_ADD_FTP_USER']}</a></center><tr><td><b>{$lang['BODY_LIGHT_USER_PANEL_FTP_FORM_USERNAME']}</b>";
			while ($ftp = mysql_fetch_array($select_ftp))
			{       
				echo "<tr><td>".$ftp['User']."</td><td>{$lang['BODY_STATUS']}: ";
				if ($ftp['status'] == 1) 
				{
					echo "<span style='color:darkgreen;'>{$lang['BODY_ACTIVE']}</span>";
				}
				elseif ($ftp['status'] == 0)
				{
					echo "<span style='color:red;'>{$lang['BODY_INACTIVE']}</span>";
				}
				echo " | ";
				if ($_SESSION['permission'] == 2 AND $_SESSION['hosting'] == 1)
				{			
						if ($ftp['ftpd_owner'] == $_SESSION['nick'])
						{
							echo "<a href='/?section=edit&id=".$ftp['ftpd_id']."&action=ftpnedit&id_edit=".$ftp['ftpd_id']."'>{$lang['BODY_LIGHT_USER_PANEL_FTP_CHANGE_NAME']}</a>"."&nbsp;<a href='/?section=edit&id=".$ftp['ftpd_id']."&action=ftppedit&id_edit=".$ftp['ftpd_id']."'>{$lang['BODY_LIGHT_USER_PANEL_FTP_CHANGE_PASS']}</a>&nbsp;"."<a href='/?section=lightuserpanelftpmanage&action=delete&id_delete=".$ftp['ftpd_id']."'>{$lang['BODY_DELETE']}</a>";
							if ($_GET['action'] == 'delete') 
							{
								$comment_id_delete = (INT)$_GET['id_delete'];
								mysql_query("DELETE FROM hosting_ftpd WHERE ftpd_id  = '".$comment_id_delete."' AND ftpd_owner = '".$_SESSION['nick']."' ") or die (mysql_error());
								echo "<meta http-equiv='REFRESH' content='0;url=/?section=lightuserpanelftpmanage'>"; 
							}
						}
				}
				elseif ($_SESSION['permission'] == 6 AND $_SESSION['hosting'] == 1 AND $_SESSION['admin'] == 1)
				{
					echo "<a href='/?section=edit&id=".$ftp['ftpd_id']."&action=ftpnedit&id_edit=".$ftp['ftpd_id']."'>{$lang['BODY_LIGHT_USER_PANEL_FTP_CHANGE_NAME']}</a>"."&nbsp;<a href='/?section=edit&id=".$ftp['ftpd_id']."&action=ftppedit&id_edit=".$ftp['ftpd_id']."'>{$lang['BODY_LIGHT_USER_PANEL_FTP_CHANGE_PASS']}</a>&nbsp;"."<a href='/?section=lightuserpanelftpmanage&action=delete&id_delete=".$ftp['ftpd_id']."'>{$lang['BODY_DELETE']}</a>";
					if ($_GET['action'] == 'delete') 
					{
						$comment_id_delete = (INT)$_GET['id_delete'];
						mysql_query("DELETE FROM hosting_ftpd WHERE ftpd_id  = '".$comment_id_delete."' ") or die (mysql_error());
						echo "<meta http-equiv='REFRESH' content='0;url=/?section=lightuserpanelftpmanage'>"; 
					}
				}
				 
				echo "</td></tr>";	
			}
			echo "</table></td></tr></table></td></tr></table>";
		}
		else
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
			        <td width='29%'><strong>{$lang['BODY_LIGHT_USER_PANEL_DOMAIN_MANAGE']}</strong></td>
			        </tr>
			       <tr><td>{$lang['BODY_LIGHT_USER_PANEL_FTP_NOT_YET_ADDED']}
			       <br>
			      <b><a href='/?section=lightuserpanelftpsubmit'>{$lang['BODY_LIGHT_USER_PANEL_FTP_LINK_ADD_NOW']}</a>
			       </td></tr></table></td></tr></table>";
		}
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