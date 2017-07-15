<?php
if ($_SESSION['logged_in'])
{
	if ($_SESSION['permission'] == 6)
	{
	echo "<table width='900' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='235' valign='top'><div class='border' id='leftdiv'>
        <h3><strong>{$lang['BODY_ADMIN_PANEL_INFORMATION']}</strong> </h3>
        <hr align='center' noshade='noshade' />
       <strong>{$lang['BODY_ADMIN_PANEL_DAILY_TICKETS']}</strong><br />
        <a href='#' class='tooltip'>1<span>{$lang['BODY_ADMIN_PANEL_TOOLTIP_DAILY_TICKETS']}</span></a>  | ~
        <hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_ADMIN_PANEL_CONTACT_MESSAGES']}</strong>s
        </p>
        <br />
        <a href='#'>1</a> | ~
        <hr align='center' noshade='noshade' />
       {$lang['BODY_ADMIN_PANEL_TOTAL_FORUM_THREADS']} <br />
        <a href='#'>1</a> | ~
        <hr align='center' noshade='noshade' />
        <strong>{$lang['BODY_ADMIN_PANEL_LIGHT_ADMIN_PANEL']} </strong><br />
        {$lang['BODY_ADMIN_PANEL_LIGHT_ADMIN_PANEL_NAME']} | {$lang['BODY_ADMIN_PANEL_LIGHT_ADMIN_PANEL_VERSION']} <strong>
        <hr align='center' noshade='noshade' />
      </div></td>
    <td width='665' valign='top'><table width='664' border='0' align='center' cellpadding='0' cellspacing='0' class='border' id='tablehead'>
        <tr>
          <td width='200'><strong>{$lang['BODY_ADMIN_PANEL_CP_NAME']}</strong></td>
        </tr>
        <tr>
          <td valign='bottom'><br />
           <a href='#' class='tooltip'><img src='img/forum.png' width='48' height='48' border='0' /><span>{$lang['BODY_ADMIN_PANEL_TOOLTIP_FORUM']}</span></a> 
            <a href='#' class='tooltip'><img src='img/blog.png' width='48' height='48' border='0' /><span>{$lang['BODY_ADMIN_PANEL_TOOLTIP_BLOG']}</span></a> 
            <a href='#' class='tooltip'><img src='img/news.png' width='48' height='48' border='0' /><span>{$lang['BODY_ADMIN_PANEL_TOOLTIP_NEWS']}</span></a> 
            <a href='#' class='tooltip'><img src='img/user_comment.png' width='48' height='48' border='0' /><span>{$lang['BODY_ADMIN_PANEL_TOOLTIP_COMMENT']}</span></a> 
            <a href='#' class='tooltip'><img src='img/active_directory_LDAP_64.png' width='48' height='48' border='0' /><span>{$lang['BODY_ADMIN_PANEL_TOOLTIP_USER']}</span></a> 
            <a href='#' class='tooltip'><img src='img/ticket-icon.png' width='48' height='48' border='0' /><span>{$lang['BODY_ADMIN_PANEL_TOOLTIP_TICKET']}</span></a>
          </td>
        </tr>
      </table></td>
  </tr>
</table>";
	}
	
	if ($_SESSION['permission'] < 6)
	{
		echo $redirect;
	}
}
else 
{
echo $redirect;
}
?>