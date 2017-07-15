<?php
@$mysql = mysql_connect('127.0.0.1','myuser','mypw');
if (!$mysql)
{
die('<span style=color:red><center>Mysql Server Is Offline Or Is Overloaded Please Try Again later</center></span>');
}

$database_select = mysql_select_db('hosting');
if (!$database_select)
{
die ('Mysql Server Could Select Database'.mysql_error());
}	
?>