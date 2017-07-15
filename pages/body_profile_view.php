<?php
if ($_SESSION['logged_in']) 
{
	if ($name = ((isset($_GET['name'])) && (ctype_alpha($_GET['name'])) ? $_GET['name'] : ''))		
	{
		true;
	}
	else 
	{
		echo $redirect.false;
	}
		
	if ($_SESSION['permission'] >= 2) 
	{
		
		$select_user_view_profile = mysql_query("SELECT * FROM hosting_user WHERE hosting_user_name = '$name' ");
		if (mysql_numrows($select_user_view_profile) > 0) 
		{
			while ($user_view_profile =  mysql_fetch_array($select_user_view_profile))
			{
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
    <table width='664' border='0' align='center' cellpadding='0' cellspacing='0'>
        <tr>
          <td width='200' ><center><b>Profile Information</b></center></td>
        </tr>
        <tr><a href='/?section=edit&id=".$user_view_profile['hosting_user_id']."&profile=manager&user_mange_id_edit=".$user_view_profile['hosting_user_id']."'>{$lang['BODY_PROFILE_EDIT_LINK']}</a></tr>
        <tr>
          <td><div align='center' ><table width='300' border='0' align='center' cellpadding='0' cellspacing='0' class='ticket'>
      <tr>
        <th scope='col'><img src='{$user_view_profile['hosting_user_avatar']}'></th>
        </tr>
      <tr>
        <th scope='col'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' class='border'>
      <tr>
        
        </tr>
      <tr>
        <th scope='col'>{$lang['BODY_PROFILE_NICK']}:</th>
        <th scope='col'>{$user_view_profile['hosting_user_name']}</th>
        </tr>
      <tr>
        <th scope='col'>{$lang['BODY_PROFILE_JOINED']}:</th>
        <th scope='col'>{$user_view_profile['hosting_user_join']}</th>
        </tr>
      <tr>
        <th scope='col'>{$lang['BODY_PROFILE_GROUP']}:</th>
        <th scope='col'>"; if ($user_view_profile['hosting_user_rights'] == 2) { echo $lang['BODY_PROFILE_GROUP_USER']; } elseif ($user_view_profile['hosting_user_rights'] == 6) { echo $lang['BODY_PROFILE_GROUP_ADMINISTRATOR']; } echo "</th>
        </tr>
      <tr>
        <th scope='col'>{$lang['BODY_PROFILE_EMAIL']}:</th>
        <th scope='col'><a href='mailto:{$user_view_profile['hosting_user_email']}'>{$user_view_profile['hosting_user_email']}</a></th>
      </tr>
      <tr>
        <th scope='col'>{$lang['BODY_PROFILE_STATUS']}:</th>
        <th scope='col'>";
		    if ($user_view_profile['hosting_user_online_status'] == 'yes') 
		    {
		    	echo $lang['BODY_PROFILE_STATUS_ONLINE'];
		    }
		    elseif ($user_view_profile['hosting_user_online_status'] == 'no')
		    {
		    	echo $lang['BODY_PROFILE_STATUS_OFFLINE'];
		    }
		    
		    echo "</th>
      </tr>
      <tr>
        <th scope='col'>{$lang['BODY_PROFILE_HOME_PAGE']}:</th>
        <th scope='col'><a href='{$user_view_profile['hosting_user_homepage']}'>{$user_view_profile['hosting_user_homepage']}</a></th>
      </tr>
      <tr>
        <th scope='col'>{$lang['BODY_PROFILE_GENDER']}:</th>
        <th scope='col'>";
		   if ($user_view_profile['hosting_user_gender'] == 'Male') 
		   {
		   	 echo $lang['BODY_PROFILE_GENDER_MALE'];
		   }
		   elseif ($user_view_profile['hosting_user_gender'] == 'Female')
		   {
		     echo $lang['BODY_PROFILE_GENDER_FEMALE'];
		   }
		    echo "</th>
      </tr>
      <tr>
        <th scope='col'>{$lang['BODY_PROFILE_LAST_TIME_SEEN']}:</th>
        <th scope='col'>{$user_view_profile['hosting_user_last_time_seen']}</th>
      </tr>
        </table></div></th>
      </tr>
      <tr>
        <th scope='col'>{$lang['BODY_PROFILE_MY_SIGNATURE']}:</th>
      </tr>
      <tr>
        <th scope='col'>{$user_view_profile['hosting_user_signature']}</th>
      </tr>
    </table></td>
        </tr>
    </table></td>
  </tr>
</table>";
			}
		}
		else
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