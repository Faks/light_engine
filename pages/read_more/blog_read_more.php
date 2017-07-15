<?php
if ($_SESSION['logged_in']) 
{
	if ($id = ((isset($_GET['id'])) && (ctype_digit($_GET['id'])) ? (int)$_GET['id'] : ''))
	{
		blog_read_more($id,$row_blog,$bbcode,$redirect);
		blog_read_more_comment($id,$comment_limit,$row_blog_comment,$bbcode,$lang,$date_comment,$time_comment,$errors,$error,$token);
	}
	else
	{
		echo $redirect.false;
	}
}
else
{
	if ($id = ((isset($_GET['id'])) && (ctype_digit($_GET['id'])) ? (int)$_GET['id'] : ''))
	{
		blog_read_more($id,$row_blog,$bbcode,$redirect);
		blog_read_more_comment($id,$comment_limit,$row_blog_comment,$bbcode,$lang,$date_comment,$time_comment,$errors,$error,$token);
	}
	else
	{
		echo $redirect.false;
	}
}					
?>