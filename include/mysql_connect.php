<?php
@$mysql = mysql_connect('localhost','myuser','mypw');
if (!$mysql)
{
	die('<span style=color:red><center>Mysql Server having issues,please wait until server god resolves it</center></span>');
}

$database_select = mysql_select_db('hosting');
if (!$database_select)
{
	die ('Mysql Server Could Select Database'.mysql_error());
}	
?>
