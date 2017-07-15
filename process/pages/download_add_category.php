<?php
if ($_SESSION['logged_in']) 
{
	if ($_SESSION['permission'] == 2) 
	{
		echo $redirect;
	}
	elseif ($_SESSION['permission'] >= 3)
	{
		require 'process/functions/functions_process_add.php';
		
		#Grupas parbaude lietotajam
		$group_check = mysql_query("SELECT hosting_user_name,hosting_user_sysop_rights,hosting_user_administrator_rights,hosting_user_moderator_rights,hosting_user_vip_rights FROM hosting_user WHERE hosting_user_name = '".$_SESSION['nick']."' ") or die (mysql_error());
		$group = mysql_fetch_array($group_check);
			
		if ($group['hosting_user_sysop_rights'] == "yes") #Sistemas administrators
		{
			
			if ($id = ((isset($_GET['id'])) && (ctype_digit($_GET['id'])) ? (int)$_GET['id'] : ''))
			{
				download_add_game_category($errors,$error,$token,$lang);
			}
			else
			{
				echo $redirect;
			}
		}
		elseif ($group['hosting_user_administrator_rights'] == "yes") #Administrators
		{
			#
		}
		elseif ($group['hosting_user_moderator_rights'] == "yes") #Moderators
		{
			echo "Moderatori Nevar Pievienot Speles";
		}
	}
}
else
{
	echo $redirect;
}
?>