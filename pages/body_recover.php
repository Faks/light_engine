<?php
if ($_SESSION['logged_in'])
{
	if ($_SESSION['permission'] >= 2 )
	{
		$select = mysql_query("select * from hosting_maintenance");
		while($row =mysql_fetch_array($select))

		if($row[hosting_maintenance_status ] == "1" )
		{
			echo $row[hosting_maintenance_text];
		}
		else 
		{
			echo "Password Recovery Form is not available while server preparations are in progress !";
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
			echo "Password Recovery Form is not available while server preparations are in progress !";
		}
}
?>