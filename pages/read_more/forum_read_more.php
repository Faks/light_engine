<?php
if ($_SESSION['logged_in'])
{
	if ($_SESSION['permission'] >= 2 )
	{
		if ($id = ((isset($_GET['id'])) && (ctype_digit($_GET['id'])) ? (int)$_GET['id'] : ''))		
		{
			forum_read_more($submit_validation_check,$id,$forum_view,$count_comment,$bbcode,$lang,$redirect);
		}
		else 
		{
			echo $redirect.false;
		}	
	}
}
else 
{
	echo $redirect;
	/*
	if ($id = ((isset($_GET['id'])) && (ctype_digit($_GET['id'])) ? (int)$_GET['id'] : ''))		
	{
		forum_read_more($submit_validation_check,$id,$forum_view,$count_comment,$bbcode,$lang,$redirect);
	}
	else 
	{
		echo $redirect.false;
	}
	*/
}
?>