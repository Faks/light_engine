<?php
if ($_SESSION['logged_in'])
{
	
	if ($_SESSION['permission'] >= 2 AND $_SESSION['hosting'] == 1)
	{
	 	$support_select = mysql_query("SELECT * FROM hosting_support WHERE ticket_nick = '{$_SESSION['nick']}' ORDER BY ticket_time desc LIMIT 10");
	 	$check_limit = mysql_query("SELECT COUNT(ticket_nick) FROM hosting_support WHERE ticket_nick = '{$_SESSION['nick']}' AND ticket_date = CURDATE()");
		while ($support_check = mysql_fetch_array($check_limit))	
		if (mysql_num_rows($support_select) != 0)
		{
			echo "<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='235' valign='top'><div class='border' id='leftdiv'>
    <h3><strong>{$lang['BODY_LIGHT_SUPPORT_PANEL_NAME'] }</strong>
    </h3><hr align='center' noshade='noshade' />
    <strong>{$lang['BODY_ADMIN_PANEL_DAILY_TICKETS']}</strong><br />".$support_check['COUNT(ticket_nick)']." | "; 
			echo "".check_ticket_limit()."
    <hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_LIGHT_SUPPORT_PANEL_GET_HELP']}</strong><br /><a href='/?section=lightusersupportpanelsubmit'>{$lang['BODY_LIGHT_SUPPORT_PANEL_GET_HELP_LINK_NAME']}</a></strong>
      <hr align='center' noshade='noshade' />
       <strong>{$lang['BODY_LIGHT_SUPPORT_PANEL']}
        </strong><br />
        {$lang['BODY_LIGHT_SUPPORT_PANEL_NAME_VERSION']}
      <strong>
      <hr align='center' noshade='noshade' /></div></td>
    <td width='665' valign='top'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'>
  <tr>
    <td width='200'><strong>{$lang['BODY_LIGHT_SUPPORT_PANEL_TICKET_NUMBER']}</strong></td>
    <td width='200'><strong>{$lang['BODY_LIGHT_SUPPORT_PANEL_TICKET_SUBJECT']}</strong></td>
    <td width='200'><strong>{$lang['BODY_LIGHT_SUPPORT_PANEL_TICKET_DOMAIN']}</strong></td>
    <td width='200'><strong>{$lang['BODY_LIGHT_SUPPORT_PANEL_TICKET_STATUS']}</strong></td>
  </tr>";
		
	 	while ($support_print = mysql_fetch_array($support_select))
	 		{		 	
	 			echo "<tr><td><a href='/?section=lightusersupportpanelview&id={$support_print['ticket_id']}'>{$support_print['ticket_id']}</a></td><td>".$support_print[ticket_title].'</td><td>'.$support_print[ticket_domain_name].'</td><td>';
	if ($support_print[ticket_status] == "0" AND $_SESSION['hosting'] == 1)
	{
		echo $lang['BODY_LIGHT_SUPPORT_PANEL_STATUS_0'];
	}
	elseif ($support_print[ticket_status] == "1" AND $_SESSION['hosting'] == 1 )
	{
		echo $lang['BODY_LIGHT_SUPPORT_PANEL_STATUS_1'];	
	}
	elseif ($support_print[ticket_status] == "2" AND $_SESSION['hosting'] == 1)
	{
		echo $lang['BODY_LIGHT_SUPPORT_PANEL_STATUS_2'];
	}
	elseif ($support_print[ticket_status] == "3" AND $_SESSION['hosting'] == 1)
	{
		echo $lang['BODY_LIGHT_SUPPORT_PANEL_STATUS_3'];
	}	
	echo '</td></tr>';
	 			
	 		};
	 			echo "</tr></table></td>
  </tr>
</table>";
		}
		else
	 		{
	 			echo "<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='235' valign='top'><div class='border' id='leftdiv'>
    <h3><strong>{$lang['BODY_LIGHT_SUPPORT_PANEL_NAME']}</strong>
    </h3><hr align='center' noshade='noshade' />
    <strong>{$lang['BODY_ADMIN_PANEL_DAILY_TICKETS']}</strong><br />".$support_check['COUNT(ticket_nick)']." | "; 
			echo "".check_ticket_limit()."
    <hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_LIGHT_SUPPORT_PANEL_GET_HELP']}</strong><br /><a href='/?section=lightusersupportpanelsubmit'>{$lang['BODY_LIGHT_SUPPORT_PANEL_GET_HELP_LINK_NAME']}</a></strong>
      <hr align='center' noshade='noshade' />
       <strong>{$lang['BODY_LIGHT_SUPPORT_PANEL']}
        </strong><br />
        {$lang['BODY_LIGHT_SUPPORT_PANEL_NAME_VERSION']}
      <strong>
      <hr align='center' noshade='noshade' /></div></td>
    <td width='665' valign='top'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'>
  <tr>
    <td><strong>{$lang['BODY_LIGHT_SUPPORT_PANEL_NOT_YET_DONE']}</strong></td>
  </tr>
  </table></td>
  </tr>
</table>";
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