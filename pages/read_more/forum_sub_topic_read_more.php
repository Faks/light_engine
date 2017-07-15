<?php
if ($_SESSION['logged_in'])
{	
	if ($_SESSION['permission'] >= 2 )
	{
		if ($id = ((isset($_GET['id'])) && (ctype_digit($_GET['id'])) ? (int)$_GET['id'] : ''))		
		{
			forum_sub_topic_read_more($id,$forum_view,$bbcode,$comment_user_information,$user_comments,$redirect);
			forum_sub_topic_read_more_comment($id,$forum_view_check,$comment_limit,$forum_comment_thread,$bbcode,$comment_user_information,$user_comments,$lang,$date_comment,$time_comment,$errors,$error,$token);
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
}
?>