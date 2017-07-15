<?php
if ($_SESSION['logged_in'])
{
	if ($_SESSION['permission'] >= 2 AND $_SESSION['hosting'] == 1 )
	{
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
    <td width='665' valign='top'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'>
      <tr>
        <td width='29%'><strong>{$lang['BODY_LIGHT_USER_PANEL_MANAGE']}</strong></td>
        <td width='27%'><strong>{$lang['BODY_LIGHT_USER_PANEL_FILE_MANAGE']}</strong></td>
        <td width='24%'><strong>{$lang['BODY_LIGHT_USER_PANEL_MYSQL_MANAGE']}</strong></td>
      </tr>
      <tr>
        <td valign='top'>
        <a href='/?section=lightuserpaneldomainmanage'>{$lang['BODY_LIGHT_USER_PANEL_MANAGE_DOMAIN']}</a><br />
		<a href='/?section=lightuserpanelftpmanage'>{$lang['BODY_LIGHT_USER_PANEL_MANAGE_FTP']}</a><br />
		</td>
        <td valign='top'><a href='http://net2ftp.hostings.flush.ws/'>{$lang['BODY_LIGHT_USER_PANEL_NET2FTP']}</a></td>
        <td valign='top' width='35%'>	
        <a href='/?section=lightuserpanelmysqlmanage'>{$lang['BODY_LIGHT_USER_PANEL_MANAGE_MYSQL']}</a><br />
	<a href='http://phpmyadmin.hostings.flush.ws/'>{$lang['BODY_LIGHT_USER_PANEL_PHPMYADMIN']}</a><br />
	<a href='http://sqlbuddy.hostings.flush.ws/'>{$lang['BODY_LIGHT_USER_PANEL_SQLBUDDY']}</a></td>
      </tr>
    </table></td>
  </tr>
</table>");	
	}
	
	if($_SESSION['permission'] <= 2 AND $_SESSION['hosting'] == 0)
	{
		echo $redirect;
	}
}
else
{
	echo $redirect;	
}	
?>