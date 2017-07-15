<?php
if ($_SESSION['logged_in'])
{
	if ($_SESSION['permission'] >= 2)
	{
		$select = mysql_query("select * from hosting_maintenance");
		while($row =mysql_fetch_array($select))
		if($row[hosting_maintenance_status ] == "1" )
		{
			echo $row[hosting_maintenance_text];
		}
		else 
		{
			$hosting = mysql_query("SELECT COUNT(hosting_domain_id) FROM hosting_domain");
			while($row_hosting = mysql_fetch_array($hosting))
			if($row_hosting['COUNT(hosting_domain_id)'] != "0")
			{	
				echo "{$lang['BODY_PROGRESS_TEXT']} ".$row_hosting['COUNT(hosting_domain_id)']." {$lang['BODY_PROGRESS_WEBSITES']}";	
			}
			else
				{
					echo $lang['BODY_PROGRESS_DONT_HOST_ANY'];
				}
	
					if ($row_hosting['COUNT(hosting_domain_id)'] == "100")
					{
						echo "<br>".$lang['BODY_PROGRESS_LIMIT'];
					}	
		}
	}
}
else 
{
		$select = mysql_query("select * from hosting_maintenance");
		while($row =mysql_fetch_array($select))
		if($row[hosting_maintenance_status ] == "1" )
		{
			echo $row[hosting_maintenance_text];
		}
		else 
		{
			$hosting = mysql_query("SELECT COUNT(hosting_domain_id) FROM hosting_domain");
			while($row_hosting = mysql_fetch_array($hosting))
			if($row_hosting['COUNT(hosting_domain_id)'] != "0")
			{	
				echo "{$lang['BODY_PROGRESS_TEXT']} ".$row_hosting['COUNT(hosting_domain_id)']." {$lang['BODY_PROGRESS_WEBSITES']}";	
			}
			else
				{
					echo $lang['BODY_PROGRESS_DONT_HOST_ANY'];
				}
	
					if ($row_hosting['COUNT(hosting_domain_id)'] == "100")
					{
						echo "<br>".$lang['BODY_PROGRESS_LIMIT'];
					}	
		}
}
?>